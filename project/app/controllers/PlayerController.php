<?php

use Phalcon\Mvc\Controller ;
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class PlayerController extends Controller
{
    public function getCollection() {
        $players = Player::find();
        if( count($players) > 0 )
            return $this->response->setJsonContent($players);
        return $this->response->setStatusCode(404) ;
    }

    public function get($id) {
        $player = Player::findFirstById($id);
        if( $player )
            return $this->response->setJsonContent($player);
        return $this->response->setStatusCode(404) ;
    }
    
    public function post() {
        $data = $this->request->getJsonRawBody();
        if( isset($data->artist_id) && isset($data->event_id) ) {
           $exist = Player::findFirstByArtistIdAndEventId($data->artist_id, $data->event_id);
              if( $exist )
                return $this->response->setStatusCode(400) ;
              
            $player = new Player();
            $player->artist_id = $data->artist_id;
            $player->event_id = $data->event_id;
            $player->save();
            return $this->response->setJsonContent($player);
        }
        return $this->response->setStatusCode(400) ;
    }
    
    public function patch($id) {
        $player = Player::findFirstById($id);
        if( is_null($player) )
            return $this->response->setStatusCode(404) ;
        $data = $this->request->getJsonRawBody();
        if( isset($data) ) {
            foreach($data as $key => $value) {
               $player->$key = $value;
            }
            $player->save();
            return $this->response->setJsonContent($player);
        }
        return $this->response->setStatusCode(400) ;          
    }
    
    public function delete($id) {
    $player = Player::findFirstById($id);
        if( is_null($player) )
            return $this->response->setStatusCode(404) ;
        $player->delete();
        return $this->response->setStatusCode(204) ;
    }
}