<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Groups_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_groups_as_datatables()
    {
        $this->datatables->select('groups_id,groups_nama,groups_keterangan');
        $this->datatables->from('auth_groups');      
        return $this->datatables->generate();
    }
    

    function get_groups_by_groups_id($groups_id)
    {
        $this->db->where('groups_id', $groups_id);
        return $this->db->get('auth_groups');
    }

    function insert_groups($data)
    {
        $this->db->insert('auth_groups', $data);
    }

    function update_groups($groups_id, $data)
    {
        $this->db->where('groups_id', $groups_id);
        $this->db->update('auth_groups', $data);
    }

    function delete_groups($id)
    {
        $this->db->where('groups_id', $id);
        $this->db->delete('auth_groups');
    }
}
