<?php

use Phalcon\Mvc\Controller ;
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class EventController extends Controller {

    public function getCollection() {
        $events = Event::find() ;
        if(count($events) > 1)
            $this->response->setJsonContent($events) ;
        else $this->response->setStatusCode(404) ;
        return $this->response ;
    }

    public function get($id) {
        $event = Event::findFirstById($id) ;

        if( ! is_null($event) && $event != false ) $this->response->setJsonContent($event);
        else $this->response->setStatusCode(404) ;
        return $this->response ;
    }

    public function post() {

        $data = $this->request->getJsonRawBody() ; // Get body as json

        if(
            isset($data->name)
        ) {
            $exist = Event::findFirstByName($data->name) ;

            if($exist === false || $exist === null ) {
                $event = new Event($data) ;
                $event->name = $data->name ;
                $event->place_id = $data->place_id ;
                $event->save() ;

                if(!is_null($event->id)) {
                    $res = new Response() ;
                    $res->setStatusCode(201) ;
                    $res->setJsonContent($event) ;
                } else {
                    $res = new Response() ;
                    $res->setStatusCode(400) ;
                }
            } else {
                $res = new Response() ;
                $res->setStatusCode(400) ;
                $res->setContent('Event already exist') ;
            }

        } else {
            $res = new Response() ;
            $res->setStatusCode(402) ;
        }
        return $res ;
    }

    public function patch($id) {
        return 'patch a user' ;
    }

    public function delete($id) {
        return 'delete a user' ;
    }
}