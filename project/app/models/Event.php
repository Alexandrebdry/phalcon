<?php

use Phalcon\Mvc\Model;
class Event extends Model {

    public $id ;
    public $date ;
    public $sells_date ;
    public $name ;
    public $place_id ;

    public function initialize() {

        $this->hasManyToMany(
            'id', Artist::class,'arist_id',
            'id', Event::class, 'event_id',
            ['reusable' => true , 'alias' => 'players']
        );
        $this->hasMany('id', Player::class, 'event_id',
            ['reusable' => true, 'alias' => 'players']
        );

        $this->hasManyToMany('id', Visitor::class,
            'v_event_id', 'v_user_id', User::class,'id', [
            'reusable' => true ,
            'alias' => 'visitors'
        ]);

        $this->hasMany('id', Visitor::class, 'v_event_id', [
            'reusable' => true ,
            'alias' => 'UserVisitors'
        ]);

        $this->belongsTo('place_id', Place::class, [

            'alias' => 'place_id'
        ]) ;
    }

    public function getId(){
        return $this->id ;
    }



}