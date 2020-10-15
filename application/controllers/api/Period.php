<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Credentials: true");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Methods: POST, OPTIONS");
class Period extends REST_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('period_model');
        $this->load->model('room_model','mRoom');
    }

	public function index_get(){
		$data_room = $this->period_model->getPeriod();
		$data = [];
		if ($data_room != null){
			foreach ($data_room as $row){
				// $hasil[$row['name_room']][$row['id_period']]['nama_ruangan'] = $row['name_room'];
				// ['periode']
				$hasil[$row['room']][$row['id_period']]['periode'] = $row['period'];	
				$hasil[$row['room']][$row['id_period']]['id_periode'] = $row['id_period'];	
			
			}
			
			foreach ($data_room as $list){
				$hasil2[$list['id_room']]['room'] = $list['room'];
				$hasil2[$list['id_room']]['id_room'] = $list['id_room'];
				$hasil2[$list['id_room']]['period'] = array_values($hasil[$list['room']]);
			}
			
			$this->response([
                'status' => true,
                'data' =>  array_values($hasil2)
            ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                'status' => false,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); 
		}
	
	}
	public function cc_get(){
        $id = $this->get('id');
        if($id === null){
            $data = $this->period_model->getSchoolYear();
        }else{
            $data = $this->period_model->getSchoolYear($id);
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

        if ( $this->period_model->createPeriod($data) > 0){
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
