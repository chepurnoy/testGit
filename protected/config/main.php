<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$localConfig = file_exists(dirname(__FILE__) . '/local.php') ? require_once (dirname(__FILE__) . '/local.php') : array();
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Main',
    // preloading 'log' component
    'preload' => array(
        'log',
        'bootstrap'
    ),
    // autoloading model and component classes
    'import' => array(
        'application.extensions.*',
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.extensions.cocoCod.*',
    ),
    'modules' => array(
        'admin',
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'igor',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('10.8.4.155', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii'
            ),
        ),
    ),
    // application components
    'components' => array(
        'bootstrap' => array(
            'class' => 'application.extensions.yiibooster.components.Bootstrap',
        ),
        'authManager' => array(
            'class' => 'AuthManager',
            // Default role
            'defaultRoles' => array('guest'),
        ),
        'user' => array(
            'class' => 'WebUser',
            'table' => 'UserModel',
            'fieldRole' => 'type',
            'loginUrl' => array('site/login'),
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'gii' => 'gii',
                'admin' => 'admin/default/index',
                '<alias:[\w\-]+>' => 'site/page',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        /* 'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
         *
         */
// uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=git',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
// use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
// using Yii::app()->params['paramName']
    'params' => array(
        'adminEmail' => 'i@mail',
        'login' => 'root',
        'password' => 'root1234',
    ),
);
