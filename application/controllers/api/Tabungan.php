<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST, OPTIONS");

class Tabungan extends REST_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->model('tabungan_model', 'mTabungan');
	}

	public function index_get()
	{
		$id_room = $this->get('id_room');
		$id_period = $this->get('id_period');
		if ($id_room == null && $id_period == null) {
			$data = $this->mTabungan->getDataTabungan();
		} else {
			$data = $this->mTabungan->getDataTabungan($id_room, $id_period);
		}

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
		$nominal = $this->post('nominal');
		$date = $this->post('tanggal');
		$id_student = $this->post('id_student');
		$data = [
			'nominal' => $nominal,
			'date' => $date,
			'id_student' => $id_student
		];

		$this->mTabungan->addTabungan($data);
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
