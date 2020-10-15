<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST, OPTIONS");

class DetailPengeluaran extends REST_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->model('detailpengeluaran_model', 'mPengeluaran');
	}

	public function index_get()
	{
		$id_student = $this->get('id_student');

		$data = $this->mPengeluaran->getDetailPengeluaran($id_student);

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



}
