<?php 
class tabungan_model extends CI_Model{
    public function addTabungan($data){
        $this->db->insert('t_tabungan', $data);
     
    }
    public function update_saldo($nominal, $id_student){
        $sql = "UPDATE t_student SET saldo = saldo + '$nominal' WHERE id_student = '$id_student'";
    $this->db->query($sql);
       
    }
    public function getDataTabungan($id_room = null, $id_period = null)
    {
        if ($id_room === null && $id_period === null)
        return $this->db->get('get_tabungan')->result_array();
        $null = NULL;
        // $this->db->select('t_money.id,
        // t_money.money,
        // t_student.id,
        // t_student.nama,
        // t_school_year.name_period,
        // room.name_room' );
        // $this->db->from('t_money');
        // $this->db->join('t_school_year', 't_school_year.id_period = t_student.id_periode','right');
        // $this->db->join('t_student', 't_student.id = t_money.id_student', 'right');
        // $this->db->join('room', 'room.id = t_school_year.id_room', 'right');
        // $this->db->join('room', 'room.id = t_student.id_room', 'right');
        // $this->db->where('room.id',$id_room);
        // $this->db->where('t_school_year.id_period',$id_period);
        $sql = "SELECT
        IF(t_tabungan.id_tabungan != '$null', t_tabungan.id_tabungan, ' ') AS id_tabungan,
        IF(t_tabungan.nominal != '$null', t_tabungan.nominal, 0) AS money, 
        t_student.id_student AS id_student,
        t_student.name AS nama,
        t_period.period AS name_period,
        t_room.room AS name_room
        FROM
        t_tabungan
        RIGHT JOIN t_student ON t_student.id_student = t_tabungan.id_student
        RIGHT JOIN t_period ON t_period.id_period = t_student.id_period
        RIGHT JOIN t_room ON t_room.id_room = t_period.id_room AND t_room.id_room = t_student.id_room
        WHERE
        t_room.id_room = ($id_room) AND
        t_period.id_period = ($id_period)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}