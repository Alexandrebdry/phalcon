<?php

use Phalcon\Mvc\Controller ; 
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class UserController extends Controller {

    public function getCollection() {
        $users = User::find() ; 
        if(count($users) > 1) {
            $response = [] ;
            foreach($users as $user) {
                unset($user->password) ;
                $response[] = $user;

            }

            return $this->response->setJsonContent($response) ;
        }
        else $this->response->setStatusCode(404) ; 
        return $this->response ;
    }

    public function get($id) {
        $user = User::findFirstById($id) ;
        
        if( ! is_null($user) && $user != false ) {
            unset($user->password) ;
            $this->response->setJsonContent($user);
        }
        else $this->response->setStatusCode(404) ; 
        return $this->response ;
    }

    public function post()
    {

        $data = $this->request->getJsonRawBody(); // Get body as json

        if (isset($data->name) && isset($data->email) && isset($data->password)) {
            $exist = User::findFirstByEmail($data->email);
            if ($exist === false || $exist === null) {
                $user = new User($data);
                $user->name = $data->name;
                $user->email = $data->email;
                $user->setPassword($data->password);
                $user->save();
                if (!is_null($user->id)) {
                    $res = new Response();
                    $res->setStatusCode(201);
                    unset($user->password) ;
                    $res->setJsonContent($user);
                } else {
                    $res = new Response();
                    $res->setStatusCode(400);
                }
            } else {
                $res = new Response();
                $res->setStatusCode(400);
                $res->setContent('User already exist');
            }

        } else {
            $res = new Response();
            $res->setStatusCode(400);
        }
        return $res;
    }

    public function patch($id) {
        $user = User::findFirstById($id) ;
        $res = new Response() ;
        if(is_null($user)) return $res->setStatusCode(404)->setContent('User not found') ;
        $data =  $this->request->getJsonRawBody() ; // Get body as json
        if(isset($data)) {
            foreach ($data as $key => $val) {
                $user->$key = $val ;
            }
            $user->save() ;
            unset($user->password) ;
            return $res->setJsonContent($user) ;
        }
        return $res->setStatusCode(400) ;

    }

    public function delete($id) {
        $user = User::findFirstById($id) ;
        if(is_null($user)) return $this->response->setStatusCode(404)->setContent('User not found') ;
        $user->delete() ;
        return $this->response->setStatusCode(204) ;
    }
}