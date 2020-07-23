<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mushrif_alquran_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_mushrif_alquran_as_datatables()
    {
        $this->datatables->select('mushrif_tahfidz_id,users_nama_lengkap,mushrif_tahfidz_status');
        $this->datatables->from('mushrif_tahfidz'); 
        $this->datatables->join('auth_users', 'auth_users.users_id = mushrif_tahfidz.users_id');        
        return $this->datatables->generate();
    }
    

    function get_mushrif_alquran_by_mushrif_tahfidz_id($mushrif_tahfidz_id)
    {
        $this->db->where('mushrif_tahfidz_id', $mushrif_tahfidz_id);
        return $this->db->get('mushrif_tahfidz');
    }

    public function get_mushrif_by_user_id($users_id)
    {
        $this->db->select('*');
        $this->db->from('mushrif_tahfidz');
        $this->db->where('users_id', $users_id);
        $query = $this->db->get();
        return $query;
    }

    function insert_mushrif_alquran($data)
    {
        $this->db->insert('mushrif_tahfidz', $data);
    }

    function update_mushrif_alquran($mushrif_tahfidz_id, $data)
    {
        $this->db->where('mushrif_tahfidz_id', $mushrif_tahfidz_id);
        $this->db->update('mushrif_tahfidz', $data);
    }

    function delete_mushrif_alquran($id)
    {
        $this->db->where('mushrif_tahfidz_id', $id);
        $this->db->delete('mushrif_tahfidz');
    }
}
