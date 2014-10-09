<?php namespace Yhbyun\Snowman\Commands;

use Symfony\Component\Console\Input\InputArgument;

class BaseRepositoryGeneratorCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'snowman:baserepository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a baserepository';

    /**
     * The path where the file will be created
     *
     * @return mixed
     */
    protected function getFileGenerationPath()
    {
        $path = $this->getPathByOptionOrConfig('path', 'baserepository_target_path');

        return $path . '/BaseRepository.php';
    }

    /**
     * Fetch the template data
     *
     * @return array
     */
    protected function getTemplateData()
    {
        return [
            'APPNAME' => ucwords($this->argument('appName'))
        ];
    }

    /**
     * Get path to the template for the generator
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return $this->getPathByOptionOrConfig('templatePath', 'baserepository_template_path');
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
