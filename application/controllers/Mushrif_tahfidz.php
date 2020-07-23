<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mushrif_tahfidz extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mushrif_tahfidz_model');
        is_login();
    }

    public function index()
    {
        $data['menu'] = "Master";
        $data['page'] = "Daftar Mushrif Tahfidz";
        $data['load_css_js'] = "mushrif_tahfidz";

        $this->template->load('template/main_template', 'view_mushrif_tahfidz_index', $data);
    }

    public function ajax_list_mushrif_tahfidz()
    {
        $list = $this->Mushrif_tahfidz_model->get_mushrif_tahfidz_as_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $mushrif_tahfidz) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="' . $mushrif_tahfidz->mushrif_tahfidz_id . '">';
            $row[] = $mushrif_tahfidz->users_nama_lengkap;
            $row[] = $mushrif_tahfidz->mushrif_tahfidz_status;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_users(' . "'" . $mushrif_tahfidz->mushrif_tahfidz_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_users(' . "'" . $mushrif_tahfidz->mushrif_tahfidz_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mushrif_tahfidz_model->count_all(),
            "recordsFiltered" => $this->Mushrif_tahfidz_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
