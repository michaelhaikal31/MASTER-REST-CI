<?php

class Tabungan_model extends CI_Model
{


	public function update_saldo($nominal, $id_student)
	{
		$sql = "UPDATE t_student SET saldo = saldo + '$nominal' WHERE id_student = '$id_student'";
		$this->db->query($sql);
	}

	public function getDataTabungan($id_room = null, $id_period = null)
	{
		$null = NULL;
		$this->db->select('t_student.`name` AS nama,
         t_student.id_student,
         t_period.period AS name_period,
         t_room.room AS name_room,
         t_student.id_period,
         IF(t_student.saldo != "$null", t_student.saldo ,0) AS money,
         t_student.id_room');
		$this->db->from('t_student');
		$this->db->join('t_room', 't_room.id_room = t_student.id_room', 'left');
		$this->db->join('t_period', 't_period.id_period = t_student.id_period', 'left');
		$this->db->where('t_room.id_room', $id_room);
		$this->db->where('t_period.id_period', $id_period);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getTotalTabungan($date)
	{
		$result = $this->db->select('sum(nominal) as total_tabungan ')
			->from('t_tabungan')
			->where('year(date)',$date)
			->get()->row();
		return $result;
	}

	public function getTabungan($id_student )
	{
		$result = $this->db->select('sum(nominal as value')->from('t_tabungan')->get()->row();
		return $result->value;
	}

	public function addTabungan($data)
	{
		$this->db->insert('t_tabungan', $data);
	}
	public function getDataKredit($id_student){
		$this->db->select('
				t_tabungan.id_tabungan,
				t_tabungan.date,
				t_tabungan.keterangan,
				t_tabungan.nominal,
				t_tabungan.type,');
		$this->db->from('t_tabungan');
		$this->db->where('t_tabungan.id_student', $id_student);
		$this->db->where('t_tabungan.nominal >', 0);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getDataDebet($id_student){
		$this->db->select('
				t_tabungan.id_tabungan,
				t_tabungan.date,
				t_tabungan.keterangan,
				t_tabungan.nominal,
				t_tabungan.type,'
			);
		$this->db->from('t_tabungan');
		$this->db->where('t_tabungan.id_student', $id_student);
		$this->db->where('t_tabungan.nominal <', 0);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getDataMutasi($id_student, $tgl_awal, $tgl_akhir){
		$sql = "SELECT
				t_tabungan.id_tabungan,
				t_tabungan.nominal,
				t_tabungan.keterangan,
				t_tabungan.date,
				t_tabungan.type
				FROM
				t_tabungan
				WHERE
				t_tabungan.date BETWEEN '$tgl_awal' AND '$tgl_akhir' AND
				t_tabungan.id_student = '$id_student'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function editDataTabungan($nominal, $keterangan, $id){
		$sql = "UPDATE t_tabungan SET nominal='$nominal', keterangan='$keterangan' WHERE id_tabungan='$id'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	public function deleteDataTabungan($id){
		$sql = "DELETE FROM t_tabungan WHERE id_tabungan = '$id'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}


}
