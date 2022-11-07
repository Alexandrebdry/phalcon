<?php
/*
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);
$loader->register();

// Create a DI
$di = new FactoryDefault();

// Setup the view component
$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

// Setup a base URI
$di->set(
    'url',
    function () {
        $url = new UrlProvider();
        $url->setBaseUri('/');
        return $url;
    }
);
// la route sera toujours / nom du controller / action du controller

$di->set(
    'db',
    function () {
        return new DbAdapter(
            [
                'adapter'  => 'Mysql',
                'host'     => 'database',
                'username' => 'root',
                'password' => 'fycphalcon',
                'dbname'   => 'fycphalcon',
            ]
        );
    }
);

$application = new Application($di);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}

*/

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\Collection as MicroCollection;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;


define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();


$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);
$loader->register();

$di = new FactoryDefault() ; 
$di->set(
    'db',
    function () {
        return new DbAdapter(
            [
                'adapter'  => 'Mysql',
                'host'     => 'database',
                'username' => 'root',
                'password' => 'fycphalcon',
                'dbname'   => 'fycphalcon',
            ]
        );
    }
);

$app = new Micro() ; 
$app->setDI($di) ; 

$app->get('/',function() use($app){
    $res = $app->response ; 
    $res->setJsonContent(['Bonjour monde ! '])->send();
});

$users = new MicroCollection() ; 
$users->setHandler(new UserController()) ; 
$users->setPrefix('/users') ; 
$users->get('/','getCollection') ;
$users->get('/{id}', 'get') ;
$users->post('/','post') ;



$app->mount($users) ;
$app->handle();
