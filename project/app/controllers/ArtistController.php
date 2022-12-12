<?php
use Phalcon\Mvc\Controller ;
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class ArtistController extends Controller {

    public function getCollection() {
        $artists = Artist::find();
        if (count($artists >= 1)
            return $this->response->setJsonContent($artists);
        return $this->response->setStatusCode(404, "Not Found");
    }

    public function get($id) {
        $artist = Artist::findFirstById($id) ;
        if( ! is_null($artist) && $artist != false)
            return $this->response->setJsonContent($artist) ;
        return $this->response->setStatusCode(404) ;
    }

    public function post() {
        $data = $this->request->getJsonRawBody() ;

        if( isset($data->name) && isset($data->style) ) {
             $exist = Artist::findFirstByName($data->name) ;

             if( $exist === false || $exist === null) {
                $artist = new Artist() ;
                $artist->name = $data->name ;
                $artist->style = $data->style ;
                $artist->save() ;

                $this->response->setStatusCode(201) ;
                return $this->response->setJsonContent($artist) ;
             } else {
                $this->response->setStatusCode(400) ;
                return $this->response->setContent('Artist already exist') ;
             }
        }
        return $this->response->setStatusCode(402) ;
    }

    public function patch($id) {
        $artist = Artist::findFirstById($id) ;
        if(is_null($artist))
            return $this->response->setStatusCode(404) ;

        $data  = $this->request->getJsonRawBody() ;
        if( isset($data) ) {
            foreach($data as $key => $val) {
                $artist->$key = $val ;
            }
            $artist->save() ;
            return $this->response->setJsonContent($artist) ;
        }
        return $this->response->setStatusCode(400) ;
    }

    public function delete($id) {
        $artist = Artist::findFirstById($id) ;
        if(is_null($artist))
            return $this->response->setStatusCode(404) ;
        $artist->delete() ;
        return $this->response->setStatusCode(204) ;
    }
}