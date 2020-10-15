<?php


class Dashboard_model extends CI_Model
{
	public function getData($id_period = null)
	{
		$this->db->select('t_period.period, Sum(t_student.saldo) AS Total_tabungan,
							Count(t_student.`name`) AS Jumlah_siswa');
		$this->db->from('t_period');
		$this->db->join('t_student', 't_student.id_period = t_period.id_period', 'left');
		$this->db->where('t_student.id_period ', $id_period);

		$get_class = "SELECT COUNT(t_room.room) as Total_kelas FROM t_room";
		$query1 = $this->db->get()->result_array();
		$query2 = $this->db->query($get_class)->result_array();

		return array_merge($query1, $query2);

	}
}
