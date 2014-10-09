<?php namespace Yhbyun\Snowman\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputArgument;
use Yhbyun\Snowman\Filesystem\FileAlreadyExists;
use Yhbyun\Snowman\Filesystem\Filesystem;
use Yhbyun\Snowman\Filesystem\FolderError;

class ScaffoldGeneratorCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'snowman:scaffold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold a new app';

    /**
     * Generate a resource
     *
     * @return mixed
     */
    public function fire()
    {
        $appName = $this->argument('appName');

        $appPath = Config::get("snowman::config.target_parant_path")
            . '/' . ucwords($appName);

        $paths = [
            $appPath,
            $appPath . '/Presenters',
            $appPath . '/Providers',
            $appPath . '/Repositories',
            $appPath . '/Repositories/Eloquent',
        ];

        foreach ($paths as $path) {
            try {
                $path = ucwords($path);
                $this->createFolder($path);
            } catch (FileAlreadyExists $e) {
                $this->error("The folder, {$path}, already exists!");

                return;
            } catch (FolderError $e) {
                $this->error("Failed to create folder, {$path}");

                return;
            }
        }

        $this->callBaseRepository($appName, $appPath);
        $this->callBaseRepositoryInterface($appName, $appPath);
        $this->callRepositoryServiceProvider($appName, $appPath);

        // All done!
        $this->info(sprintf(
            "All done!"
        ));

    }

    /**
     * Call baserepositorysitory generator
     *
     * @param $appName
     * @param $appPath
     */
    protected function callBaseRepository($appName, $appPath)
    {
        $this->call('snowman:baserepositorysitory', ['appName' => $appName,
            '--path' => $appPath . '/Repositories/Eloquent']);
    }

    /**
     * Call baserepositoryinterface generator
     *
     * @param $appName
     * @param $appPath
     */
    protected function callBaseRepositoryInterface($appName, $appPath)
    {
        $this->call('snowman:baserepositoryinterface', ['appName' => $appName,
            '--path' => $appPath . '/Repositories']);
    }

    /**
     * Call repositoryserviceprovider generator
     *
     * @param $appName
     * @param $appPath
     */
    protected function callRepoServiceProvider($appName, $appPath)
    {
        $this->call('snowman:repositoryserviceprovider', ['appName' => $appName,
            '--path' => $appPath . '/Providers']);
    }

    /**
     * Create folder
     *
     * @param $path
     */
    protected function createFolder($path)
    {
        $file = new Filesystem;

        $file->mkdir($path);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['appName', InputArgument::REQUIRED, 'The namespace of the App']
        ];
    }
}
