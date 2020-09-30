<?php
class Detailtabungan_model extends  CI_Model{
	public function getDetailTabungan($id_student = null){
		$null = NULL;
		$this->db->select('t_student.`name` AS nama,
         t_tabungan.date,
         t_tabungan.nominal
        ');
		$this->db->from('t_tabungan');
		$this->db->join('t_student', 't_tabungan.id_student = t_student.id_student', 'left');
		$this->db->where('t_tabungan.id_student', $id_student);
		$query = $this->db->get();
		return $query->result_array();
	}
}
