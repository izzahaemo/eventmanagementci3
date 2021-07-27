<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_user');
        $this->load->model('m_event');
        $this->load->model('m_budget');
    }

    public function index()
    {
        $data['titlemenu'] = 'Admin';
        $data['title'] = 'Dashboard';
        $data['user'] = $this->m_user->userone();
        $data['all'] = $this->m_user->show_user();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("admin/index", $data);
        $this->load->view("templates/footer", $data);
    }
    public function role()
    {
        $data['titlemenu'] = 'Admin';
        $data['title'] = 'Role';
        $data['user'] = $this->m_user->userone();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("admin/role", $data);
        $this->load->view("templates/footer", $data);
    }
    public function addrole()
    {
        $namerole = $this->input->post('role');
        $lastid = $this->input->post('lastid');

        $isi = [
            'id' => $lastid,
            'role' => $namerole
        ];
        $this->m_user->addrole($isi);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed! </div>');
        redirect('admin/role');
    }
    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['titlemenu'] = 'Admin';
        $data['user'] = $this->m_user->userone();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("admin/role-access", $data);
        $this->load->view("templates/footer", $data);
    }
    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed! </div>');
    }
    public function account()
    {
        $data['titlemenu'] = 'Admin';
        $data['title'] = 'Account';
        $data['user'] = $this->m_user->userone();
        $data['account'] = $this->m_user->show_user();
        $data['role'] = $this->m_user->getrole();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("admin/account", $data);
        $this->load->view("templates/footer", $data);
    }

    public function edit_user()
    {
        $iduser = $this->input->post('iduser');
        //$edit_role = $this->input->post('edit_role');
        $edit_email = $this->input->post('email');
        $edit_active = $this->input->post('edit_active');
        $edit_role = $this->input->post('edit_role');
        $this->m_user->edit_user($iduser, $edit_role, $edit_active, $edit_email);
        $name =  $this->input->post('namee');
        if ($edit_active == 1) {

            $a = date("H");
            if (($a >= 6) && ($a <= 11)) {
                $b = "Selamat Pagi";
            } else if (($a >= 11) && ($a <= 15)) {
                $b = "Selamat Siang";
            } elseif (($a > 15) && ($a <= 18)) {
                $b = "Selamat Sore";
            } else {
                $b = "Selamat Malam";
            }

            $config = [
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'protocol'  => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_user' => 'sisuka.no.reply@gmail.com',  // Email gmail
                'smtp_pass'   => '12j3lkSLK7sad12',  // Password gmail
                'smtp_crypto' => 'ssl',
                'smtp_port'   => 465,
                'crlf'    => "\r\n",
                'newline' => "\r\n"
            ];

            $this->load->library('email', $config);
            $this->email->from('emapp.no.reply@gmail.com', 'Event Management APP');
            $this->email->to($edit_email);
            $this->email->subject('Aktivasi Akun Event Management APP');
            $this->email->message("$b $name<br>Akun Anda sudah di Aktifkan </br><br><br> Klik <strong><a href='http://localhost/eventmanagementci3' target='_blank' rel='noopener'>Disini</a></strong> Untuk masuk Ke Aplikasi<br><br>Terima kasih<br><br>");
            $this->email->send();
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun berhasil di ubah! </div>');
        redirect('admin/account/');
    }

    public function delete()
    {
        $iduser = $this->input->post('iduser');
        $this->m_user->delete_user($iduser);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun berhasil dihapus! </div>');
        redirect('admin/account/');
    }

    public function item()
    {
        $data['titlemenu'] = 'Admin';
        $data['title'] = 'List Item';
        $data['user'] = $this->m_user->userone();
        $data['item'] = $this->m_budget->allitem();
        $data['divisi'] = $this->m_event->alldivisi();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("admin/item", $data);
        $this->load->view("templates/footer", $data);
    }

    public function itemedit()
    {
        $iditem = $this->input->post('id_item');
        $total_harga = $this->input->post('jumlah') * $this->input->post('harga');
        $isinya = [
            'in_or_outdoor' => $this->input->post('in_or_outdoor'),
            'item_kategori' => $this->input->post('item_kategori'),
            'divisi' => $this->input->post('divisi'),
            'item' => $this->input->post('item'),
            'jumlah' => $this->input->post('jumlah'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga'),
            'total_harga' => $total_harga,
            'value' => $this->input->post('value')
        ];
        $this->m_budget->updateitem($iditem, $isinya);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Item berhasil di perbarui</div>');
        redirect('admin/item/');
    }
    public function itemhapus()
    {
        $iditem = $this->input->post('id_item');
        $this->m_budget->deleteitem($iditem);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Item berhasil di hapus</div>');
        redirect('admin/item/');
    }
}
