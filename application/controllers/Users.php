<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        is_login();
    }

    public function index()
    {
        $data['menu'] = "Master";
        $data['page'] = "Daftar Pengguna";
        $data['load_css_js'] = "users_index";

        $this->template->load('template/main_template', 'view_users_index', $data);
    }

    public function users_data()
	{
        header('Content-Type: application/json');
        echo $this->Users_model->get_users_as_datatables();
	}

    public function create()
    {
        $data['menu'] = "Master";
        $data['page'] = "Tambah Pengguna";
        $data['load_css_js'] = "";
        $data['action'] = site_url('users/create_action');
        $data['users_id'] = set_value('users_id');
        $data['users_email'] = set_value('users_email');
        $data['users_username'] = set_value('users_username');
        $data['users_nama_lengkap'] = set_value('users_nama_lengkap');
        $data['users_status'] = set_value('users_status');
        $this->template->load('template/main_template', 'view_users_form_create', $data);
    }

    public function create_action()
    {
        $this->form_validation->set_rules('users_username', 'Username', 'trim|required|is_unique[auth_users.users_username]');
        $this->form_validation->set_rules('users_email', 'Email', 'trim|required|valid_email|is_unique[auth_users.users_email]');
        $this->form_validation->set_rules('users_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('ulangi_users_password', 'Verifikasi Password', 'trim|required|matches[users_password]');
        $this->form_validation->set_rules('users_nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('users_status', 'Status', 'trim|required');
        $this->form_validation->set_rules('users_id', 'users_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $password = $this->input->post('users_password', TRUE);
            $options = array("cost" => 10);
            $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);

            $data['users_id'] = insert_uuid();
            $data['users_email'] = $this->input->post('users_email', TRUE);
            $data['users_username'] = $this->input->post('users_username', TRUE);            
            $data['users_password'] = $hashPassword;
            $data['users_nama_lengkap'] = $this->input->post('users_nama_lengkap', TRUE);
            $data['users_status'] = $this->input->post('users_status', TRUE);
            $data['users_update_waktu'] = date('Y-m-d H:i:s');

            $this->Users_model->insert_users($data);
            $this->session->set_flashdata('success_message', 'Data Pengguna Berhasil di Tambah');
            redirect(site_url('users'));
        }
    }

    public function update($id)
    {
        $row = $this->Users_model->get_users_by_users_id($id)->row();

        if ($row) {
            $data['menu'] = "Master";
            $data['page'] = "Edit Pengguna";
            $data['load_css_js'] = "";
            $data['action'] = site_url('users/update_action');
            $data['users_id'] = set_value('users_id', $row->users_id);
            $data['users_email'] = set_value('users_email', $row->users_email);
            $data['users_username'] = set_value('users_username', $row->users_username);
            $data['users_nama_lengkap'] = set_value('users_nama_lengkap', $row->users_nama_lengkap);
            $data['users_status'] = set_value('users_status', $row->users_status);

            $this->template->load('template/main_template', 'view_users_form_update', $data);
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('users'));
        }
    }

    public function update_action()
    {
        $this->form_validation->set_rules('users_email', 'Email', 'trim|required|valid_email');
        if ($this->input->post('users_password', TRUE)) {
            $this->form_validation->set_rules('users_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('ulangi_users_password', 'Verifikasi Password', 'trim|required|matches[users_password]');
        }
        $this->form_validation->set_rules('users_nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('users_status', 'Status', 'trim|required');
        $this->form_validation->set_rules('users_id', 'users_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('users_id', TRUE));
        } else {
            $data['users_email'] = $this->input->post('users_email', TRUE);
            if ($this->input->post('users_password', TRUE)) {
                $password = $this->input->post('users_password', TRUE);
                $options = array("cost" => 10);
                $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
                $data['users_password'] = $hashPassword;
            }
            $data['users_username'] = $this->input->post('users_username', TRUE);
            $data['users_nama_lengkap'] = $this->input->post('users_nama_lengkap', TRUE);
            $data['users_status'] = $this->input->post('users_status', TRUE);
            $data['users_update_waktu'] = date('Y-m-d H:i:s');

            $this->Users_model->update_users($this->input->post('users_id', TRUE), $data);
            $this->session->set_flashdata('success_message', 'Data Pengguna Berhasil di Update');
            redirect(site_url('users'));
        }
    }

    public function groups($id)
    {
        $row = $this->Users_model->get_users_by_users_id($id)->row();

        if ($row) {
            $data['menu'] = "Master";
            $data['page'] = "Edit Groups Pengguna : " . $row->users_nama_lengkap;
            $data['load_css_js'] = "";
            $data['action'] = site_url('users/tambah_groups');
            $data['users_id'] = set_value('users_id', $row->users_id);
            $data['groups_data'] = $this->Users_model->get_all_groups()->result();
            $data['groups_users_id_data'] = $this->Users_model->get_groups_users_id($row->users_id)->result();
            $this->template->load('template/main_template', 'view_users_groups', $data);
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih Tidak Ada Dalam Sistem');
            redirect(site_url('users'));
        }
    }

    public function tambah_groups()
    {
        $this->form_validation->set_rules('groups_id', 'Groups', 'trim|required');
        $this->form_validation->set_rules('users_id', 'User', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->groups($this->input->post('users_id', TRUE));
        } else {
            $groups_id = $this->input->post('groups_id', TRUE);
            $users_id = $this->input->post('users_id', TRUE);
            $row_groups = $this->Users_model->get_groups_user_groups($groups_id, $users_id)->row();

            if ($row_groups) {
                $this->session->set_flashdata('error_message', 'Group Pengguna Sudah Ada');
                redirect(site_url('users/groups/' . $users_id));
            } else {
                $data['users_groups_id'] = insert_uuid();
                $data['users_id'] = $users_id;
                $data['groups_id'] = $this->input->post('groups_id', TRUE);
                $this->Users_model->insert_users_groups($data);
                $this->session->set_flashdata('success_message', 'Group Berhasil di Tambahkan');
                redirect(site_url('users/groups/' . $users_id));
            }
        }
    }

    public function hapus_groups($id)
    {
        $row = $this->Users_model->get_users_groups_by_users_groups_id($id)->row();

        if ($row) {
            $this->Users_model->delete_users_groups($id);
            $this->session->set_flashdata('success_message', 'Data Group Pengguna Berhasil di Hapus');
            redirect(site_url('users/groups/' . $row->users_id));
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('users/groups/' . $row->users_id));
        }
    }

    public function delete($id)
    {
        $row = $this->Users_model->get_users_by_users_id($id)->row();

        if ($row) {
           $this->Users_model->delete_users($id);
            $this->session->set_flashdata('success_message', 'Data Pengguna Berhasil di Hapus');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('users'));
        }
    }

    public function import()
    {
        $data['menu'] = "Master";
        $data['page'] = "Import Pengguna";
        $data['action'] = site_url('users/import_excel');
        $data['file_download'] = "upload/format_file/Import Pengguna.xlsx";
        $data['load_css_js'] = "";

        $this->template->load('template/main_template', 'view_import_excel', $data);
    }
    public function import_excel()
    {
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['upload_file']['name']);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            foreach ($sheetData as $datas) {
                $data['siswa_id'] = insert_uuid();
                $data['users_email'] = $datas[1];
                $data['users_username'] = $datas[2];
                $options = array("cost" => 10);
                $hash = password_hash($datas[3], PASSWORD_BCRYPT, $options);
                $data['users_password'] = $hash;
                $data['users_nama_lengkap'] = $datas[4];
                $data['images'] = $datas[5];
                $data['users_status'] = $datas[6];
                $data['users_cookie'] = $datas[7];
                $data['users_update_waktu'] = $datas[8];                

                $this->Users_model->insert_users($data);
                $this->session->set_flashdata('success_message', 'Data Pengguna Berhasil di Import');
                redirect(site_url('users'));
            }
        }
    }
}
