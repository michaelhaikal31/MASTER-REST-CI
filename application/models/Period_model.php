<?php

class Period_model extends CI_Model{

    public function getSchoolYear($id = null){
        $this->db->select('t_period.period');
        $this->db->from('t_period');
        $this->db->join('room', 't_period.id_room = room.id', 'left');
        if($id === null){
            $query = $this->db->get();
        }else{
             $this->db->where('t_period.id_room', $id);
             $query = $this->db->get();
        }
        return $query->result_array();
    }

    public function createPeriod($data){
        $this->db->insert('t_period', $data);
        return $this->db->affected_rows();
    }

    public function getPeriod(){
       return $this->db->get('get_period')->result_array();
    }
}
