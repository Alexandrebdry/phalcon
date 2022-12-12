<?php

use Phalcon\Mvc\Controller ;
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class VisitorController extends Controller {

    public function getCollection() {
        $visitors = Visitor::find();
        if (count($visitors) > 0 )
            return $this->response->setJsonContent($visitors);
        return $this->response->setStatusCode(404) ;
    }

    public function get($id) {
        $visitor = Visitor::findFirst($id);
            if ($visitor)
                return $this->response->setJsonContent($visitor);
            return $this->response->setStatusCode(404) ;
    }

    public function delete($id) {
        $visitor = Visitor::findFirstById($id) ;
        if ( is_null($visitor) )
            return $this->response->setStatusCode(404) ;
        $visitor->delete() ;
        return $this->response->setStatusCode(204) ;
    }

    public function post() {
        $data = $this->request->getJsonRawBody() ;
        if ( is_null($data) )
            return $this->response->setStatusCode(400) ;

        if( !isset($data->v_event_id) || !isset($data->v_user_id) )
            return $this->response->setStatusCode(400) ;

        $exist = Visitor::FindFirstByV_event_idAndV_user_id($data->v_event_id, $data->v_user_id) ;
        if ( !is_null($exist) )
            return $this->response->setStatusCode(400) ;

        $visitor = new Visitor() ;
        $visitor->v_event_id = $data->v_event_id ;
        $visitor->v_user_id = $data->v_user_id ;
        $visitor->save();
        return $this->response->setStatusCode(201) ;
    }

    public function patch($id) {
        $visitor = Visitor::findFirstById($id) ;
        if ( is_null($visitor) )
            return $this->response->setStatusCode(404) ;
        $data = $this->request->getJsonRawBody() ;
        if ( is_null($data) )
            return $this->response->setStatusCode(400) ;
        foreach($data as $key => $value) {
            $visitor->$key = $value ;
        }
        $visitor->save() ;
        return $this->response->setJsonContent($visitor) ;

    }

}