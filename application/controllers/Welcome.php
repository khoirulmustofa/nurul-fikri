<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Test_model');
    }

    public function kirim_email()
    {
        // $loader = require_once __DIR__ . '/../vendor/autoload.php';

        $configuration = new ElasticEmailClient\ApiConfiguration([
            'apiUrl' => 'https://api.elasticemail.com/v2/',
            'apiKey' => 'DE3298F99552A88388740B490C859AD0BF9CAC5BD82C946A36C3EB5D5521AE597F0B1B43034C64F9E92847F5B87068A8',
        ]);

        $client = new ElasticEmailClient\ElasticClient($configuration);

        $client->Email->Send(
            "humas@nfbs-bogor.sch.id",
            "Humas",
            "friend.nfbs@gmail.com",
            "Teguh",
           
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "utf-8"
        );
    }
    public function index()
    {
        $uri = $this->uri->segment(1);
        echo $uri;
        echo '<hr>';
        $options = array("cost" => 10);
        $password = 'admin@111111';
        $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        print_r('Kata : ' . $password);
        echo '<hr>';
        print_r('Hash : ' . $hashPassword);
        echo '<hr>';
        if (password_verify($password, $hashPassword)) {
            print_r('Benar');
        } else {
            print_r('Salah');
        }

        $data_users = $this->Users_model->get_all_users()->result();

        foreach ($data_users as $user) {
            $options = array("cost" => 10);
            $kata = 'password';
            $hash = password_hash($kata, PASSWORD_BCRYPT, $options);
            $data['users_password'] = $hash;
            if ($user->users_id == 'nfbs-5ecf3f4ced30f') {
                $kata = 'admin@111';
                $hashing = password_hash($kata, PASSWORD_BCRYPT, $options);
                $data['users_password'] = $hashing;
            }
            $this->Users_model->update_users($user->users_id, $data);
            echo $user->users_nama_lengkap . " Updated -> " . $hash;
            echo "<br>";
        }
    }

    public function fungsi()
    {
        $uri1 = $this->uri->segment(1);
        $uri2 = $this->uri->segment(2);
        echo $uri1 . '_' . $uri2;
    }

    public function excel()
    {
        $this->load->view('view_excel');
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $writer = new Xlsx($spreadsheet);
        $filename = 'name-of-the-generated-file';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output'); // download file
    }

    public function import()
    {
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['upload_file']['name']);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $this->load->model('Welcome_model');
            foreach ($sheetData as $datas) {
                $data['siswa_id'] = insert_uuid();
                $data['siswa_NIS'] = $datas[1];
                $data['siswa_NISN'] = $datas[2];
                // $options = array("cost" => 10);
                // $hash = password_hash($datas[3], PASSWORD_BCRYPT, $options);
                $data['siswa_nama_lengkap'] = $datas[3];
                $data['kelas_id'] = $datas[4];
                $data['mushrif_tahfidz_id'] = $datas[5];
                // $data['users_status'] = $datas[6];
                // $data['users_update_waktu'] = $datas[8];
                //print_r($data);

                $this->Welcome_model->insert($data, 'siswa');
                echo $datas[1];
                echo '<hr>';
            }
        }
    }

    public function enkrip()
    {
        $encrypt = km_encrypt("1");
        echo "encrypt " . $encrypt . "\n";

        echo "decrypt " . km_decrypt($encrypt) . "\n";
    }

    // $this->db->get();
    // $query = $this->db->last_query();

    public function update()
    {
        echo uniqid('km-');
        // $data = $this->Users_model->get_all();
        // foreach ($data as $datas) {
        //     $d['users_id'] = uniqid('km-');
        //     $this->Users_model->update_users($datas->users_email, $d);
        // }
    }

    public function backup()
    {
        $this->load->dbutil();
        $waktu = date('Y-m-d H:i:s');
        $prefs = array(
            'format' => 'zip',
            'filename' => 'absensi_' . $waktu . '.sql',
        );

        $backup = &$this->dbutil->backup($prefs);

        $db_name = 'absensi_' . $waktu . '.zip';
        $save = 'pathtobkfolder/' . $db_name;

        $this->load->helper('file');
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);
    }
}
