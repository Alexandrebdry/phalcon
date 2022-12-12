<?php

use Phalcon\Mvc\Controller ;
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class PlaceController extends Controller

{
    public function getCollection() {
        $places = Place::find() ;
        if(count($places) > 0)
            return $this->response->setJsonContent($places);
        return $this->response->setStatusCode(404) ;
    }

    public function get($id) {
        $place = Place::findFirstById($id) ;
        if( ! is_null($place) && $event != false)
            return $this->response->setJsonContent($place);
        return $this->response->setStatusCode(404) ;
    }

    public function post() {
        $data = $this->request->getJsonRawBody() ;
        if(
            isset($data->longitude) &&
            isset($data->latitude) &&
            isset($data->name) &&
            isset($data->city) &&
            isset($data->country) &&
            isset($data->region) &&
        ) {
            $place = new Place() ;
            $place->longitude = $data->longitude ;
            $place->latitude = $data->latitude ;
            $place->name = $data->name ;
            $place->city = $data->city ;
            $place->country = $data->country ;
            $place->region = $data->region ;
            $place->save() ;
            if(!is_null($place->id)) {
               $this->response->setStatusCode(201) ;
               return $this->response->setJsonContent($place) ;
            }
        }
        return $this->response->setStatusCode(400) ;
    }

    public function patch($id) {
        $place = Place::findFirstById($id) ;
        if( is_null($place) )
            return $this->response->setStatusCode(404) ;
        $data = $this->request->getJsonRawBody() ;
        if(isset($data)) {
            foreach($data as $key => $value) {
                $place->$key = $value ;
            }
            $place->save() ;
            return $this->response->setJsonContent($place) ;
        }
        return $this->response->setStatusCode(400) ;
    }

    public function delete($id) {
        $place = Place::findFirstById($id) ;
        if( is_null($place) )
            return $this->response->setStatusCode(404) ;
        $place->delete() ;
        return $this->response->setStatusCode(204) ;
    }
}