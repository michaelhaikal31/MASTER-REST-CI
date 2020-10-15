<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: *");

class Dashboard extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->model('tabungan_model');
		$this->load->model('pengeluaran_model');
		$this->load->model('room_model');
		$this->load->model('student_model');
	}

	public function indexss_get()
	{
		$id_period = $this->get('id_period');
		$data = $this->dashboard_model->getData($id_period);
		if ($data) {
			$this->response([
				'status' => true,
				'message' => 'success',
				'data' => $data
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'No users were found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}


	public function index_get()
	{
		$date = $this->get('year');
		$data_tabungan = $this->tabungan_model->getTotalTabungan($date);
		$data_pengeluaran = $this->pengeluaran_model->getTotalPengeluaran($date);
		$data_room = $this->room_model->getTotalRoom();
		$data_student = $this->student_model->getJumlahStudent();

		$gabunganJson1DanJson2 = array_merge(
			(array)$data_tabungan,
			(array)$data_pengeluaran,
			(array)$data_room,
			(array)$data_student
		);
		if ($gabunganJson1DanJson2) {
			$this->response([
				'status' => true,
				'message' => 'success',
				'data' => $gabunganJson1DanJson2
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'No users were found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

}
