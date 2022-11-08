<?php

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

use Phalcon\Config ;

return new Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => 'database',
        'username' => 'root',
        'password' => 'fycphalcon',
        'dbname' => 'fycphalcon',
        'charset' => 'utf8'
    ],
    'application'=> [
        'appDir' => APP_PATH . '/' ,
        'controllersDir' => APP_PATH . '/controllers/' ,
        'modelsDir' => APP_PATH . '/models/' ,
        'migrationsDir' => APP_PATH . '/migrations/' ,
        'viewsDir' => APP_PATH . '/views/',
        'pluginsDir' => APP_PATH . '/plugins/',
        'libraryDir' => APP_PATH . '/library/',
        'cacheDir' => BASE_PATH . '/cache/',
        'baseUri' => '/',
        'ApiUri' =>'/api'
    ]
]);