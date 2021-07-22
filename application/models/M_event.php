<?php
// Untuk koneksi data user!
class M_event extends CI_Model
{
    public function show_event()
    {
        $query = "  SELECT * FROM `event`
        ";
        return $this->db->query($query)->result_array();
    }

    public function eventone($idwhere)
    {
        $hasil = $this->db->get_where('event', ['id' => $idwhere])->row_array();
        return $hasil;
    }

    public function eventcode1($eventcode)
    {
        $hasil = $this->db->get_where('event', ['codeanggota' => $eventcode])->row_array();
        return $hasil;
    }

    public function eventcode2($eventcode)
    {
        $hasil = $this->db->get_where('event', ['codefeedback' => $eventcode])->row_array();
        return $hasil;
    }

    public function alldivisi()
    {
        $query = "  SELECT * FROM `divisi`
        ";
        return $this->db->query($query)->result_array();
    }

    public function addevent($isinya)
    {
        $hasil = $this->db->insert('event', $isinya);
        return $hasil;
    }

    public function editevent($id, $isinya)
    {
        $hasil = $this->db->where('id', $id);
        $hasil = $this->db->update('event', $isinya);
        return $hasil;
    }

    public function deleteevent($ids)
    {
        $hasil = $this->db->where('id', $ids);
        $hasil = $this->db->delete('event');
        return $hasil;
    }

    public function lastevent()
    {
        return $this->db->order_by('id', "desc")->limit(1)->get('event')->result_array();
    }
}
