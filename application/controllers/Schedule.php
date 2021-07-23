<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_user');
        $this->load->model('m_schedule');
        $this->load->model('m_event');
    }

    public function index()
    {
        $data['titlemenu'] = 'Schedule';
        $data['title'] = 'Lihat Schedule';
        $data['user'] = $this->m_user->userone();
        $data['schedule'] = $this->m_schedule->schedule_perm();
        $data['data_mhs'] = $this->m_schedule->data_mhs();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("schedule/kosong", $data);
        $this->load->view("templates/footer", $data);
    }


    public function view($id)
    {
        $data['titlemenu'] = 'Schedule';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->show_event();
        if ($id == 1) {
            $data['url'] = 'buat';
            $data['title'] = 'Event Schedule';
            $data['idview'] = $id;
        } elseif ($id == 2) {
            $data['url'] = 'atur';
            $data['title'] = 'Member Schedule';
            $data['idview'] = $id;
        } elseif ($id == 3) {
            $data['url'] = 'generate';
            $data['title'] = 'Generate Plotting Schedule';
            $data['idview'] = $id;
        } elseif ($id == 4) {
            $data['url'] = 'lihat';
            $data['title'] = 'Plot Schedule';
            $data['idview'] = $id;
        }
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("schedule/index", $data);
        $this->load->view("templates/footer", $data);
    }

    public function buat($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Schedule';
        $data['title'] = 'Event Schedule';
        $data['user'] = $this->m_user->userone();
        $data['idevent'] = $id;
        $data['schedule'] = $this->m_schedule->schedule_on($id);
        $data['event'] = $this->m_event->eventone($id);
        $data['url'] = 1;
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("schedule/buat", $data);
        $this->load->view("templates/footer", $data);
    }

    public function addscheduleo($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Schedule';
        $data['title'] = 'Event Schedule';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['idevent'] = $id;
        $data['url'] = 1;
        $this->form_validation->set_rules('scheduleo', 'Scheduleo', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("schedule/addscheduleo", $data);
            $this->load->view("templates/footer", $data);
        } else {
            $isinya = [
                'ide' => $id,
                'schedule' => $this->input->post('scheduleo'),
                'mulai' => $this->input->post('mulai'),
                'selesai' => $this->input->post('selesai')
            ];
            $this->m_schedule->addscheduleo($isinya);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Schedule Berhasil Di Input</div>');
            redirect('schedule/addscheduleo/' . $id);
        }
    }

    public function editscheduleo($id)
    {
        check_event($id);
        $idschedule = $this->input->post('ids');
        $isinya = [
            'schedule' => $this->input->post('scheduleo'),
            'mulai' => $this->input->post('mulai'),
            'selesai' => $this->input->post('selesai')
        ];
        $this->m_schedule->editscheduleo($idschedule, $isinya);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Event Schedule Berhasil Di Perbarui</div>');
        redirect('schedule/buat/' . $id);
    }

    public function deletescheduleo($id)
    {
        check_event($id);
        $ids = $this->input->post('ids');
        $this->m_schedule->deletescheduleo($ids);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Event Schedule Berhasil Di Hapus </div>');
        redirect('schedule/buat/' . $id);
    }

    public function printscheduleo($id)
    {
        check_event($id);
        $data['schedule'] = $this->m_schedule->schedule_on($id);
        $data['event'] = $this->m_event->eventone($id);
        $this->load->view('schedule/printscheduleo', $data);
    }

    public function atur($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Schedule';
        $data['title'] = 'Member Schedule';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        //$data['mhs'] = $this->m_schedule->mhsevent($id);
        $data['mhs'] = $this->m_schedule->data_mhs();
        $data['divisi'] = $this->m_event->alldivisi();
        $data['idevent'] = $id;
        $data['url'] = 2;
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("schedule/atur", $data);
        $this->load->view("templates/footer", $data);
    }

    public function addmhs($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Schedule';
        $data['title'] = 'Member Schedule';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['divisi'] = $this->m_event->alldivisi();
        $data['idevent'] = $id;
        $data['schedule'] = $this->m_schedule->schedule_on($id);
        $data['lastmhs'] = $this->m_schedule->last_mhs();
        $data['url'] = 2;

        $this->form_validation->set_rules('name', 'Name', 'required');

        $c = 1;

        foreach ($data['schedule'] as $s) :
            $this->form_validation->set_rules('bi' . $c, 'bi' . $c, 'required', [
                'required' => 'Harus Pilih'
            ]);
            $c = $c + 1;
        endforeach;

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("schedule/addmhs", $data);
            $this->load->view("templates/footer", $data);
        } else {
            $i = 1;
            $at = "1";
            foreach ($data['schedule'] as $s) :

                $at = $at . $this->input->post('bi' . $i);

                $i = $i + 1;
            endforeach;
            $lastid = $data['lastmhs'][0]['id'] + 1;
            $isinya = [
                'id' => $lastid,
                'idd' => $this->input->post('idd'),
                'name' => $this->input->post('name'),
                'class' => $at,
                'pointer' => 1,
                'nick' => $this->input->post('nick'),
                'no_telp' => $this->input->post('no_telp'),
                'ide' => $id
            ];
            $this->m_schedule->addmhs($isinya);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Member Berhasil Di Input! </div>');
            redirect('schedule/addmhs/' . $id);
        }
    }

    public function editmhs1($id)
    {
        check_event($id);
        $idmhs = $this->input->post('idmhs');
        $isinya = [
            'name' => $this->input->post('name'),
            'nick' => $this->input->post('nick'),
            'no_telp' => $this->input->post('no_telp'),
            'idd' => $this->input->post('idd')
        ];
        $this->m_schedule->updatemhs($idmhs, $isinya);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Member berhasil di perbarui</div>');
        redirect('schedule/atur/' . $id);
    }



    public function editmhs2($id, $idmhs)
    {
        check_event($id);
        $data['titlemenu'] = 'Schedule';
        $data['title'] = 'Member Schedule';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['divisi'] = $this->m_event->alldivisi();
        $data['idevent'] = $id;
        $data['schedule'] = $this->m_schedule->schedule_on($id);
        $data['lastmhs'] = $this->m_schedule->last_mhs();
        $data['mhs'] = $this->m_schedule->mhsone($idmhs);
        $data['url'] = 2;

        $this->form_validation->set_rules('name', 'Name', 'required');

        $c = 1;

        foreach ($data['schedule'] as $s) :
            $this->form_validation->set_rules('bi' . $c, 'bi' . $c, 'required', [
                'required' => 'Harus Pilih'
            ]);
            $c = $c + 1;
        endforeach;

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("schedule/editmhs2", $data);
            $this->load->view("templates/footer", $data);
        } else {
            $i = 1;
            $at = "1";
            foreach ($data['schedule'] as $s) :

                $at = $at . $this->input->post('bi' . $i);

                $i = $i + 1;
            endforeach;
            $isinya = [
                'class' => $at
            ];
            $this->m_schedule->updatemhs($idmhs, $isinya);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Member Berhasil Di Update! </div>');
            redirect('schedule/atur/' . $id);
        }
    }

    public function deletemhs($id)
    {
        check_event($id);
        $idmhs = $this->input->post('idmhs');
        $this->m_schedule->deletemhs($idmhs);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun berhasil dihapus! </div>');
        redirect('schedule/atur/' . $id);
    }

    public function printmhs($id)
    {
        check_event($id);
        $data['event'] = $this->m_event->eventone($id);
        $data['mhs'] = $this->m_schedule->mhsevent($id);
        $this->load->view('schedule/printmhs', $data);
    }

    public function generate($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Schedule';
        $data['title'] = 'Generate Plotting Schedule';
        $data['user'] = $this->m_user->userone();
        $data['schedule'] = $this->m_schedule->schedule_temp();
        $data['idevent'] = $id;
        $data['event'] = $this->m_event->eventone($id);
        $data['url'] = 3;
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("schedule/generate", $data);
        $this->load->view("templates/footer", $data);
    }

    public function goto($id)
    {
        check_event($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Plotting Schedule Sementara Berhasil</div>');
        redirect('schedule/sementara/' . $id);
    }

    public function sementara($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Schedule';
        $data['title'] = 'Generate Plotting Schedule';
        $data['user'] = $this->m_user->userone();
        $data['schedule'] = $this->m_schedule->schedule_temp();
        $data['data_mhs'] = $this->m_schedule->data_mhs();
        $data['idevent'] = $id;
        $data['event'] = $this->m_event->eventone($id);
        $data['url'] = 3;
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("schedule/sementara", $data);
        $this->load->view("templates/footer", $data);
    }

    public function updateschedule($id)
    {
        check_event($id);
        $data['schedule'] = $this->m_schedule->schedule_temp();
        $data['perm'] = $this->m_schedule->schedule_perm($id);
        $data['lastids'] = $this->m_schedule->lastschedulep();
        $f = false;
        foreach ($data['perm'] as $p) :
            $f = true;

        endforeach;
        $lastids = $data['lastids'][0]['id'];
        if ($f == false) {
            foreach ($data['schedule'] as $a) :
                $lastids = $lastids + 1;
                $ids = $a['id_schedule'];
                $isinya = [
                    'id' => $lastids,
                    'id_schedule' => $a['id_schedule'],
                    'is_fine' => $a['is_fine'],
                    'ide' => $id,
                    'div_1' => $a['div_1'],
                    'div_2' => $a['div_2'],
                    'div_3' => $a['div_3'],
                    'div_4' => $a['div_4'],
                    'div_5' => $a['div_5'],
                    'div_6' => $a['div_6'],
                    'div_7' => $a['div_7']
                ];
                $this->m_schedule->addschedulep($isinya);
            endforeach;
        } else {
            foreach ($data['schedule'] as $a) :
                $ids = $a['id_schedule'];
                $isinya = [
                    'is_fine' => $a['is_fine'],
                    'div_1' => $a['div_1'],
                    'div_2' => $a['div_2'],
                    'div_3' => $a['div_3'],
                    'div_4' => $a['div_4'],
                    'div_5' => $a['div_5'],
                    'div_6' => $a['div_6'],
                    'div_7' => $a['div_7']
                ];
                $this->m_schedule->editschedulep($ids, $id, $isinya);
            endforeach;
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pembuatan Schedule berhasil</div>');
        redirect('schedule/lihat/' . $id);
    }

    public function lihat($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Schedule';
        $data['title'] = 'Plot Schedule';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['schedule'] = $this->m_schedule->schedule_perm($id);
        $data['data_mhs'] = $this->m_schedule->data_mhs();
        $data['url'] = 4;
        $data['idevent'] = $id;
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("schedule/lihat", $data);
        $this->load->view("templates/footer", $data);
    }

    public function printschedulep($id)
    {
        check_event($id);
        $data['schedule'] = $this->m_schedule->schedule_perm($id);
        $data['data_mhs'] = $this->m_schedule->data_mhs();
        $data['event'] = $this->m_event->eventone($id);
        $this->load->view('schedule/printschedulep', $data);
    }
}
