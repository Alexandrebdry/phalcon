<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

$users = new MicroCollection() ;
$users->setHandler(new UserController()) ;
$users->setPrefix($config->application->ApiUri . '/users') ;
$users->get('/','getCollection') ;
$users->get('/{id}', 'get') ;
$users->post('/','post') ;
$users->patch('/{id}','patch') ;
$users->delete('/{id}', 'delete') ;

return $users ;