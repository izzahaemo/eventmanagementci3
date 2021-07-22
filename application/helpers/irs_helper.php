<?php

function check_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-danger   " role="alert"> Anda Belum Login, silahkan Login dahulu </div>');
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAcces = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);
        if ($userAcces->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_re()
{
    $ci = get_instance();
    $role_id = $ci->session->userdata('role_id');
    if ($role_id != 5) {
        redirect('auth/blocked1');
    }
}

function check_ki()
{
    $ci = get_instance();
    $role_id = $ci->session->userdata('role_id');
    if ($role_id > 6) {
        redirect('auth/blocked');
    }
}
function check_event($idevent)
{
    $ci = get_instance();
    $iduser = $ci->session->userdata('id');
    $userAcces = $ci->db->get_where('event', ['id' => $idevent, 'idu' => $iduser]);
    if ($userAcces->num_rows() < 1) {
        redirect('auth/blocked');
    }
}

function check_outside1($eventcode)
{
    $ci = get_instance();
    $userAcces = $ci->db->get_where('event', ['codeanggota' => $eventcode]);
    if ($userAcces->num_rows() < 1) {
        redirect('auth/blocked');
    }
}

function check_outside2($eventcode)
{
    $ci = get_instance();
    $userAcces = $ci->db->get_where('event', ['codefeedback' => $eventcode]);
    if ($userAcces->num_rows() < 1) {
        redirect('auth/blocked');
    }
}
