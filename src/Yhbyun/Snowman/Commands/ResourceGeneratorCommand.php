<?php namespace Yhbyun\Snowman\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputArgument;
use Yhbyun\Snowman\Filesystem\FileNotFound;
use Yhbyun\Snowman\Filesystem\Filesystem;

class ResourceGeneratorCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'snowman:resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new resource';

    /**
     * Generate a resource
     *
     * @return mixed
     */
    public function fire()
    {
        $appName = $this->argument('appName');
        $modelName = $this->argument('modelName');

        $appPath = Config::get("snowman::config.target_parant_path")
            . '/' . ucwords($appName);

        $this->callRepository($appName, $modelName, $appPath);
        $this->callRepositoryInterface($appName, $modelName, $appPath);
        $this->callModel($appName, $modelName, $appPath);
        $this->callPresenter($appName, $modelName, $appPath);

        if ($this->confirm("Do you want me to add $modelName binding code to RepositoryServiceProvider.php? [yes|no]")) {
            $file = new Filesystem;
            $repositoryPath = $appPath . '/Providers/RepositoryServiceProvider.php';

            try {
                $contents = $file->get($repositoryPath);
            } catch (FileNotFound $e) {
                $this->error("The file, {$repositoryPath}, does not exist.");

                return;
            }

            $appName = ucwords($appName);
            $modelName = ucwords(camel_case($modelName));

            $newCode = <<<EOF
public function register()
    {
        \$this->app->bind(
            '{$appName}\\Repositories\\{$modelName}RepositoryInterface',
            '{$appName}\\Repositories\\Eloquent\\{$modelName}Repo'
        );

EOF;
            $contents = str_replace(
                "public function register()\n    {",
                $newCode,
                $contents
            );

            $file->make($repositoryPath, $contents, true);
            $this->info("The file, {$repositoryPath}, was modified.");
        }

        // All done!
        $this->info(sprintf(
            "All done!"
        ));

    }

    /**
     * Call repository generator
     *
     * @param $appName
     * @param $modelName
     * @param $appPath
     */
    protected function callRepository($appName, $modelName, $appPath)
    {
        $this->call('snowman:repository', ['appName' => $appName,
            'modelName' => $modelName,
            '--path' => $appPath . '/Repositories/Eloquent']);
    }

    /**
     * Call repositoryinterface generator
     *
     * @param $appName
     * @param $modelName
     * @param $appPath
     */
    protected function callRepositoryInterface($appName, $modelName, $appPath)
    {
        $this->call('snowman:repositoryinterface', ['appName' => $appName,
            'modelName' => $modelName,
            '--path' => $appPath . '/Repositories']);
    }

    /**
     * Call model generator
     *
     * @param $appName
     * @param $modelName
     * @param $appPath
     */
    protected function callModel($appName, $modelName, $appPath)
    {
        $this->call('snowman:model', ['appName' => $appName,
            'modelName' => $modelName,
            '--path' => $appPath]);
    }

    /**
     * Call presenter generator
     *
     * @param $appName
     * @param $presenterName
     * @param $appPath
     */
    protected function callPresenter($appName, $presenterName, $appPath)
    {
        $this->call('snowman:presenter', ['appName' => $appName,
            'presenterName' => $presenterName,
            '--path' => $appPath . '/Presenters']);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['appName', InputArgument::REQUIRED, 'The namespace of the App'],
            ['modelName', InputArgument::REQUIRED, 'The name of the desired model']
        ];
    }
}
