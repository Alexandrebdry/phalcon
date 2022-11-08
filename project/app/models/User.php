<?php

use Phalcon\Mvc\Model;

class User extends Model
{
    protected $id;
    protected $name;
    protected $email;
    protected $password;

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