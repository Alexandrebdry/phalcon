<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

$events = new MicroCollection() ;
$events->setHandler(new eventController() ) ;
$events->setPrefix($config->application->ApiUri . '/events') ;
$events->get('/','getCollection') ;
$events->get('/{id}', 'get') ;
$events->post('/','post') ;
$events->patch('/{id}','patch') ;
$events->delete('/{id}', 'delete') ;

return $events ;