<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Budget extends CI_Controller
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
        $data['titlemenu'] = 'Budget';
        $data['title'] = '';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->show_event();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("budget/kosong", $data);
        $this->load->view("templates/footer", $data);
    }

    public function view($id)
    {
        $data['titlemenu'] = 'Budget';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->show_event();
        if ($id == 1) {
            $data['url'] = 'rab';
            $data['title'] = 'Atur Budget';
            $data['id'] = $id;
        } elseif ($id == 2) {
            $data['url'] = 'checkrab';
            $data['title'] = 'Budget Per-Divisi';
            $data['id'] = $id;
        } elseif ($id == 3) {
            $data['url'] = 'viewrab';
            $data['title'] = 'Rencana Anggaran';
            $data['id'] = $id;
        }
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("budget/index", $data);
        $this->load->view("templates/footer", $data);
    }

    public function rab($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Budget';
        $data['title'] = 'Atur Budget';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['idevent'] = $id;
        $data['divisi'] = $this->m_event->alldivisi();
        $data['url'] = 1;
        $i = 1;
        $sum = 0;

        $data['budget'] = $this->m_budget->budgetone($id);

        $f = false;
        foreach ($data['budget'] as $p) :
            $f = true;
        endforeach;

        foreach ($data['divisi'] as $d) :
            $this->form_validation->set_rules('budget' . $i, 'Budget' . $i, 'required');
            $sum = $sum + $this->input->post('budget' . $i);
            $i++;
        endforeach;

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("budget/rab", $data);
            $this->load->view("templates/footer", $data);
        } elseif ($sum == "100") {
            if ($f == false) {
                $i = 1;
                foreach ($data['divisi'] as $d) :
                    $persentase = $this->input->post('budget' . $i);
                    $budget = $data['event']['budget'] * $persentase / 100;
                    $isinya2 = [
                        'ide' => $id,
                        'idd' => $d['id'],
                        'budget' => $budget,
                        'persentase' => $persentase
                    ];
                    $this->m_budget->addbudget($isinya2);
                    $i++;
                endforeach;
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pembuatan Budget berhasil</div>');
                redirect('budget/checkrab/' . $id);
            } else {
                $i = 1;
                foreach ($data['divisi'] as $d) :
                    $persentase = $this->input->post('budget' . $i);
                    $budget = $data['event']['budget'] * $persentase / 100;
                    $this->m_budget->updatebudget($id, $i, $budget, $persentase);
                    $i++;
                endforeach;
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pembuatan Budget berhasil</div>');
                redirect('budget/checkrab/' . $id);
            }
        } elseif ($sum > "100") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Persentase Kelebihan</div>');
            redirect('budget/rab/' . $id);
        } elseif ($sum < "100") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Persentase Kekurangan</div>');
            redirect('budget/rab/' . $id);
        }
    }


    public function checkrab($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Budget';
        $data['title'] = 'Budget Per-Divisi';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['idevent'] = $id;
        $data['divisi'] = $this->m_event->alldivisi();
        $data['budget'] = $this->m_budget->allbudget();
        $data['url'] = 2;
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("budget/checkrab", $data);
        $this->load->view("templates/footer", $data);
    }

    public function goto($id)
    {
        check_event($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pembuatan rab berhasil</div>');
        redirect('budget/sementararab/' . $id);
    }

    public function sementararab($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Budget';
        $data['title'] = 'Rencana Anggaran Sementara';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['rab'] = $this->m_budget->rabtemp($id);
        $data['idevent'] = $id;
        $data['divisi'] = $this->m_event->alldivisi();
        $data['url'] = 3;
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("budget/sementararab", $data);
        $this->load->view("templates/footer", $data);
    }

    public function updaterab($id)
    {
        check_event($id);
        $data['rab'] = $this->m_budget->rabtemp($id);
        $this->db->query(' DELETE FROM `rab_perm` WHERE `rab_perm`.`ide` = ' . $id . '');
        foreach ($data['rab'] as $a) :
            $isinya = [
                'ide' => $id,
                'created_at' => $a['created_at'],
                'idi' => $a['idi']
            ];
            $this->m_budget->addrab($isinya);
        endforeach;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pembuatan RAB berhasil</div>');
        redirect('budget/viewrab/' . $id);
    }

    public function viewrab($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Budget';
        $data['title'] = 'Rencana Anggaran';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['rab'] = $this->m_budget->rabperm($id);
        $data['idevent'] = $id;
        $data['divisi'] = $this->m_event->alldivisi();
        $data['url'] = 3;
        $data['budget'] = $this->m_budget->budgetone($id);
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("budget/viewrab", $data);
        $this->load->view("templates/footer", $data);
    }

    public function printrab($id)
    {
        check_event($id);
        $data['rab'] = $this->m_budget->rabperm($id);
        $data['divisi'] = $this->m_event->alldivisi();
        $data['event'] = $this->m_event->eventone($id);
        $this->load->view('budget/printrab', $data);
    }

    public function buat($id)
    {
        check_event($id);
        $data['titlemenu'] = 'Admin';
        $data['title'] = 'Atur Budget';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['idevent'] = $id;
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("budget/buat", $data);
        $this->load->view("templates/footer", $data);
    }

    public function item()
    {
        $data['titlemenu'] = 'Budget';
        $data['title'] = 'List Item';
        $data['user'] = $this->m_user->userone();
        $data['item'] = $this->m_budget->allitem();
        $data['divisi'] = $this->m_event->alldivisi();
        $data['url'] = 2;
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("budget/item", $data);
        $this->load->view("templates/footer", $data);
    }
}
