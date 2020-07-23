<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bot_telegram extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    const bot_token = "1307872209:AAEJ_U_NkPD1vMHN5saCXrKz3gZL0oRaw2Y";

    public function index()
    {
        $chat_id = '253333888';
        $pesan = '
        بِسْمِ اللّهِ الرَّحْمَنِ الرَّحِيْمِ

        ٱلسَّلَامُ عَلَيْكُمْ وَرَحْمَةُ ٱللَّٰهِ وَبَرَكَاتُهُ
        
        Ayah Bunda <strong>Muhammad</strong>
        
        Alhamdullillah ananda pada tanggal 14 Juli 2020 sesi subuh telah melah melakukan setor Alqur`an.
        
        
        Surah : <strong>Al Fathihah</strong>
        
        Ayat : <strong>Al Fathihah</strong>
        
        Jumlah Baris : <strong>Al Fathihah</strong>
         
        
        Terima kasih ayah bunda telah mendoakan ananda semoga istoqomah. 
        
        
        وَعَلَيْكُمْ السَّلاَمُ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ';
        $data = $this->telegram_lib->sendmsg($pesan, $chat_id, 'HTML'); // Markdown HTML
        // echo "<pre>";
        // print_r($data);
        echo json_encode($data);
        die;
    }


    public function kirim_laporan_absensi()
    {
        set_time_limit(0);
        $kode_access = urldecode($this->input->get('kode_access', TRUE));
        if ($this->config->item('access_bot') == $kode_access) {
            $ch = curl_init();
            for ($i = 1; $i < 500; $i++) {
                $API = "http://localhost/nurul-fikri/bot_telegram/kirim_laporan_alquran?urut=" . $i . "&kode_access=" . $kode_access . "";
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, true);
                curl_setopt($ch, CURLOPT_URL, $API);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
                if (curl_exec($ch)) { // ?? - if request and data are completely received
                    continue; // ?? - go to the next loop
                } else {
                    break;
                }
                sleep(1);
            }
            curl_close($ch);
        } else {
            echo 'Nooooo';
        }

        // array of curl handles
        $multiCurl = array();
        // data to be returned
        $result = array();
        // multi handle
        $mh = curl_multi_init();
        foreach ($ids as $i => $id) {
            // URL from which data will be fetched
            $fetchURL = 'https://webkul.com&customerId=' . $id;
            $multiCurl[$i] = curl_init();
            curl_setopt($multiCurl[$i], CURLOPT_URL, $fetchURL);
            curl_setopt($multiCurl[$i], CURLOPT_HEADER, 0);
            curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER, 1);
            curl_multi_add_handle($mh, $multiCurl[$i]);
        }
        $index = null;
        do {
            curl_multi_exec($mh, $index);
        } while ($index > 0);
        // get content and remove handles
        foreach ($multiCurl as $k => $ch) {
            $result[$k] = curl_multi_getcontent($ch);
            curl_multi_remove_handle($mh, $ch);
        }
        // close
        curl_multi_close($mh);
    }

    public function kirim_laporan_alquran()
    {
        $kode_access = urldecode($this->input->get('kode_access', TRUE));
        $urut = urldecode($this->input->get('urut', TRUE));
        if ($this->config->item('access_bot') == $kode_access) {
            $chat_id = '253333888';
            $pesan = '' . $urut . '
        بِسْمِ اللّهِ الرَّحْمَنِ الرَّحِيْمِ

        ٱلسَّلَامُ عَلَيْكُمْ وَرَحْمَةُ ٱللَّٰهِ وَبَرَكَاتُهُ
        
        Ayah Bunda <strong>Muhammad</strong>
        
        Alhamdullillah ananda pada tanggal 14 Juli 2020 sesi subuh telah melah melakukan setor Alqur`an.
        
        
        Surah : <strong>Al Fathihah</strong>
        
        Ayat : <strong>Al Fathihah</strong>
        
        Jumlah Baris : <strong>Al Fathihah</strong>
         
        
        Terima kasih ayah bunda telah mendoakan ananda semoga istoqomah. 
        
        
        وَعَلَيْكُمْ السَّلاَمُ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ';
            $data =  $this->telegram_lib->sendmsg($pesan, $chat_id, 'HTML'); // Markdown HTML
            echo json_encode($data);
        } else {
            echo 'Nooooo';
        }
    }
}
