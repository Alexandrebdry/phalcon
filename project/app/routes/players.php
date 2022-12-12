<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

$players = new MicroCollection() ;
$players->setHandler(new PlayerController() ) ;
$players->setPrefix($config->application->ApiUri . '/players') ;
$players->get('/','getCollection') ;
$players->get('/{id}', 'get') ;
$players->post('/','post') ;
$players->patch('/{id}','patch') ;
$players->delete('/{id}', 'delete') ;

return $players ;