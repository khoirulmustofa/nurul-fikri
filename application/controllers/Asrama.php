<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asrama extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Asrama_model');
        is_login();
    }

    public function index()
    {
        $data['menu'] = "Master";
        $data['page'] = "Daftar Asrama";
        $data['load_css_js'] = "asrama_index";

        $this->template->load('template/main_template', 'view_asrama_index', $data);
    }

    public function asrama_data()
    {
        header('Content-Type: application/json');
        echo $this->Asrama_model->get_asrama_as_datatables();
    }

    public function create()
    {
        $data['menu'] = "Master";
        $data['page'] = "Tambah Asrama";
        $data['load_css_js'] = "";
        $data['action'] = site_url('asrama/create_action');
        $data['asrama_id'] = set_value('asrama_id');
        $data['users_id'] = set_value('users_id');
        $data['asrama_nama'] = set_value('asrama_nama');
        $this->template->load('template/main_template', 'view_asrama_form_create', $data);
    }

    public function create_action()
    {
        $this->form_validation->set_rules('users_id', 'Wali Asrama', 'trim|required');
        $this->form_validation->set_rules('asrama_nama', 'Nama Asrama', 'trim|required');
        $this->form_validation->set_rules('asrama_id', 'asrama_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $users_id = $this->input->post('users_id', TRUE);
            $Asrama = $this->Asrama_model->get_asrama_by_users_id($users_id);
            if ($Asrama->num_rows() > 0){
                $this->session->set_flashdata('error_message', 'Data Wali Asrama Sudah Ada');
                redirect(site_url('asrama'));
            }else {
                $data['asrama_id'] = insert_uuid();
                $data['users_id'] = $users_id;
                $data['asrama_nama'] = $this->input->post('asrama_nama', TRUE);
    
                $this->Asrama_model->insert_asrama($data);
                $this->session->set_flashdata('success_message', 'Data Asrama Berhasil di Tambah');
                redirect(site_url('asrama'));
            }   
        }
    }

    public function update($id)
    {
        $row = $this->Asrama_model->get_asrama_by_asrama_id($id)->row();

        if ($row) {
            $data['menu'] = "Master";
            $data['page'] = "Edit Asrama";
            $data['load_css_js'] = "";
            $data['action'] = site_url('asrama/update_action');
            $data['asrama_id'] = set_value('asrama_id', $row->asrama_id);
            $data['users_id'] = set_value('users_id', $row->users_id);
            $data['asrama_nama'] = set_value('asrama_nama', $row->asrama_nama);

            $this->template->load('template/main_template', 'view_asrama_form_update', $data);
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('asrama'));
        }
    }

    public function update_action()
    {
        $this->form_validation->set_rules('users_id', 'Wa;i Asrama', 'trim|required');
        $this->form_validation->set_rules('asrama_nama', 'Nama Asrama', 'trim|required');
        $this->form_validation->set_rules('asrama_id', 'asrama_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('asrama_id', TRUE));
        } else {
            $data['users_id'] = $this->input->post('users_id', TRUE);
            $data['asrama_nama'] = $this->input->post('asrama_nama', TRUE);

            $this->Asrama_model->update_asrama($this->input->post('asrama_id', TRUE), $data);
            $this->session->set_flashdata('success_message', 'Data Asrama Berhasil di Update');
            redirect(site_url('asrama'));
        }
    }

    public function delete($id)
    {
        $row = $this->Asrama_model->get_asrama_by_asrama_id($id)->row();

        if ($row) {
            $this->Asrama_model->delete_asrama($id);
            $this->session->set_flashdata('success_message', 'Data Asrama Berhasil di Hapus');
            redirect(site_url('asrama'));
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('asrama'));
        }
    }
}
