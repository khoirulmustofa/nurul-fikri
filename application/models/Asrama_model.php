<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asrama_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_asrama_as_datatables()
    {
        $this->datatables->select('asrama_id,asrama_nama,users_nama_lengkap');
        $this->datatables->from('asrama');
        $this->datatables->join('auth_users', 'auth_users.users_id = asrama.users_id');
        return $this->datatables->generate();
    }

    public function get_asrama_by_asrama_id($asrama_id)
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->where('asrama_id', $asrama_id);
        $query = $this->db->get();
        return $query;
    }

    public function get_asrama_by_users_id($users_id)
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->where('users_id', $users_id);
        $query = $this->db->get();
        return $query;
    }

    function insert_asrama($data)
    {
        $this->db->insert('asrama', $data);
    }

    function update_asrama($asrama_id, $data)
    {
        $this->db->where('asrama_id', $asrama_id);
        $this->db->update('asrama', $data);
    }

    function delete_asrama($asrama_id)
    {
        $this->db->where('asrama_id', $asrama_id);
        $this->db->delete('asrama');
    }

    public function get_user_active()
    {
        $this->db->select('*');
        $this->db->from('auth_users');
        $this->db->where('users_status', 'Y');
        $this->db->order_by('users_nama_lengkap', 'ASC');
        $query = $this->db->get();
        return $query;
        // $this->db->get();
        // return $this->db->last_query();
    }
}
