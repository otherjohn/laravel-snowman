<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Where the templates for the snowman are stored...
    |--------------------------------------------------------------------------
    |
    */

    'model_template_path' => 'vendor/yhbyun/snowman/src/Yhbyun/Snowman/templates/model.txt',
    'repository_template_path' => 'vendor/yhbyun/snowman/src/Yhbyun/Snowman/templates/repository.txt',
    'repository_interface_template_path' => 'vendor/yhbyun/snowman/src/Yhbyun/Snowman/templates/repository_interface.txt',
    'baserepository_template_path' => 'vendor/yhbyun/snowman/src/Yhbyun/Snowman/templates/baserepository.txt',
    'baserepository_interface_template_path' => 'vendor/yhbyun/snowman/src/Yhbyun/Snowman/templates/baserepository_interface.txt',
    'presenter_template_path' => 'vendor/yhbyun/snowman/src/Yhbyun/Snowman/templates/presenter.txt',
    'repositoryserviceprovider_template_path' => 'vendor/yhbyun/snowman/src/Yhbyun/Snowman/templates/repositoryserviceprovider.txt',

    /*
    |--------------------------------------------------------------------------
    | Where the generated files will be saved...
    |--------------------------------------------------------------------------
    |
    */

    'target_parant_path' => app_path(),
    'model_target_path' => app_path() . '/$APPNAME$',
    'repository_target_path' => app_path() . '/$APPNAME$/Repositories/Eloquent',
    'repository_interface_target_path' => app_path() . '/$APPNAME$/Repositories',
    'baserepository_target_path' => app_path() . '/$APPNAME$/Repositories/Eloquent',
    'baserepository_interface_target_path' => app_path() . '/$APPNAME$/Repositories',
    'presenter_target_path' => app_path() . '/$APPNAME$/Presenters',
];
