<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Kontak extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function index_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            $users = $this->db->get("kontak")->result_array();        // Check if the users data store contains users (in case the database result returns NULL)
            // ;print_r($users);
            // die

           

            if ($users)
            {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
         else {
            $id = (int) $id;
           
            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            $this->db->where(array("idkontak"=>$id));
            $users = $this->db->get('kontak')->row_array();
            // $this->response($users, REST_Controller::HTTP_OK);
            $respon['status'] = "OK";
            $respon['msg'] ="bisa";
            $respon['data'] = $users;
            echo json_encode($respon);
            die;

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

        //     $user = NULL;

        //     if (!empty($users))
        //     {
        //         foreach ($users as $key => $value)
        //         {
        //             if (isset($value['id']) && $value['id'] === $id)
        //             {
        //                 $user = $value;
        //             }
        //         }
        //     }

        //     if (!empty($user))
        //     {
        //         $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        //     }
        //     else
        //     {
        //         $this->set_response([
        //             'status' => FALSE,
        //             'message' => 'User could not be found'
        //         ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        //     }
          }
    }

    public function index_post()
    {
        // $this->some_model->update_user( ... );
        $data = [
        
            'kontak' => $this->post('kontak'),
            'nomor' => $this->post('nomor')
        ];
        $this->db->insert("kontak",$data);

        $this->set_response($data, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function index_delete()
    {
        $id = (int) $this->delete('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'idkontak' => $id
        ];
        $this->db->delete("kontak",$message);

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function index_put(){
        $where = [
            'idkontak' => $this->put('id')
        ];
        $data = [
            'kontak' => $this->put('kontak'),
            'nomor' => $this->put('nomor')
        ];

        $this->db->update("kontak",$data, $where);

        $respon['status'] = "Updated";
        $respon['msg'] ="bisa";
        $respon['data'] = $data;
        echo json_encode($respon);
        die;
    }

}
