<?php

$config = [
    'module' => [
        'url' => '/admin',
        'layout' => 'Admin',
    ],

    'views' => [
        'index',
        'edit',
        'show',
        'create',
    ],

    /*
     * Directory containing the templates
     * If you want to use your custom templates, specify them here
     * */
    'templates' => 'vendor.crud.single-page-templates',

];

    /*
     * Layout template used when generating views
     * */
    $config['layout'] = $config['templates'].'.common.app';

return $config;