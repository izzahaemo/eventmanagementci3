<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_user');
        $this->load->model('m_event');
        $this->load->model('m_budget');
        $this->load->model('m_feedback');
    }

    public function index()
    {
        $data['titlemenu'] = 'feedback';
        $data['title'] = 'Feedback';
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
        $data['titlemenu'] = 'Feedback';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->show_event();
        if ($id == 1) {
            $data['url'] = 'feedback';
            $data['title'] = 'Feedback';
            $data['id'] = $id;
        }
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("feedback/index", $data);
        $this->load->view("templates/footer", $data);
    }

    public function feedback($id)
    {
        $data['titlemenu'] = 'Feedback';
        $data['title'] = 'Feedback';
        $data['user'] = $this->m_user->userone();
        $data['event'] = $this->m_event->eventone($id);
        $data['komentar'] = $this->m_feedback->onekomentar($id);
        $data['feedback'] = $this->m_feedback->onefeedback($id);
        $data['idevent'] = $id;
        $data['total'] = 0;
        $data['ada'] = false;

        foreach ($data['komentar'] as $k) :
            $data['ada'] = true;
            $data['total'] = $data['total'] + 1;
        endforeach;

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("feedback/feedback", $data);
        $this->load->view("templates/footer", $data);
    }
}
