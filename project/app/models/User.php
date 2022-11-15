<?php

use Phalcon\Mvc\Model;
class User extends Model
{
    public $id;
    public $name;
    public $email;
    public $password;

    public function initialize() {
        $this->hasMany('id',Visitor::class,'v_user_id') ;
        $this->hasManyToMany('id', Visitor::class, 'v_user_id', 'v_event_id',
            Event::class, 'id' , ['reusable' => true , 'alias' => 'events']
        );
    }

    public function getId() {
        return $this->id ;
    }
    public function setName($name) {
        $this->name = $name ;
        return $this ;
    }
    public function getName() {
        return $this->name ;
    }
    public function setEmail($email) {
        $this->email = $email ;
        return $this ;
    }
    public function getEmail() {
        return $this->email ;
    }
    public function getPassword() {
        return $this->password ;
    }
    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT) ;
        return $this ;
    }


}