<?php

use Phalcon\Mvc\Model;

class User extends Model
{
    public $id;
    public $name;
    public $email;
    public $url ;
    public $type ; 

    public function initilialize() {
        $this->hasMany(
            'id', 
            'Event',
            'events'
        );
    }
}