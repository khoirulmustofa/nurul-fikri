<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect(site_url('dashboard'));
        } else {
            $users_cookie = get_cookie('khoirul_mustofa');
            if ($users_cookie != '') {
                $row_user = $this->Users_model->get_users_by_users_cookie($users_cookie)->row();
                if ($row_user) {
                    $this->daftarkan_session($row_user);
                }
            }
            $data['users_username'] = set_value('users_username');
            $data['users_password'] = set_value('users_password');
            $data['remember'] = set_value('remember');
            $this->load->view('view_login_index', $data);
        }
    }

    public function output_json($data)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function action_login()
    {
        $this->form_validation->set_rules('users_username', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('users_password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $invalid = [
                'users_username' => form_error('users_username'),
                'users_password' => form_error('users_password')
            ];
            $data = [
                'status'     => false,
                'invalid'     => $invalid
            ];
            $this->output_json($data);
        } else {
            $users_username = $this->input->post('users_username', true);
            $users_password = $this->input->post('users_password', true);
            $remember = $this->input->post('remember', true);

            $user = $this->Users_model->login($users_username);

            if ($user->num_rows() > 0) {
                $row_user = $user->row();
                if (password_verify($users_password, $row_user->users_password)) {
                    if ($remember) {
                        $key = random_string('alnum', 64);
                        set_cookie('khoirul_mustofa', $key, 3600 * 24 * 30); // set expired 30 hari kedepan
                        // simpan key di database
                        $update_key = array(
                            'users_cookie' => $key,
                            'users_update_waktu' => date('Y-m-d H:i:s')
                        );
                        $this->Users_model->update_users($row_user->users_id, $update_key);
                    }
                    $this->daftarkan_session($row_user);
                } else {
                    $data1 = [
                        'status' => false,
                        'failed' => 'Password Yang Dimasukan Salah',
                    ];
                    $this->output_json($data1);
                }
            } else {
                $data2 = [
                    'status' => false,
                    'failed' => 'Username Tidak Terdaftar Dalam Sistem',
                ];
                $this->output_json($data2);
            }
        }
    }

    public function daftarkan_session($user)
    {
        $session = array(
            'users_id' => $user->users_id,
            'users_nama_lengkap' => $user->users_nama_lengkap,
            'logged_in' => TRUE
        );

        $this->session->set_userdata($session);
        $data2 = [
            'status' => true,
            'url' => 'home',
        ];
        $this->output_json($data2);
    }

    public function logout()
    {
        delete_cookie('khoirul_mustofa');
        $this->session->sess_destroy();
        $this->session->set_flashdata('success_message', 'Terima Kasih Telah Menggunkan Sistem Absensi.');
        redirect(site_url('login'));
    }
}
