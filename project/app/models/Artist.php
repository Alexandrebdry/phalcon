<?php

use Phalcon\Mvc\Model;
class Artist extends Model {

    protected $id ;
    protected $name ;
    protected $style ;

    public function initialize() {
        $this->hasMany('id', Player::class, 'artist_id') ;
        $this->hasManyToMany(
            'id', Player::class , 'artist_id',
            'event_id' Event::class , 'id',
            ['reusable' => true , 'alias' => 'group']
        ) ;
    }
}