<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$params = array_merge(
        require('params.php'), require('params-local.php')
);

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'params' => $params,
    'name' => 'IIT UBF Console Application',
    // preloading 'log' component
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => $params['db.connectionString'],
            'emulatePrepare' => true,
            'username' => $params['db.username'],
            'password' => $params['db.password'],
            'charset' => 'utf8',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
);
