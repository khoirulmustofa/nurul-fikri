<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Santri extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Santri_model');
        is_login();
    }

    public function index()
    {
        $data['menu'] = "Master";
        $data['page'] = "Daftar Santri";
        $data['load_css_js'] = "santri_index";

        $this->template->load('template/main_template', 'view_santri_index', $data);
    }

    public function data_santri()
    {
        header('Content-Type: application/json');
        echo $this->Santri_model->get_data_santri();
    }

    public function create()
    {
        $data['menu'] = "Master";
        $data['page'] = "Tambah Santri";
        $data['load_css_js'] = "";
        $data['action'] = site_url('santri/create_action');
        $data['siswa_id'] = set_value('siswa_id');
        $data['siswa_NIS'] = set_value('siswa_NIS');
        $data['siswa_NISN'] = set_value('siswa_NISN');
        $data['siswa_nama_lengkap'] = set_value('siswa_nama_lengkap');
        $data['kelas_id'] = set_value('kelas_id');
        $data['asrama_id'] = set_value('asrama_id');
        $data['mushrif_tahfidz_id'] = set_value('mushrif_tahfidz_id');
        $data['user_id_telegram'] = set_value('user_id_telegram');
        $data['siswa_status'] = set_value('siswa_status');

        $this->template->load('template/main_template', 'view_santri_form_create', $data);
    }

    public function create_action()
    {
        $this->form_validation->set_rules('siswa_NIS', 'NIS', 'trim|required|is_unique[siswa.siswa_NIS]');
        $this->form_validation->set_rules('siswa_NISN', 'NISN', 'trim|required|is_unique[siswa.siswa_NISN]');
        $this->form_validation->set_rules('siswa_nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'trim|required');
        $this->form_validation->set_rules('asrama_id', 'Asrama', 'trim|required');
        $this->form_validation->set_rules('mushrif_tahfidz_id', 'Mushrif Tahfidz', 'trim|required');
        $this->form_validation->set_rules('siswa_status', 'Status', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'siswa_id' => insert_uuid(),
                'siswa_NIS' => $this->input->post('siswa_NIS', TRUE),
                'siswa_NISN' => $this->input->post('siswa_NISN', TRUE),
                'siswa_nama_lengkap' => $this->input->post('siswa_nama_lengkap', TRUE),
                'kelas_id' => $this->input->post('kelas_id', TRUE),
                'mushrif_tahfidz_id' => $this->input->post('mushrif_tahfidz_id', TRUE),
                'siswa_status' => $this->input->post('siswa_status', TRUE),
            );

            $this->Santri_model->insert_santri($data);
            $this->session->set_flashdata('success_message', 'Data Santri Berhasil di Tambah.');
            redirect(site_url('santri'));
        }
    }
    public function update($id)
    {
        $row = $this->Santri_model->get_santri_by_siswa_id($id)->row();

        if ($row) {
            $data['menu'] = "Master";
            $data['page'] = "Edit Santri";
            $data['load_css_js'] = "";
            $data['action'] = site_url('santri/update_action');
            $data['siswa_id'] = set_value('siswa_id', $row->siswa_id);
            $data['siswa_NIS'] = set_value('siswa_NIS', $row->siswa_NIS);
            $data['siswa_NISN'] = set_value('siswa_NISN', $row->siswa_NISN);
            $data['siswa_nama_lengkap'] = set_value('siswa_nama_lengkap', $row->siswa_nama_lengkap);
            $data['kelas_id'] = set_value('kelas_id', $row->kelas_id);
            $data['asrama_id'] = set_value('asrama_id', $row->asrama_id);
            $data['mushrif_tahfidz_id'] = set_value('mushrif_tahfidz_id', $row->mushrif_tahfidz_id);            
            $data['user_id_telegram'] = set_value('user_id_telegram',$row->user_id_telegram);
            $data['siswa_status'] = set_value('siswa_status', $row->siswa_status);

            $this->template->load('template/main_template', 'view_santri_form_update', $data);
        } else {
            $this->session->set_flashdata('error_message', 'Maaf Data Yang Anda Pilih TIdak Ada Dalam Sistem');
            redirect(site_url('santri'));
        }
    }

    public function update_action()
    {
        $this->form_validation->set_rules('siswa_NIS', 'NIS', 'trim|required');
        $this->form_validation->set_rules('siswa_NISN', 'siswa nisn', 'trim|required');
        $this->form_validation->set_rules('siswa_nama_lengkap', 'siswa nama lengkap', 'trim|required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'trim|required');
        $this->form_validation->set_rules('asrama_id', 'Asrama', 'trim|required');
        $this->form_validation->set_rules('mushrif_tahfidz_id', 'mushrif tahfidz id', 'trim|required');
        $this->form_validation->set_rules('siswa_status', 'Status', 'trim|required');
        $this->form_validation->set_rules('siswa_id', 'siswa_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('siswa_id', TRUE));
        } else {
            $data = array(
                'siswa_nama_lengkap' => $this->input->post('siswa_nama_lengkap', TRUE),
                'kelas_id' => $this->input->post('kelas_id', TRUE),
                'asrama_id' => $this->input->post('asrama_id', TRUE),
                'mushrif_tahfidz_id' => $this->input->post('mushrif_tahfidz_id', TRUE),
                'siswa_status' => $this->input->post('siswa_status', TRUE),
            );

            $this->Santri_model->update_santri($this->input->post('siswa_id', TRUE), $data);
            $this->session->set_flashdata('success_message', 'Data Santri Berhasil di Update.');
            redirect(site_url('santri'));
        }
    }

    public function delete($siswa_id)
    {
        $row = $this->Santri_model->get_santri_by_siswa_id($siswa_id);

        if ($row) {
            $this->Santri_model->delete_santri($siswa_id);
            $this->session->set_flashdata('success_message', 'Data Santri Berhasil di Hapus');
            redirect(site_url('santri'));
        } else {
            $this->session->set_flashdata('error_message', 'Data Santri Tidak di Temukan');
            redirect(site_url('santri'));
        }
    }

    public function import()
    {
        $data['menu'] = "Master";
        $data['page'] = "Import Santri";
        $data['action'] = site_url('santri/import_excel');
<<<<<<< HEAD
        $data['file_download'] = "upload/format_file/Import Santri.xlsx";
=======
        $data['file_download'] = "upload/format_file/Import_Santri.xlsx";
>>>>>>> 199b6f8adbc1b158aa5850a688dd2de64294ff67
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
            $sheetCount = count($sheetData);
<<<<<<< HEAD
            for ($i = 0; $i <= $sheetCount; $i++) {
                if ($i > 0) {
                    $data['siswa_id'] = insert_uuid();
                    $data['siswa_NIS'] = $sheetData[$i][1];
                    $data['siswa_NISN'] = $sheetData[$i][2];
                    $data['siswa_nama_lengkap'] = $sheetData[$i][3];
                    $data['kelas_id'] = $sheetData[$i][4];
                    $data['asrama_id'] = $sheetData[$i][5];
                    $data['mushrif_tahfidz_id'] = $sheetData[$i][6];
                    $data['user_id_telegram'] = $sheetData[$i][7];
                    $data['siswa_status'] = $sheetData[$i][8];
                    $this->Santri_model->insert_santri($data);
                }
            }
            $this->session->set_flashdata('success_message', 'Data Pengguna Berhasil di Import');
            redirect(site_url('users'));
=======
            foreach ($sheetData as $datas) {
                $data['siswa_id'] = insert_uuid();
                    $data['siswa_NIS'] = $datas[1];
                    $data['siswa_NISN'] = $datas[2];
                    $data['siswa_nama_lengkap'] = $datas[3];
                    $data['kelas_id'] = $datas[4];
                    $data['asrama_id'] = $datas[5];
                    $data['mushrif_tahfidz_id'] = $datas[6];
                    $data['user_id_telegram'] = $datas[7];
                    $data['siswa_status'] = $datas[8];
                    $this->Santri_model->insert_santri($data);
            }
            $this->session->set_flashdata('success_message', 'Data Santri Berhasil di Import');
            redirect(site_url('santri'));
>>>>>>> 199b6f8adbc1b158aa5850a688dd2de64294ff67
        }
    }
}
