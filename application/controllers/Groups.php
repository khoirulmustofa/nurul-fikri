<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Groups extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Groups_model');
        is_login();
        if (!have_access('nfbs-5ef31438ccf8b')) {            
            redirect(site_url('blok'));
        }
    }

    public function index()
    {
        $data['menu'] = "Master";
        $data['page'] = "Daftar Groups";
        $data['load_css_js'] = "groups_index";

        $this->template->load('template/main_template', 'view_groups_index', $data);
    }

    public function groups_data()
    {
        header('Content-Type: application/json');
        echo $this->Groups_model->get_groups_as_datatables();
    }

    public function create()
    {
        $data['menu'] = "Master";
        $data['page'] = "Tambah Group";
        $data['load_css_js'] = "";
        $data['action'] = site_url('groups/create_action');
        $data['groups_id'] = set_value('groups_id');
        $data['groups_nama'] = set_value('groups_nama');
        $data['groups_keterangan'] = set_value('groups_keterangan');
        $this->template->load('template/main_template', 'view_groups_form_create', $data);
    }

    public function create_action()
    {
        $this->form_validation->set_rules('groups_nama', 'Nama Group', 'trim|required');
        $this->form_validation->set_rules('groups_keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('groups_id', 'groups_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $data['groups_id'] = insert_uuid();
            $data['groups_nama'] = $this->input->post('groups_nama', TRUE);
            $data['groups_keterangan'] = $this->input->post('groups_keterangan', TRUE);

            $this->Groups_model->insert_groups($data);
            $this->session->set_flashdata('success_message', 'Data Pengguna Berhasil di Tambah');
            redirect(site_url('groups'));
        }
    }

    public function update($id)
    {
        $row = $this->Groups_model->get_groups_by_groups_id($id)->row();

        if ($row) {
            $data['menu'] = "Master";
            $data['page'] = "Edit Pengguna";
            $data['load_css_js'] = "";
            $data['action'] = site_url('groups/update_action');
            $data['groups_id'] = set_value('groups_id', $row->groups_id);
            $data['groups_nama'] = set_value('groups_nama', $row->groups_nama);
            $data['groups_keterangan'] = set_value('groups_keterangan', $row->groups_keterangan);

            $this->template->load('template/main_template', 'view_groups_form_update', $data);
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('groups'));
        }
    }

    public function update_action()
    {
        $this->form_validation->set_rules('groups_nama', 'Nama Group', 'trim|required');
        $this->form_validation->set_rules('groups_keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('groups_id', 'groups_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('groups_id', TRUE));
        } else {
            $data['groups_nama'] = $this->input->post('groups_nama', TRUE);
            $data['groups_keterangan'] = $this->input->post('groups_keterangan', TRUE);

            $this->Groups_model->update_groups($this->input->post('groups_id', TRUE), $data);
            $this->session->set_flashdata('success_message', 'Data Pengguna Berhasil di Update');
            redirect(site_url('groups'));
        }
    }

    public function delete($id)
    {
        $row = $this->Groups_model->get_groups_by_groups_id($id)->row();

        if ($row) {
            $this->Groups_model->delete_groups($id);
            $this->session->set_flashdata('success_message', 'Data Pengguna Berhasil di Hapus');
            redirect(site_url('groups'));
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('groups'));
        }
    }
}
