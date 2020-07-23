<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Santri_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function get_asrama()
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->order_by('asrama_nama', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_data_santri()
    {
        $this->datatables->select('siswa_id,siswa_NIS,siswa_nama_lengkap,kelas_nama,users_nama_lengkap,siswa_status');
        $this->datatables->from('siswa');
        $this->datatables->join('mushrif_tahfidz', 'mushrif_tahfidz.mushrif_tahfidz_id = siswa.mushrif_tahfidz_id', 'left');
        $this->datatables->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'left');
        $this->datatables->join('auth_users', 'auth_users.users_id = mushrif_tahfidz.users_id', 'left');
        return $this->datatables->generate();
    }

    public function get_santri_by_siswa_id($siswa_id)
    {
        $this->db->where('siswa_id', $siswa_id);
        return $this->db->get('siswa');
    }

    public function insert_santri($data)
    {
        $this->db->insert('siswa', $data);
    }

    public function update_santri($siswa_id, $data)
    {
        $this->db->where('siswa_id', $siswa_id);
        $this->db->update('siswa', $data);
    }

    public function delete_santri($siswa_id)
    {
        $this->db->where('siswa_id', $siswa_id);
        $this->db->delete('siswa');
    }
}
