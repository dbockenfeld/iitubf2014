<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//$root = dirname(__FILE__) . '/..';
$params = array_merge(
        require('params.php'), 
        require('params-local.php')
);

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'University Bible Fellowship at IIT',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
//			'ipFilters'=>array('127.0.0.1','::1'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '' => 'site/index',
                '<action:\w+>' => 'site/<action>',
                '<action:\w+>/<year:\d+>/<month:\d+>/<day:\d+>/' => 'site/<action>/year/<year>/month/<month>/day/<day>',
                '<action:\w+>/<year:\d+>/<month:\d+>/<day:\d+>/<name:\w+>.html' => 'site/<action>/year/<year>/month/<month>/day/<day>/name/<name>',
//                'admin' => 'admin/index',
            ),
            'showScriptName' => false,
        ),
//        'db' => array(
//            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
//        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => $params['db.connectionString'],
            'emulatePrepare' => true,
            'username' => $params['db.username'],
            'password' => $params['db.password'],
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
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            
//              array(
//              'class'=>'CWebLogRoute',
//              ),
             
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'update@iitubf.org',
    ),
);
