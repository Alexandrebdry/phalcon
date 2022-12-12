<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

$places = new MicroCollection() ;
$places->setHandler(new PlacesController() ) ;
$places->setPrefix($config->application->ApiUri . '/places') ;
$places->get('/','getCollection') ;
$places->get('/{id}', 'get') ;
$places->post('/','post') ;
$places->patch('/{id}','patch') ;
$places->delete('/{id}', 'delete') ;

return $places ;