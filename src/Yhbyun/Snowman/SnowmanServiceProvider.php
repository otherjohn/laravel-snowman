<?php namespace Yhbyun\Snowman;

use Illuminate\Support\ServiceProvider;
use Yhbyun\Snowman\Commands\BaseRepositoryGeneratorCommand;
use Yhbyun\Snowman\Commands\BaseRepositoryInterfaceGeneratorCommand;
use Yhbyun\Snowman\Commands\ModelGeneratorCommand;
use Yhbyun\Snowman\Commands\PresenterGeneratorCommand;
use Yhbyun\Snowman\Commands\PublishTemplatesCommand;
use Yhbyun\Snowman\Commands\RepositoryGeneratorCommand;
use Yhbyun\Snowman\Commands\RepositoryInterfaceGeneratorCommand;
use Yhbyun\Snowman\Commands\RepositoryServiceProviderGeneratorCommand;
use Yhbyun\Snowman\Commands\ResourceGeneratorCommand;
use Yhbyun\Snowman\Commands\ScaffoldGeneratorCommand;

/**
 * Class SnowmanServiceProvider
 * @package Yhbyun\Snowman
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class SnowmanServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('yhbyun/snowman');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach ([
                    'Model',
                    'Repository',
                    'RepositoryInterface',
                    'BaseRepository',
                    'BaseRepositoryInterface',
                    'Presenter',
                    'RepositoryServiceProvider',
                    'Scaffold',
                    'Resource',
                    'Publisher',
                ] as $command) {
            $this->{"register$command"}();
        }
    }

    /**
     * Register the model generator
     */
    protected function registerModel()
    {
        $this->app['snowman.model'] = $this->app->share(function ($app) {
            $generator = $app->make('Yhbyun\Snowman\Generator');

            return new ModelGeneratorCommand($generator);
        });

        $this->commands('snowman.model');
    }

    /**
     * Register the repository generator
     */
    protected function registerRepository()
    {
        $this->app['snowman.repository'] = $this->app->share(function ($app) {
            $generator = $app->make('Yhbyun\Snowman\Generator');

            return new RepositoryGeneratorCommand($generator);
        });

        $this->commands('snowman.repository');
    }

    /**
     * Register the repositoryinterface generator
     */
    protected function registerRepositoryInterface()
    {
        $this->app['snowman.repositoryinterface'] = $this->app->share(function ($app) {
            $generator = $app->make('Yhbyun\Snowman\Generator');

            return new RepositoryInterfaceGeneratorCommand($generator);
        });

        $this->commands('snowman.repositoryinterface');
    }

    /**
     * Register the baserepository generator
     */
    protected function registerBaseRepository()
    {
        $this->app['snowman.baserepository'] = $this->app->share(function ($app) {
            $generator = $app->make('Yhbyun\Snowman\Generator');

            return new BaseRepositoryGeneratorCommand($generator);
        });

        $this->commands('snowman.baserepository');
    }

    /**
     * Register the baserepositoryinterface generator
     */
    protected function registerBaseRepositoryInterface()
    {
        $this->app['snowman.baserepositoryinterface'] = $this->app->share(function ($app) {
            $generator = $app->make('Yhbyun\Snowman\Generator');

            return new BaseRepositoryInterfaceGeneratorCommand($generator);
        });

        $this->commands('snowman.baserepositoryinterface');
    }

    /**
     * Register the presenter generator
     */
    protected function registerPresenter()
    {
        $this->app['snowman.presenter'] = $this->app->share(function ($app) {
            $generator = $app->make('Yhbyun\Snowman\Generator');

            return new PresenterGeneratorCommand($generator);
        });

        $this->commands('snowman.presenter');
    }

    /**
     * Register the repositoryserviceprovider generator
     */
    protected function registerRepositoryServiceProvider()
    {
        $this->app['snowman.repositoryserviceprovider'] = $this->app->share(function ($app) {
            $generator = $app->make('Yhbyun\Snowman\Generator');

            return new RepositoryServiceProviderGeneratorCommand($generator);
        });

        $this->commands('snowman.repositoryserviceprovider');
    }

    /**
     * Register the regtsterscaffold generator
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    protected function registerScaffold()
    {
        $this->app['snowman.scaffold'] = $this->app->share(function ($app) {
            return new ScaffoldGeneratorCommand;
        });

        $this->commands('snowman.scaffold');
    }

    /**
     * Register the regtsterresource generator
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    protected function registerResource()
    {
        $this->app['snowman.resource'] = $this->app->share(function ($app) {
            return new ResourceGeneratorCommand;
        });

        $this->commands('snowman.resource');
    }

    /**
     * register command for publish templates
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function registerPublisher()
    {
        $this->app['snowman.publish-templates'] = $this->app->share(function ($app) {
            return new PublishTemplatesCommand;
        });

        $this->commands('snowman.publish-templates');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
