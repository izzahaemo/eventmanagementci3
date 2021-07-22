<?php
// Untuk koneksi data user!
class M_schedule extends CI_Model
{
    public function allmhs()
    {
        $query = "  SELECT * FROM `data_mhs`
        ";
        return $this->db->query($query)->result_array();
    }

    public function mhsone($idwhere)
    {
        $hasil = $this->db->get_where('data_mhs', ['id' => $idwhere])->row_array();
        return $hasil;
    }

    public function mhsevent($idwhere)
    {
        $query = "  SELECT * FROM `data_mhs`
                    JOIN `divisi` ON `data_mhs`.`idd` = `divisi`.`id`
                    WHERE `ide` = $idwhere
        ";
        return $this->db->query($query)->result_array();
    }


    public function data_mhs()
    {
        $query = "  SELECT `data_mhs`.*,`divisi`.`nama`
                    FROM `data_mhs`JOIN `divisi`
                    ON `data_mhs`.`idd` = `divisi`.`id`
        ";
        return $this->db->query($query)->result_array();
    }
    public function last_mhs()
    {
        return $this->db->order_by('id', "desc")->limit(1)->get('data_mhs')->result_array();
    }

    public function addmhs($isinya)
    {
        $hasil = $this->db->insert('data_mhs', $isinya);
        return $hasil;
    }

    public function updatemhs($id, $isinya)
    {
        $hasil = $this->db->where('id', $id);
        $hasil = $this->db->update('data_mhs', $isinya);

        return $hasil;
    }

    public function deletemhs($idmhs)
    {
        // $isi['user'] = $this->db->get_where('user', ['id' => $iduser])->row_array();
        // $imageuser = $isi['user']['image'];
        // if ($imageuser != 'default.jpg') {
        //     unlink(FCPATH . 'assets/img/profile/' . $imageuser);
        // }
        $hasil = $this->db->where('id', $idmhs);
        $hasil = $this->db->delete('data_mhs');
        return $hasil;
    }

    public function schedule_on($idwhere)
    {
        $query = "  SELECT * FROM `schedule_on`
                    WHERE `schedule_on`.`ide`= $idwhere
        ";
        return $this->db->query($query)->result_array();
    }

    public function editscheduleo($id, $isinya)
    {
        $hasil = $this->db->where('id', $id);
        $hasil = $this->db->update('schedule_on', $isinya);
        return $hasil;
    }

    public function addscheduleo($isinya)
    {
        $hasil = $this->db->insert('schedule_on', $isinya);
        return $hasil;
    }

    public function deletescheduleo($ids)
    {
        $hasil = $this->db->where('id', $ids);
        $hasil = $this->db->delete('schedule_on');
        return $hasil;
    }

    public function schedule_temp()
    {
        $query = "  SELECT * FROM `schedule_tempory`
                    JOIN `schedule_on` ON `schedule_tempory`.`id_schedule` = `schedule_on`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function schedule_perm($idwhere)
    {
        $query = "  SELECT * FROM `schedule_perm`
                    JOIN `schedule_on` ON `schedule_perm`.`id_schedule` = `schedule_on`.`id`
                    WHERE `schedule_perm`.`ide` = $idwhere
        ";
        return $this->db->query($query)->result_array();
    }

    public function lastschedulep()
    {
        return $this->db->order_by('id', "desc")->limit(1)->get('schedule_perm')->result_array();
    }

    public function addschedulep($isinya)
    {
        $hasil = $this->db->insert('schedule_perm', $isinya);
        return $hasil;
    }

    public function editschedulep($ids, $ide, $isinya)
    {
        $hasil = $this->db->where('id_schedule', $ids);
        $hasil = $this->db->where('ide', $ide);
        $hasil = $this->db->update('schedule_perm', $isinya);
        return $hasil;
    }
}
