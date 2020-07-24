<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_users_as_datatables()
    {
        $this->datatables->select('users_id,users_email,users_username,users_nama_lengkap,users_status');
        $this->datatables->from('auth_users');        
        return $this->datatables->generate();
    }

    function update_users($users_id, $data)
    {
        $this->db->where('users_id', $users_id);
        $this->db->update('auth_users', $data);
    }

    function insert_users($data)
    {
        $this->db->insert('auth_users', $data);
    }

    function delete_users($id)
    {
        $this->db->where('users_id', $id);
        $this->db->delete('auth_users');
    }

    function get_users_by_users_id($users_id)
    {
        $this->db->where('users_id', $users_id);
        return $this->db->get('auth_users');
    }

    public function get_all_groups()
    {
        $this->db->order_by('groups_nama', 'ASC');
        return $this->db->get('auth_groups');
    }

    public function get_groups_users_id($users_id)
    {
        $this->db->select('*');
        $this->db->from('auth_users_groups');
        $this->db->join('auth_users', 'auth_users.users_id = auth_users_groups.users_id');
        $this->db->join('auth_groups', 'auth_groups.groups_id = auth_users_groups.groups_id');
        $this->db->where('auth_users_groups.users_id', $users_id);
        $this->db->order_by('groups_nama', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_groups_user_groups($groups_id, $users_id)
    {
        $this->db->select('*');
        $this->db->from('auth_users_groups');
        $this->db->where('users_id', $users_id);
        $this->db->where('groups_id', $groups_id);
        $query = $this->db->get();
        return $query;
    }

    public function insert_users_groups($data)
    {
        $this->db->insert('auth_users_groups', $data);
    }

    public function get_users_groups_by_users_groups_id($users_groups_id)
    {
        $this->db->select('*');
        $this->db->from('auth_users_groups');
        $this->db->where('users_groups_id', $users_groups_id);
        $query = $this->db->get();
        return $query;
    }

    public function delete_users_groups($users_groups_id)
    {
        $this->db->where('users_groups_id', $users_groups_id);
        $this->db->delete('auth_users_groups');
    }
}
