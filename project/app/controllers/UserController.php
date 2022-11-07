<?php

use Phalcon\Mvc\Controller ; 
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class UserController extends Controller {

    public function getCollection() {
        $users = User::find() ; 
        if(count($users) > 1)
            $this->response->setJsonContent($users) ;
        else $this->response->setStatusCode(404) ; 
        return $this->response ;
    }

    public function get($id) {
        $user = User::findFirstById($id) ;
        
        if( ! is_null($user) && $user != false ) $this->response->setJsonContent($user);
        else $this->response->setStatusCode(404) ; 
        return $this->response ;
    }

    public function post() {

        $data = $this->request->getJsonRawBody() ; // Get body as json
        
        if(isset($data->name) && isset($data->email)) {
           
            if(User::findFirstByEmail($data->email) === false) {
                $user = new User($data) ;
                $user->name = $data->name ; 
                $user->email = $data->email ; 
                $user->save() ;
                if(!is_null($user->id)) {
                    $res = new Response() ;
                    $res->setStatusCode(201) ;
                    $res->setJsonContent($user) ;
                } else {
                    $res = new Response() ;
                    $res->setStatusCode(400) ;
                }
            } else {
                $res = new Response() ;
                $res->setStatusCode(400) ;
                $res->setContent('User already exist') ;
            }
 
        } else {
            $res = new Response() ;
            $res->setStatusCode(400) ;
        }

        
        return $res ;
       
    }
}