<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST, OPTIONS");

class School_Year extends REST_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('period_model','mSchoolYear');
    }
    public function index_get(){
        $id = $this->get('id');
        if($id === null){
            $data = $this->mSchoolYear->getSchoolYear();
        }else{
            $data = $this->mSchoolYear->getSchoolYear($id);
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

        $schoolYear = $this->post('period');
        $idRoom = $this->post('id_room');

        $data = [
            'period' => $schoolYear,
            'id_room' => $idRoom
        ];

        if ( $this->mSchoolYear->createPeriod($data) > 0){
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

    public function get_room(){
        $data_room = $this->school_year_model->room();

        // echo"<pre>";
        print_r($data_room);
        die;
    }

}