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
		$data = [
			'nominal' => $this->post('nominal'),
			'date' => $this->post('tanggal'),
			'id_student' => $this->post('id_student'),
			'keterangan' => $this->post('keterangan'),
			'type' => $this->post('type')
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


	public function totalTabungan()
	{
		$save= $this->inssret([]);
		$this->updateSaldoStudent(123,321312);
	}

	public function updateSaldoStudent($student_id, $amount)
	{
			$this->db->where('id',$student_id)->update('t_stunt',['amount'=>$amount]);
	}

	public function datakredit_get(){
		$id = $this->get('id_student');
		$data = $this->mTabungan->getDataKredit($id);
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
	public function datadebet_get(){
		$id = $this->get('id_student');
		$data = $this->mTabungan->getDataDebet($id);
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
	public function datamutasi_get(){
		$id = $this->get('id_student');
		$tgl_awal = $this->get('tgl_awal');
		$tgl_akhir = $this->get('tgl_akhir');
		$data = $this->mTabungan->getDataMutasi($id, $tgl_awal, $tgl_akhir);
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
	public function edittabungan_post(){
		$id_tabungan = $this->post('id_tabungan');
		$nominal = $this->post('nominal');
		$keterangan = $this->post('keterangan');
		$data = $this->mTabungan->editDataTabungan($nominal, $keterangan,$id_tabungan);
		if ($data > 0) {
			$this->response([
				'status' => true,
				'message' => "Success",
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'No users were found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function deletetabungan_post(){
		$id_tabungan = $this->post('id_tabungan');
		$data = $this->mTabungan->deleteDataTabungan($id_tabungan);
		if ($data > 0) {
			$this->response([
				'status' => true,
				'message' => "Success",
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'No Tabungan were found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
