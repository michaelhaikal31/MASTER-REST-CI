<?php 
class pengeluaran_model extends CI_Model{
    public function addPengeluaran($data)
    {
        $this->db->insert('t_pengeluaran', $data);
    }
    public function update_saldo($nominal, $id_student)
    {
        $sql = "UPDATE t_student SET saldo = saldo - '$nominal' WHERE id_student = '$id_student'";
        $this->db->query($sql);
    }
    public function getDataPengeluaran($id_student = null, $id_room = null, $id_period = null)
    {
        if ($id_room == null && $id_period == null)
        return $this->db->get('get_pengeluaran')->result_array();

        $null = NULL;
        $sql = "SELECT
        t_pengeluaran.nominal,
        t_pengeluaran.id_pengeluaran,
        t_pengeluaran.keterangan,
        t_pengeluaran.date,
        t_student.saldo,
        t_student.`name`,
        t_student.id_student
        FROM
        t_pengeluaran
        RIGHT JOIN t_student ON t_student.id_student = t_pengeluaran.id_student
        RIGHT JOIN t_room ON t_room.id_room = t_student.id_room
        RIGHT JOIN t_period ON t_period.id_period = t_student.id_period
        WHERE
        t_period.id_period = '$id_period' AND
        t_room.id_room = '$id_room'
        ORDER BY
        t_pengeluaran.date DESC ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}