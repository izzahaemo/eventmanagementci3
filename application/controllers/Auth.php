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
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email Sudah Di Guanakan'
        ]);
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
                'is_active' => 0
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
            $name = htmlspecialchars($this->input->post('name', true));

            $token = base64_encode(random_bytes(32));

            $user_token = [
                'email' => $edit_email,
                'token' => $token
            ];
            $this->db->insert('user_token', $user_token);


            $this->load->library('email', $config);
            $this->email->from('eventmanagementapp2021@gmail.com', 'Event Management APP');
            $this->email->to($edit_email);
            $this->email->subject('Aktivasi Akun Event Management APP');
            $this->email->message("$b $name<br><br> Klik <strong><a href=" . base_url() . 'auth/verify?email=' . $edit_email . '&token=' . urlencode($token) .   ">Disini</a></strong> Untuk Aktivasi Akun<br><br>Terima kasih<br><br>");
            $this->email->send();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Akun Berhasil Dibuat, Silahkan Cek Email dan Folder Spam Untuk Aktivasi </div>');
            redirect('auth');
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->db->set('is_active', 1);
                $this->db->where('email', $email);
                $this->db->update('user');

                $this->db->delete('user_token', ['email' => $email]);
                $this->session->set_flashdata('message', '<div class="alert alert-success   " role="alert">Aktivasi Akun Berhasil. Silahkan login </div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger   " role="alert">Aktivasi Akun Gagal. Token Salah </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger   " role="alert">Aktivasi Akun Gagal. Email Salah </div>');
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


    public function forgotpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == false) {
            $isi['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $isi);
            $this->load->view('auth/forgotpassword');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));

                $user_token = [
                    'email' => $email,
                    'token' => $token
                ];
                $this->db->insert('user_token', $user_token);

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

                $this->load->library('email', $config);
                $name = $user['name'];
                $this->email->from('eventmanagementapp2021@gmail.com', 'Event Management APP');
                $this->email->to($email);
                $this->email->subject('Reset Password Event Management APP');
                $this->email->message("$b $name<br><br> Klik <strong><a href=" . base_url() . 'auth/resetpassword?email=' . $email . '&token=' . urlencode($token) .   ">Disini</a></strong> Untuk Reset Password Anda<br><br>Terima kasih<br><br>");
                $this->email->send();

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Link Reset Password Berhasil Dibuat, Silahkan Cek Email dan Folder Spam Untuk Reset Password</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger   " role="alert">Email Tidak Terdafatar</div>');
                redirect('auth');
            }
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changepassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger   " role="alert">Aktivasi Akun Gagal. Token Salah </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger   " role="alert">Reset Password Akun Gagal. Email Salah </div>');
            redirect('auth');
        }
    }

    public function changepassword()
    {
        if (!$this->session->userdata('reset_email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger   " role="alert">Reset Password Akun Gagal</div>');
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu Pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $isi['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $isi);
            $this->load->view('auth/changepassword');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['email' => $email]);
            $this->session->set_flashdata('message', '<div class="alert alert-success   " role="alert">Password Berhasil Di Ubah. Silahkan login </div>');
            redirect('auth');
        }
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
