<?php


class Detailpengeluaran_model extends CI_Model
{
	public function getDetailPengeluaran($id_student = null)
	{
		$this->db->select('t_pengeluaran.keterangan,
		t_pengeluaran.nominal,
		t_pengeluaran.date,
		t_student.name');
		$this->db->from('t_pengeluaran');
		$this->db->join('t_student', 't_pengeluaran.id_student = t_student.id_student', 'left');
		$this->db->where('t_pengeluaran.id_student', $id_student);
		$query = $this->db->get();
		return $query->result_array();
	}
}
