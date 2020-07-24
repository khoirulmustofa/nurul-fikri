<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alquran_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_santri_by_mushrif_tahfidz_id($mushrif_tahfidz_id, $tahfidz_sesi, $date_now)
    {
        $this->datatables->select('tahfidz.tahfidz_id,tahfidz.siswa_NIS,tahfidz.tahfidz_absensi_status,tahfidz.tahfidz_absensi_keterangan,tahfidz.al_quran_id');
        $this->datatables->select('siswa.siswa_nama_lengkap');
        $this->datatables->from('tahfidz');
        $this->datatables->join('siswa', 'siswa.siswa_NIS = tahfidz.siswa_NIS');
        $this->datatables->where('tahfidz.mushrif_tahfidz_id', $mushrif_tahfidz_id);
        $this->datatables->where('tahfidz.tahfidz_sesi', $tahfidz_sesi);
        $this->datatables->where('DATE(tahfidz.tahfidz_buat_waktu)', $date_now);
        $query = $this->datatables->generate();
        return $query;        
    }

    public function get_mushrif_tahfidz_by_users_id($users_id)
    {
        $this->db->select('*');
        $this->db->from('mushrif_tahfidz');
        $this->db->join('auth_users', 'auth_users.users_id = mushrif_tahfidz.users_id');
        $this->db->where('mushrif_tahfidz.users_id', $users_id);
        $query = $this->db->get();
        return $query;
    }

    public function get_tahfidz_by_mushrif_tahfidz_id($mushrif_tahfidz_id, $tahfidz_sesi, $date_now)
    {
        $this->db->select('*');
        $this->db->from('tahfidz');
        $this->db->where('mushrif_tahfidz_id', $mushrif_tahfidz_id);
        $this->db->where('tahfidz_sesi', $tahfidz_sesi);
        $this->db->where('DATE(tahfidz_buat_waktu)', $date_now);
        $query = $this->db->get();
        return $query;
    }

    public function get_siswa_by_mushrif_tahfidz_id($mushrif_tahfidz_id)
    {
        $this->db->where('mushrif_tahfidz_id', $mushrif_tahfidz_id);
        return $this->db->get('siswa');
    }
    
    function insert_tahfidz($data)
    {
        $this->db->insert('tahfidz', $data);
    }

    public function get_tahfidz_santri_by_mushrif_tahfidz_id($mushrif_tahfidz_id, $tahfidz_sesi, $date_now)
    {
        $this->db->select('tahfidz.tahfidz_id,tahfidz.siswa_NIS,tahfidz.tahfidz_absensi_status,tahfidz.tahfidz_absensi_keterangan,tahfidz.al_quran_id');
        $this->db->select('siswa.siswa_nama_lengkap');
        $this->db->from('tahfidz');
        $this->db->join('siswa', 'siswa.siswa_NIS = tahfidz.siswa_NIS');
        $this->db->where('tahfidz.mushrif_tahfidz_id', $mushrif_tahfidz_id);
        $this->db->where('tahfidz.tahfidz_sesi', $tahfidz_sesi);
        $this->db->where('DATE(tahfidz.tahfidz_buat_waktu)', $date_now);
        $query = $this->db->get();
        return $query;        
    }

    function update_status_tahfidz($id, $data)
    {
        $this->db->where('tahfidz_id', $id);
        $this->db->update('tahfidz', $data);
    }

    function get_tahfidz_siswa_by_tahfidz_id($tahfidz_id)
    {
        $this->db->select('*');
        $this->db->from('tahfidz');
        $this->db->join('siswa', 'siswa.siswa_NIS = tahfidz.siswa_NIS');
        $this->db->where('tahfidz.tahfidz_id', $tahfidz_id);
        $query = $this->db->get();
        return $query;
        // $this->db->get();
        // return $this->db->last_query();
    }

    public function get_al_quran_terakhir_setor($siswa_NIS)
    {
        $this->db->select('*');
        $this->db->from('tahfidz');
        $this->db->join('al_quran', 'al_quran.al_quran_id = tahfidz.al_quran_id','LEFT');
        $this->db->where('tahfidz.siswa_NIS', $siswa_NIS);
        $this->db->where('tahfidz.al_quran_id IS NOT NULL', null, false);
        $this->db->order_by('tahfidz.tahfidz_buat_waktu', 'DEC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query;
        // $this->db->get();
        // return $this->db->last_query();
    }

    public function get_all_alquran(){
        $this->db->select('*');
        $this->db->from('al_quran');
        $this->db->order_by('al_quran_urutan', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_check_absensi_santri_by_mushrif_tahfidz_id($mushrif_tahfidz_id, $waktu, $sesi_tahfidz)
    {
        $this->db->where('tahfidz_absensi_status', 'B');
        $this->db->where('mushrif_tahfidz_id', $mushrif_tahfidz_id);
        $this->db->where('tahfidz_sesi', $sesi_tahfidz);
        $this->db->where('DATE(tahfidz_buat_waktu)', $waktu);
        $query = $this->db->get('tahfidz');
        return $query;
    }

    public function get_dashboard_tahfidz_by_mushrif_tahfidz_id($mushrif_tahfidz_id, $waktu, $sesi_tahfidz)
    {
        $this->db->where('mushrif_tahfidz_id', $mushrif_tahfidz_id);
        $this->db->where('tahfidz_sesi', $sesi_tahfidz);
        $this->db->where('DATE(dashboard_absensi_tahfid_buat_waktu)', $waktu);
        $query = $this->db->get('dashboard_absensi_tahfid');
        return $query;
        // // $this->db->get();
        // return $this->db->last_query();
    }

    
    public function get_all_absensi_santri_by_mushrif_tahfidz($mushrif_tahfidz_id, $waktu, $sesi_tahfidz)
    {
        $this->db->where('mushrif_tahfidz_id', $mushrif_tahfidz_id);
        $this->db->where('tahfidz_sesi', $sesi_tahfidz);
        $this->db->where('DATE(tahfidz_buat_waktu)', $waktu);
        $query = $this->db->get('tahfidz');
        return $query;
    }

    public function get_status_absensi_tahfidz_mushrif_tahfidz($mushrif_tahfidz_id, $waktu, $tahfidz_absensi_status, $sesi_tahfidz)
    {
        $this->db->where('tahfidz_absensi_status', $tahfidz_absensi_status);
        $this->db->where('mushrif_tahfidz_id', $mushrif_tahfidz_id);
        $this->db->where('tahfidz_sesi', $sesi_tahfidz);
        $this->db->where('DATE(tahfidz_buat_waktu)', $waktu);
        $query = $this->db->get('tahfidz');
        return $query;
    }

    public function insert_dashboard_tahfidz($data_dash)
    {
        $this->db->insert('dashboard_absensi_tahfid', $data_dash);
    }

    public function update_dashboard_tahfidz($mushrif_tahfidz_id, $waktu, $sesi_tahfidz, $data_update)
    {
        $this->db->where('mushrif_tahfidz_id', $mushrif_tahfidz_id);
        $this->db->where('DATE(dashboard_absensi_tahfid_buat_waktu)', $waktu);
        $this->db->where('tahfidz_sesi', $sesi_tahfidz);
        $this->db->update('dashboard_absensi_tahfid', $data_update);
    }
}
