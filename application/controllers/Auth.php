<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect(site_url('home'));
        }

        $users_cookie = get_cookie('khoirul_mustofa');

        if ($users_cookie != '') {
            $row_user = $this->Auth_model->get_users_by_users_cookie($users_cookie)->row();

            if ($row_user) {
                $this->daftarkan_session($row_user);
            }
        }
        
        $data['menu'] = "Login";
        $data['page'] = "Login";
        $data['load_css_js'] = "";
        $data['users_username'] = set_value('users_username');
        $data['users_password'] = set_value('users_password');
        $data['remember'] = set_value('remember');

        $this->load->view('view_auth_index', $data);
    }

    public function login()
    {
        $data['menu'] = "Login";
        $data['page'] = "Login";
        $data['load_css_js'] = "";
        $data['users_username'] = set_value('users_username');
        $data['users_password'] = set_value('users_password');
        $data['remember'] = set_value('remember');

        $this->load->view('view_auth_index', $data);
    }

    public function action_login()
    {
        $this->form_validation->set_rules('users_username', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('users_password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $users_username = $this->input->post('users_username', true);
            $users_password = $this->input->post('users_password', true);
            $remember = $this->input->post('remember', true);

            $user = $this->Auth_model->login($users_username);

            if ($user->num_rows() > 0) {
                $row_user = $user->row();
                if (password_verify($users_password, $row_user->users_password)) {
                    if ($remember) {
                        $key = random_string('alnum', 64);
                        set_cookie('khoirul_mustofa', $key, 3600 * 24 * 30);
                        // simpan key di database
                        $update_key = array(
                            'users_cookie' => $key,
                            'users_update_waktu' => date('Y-m-d H:i:s')
                        );
                        $this->Auth_model->update_users($row_user->users_id, $update_key);
                    }
                    $this->daftarkan_session($row_user);
                } else {
                    $this->session->set_flashdata('message_error', 'Password yang anda masukan salah ...');
                    redirect(site_url('auth'));
                }
            } else {
                $this->session->set_flashdata('message_error', 'Username tidak terdaftar dalam sistem ...');
                redirect(site_url('auth'));
            }
        }
    }

    public function daftarkan_session($user)
    {
        $users_id =  $user->users_id;
        $group = $this->Auth_model->get_groups_by_users_id($users_id)->result();
        $arr = array();
        foreach ($group as $data) {
            $arr[] = $data->groups_id;
        }
        $session = array(
            'users_id' => $users_id,
            'arr_groups_id' => $arr,
            'users_nama_lengkap' => $user->users_nama_lengkap,
            'logged_in' => TRUE
        );

        $this->session->set_userdata($session);
        redirect(site_url('home'));
    }

    public function logout()
    {
        delete_cookie('khoirul_mustofa');
        $this->session->sess_destroy();
        $this->session->set_flashdata('message_success', 'Terima Kasih Telah Menggunkan Sistem Absensi.');
        redirect(site_url('auth'));
    }
}
