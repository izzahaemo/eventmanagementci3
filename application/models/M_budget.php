<?php
// Untuk koneksi data user!
class M_budget extends CI_Model
{
    public function allbudget()
    {
        $query = "  SELECT `budget`.*,`divisi`.`nama`
                    FROM `budget`JOIN `divisi`
                    ON `budget`.`idd` = `divisi`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function budgetone($ide)
    {
        $query = "  SELECT * FROM `budget` WHERE `ide` = $ide
        ";
        return $this->db->query($query)->result_array();
    }

    public function lastbudget()
    {
        return $this->db->order_by('id', "desc")->limit(1)->get('budget')->result_array();
    }

    public function updatebudget($ide, $idd, $budget, $persentase)
    {
        $query = "  UPDATE `budget` SET  `budget` = $budget, `persentase` = $persentase
                    WHERE `budget`.`ide` = $ide and `budget`.`idd` = $idd
        ";
        return $this->db->query($query);
    }

    public function allitem()
    {
        $query = "  SELECT * FROM `item`
        ";
        return $this->db->query($query)->result_array();
    }

    public function updateitem($id, $isinya)
    {
        $hasil = $this->db->where('id', $id);
        $hasil = $this->db->update('item', $isinya);
        return $hasil;
    }

    public function deleteitem($id)
    {
        $hasil = $this->db->where('id', $id);
        $hasil = $this->db->delete('item');
        return $hasil;
    }

    public function addbudget($isinya)
    {
        $hasil = $this->db->insert('budget', $isinya);
        return $hasil;
    }

    public function rabtemp($idwhere)
    {
        $query = "  SELECT * FROM rab_temp 
                    JOIN item ON rab_temp.idi=item.id 
                    WHERE ide=$idwhere
        ";
        return $this->db->query($query)->result_array();
    }

    public function rabperm($idwhere)
    {
        $query = "  SELECT * FROM rab_perm 
                    JOIN item ON rab_perm.idi=item.id 
                    WHERE ide=$idwhere
        ";
        return $this->db->query($query)->result_array();
    }

    public function addrab($isinya)
    {
        $hasil = $this->db->insert('rab_perm', $isinya);
        return $hasil;
    }
}
