<?php

declare(strict_types=1);

use Phalcon\Di\FactoryDefault ;
use Phalcon\Mvc\Micro ;
use Phalcon\Events\Event;
use Phalcon\Events\Manager;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    $di = new FactoryDefault();

    include APP_PATH . '/config/services.php';
    include APP_PATH . '/config/router.php';

    $config = $di->getConfig();
    include APP_PATH . '/config/loader.php';

    // FOR NORMAL WEB SITE
    /*$application = new \Phalcon\Mvc\Application($di);
    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();*/

    // FOR API
    $micro = new Micro() ;
    $micro->setDI($di) ;

    $micro->before(function() use($micro) {

        if( $_SERVER['REQUEST_URI'] === '/api/login') return true ;

        if( is_null($micro->request->getHeaders()['Authorization']) ) {

            // test credentields there
            /*
            $micro->response->setStatusCode(401)->send() ;
            return $micro->response ;*/
            return true ;
        }
        return true ;
    });

    $micro->notFound(
        function () use ($micro) {

            $micro
                ->response
                ->setStatusCode(404, 'Not Found')
                ->sendHeaders()
                ->setContent('This route does not exist. Not Found ')
                ->send()
            ;
        }
    );

    $micro->get($config->application->ApiUri,function() use($micro){
        $res = $micro->response ;
        $res->setJsonContent([' Hello worlds! '])->send();
    });

    $micro->mount(include APP_PATH . '/routes/users.php' ) ;
    $micro->handle($_SERVER['REQUEST_URI']);

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}