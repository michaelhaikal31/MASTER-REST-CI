<?php

class Room_model extends CI_Model{

    public function getRoom($id = null){
        if($id===null){
            return $this->db->get('t_room')->result_array();
        }else{
            return $this->db->get_where('room', ['id_room'=> $id])->result_array();
        }
        
    }

    public function createRoom($data){
        $this->db->insert('t_room', $data);
        return $this->db->affected_rows();
    }

	public function getTotalRoom()
	{
		$result = $this->db->select('count(room) as total_room ')->from('t_room')->get()->row();
		return $result;
	}
}
