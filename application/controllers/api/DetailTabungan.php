<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST, OPTIONS");

class DetailTabungan extends REST_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->model('detailtabungan_model', 'mTabungan');
	}

	public function index_get()
	{
		$id_student = $this->get('id_student');
		$data = $this->mTabungan->getDetailTabungan($id_student);

		if ($data) {
			$this->response([
				'status' => true,
				'message' => "Success",
				'data' => $data
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'No users were found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_post()
	{
		$id_student = $this->post('id_student');
		$data = [
			'id_student' => $id_student
		];

		$this->mTabungan->getDetailTabungan($data);
		if ($this->db->affected_rows() > 0) {
			$this->set_response([
				'status' => true,
				'message' => 'success',
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed',
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_put()
	{
		$id = $this->put('id_tabungan');
		$data = [
			'money' => $this->put('nominal'),
			'id_room' => $this->put('id_room'),
			'id_period' => $this->put('id_period'),
			'id_student' => $this->put('id_student')
		];
		if ($this->mTabungan->updateTabungan($data, $id) > 0) {
			$this->set_response([
				'status' => true,
				'message' => 'success',
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed',
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
