<?php

class Student_model extends CI_Model{
    public function addStudent($data){
        $this->db->insert('t_student', $data);
    }
    public function getStudent($id_room = null, $id_period = null){
          $null = NULL;
         $this->db->select('t_student.`name` AS nama,
         t_student.id_student,
         IF(t_student.saldo != "$null", t_student.saldo ,0) AS money,
         t_period.period AS name_period,
         t_student.id_period,
         t_room.room AS name_room,
        
         t_student.id_room');
         $this->db->from('t_student');
         $this->db->join('t_room', 't_room.id_room = t_student.id_room','left');
         $this->db->join('t_period', 't_period.id_period = t_student.id_period', 'left');
       
        if($id_room === null){
           $query = $this->db->get('get_student'); 
        }else{
            $this->db->where('t_room.id_room',$id_room);
            $this->db->where('t_period.id_period',$id_period);
        
            $query = $this->db->get();  
        }
        return $query->result_array();
    }
	public function getJumlahStudent()
	{
		$result = $this->db->select('count(name) as total_student ')->from('t_student')->get()->row();
		return $result;
	}
	public function deleteStudent($id){
		$sql = "DELETE FROM t_student WHERE id_student = '$id'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	public function editStudent($data, $id){
		$sql = "UPDATE t_student SET name = '$data' WHERE id_student = '$id'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

}
