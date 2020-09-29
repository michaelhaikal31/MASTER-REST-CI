<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");

class login extends REST_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model','mUser');
    }

    public function index_post(){
        $username = $this->post('username');
        $pass = $this->post('password');
        $data = $this->mUser->cekUser($username);
        if($data->row()){
            $Password = $data->row()->Password;
            if ($pass==$Password){
                $this->set_response([
                    'status' => true,
                    'message' => 'success',
                ], REST_Controller::HTTP_OK); 
            }else{
                $this->set_response([
                    'status' => false,
                    'message' => 'failed'
                ], REST_Controller::HTTP_NOT_FOUND); 
            }
        }else{
            $this->set_response([
                'status' => false,
                'message' => 'user not found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }
}