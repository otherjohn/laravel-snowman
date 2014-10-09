<?php namespace Yhbyun\Snowman\Commands;

use Symfony\Component\Console\Input\InputArgument;

class RepositoryInterfaceGeneratorCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'snowman:repositoryinterface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a repository interface';

    /**
     * The path where the file will be created
     *
     * @return mixed
     */
    protected function getFileGenerationPath()
    {
        $path = $this->getPathByOptionOrConfig('path', 'repository_interface_target_path');

        return $path . '/' . ucwords(camel_case($this->argument('modelName'))) . 'RepositoryInterface.php';
    }

    /**
     * Fetch the template data
     *
     * @return array
     */
    protected function getTemplateData()
    {
        return [
            'APPNAME' => ucwords($this->argument('appName')),
            'NAME' => ucwords(camel_case($this->argument('modelName')))
        ];
    }

    /**
     * Get path to the template for the generator
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return $this->getPathByOptionOrConfig('templatePath', 'repository_interface_template_path');
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
