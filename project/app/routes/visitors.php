<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

$visitors = new MicroCollection() ;
$visitors->setHandler(new VisitorController() ) ;
$visitors->setPrefix($config->application->ApiUri . '/visitors') ;
$visitors->get('/','getCollection') ;
$visitors->get('/{id}', 'get') ;
$visitors->post('/','post') ;
$visitors->patch('/{id}','patch') ;
$visitors->delete('/{id}', 'delete') ;

return $visitors ;