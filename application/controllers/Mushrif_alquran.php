<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mushrif_alquran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mushrif_alquran_model');
        is_login();
    }

    public function index()
    {
        $data['menu'] = "Master";
        $data['page'] = "Daftar Mushrif Alqur`an";
        $data['load_css_js'] = "mushrif_alquran_index";

        $this->template->load('template/main_template', 'view_mushrif_alquran_index', $data);
    }

    public function mushrif_alquran_data()
    {
        header('Content-Type: application/json');
        echo $this->Mushrif_alquran_model->get_mushrif_alquran_as_datatables();
    }

    public function create()
    {
        $data['menu'] = "Master";
        $data['page'] = "Tambah Mushrif Alqur`an";
        $data['load_css_js'] = "";
        $data['action'] = site_url('mushrif_alquran/create_action');
        $data['mushrif_tahfidz_id'] = set_value('mushrif_tahfidz_id');
        $data['users_id'] = set_value('users_id');
        $data['mushrif_tahfidz_status'] = set_value('mushrif_tahfidz_status');
        $this->template->load('template/main_template', 'view_mushrif_alquran_form_create', $data);
    }

    public function create_action()
    {
        $this->form_validation->set_rules('users_id', 'Nama Mushrif Alqur`an', 'trim|required');
        $this->form_validation->set_rules('mushrif_tahfidz_status', 'Status', 'trim|required');
        $this->form_validation->set_rules('mushrif_tahfidz_id', 'mushrif_tahfidz_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $users_id = $this->input->post('users_id', TRUE);
            $mushrif = $this->Mushrif_alquran_model->get_mushrif_by_user_id($users_id);
            if ($mushrif->num_rows() > 0){
                $this->session->set_flashdata('error_message', 'Data Mushrif Alqur`an Sudah Ada');
                redirect(site_url('mushrif_alquran'));
            }else {
                $data['mushrif_tahfidz_id'] = insert_uuid();
                $data['users_id'] = $users_id;
                $data['mushrif_tahfidz_status'] = $this->input->post('mushrif_tahfidz_status', TRUE);
    
                $this->Mushrif_alquran_model->insert_mushrif_alquran($data);
                $this->session->set_flashdata('success_message', 'Data Mushrif Alqur`an Berhasil di Tambah');
                redirect(site_url('mushrif_alquran'));
            }   
        }
    }

    public function update($id)
    {
        $row = $this->Mushrif_alquran_model->get_mushrif_alquran_by_mushrif_tahfidz_id($id)->row();

        if ($row) {
            $data['menu'] = "Master";
            $data['page'] = "Edit Mushrif Alqur`an";
            $data['load_css_js'] = "";
            $data['action'] = site_url('mushrif_alquran/update_action');
            $data['mushrif_tahfidz_id'] = set_value('mushrif_tahfidz_id', $row->mushrif_tahfidz_id);
            $data['users_id'] = set_value('users_id', $row->users_id);
            $data['mushrif_tahfidz_status'] = set_value('mushrif_tahfidz_status', $row->mushrif_tahfidz_status);

            $this->template->load('template/main_template', 'view_mushrif_alquran_form_update', $data);
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('mushrif_alquran'));
        }
    }

    public function update_action()
    {
        $this->form_validation->set_rules('users_id', 'Nama Mushrif Alqur`an', 'trim');
        $this->form_validation->set_rules('mushrif_tahfidz_status', 'Status', 'trim|required');
        $this->form_validation->set_rules('mushrif_tahfidz_id', 'mushrif_tahfidz_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('mushrif_tahfidz_id', TRUE));
        } else {
            $data['mushrif_tahfidz_status'] = $this->input->post('mushrif_tahfidz_status', TRUE);

            $this->Mushrif_alquran_model->update_mushrif_alquran($this->input->post('mushrif_tahfidz_id', TRUE), $data);
            $this->session->set_flashdata('success_message', 'Data Mushrif Alqur`an Berhasil di Update');
            redirect(site_url('mushrif_alquran'));
        }
    }

    public function delete($id)
    {
        $row = $this->Mushrif_alquran_model->get_mushrif_alquran_by_mushrif_tahfidz_id($id)->row();

        if ($row) {
            $this->Mushrif_alquran_model->delete_mushrif_alquran($id);
            $this->session->set_flashdata('success_message', 'Data Mushrif Alqur`an Berhasil di Hapus');
            redirect(site_url('mushrif_alquran'));
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('mushrif_alquran'));
        }
    }
}
