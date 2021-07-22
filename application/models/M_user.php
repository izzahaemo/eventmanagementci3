<?php
// Untuk koneksi data user!
class M_user extends CI_Model
{
    public function show_user()
    {
        $query = "  SELECT `user`.*,`user_role`.`role`
                    FROM `user`JOIN `user_role`
                    ON `user`.`role_id` = `user_role`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function last_login()
    {
        $email = $this->session->userdata('email');
        $query = " UPDATE `user` SET `last_login` = NOW() WHERE `user`.`email` = '$email'; ";
        return $this->db->query($query);
    }

    public function userone()
    {
        $email = $this->session->userdata('email');
        $querylogin = " UPDATE `user` SET `last_login` = NOW() WHERE `user`.`email` = '$email'; ";
        $this->db->query($querylogin);

        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $iduser = $user['id'];
        $query = "  SELECT `user`.*,`user_role`.`role`
                    FROM `user`JOIN `user_role`
                    ON `user`.`role_id` = `user_role`.`id`
                    WHERE `user`.`id` = $iduser
        ";
        return $this->db->query($query)->row_array();
    }

    function getrole()
    {
        $isi = $this->db->get('user_role')->result_array();
        return $isi;
    }
    function addrole($isi)
    {
        $hasil = $this->db->insert('user_role', $isi);
        return $hasil;
    }

    function edit_user($iduser, $edit_role, $edit_active, $edit_email)
    {
        $isi = array(
            'email' => $edit_email,
            'role_id' => $edit_role,
            'is_active' => $edit_active
        );
        $hasil = $this->db->where('id', $iduser);
        $hasil = $this->db->update('user', $isi);
        return $hasil;
    }

    function aktif_user($iduser)
    {
        $isi = array(
            'is_active' => '1'
        );
        $hasil = $this->db->where('id', $iduser);
        $hasil = $this->db->update('user', $isi);
        return $hasil;
    }

    function delete_user($iduser)
    {
        $isi['user'] = $this->db->get_where('user', ['id' => $iduser])->row_array();
        $imageuser = $isi['user']['image'];
        if ($imageuser != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $imageuser);
        }
        $hasil = $this->db->where('id', $iduser);
        $hasil = $this->db->delete('user');
        return $hasil;
    }

    function select_user($iduser)
    {
        $hasil = $this->db->get_where('user', ['id' => $iduser])->row_array();
        return $hasil;
    }

    function updaterole($id, $role)
    {
        $isi = array(
            'terakhir' => date('Y-m-d H:i:s'),
            'oleh' => $role
        );
        $hasil = $this->db->where('id', $id);
        $hasil = $this->db->update('user_role', $isi);
        return $hasil;
    }

    function check($id)
    {
        $query = "SELECT `votei`, `votea` FROM `user` WHERE `id` = '$id'";
        return $this->db->query($query)->row_array();
    }

    function select_emails()
    {
        $hasil = $this->db->get_where('emails', ['id' => 1])->row_array();
        return $hasil;
    }
}
