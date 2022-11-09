<?php

use Phalcon\Mvc\Model ;

class Player extends Model {

    public $artist_id ;
    public $event_id ;

    public function initialize() {
        $this->belongsTo('artist_id', Artist::class, 'id',
         ['alias' => 'group']) ;

        $this->belongsTo('event_id', Event::class,'id',
        ['alias'=>'events']) ;
    }
}