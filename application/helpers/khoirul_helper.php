<?php

define("BOT_TOKEN", "");
 
function kirimTelegram($chat_id,$pesan) {
   // $pesan = json_encode($pesan);
    $API = "https://api.telegram.org/bot".BOT_TOKEN."/sendmessage?chat_id=".$chat_id."&text=.$pesan.&parse_mode=HTML";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $API);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


function set_validation_style($field)
{
    if ($_POST) {
        // Apakah nama_field = array
        if (is_array($field)) {
            $last_status = false;
            for ($i = 0; $i < count($field); $i++) {
                if (form_error($field[$i]) || $last_status) {
                    $last_status = true; // ya, ada error
                } else {
                    $last_status = false; // no, tidak ada error
                }
            }

            if ($last_status) {
                echo 'has-error';
            } else {
                echo 'has-success';
            }

            // Bukan array
        } else {
            if (form_error($field)) {
                echo 'has-error';
            } else {
                echo 'has-success';
            }
        }
    }
}

function sesi_tahfidz()
{
    $jam = date('H');
    if ($jam <= 7) {
        $sesi = "Subuh";
    } elseif ($jam > 17) {
        $sesi = "Magrib";
    } else {
        $sesi = "Tidak Ada Jadwal";
    }
    return $sesi;
}

function date_to_eng($tanggal)
{
    $tgl = date('Y-m-d', strtotime($tanggal));
    if ($tgl == '1970-01-01') {
        return '';
    } else {
        return $tgl;
    }
}

function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulann(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function getBulann($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output)) {
        $output = implode(',', $output);
    }

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function is_login()
{
    $ci = &get_instance();
    if ($ci->session->userdata('logged_in') != true) {
        redirect(site_url('auth'));
    }
}

function have_access($groups_id)
{
    $ci = &get_instance();
    $arr_groups_id = $ci->session->userdata('arr_groups_id');
    if (in_array($groups_id, $arr_groups_id)) {
        return true;
    } else {
        return false;
    }
}

function cmb_dinamis_join3($name, $field, $pk, $selected, $pilihan, $disabled)
{
    $ci = &get_instance();
    $cmb = "<select name='$name' $disabled class='form-control select2'> <option value='' selected> $pilihan </option>";
    $ci->db->select('mushrif_tahfidz_id,mushrif_tahfidz.users_id,users_nama_lengkap');
    $ci->db->from('mushrif_tahfidz');
    $ci->db->join('auth_users', 'auth_users.users_id = mushrif_tahfidz.users_id');
    $ci->db->order_by($field, 'ASC');
    $data = $ci->db->get()->result();
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" . ucwords($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function cmb_dinamis($name, $table, $field, $pk, $selected, $pilihan, $disabled)
{
    $ci = &get_instance();
    $cmb = "<select name='$name' $disabled class='form-control select2'> <option value='' selected> $pilihan </option>";
    $ci->db->order_by($field, 'ASC');
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" . ucwords($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function cmb_dinamis_double($name, $table, $field1, $field2, $pk, $selected, $pilihan)
{
    $ci = &get_instance();
    $cmb = "<select name='$name' class='form-control select2'> <option value='' selected> $pilihan </option>";
    $ci->db->order_by($field2, 'ASC');
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" . $d->$field1 . " (" . $d->$field2 . ")" . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function km_encrypt($value)
{
    $key = "KhoirulMutofajossg4ndo55R3w0rew0";
    return urlencode(base64_encode($key . $value));
}

function km_decrypt($string)
{
    $key = "KhoirulMutofajossg4ndo55R3w0rew0";
    $urldecode = urldecode($string);
    $base64_decode = base64_decode($urldecode);
    $hasil = str_replace($key, "", $base64_decode);
    return urldecode($hasil);
}

function insert_uuid()
{
    return uniqid("nfbs-");
}
