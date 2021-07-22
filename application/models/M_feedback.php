<?php
// Untuk koneksi data user!
class M_feedback extends CI_Model
{
    public function onekomentar($idwhere)
    {
        $query = "  SELECT * FROM `komentar`
                    WHERE `komentar`.`ide` = $idwhere
        ";
        return $this->db->query($query)->result_array();
    }

    public function onefeedback($idwhere)
    {
        $query = "  SELECT * FROM `feedbacksummary`
                    WHERE `feedbacksummary`.`ide` = $idwhere
        ";
        return $this->db->query($query)->row_array();
    }

    public function addfeedback($isinya)
    {
        $hasil = $this->db->insert('komentar', $isinya);
        return $hasil;
    }
}
