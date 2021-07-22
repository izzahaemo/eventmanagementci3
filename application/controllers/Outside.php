<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outside extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_event');
        $this->load->model('m_schedule');
        $this->load->model('m_feedback');
    }
    public function index()
    {
        redirect('auth/blocked');
    }

    public function isianggota($eventcode)
    {
        check_outside1($eventcode);
        $data['event'] = $this->m_event->eventcode1($eventcode);
        $data['title'] = 'Isi Data Anggota';
        $data['eventcode'] = $eventcode;
        $idevent = $data['event']['id'];
        $data['schedule'] = $this->m_schedule->schedule_on($idevent);
        $data['divisi'] = $this->m_event->alldivisi();
        $data['lastmhs'] = $this->m_schedule->last_mhs();

        $this->form_validation->set_rules('name', 'Name', 'required');

        $c = 1;

        foreach ($data['schedule'] as $s) :
            $this->form_validation->set_rules('bi' . $c, 'bi' . $c, 'required', [
                'required' => 'Harus Pilih'
            ]);
            $c = $c + 1;
        endforeach;

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/outside_header", $data);
            $this->load->view("outside/isischedule", $data);
            $this->load->view("templates/outside_footer");
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
                'ide' => $idevent
            ];
            $this->m_schedule->addmhs($isinya);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Mahasiswa Berhasil Di Input! </div>');
            redirect('outside/isianggota/' . $eventcode);
        }
    }

    public function isifeedback($eventcode)
    {
        check_outside2($eventcode);
        $data['event'] = $this->m_event->eventcode2($eventcode);
        $data['title'] = 'Isi Data Anggota';
        $data['eventcode'] = $eventcode;
        $idevent = $data['event']['id'];

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        $c = 1;

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/outside_header", $data);
            $this->load->view("outside/isifeedback", $data);
            $this->load->view("templates/outside_footer");
        } else {

            $isinya = [
                'nama' => $this->input->post('nama'),
                'institusi' => $this->input->post('institusi'),
                'feedback' => $this->input->post('feedback'),
                'ide' => $idevent
            ];
            $this->m_feedback->addfeedback($isinya);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
               Feedback berhasil! </div>');
            redirect('outside/isifeedback/' . $eventcode);
        }
    }
}
