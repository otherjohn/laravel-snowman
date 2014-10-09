<?php namespace Yhbyun\Snowman\Commands;

use Symfony\Component\Console\Input\InputArgument;

class BaseRepositoryInterfaceGeneratorCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'snowman:baserepositoryinterface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a baserepositoryinterface';

    /**
     * The path where the file will be created
     *
     * @return mixed
     */
    protected function getFileGenerationPath()
    {
        $path = $this->getPathByOptionOrConfig('path', 'baserepository_interface_target_path');

        return $path . '/BaseRepositoryInterface.php';
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
        return $this->getPathByOptionOrConfig('templatePath', 'baserepository_interface_template_path');
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
