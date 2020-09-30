<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST, OPTIONS");

class Student extends REST_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('student_model', 'mStudent');
        $this->load->model('room_model','mRoom');
    }
    public function index_post(){
        $data = [
            'name' => $this->post('name_student'),
            'id_room' => $this->post('id_class'),
            'id_period' => $this->post('id_period'),
			'saldo' => $this->post('init_saldo')
        ];

		$this->mStudent->addStudent($data);
        if ($this->db->affected_rows() > 0 ){
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
    }

    public function index_get(){

        $id_room = $this->get('id_room');
        $id_period = $this->get('id_period');
        if ($id_room === null){
            $data = $this->mStudent->getStudent(); 
        }else{
            $data = $this->mStudent->getStudent($id_room, $id_period); 
        }
       
        if ($data){
            // foreach($data as $s){
            //     $result[$s['period']][$s['id_period']]['id_student'] = $s['id_student'];
            //     $result[$s['period']][$s['id_period']]['name_student'] = $s['name'];
            // }

            // foreach($data as $row){
            //     $hasil[$row['room']][$row['id_period']]['periode'] = $row['period'];	
            //     $hasil[$row['room']][$row['id_period']]['id_periode'] = $row['id_period'];	
            //     $hasil[$row['room']][$row['id_period']]['student'] = array_values($result[$row['period']]);
            // }
            // foreach ($data as $list){
            //     $hasil2[$list['id_room']]['room'] = $list['room'];
            //     $hasil2[$list['id_room']]['id_room'] = $list['id_room'];
            //     $hasil2[$list['id_room']]['period'] = array_values($hasil[$list['room']]);
            // }

            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

}
