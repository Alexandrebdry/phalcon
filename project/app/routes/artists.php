<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

$artists = new MicroCollection() ;
$artists->setHandler(new ArtistController() ) ;
$artists->setPrefix($config->application->ApiUri . '/artists') ;
$artists->get('/','getCollection') ;
$artists->get('/{id}', 'get') ;
$artists->post('/','post') ;
$artists->patch('/{id}','patch') ;
$artists->delete('/{id}', 'delete') ;

return $artists ;