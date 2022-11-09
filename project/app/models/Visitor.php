<?php

use Phalcon\Mvc\Model ;
class Visitor extends Model {

    public $v_event_id ;
    public $v_user_id ;

    public function initialize() {

        $this->belongsTo('v_event_id' , Event::class,'id', ['alias' => 'event']) ;
        $this->belongsTo('v_user_id', User::class , 'id', ['alias' => 'user'])

    }
}