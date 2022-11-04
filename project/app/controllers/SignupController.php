<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function indexAction()
    {
        var_dump(new Users()) ;
    }

    public function registerAction()
    {

    }
}