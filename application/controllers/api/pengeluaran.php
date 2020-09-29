<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");

class pengeluaran extends REST_Controller{
    public function __Construct(){
        parent::__Construct();
        $this->load->model('pengeluaran_model', 'mPengeluaran');
    }
    public function index_get()
    {
        $id_student = $this->get('id_student');
        $id_room = $this->get('id_room');
        $id_period = $this->get('id_period');

        $data = $this->mPengeluaran->getDataPengeluaran($id_student, $id_room, $id_period);  
       
        if($data){
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

    public function index_post()
    {
    $nominal = $this->post('nominal');
    $id_student = $this->post('id_student');
    $keterangan = $this->post('keterangan');
    $date = $this->post('tanggal');
    $data = [
        'nominal'=>   $nominal,
        'keterangan' => $keterangan,
        'date' => $date,
        'id_student' =>  $id_student,
    ];
    $this->mPengeluaran->addPengeluaran($data);
    $this->mPengeluaran->update_saldo($nominal, $id_student);
    if ($this->db->affected_rows() > 0){
        $this->set_response([
            'status' => true,
            'message' => 'success',  
        ], REST_Controller::HTTP_OK);
    }else{
        $this->response([
            'status' => false,
            'message' => 'failed',
        ], REST_Controller::HTTP_NOT_FOUND);
    }
    }
}