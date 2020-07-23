<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_users_by_users_cookie($users_cookie)
    {
        $this->db->select('*');
        $this->db->from('auth_users');
        $this->db->where('users_cookie', $users_cookie);
        $query = $this->db->get();
        // $this->db->get();
        // $query = $this->db->last_query();
        return $query;
    }

    function login($users_email)
    {
        $this->db->select('*');
        $this->db->from('auth_users');
        $this->db->like('users_email', $users_email);
        $this->db->or_like('users_username', $users_email);
        $query = $this->db->get();
        return $query;
    }

    function update_users($users_id, $data)
    {
        $this->db->where('users_id', $users_id);
        $this->db->update('auth_users', $data);
    }

    public function get_groups_by_users_id($users_id)
    {
        $this->db->select('*');
        $this->db->from('auth_users_groups');
        $this->db->where('users_id', $users_id);
        $query = $this->db->get();
        return $query;
    }
}
