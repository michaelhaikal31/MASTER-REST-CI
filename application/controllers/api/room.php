<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST, OPTIONS");

class Room extends REST_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('room_model','mRoom');
    }
    public function index_get(){
        $id = $this->get('id');
        if($id === null){
            $data = $this->mRoom->getRoom();
        }else{
            $data = $this->mRoom->getRoom($id);
        }
       
        if ($data){
            $this->set_response([
                'status' => true,
                'data' => $data,
            ], REST_Controller::HTTP_OK); 
        }else{
            $this->set_response([
                'status' => false,
                'message' => 'failed',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_post(){

        $nameRoom = $this->post('name');

        $data = [
            'room' => $nameRoom,
        ];

        if ( $this->mRoom->createRoom($data) > 0){
            $this->set_response([
                'status' => true,
                'message' => 'success',
            ], REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'status' => false,
                'message' => 'failed',
            ], REST_Controller::HTTP_NOT_FOUND);
        }

    }

}