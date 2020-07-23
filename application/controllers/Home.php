<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        is_login();
    }

    public function index()
    {
        $users_id =  $this->session->userdata('users_id');
        // $group = $this->Auth_model->get_groups_by_users_id($users_id)->result();
        // $arr = array();
        // foreach ($group as $data) {
        //     $arr[] = $data->groups_id;
        // }
        // $key= in_array('nfbs-5ef31438d5f69',$arr);

        
        $data['menu'] = "Dashboard";
        $data['page'] = "Dashboard";
        $data['load_css_js'] = "dashboard_index";
        $this->template->load('template/main_template', 'view_home_index', $data);
    }
}
