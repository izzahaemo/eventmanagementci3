<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_user');
    }

    public function index()
    {
        $this->goToDefaultPage();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $isi['title'] = 'Event Management App';
            $this->load->view('templates/auth_header', $isi);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            //user aktif
            if ($user['is_active'] == 1) {
                //cekpassword
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id']
                    ];
                    $this->session->set_userdata($data);
                    redirect('user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Salah </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Akun belum Aktif, silahkan hubungi Admin!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email belum Terdaftar </div>');
            redirect('auth');
        }
    }



    public function registration()
    {
        $this->goToDefaultPage();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        //
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu Pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $isi['title'] = 'Registrasi';
            $this->load->view('templates/auth_header', $isi);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => $this->input->post('email', true),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1
            ];
            //htmlspecialchars($this->input->post('name',true));
            $this->db->insert('user', $data);
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
                'smtp_user' => 'eventmanagementapp2021@gmail.com',  // Email gmail
                'smtp_pass'   => 'darklord12345678',  // Password gmail
                'smtp_crypto' => 'ssl',
                'smtp_port'   => 465,
                'crlf'    => "\r\n",
                'newline' => "\r\n"
            ];
            
            $edit_email =  $this->input->post('email', true);
            $this->load->library('email', $config);
            $this->email->from('emapp.no.reply@gmail.com', 'Event Management APP');
            $this->email->to($edit_email);
            $this->email->subject('Aktivasi Akun Event Management APP');
            $this->email->message("$b $name<br>Akun Anda sudah di Aktifkan </br><br><br> Klik <strong><a href='http://localhost:8080/eventmanagementci3' target='_blank' rel='noopener'>Disini</a></strong> Untuk masuk Ke Aplikasi<br><br>Terima kasih<br><br>");
            $this->email->send();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Akun Berhasil Dibuat, Silahkan Cek Email dan Folder Spam Untuk Aktivasi </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success   " role="alert">Anda berhasil Logout </div>');
        redirect('auth');
    }


    public function blocked()
    {
        $isi['title'] = 'Acces Denied';
        $this->load->view('templates/auth_header', $isi);
        $this->load->view('auth/blocked');
        $this->load->view('templates/auth_footer');
    }
    public function blocked1()
    {
        $isi['title'] = 'Acces Denied';
        $this->load->view('templates/auth_header', $isi);
        $this->load->view('auth/blocked1');
        $this->load->view('templates/auth_footer');
    }

    public function about()
    {
        $isi['title'] = 'About Us';
        $this->load->view('templates/auth_header', $isi);
        $this->load->view('auth/about');
        $this->load->view('templates/auth_footer');
    }

    public function goToDefaultPage()
    {
        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        } else {
            // jika ada role_id yg lain maka tambahkan disini
        }
    }
}
