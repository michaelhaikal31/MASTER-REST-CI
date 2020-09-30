<?php 
class Pengeluaran_model extends CI_Model{
    public function addPengeluaran($data)
    {
        $this->db->insert('t_pengeluaran', $data);
    }
    public function update_saldo($nominal, $id_student)
    {
        $sql = "UPDATE t_student SET saldo = saldo - '$nominal' WHERE id_student = '$id_student'";
        $this->db->query($sql);
    }
    public function getDataPengeluaran($id_room = null, $id_period = null)
    {
        if ($id_room == null && $id_period == null)
        return $this->db->get('get_pengeluaran')->result_array();

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
}
