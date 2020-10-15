<?php

class User_model extends CI_Model{

    public function getUser(){
        return $this->db->get('user')->result_array();
    }

    public function createUser($data){
        $this->db->insert('user', $data);
        return $this->db->affected_rows();
    }

    function cekUser($username=null){
        $this->db->select('*');
        $this->db->from('t_user');
        $this->db->where('Username',$username);
        $this->db->limit(1);
        return $this->db->get();
    }
}
