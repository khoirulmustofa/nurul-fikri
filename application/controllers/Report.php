<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model');
        is_login();        
    }

    public function index()
    {
        $this->absensi_tahfidz();
    }    

    public function absensi_tahfidz()
    {
        $users_id = $this->session->userdata('users_id');
        $mushrif_tahfidz_row = $this->Report_model->get_mushrif_tahfidz_user_users_id($users_id)->row();

        $tgl_mulai = urldecode($this->input->get('tgl_mulai', TRUE));
        $tgl_akhir = urldecode($this->input->get('tgl_akhir', TRUE));
        $absensi_tahfidz = $this->Report_model->get_report_absensi_tahfidz($mushrif_tahfidz_row->mushrif_tahfidz_id, date_to_eng($tgl_mulai), date_to_eng($tgl_akhir));
        if (isset($_GET['download_excel'])) {
            $spreadsheet = new Spreadsheet;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'NIS')
                ->setCellValue('C1', 'Nama Santri')
                ->setCellValue('D1', 'Tanggal')
                ->setCellValue('D2', '1')
                ->setCellValue('E2', '2')
                ->setCellValue('F2', '3')
                ->setCellValue('G2', '4')
                ->setCellValue('H2', '5')
                ->setCellValue('I2', '6')
                ->setCellValue('J2', '7')
                ->setCellValue('K2', '8')
                ->setCellValue('L2', '9')
                ->setCellValue('M2', '10')
                ->setCellValue('N2', '11')
                ->setCellValue('O2', '12')
                ->setCellValue('P2', '13')
                ->setCellValue('Q2', '14')
                ->setCellValue('R2', '15')
                ->setCellValue('S2', '16')
                ->setCellValue('T2', '17')
                ->setCellValue('U2', '18')
                ->setCellValue('V2', '19')
                ->setCellValue('W2', '20')
                ->setCellValue('X2', '21')
                ->setCellValue('Y2', '22')
                ->setCellValue('Z2', '23')
                ->setCellValue('AA2', '24')
                ->setCellValue('AB2', '25')
                ->setCellValue('AC2', '26')
                ->setCellValue('AD2', '27')
                ->setCellValue('AE2', '28')
                ->setCellValue('AF2', '29')
                ->setCellValue('AG2', '30')
                ->setCellValue('AH2', '31')
                ->setCellValue('AI1', 'Hadir')
                ->setCellValue('AJ1', 'Telat')
                ->setCellValue('AK1', 'Sakit')
                ->setCellValue('AL1', 'Ijin')
                ->setCellValue('AM1', 'Absen');
            $spreadsheet->getActiveSheet()->mergeCells("A1:A2");
            $spreadsheet->getActiveSheet()->mergeCells("B1:B2");
            $spreadsheet->getActiveSheet()->mergeCells("C1:C2");
            $spreadsheet->getActiveSheet()->mergeCells("D1:AH1");
            $spreadsheet->getActiveSheet()->mergeCells("AI1:AI2");
            $spreadsheet->getActiveSheet()->mergeCells("AJ1:AJ2");
            $spreadsheet->getActiveSheet()->mergeCells("AK1:AK2");
            $spreadsheet->getActiveSheet()->mergeCells("AL1:AL2");
            $spreadsheet->getActiveSheet()->mergeCells("AM1:AM2");
            $kolom = 3;
            $nomor = 1;
            foreach ($absensi_tahfidz->result() as $absensi) {

                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $nomor)
                    ->setCellValue('B' . $kolom, $absensi->siswa_NIS)
                    ->setCellValue('C' . $kolom, $absensi->siswa_nama_lengkap)
                    ->setCellValue('D' . $kolom, $absensi->T1)
                    ->setCellValue('E' . $kolom, $absensi->T2)
                    ->setCellValue('F' . $kolom, $absensi->T3)
                    ->setCellValue('G' . $kolom, $absensi->T4)
                    ->setCellValue('H' . $kolom, $absensi->T5)
                    ->setCellValue('I' . $kolom, $absensi->T6)
                    ->setCellValue('J' . $kolom, $absensi->T7)
                    ->setCellValue('K' . $kolom, $absensi->T8)
                    ->setCellValue('L' . $kolom, $absensi->T9)
                    ->setCellValue('M' . $kolom, $absensi->T10)
                    ->setCellValue('N' . $kolom, $absensi->T11)
                    ->setCellValue('O' . $kolom, $absensi->T12)
                    ->setCellValue('P' . $kolom, $absensi->T13)
                    ->setCellValue('Q' . $kolom, $absensi->T14)
                    ->setCellValue('R' . $kolom, $absensi->T15)
                    ->setCellValue('S' . $kolom, $absensi->T16)
                    ->setCellValue('T' . $kolom, $absensi->T17)
                    ->setCellValue('U' . $kolom, $absensi->T18)
                    ->setCellValue('V' . $kolom, $absensi->T19)
                    ->setCellValue('W' . $kolom, $absensi->T20)
                    ->setCellValue('X' . $kolom, $absensi->T21)
                    ->setCellValue('Y' . $kolom, $absensi->T22)
                    ->setCellValue('Z' . $kolom, $absensi->T23)
                    ->setCellValue('AA' . $kolom, $absensi->T24)
                    ->setCellValue('AB' . $kolom, $absensi->T25)
                    ->setCellValue('AC' . $kolom, $absensi->T26)
                    ->setCellValue('AD' . $kolom, $absensi->T27)
                    ->setCellValue('AE' . $kolom, $absensi->T28)
                    ->setCellValue('AF' . $kolom, $absensi->T29)
                    ->setCellValue('AG' . $kolom, $absensi->T30)
                    ->setCellValue('AH' . $kolom, $absensi->T31)
                    ->setCellValue('AI' . $kolom, $absensi->total_hadir)
                    ->setCellValue('AJ' . $kolom, $absensi->total_telat)
                    ->setCellValue('AK' . $kolom, $absensi->total_sakit)
                    ->setCellValue('AL' . $kolom, $absensi->total_ijin)
                    ->setCellValue('AM' . $kolom, $absensi->total_absen);

                $kolom++;
                $nomor++;
            }
            for ($col = 'A'; $col !== 'AM'; $col++) {
                $spreadsheet->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
            }

            $spreadsheet->getActiveSheet()->setTitle('Laporan Absensi Tahfidz');

            $writer = new Xlsx($spreadsheet);
            $nama_file = "Report Absensi Tahfidz Ustadz/ah " . $mushrif_tahfidz_row->users_nama_lengkap . " | Tanggal : " . tgl_indo(date_to_eng($tgl_mulai)) . " Sampai " . tgl_indo(date_to_eng($tgl_akhir)) . ".xlsx";
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $nama_file . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        }

        $data['menu'] = "Report";
        $data['page'] = "Report Absensi Tahfidz " . $mushrif_tahfidz_row->users_nama_lengkap;
        $data['load_css_js'] = "report_absensi_tahfidz";
        $data['nama_mushrif'] = $mushrif_tahfidz_row->users_nama_lengkap;
        $data['mushrif_tahfidz_id'] = $mushrif_tahfidz_row->mushrif_tahfidz_id;
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['data_absensi_tahfidz'] = $absensi_tahfidz;
        $this->template->load('template/main_template', 'view_report_absensi_tahfidz', $data);
    }

    public function tahfidz()
    {
        $users_id = $this->session->userdata('users_id');
        $mushrif_tahfidz_row = $this->Report_model->get_mushrif_tahfidz_user_users_id($users_id)->row();

        $tgl_mulai = urldecode($this->input->get('tgl_mulai', TRUE));
        $tgl_akhir = urldecode($this->input->get('tgl_akhir', TRUE));
        $tahfidz_query = $this->Report_model->get_report_tahfidz($mushrif_tahfidz_row->mushrif_tahfidz_id, date_to_eng($tgl_mulai), date_to_eng($tgl_akhir));
        if (isset($_GET['download_excel'])) {
            $spreadsheet = new Spreadsheet;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'NIS')
                ->setCellValue('C1', 'Nama Santri')
                ->setCellValue('D1', 'Tanggal')
                ->setCellValue('D2', '1')
                ->setCellValue('E2', '2')
                ->setCellValue('F2', '3')
                ->setCellValue('G2', '4')
                ->setCellValue('H2', '5')
                ->setCellValue('I2', '6')
                ->setCellValue('J2', '7')
                ->setCellValue('K2', '8')
                ->setCellValue('L2', '9')
                ->setCellValue('M2', '10')
                ->setCellValue('N2', '11')
                ->setCellValue('O2', '12')
                ->setCellValue('P2', '13')
                ->setCellValue('Q2', '14')
                ->setCellValue('R2', '15')
                ->setCellValue('S2', '16')
                ->setCellValue('T2', '17')
                ->setCellValue('U2', '18')
                ->setCellValue('V2', '19')
                ->setCellValue('W2', '20')
                ->setCellValue('X2', '21')
                ->setCellValue('Y2', '22')
                ->setCellValue('Z2', '23')
                ->setCellValue('AA2', '24')
                ->setCellValue('AB2', '25')
                ->setCellValue('AC2', '26')
                ->setCellValue('AD2', '27')
                ->setCellValue('AE2', '28')
                ->setCellValue('AF2', '29')
                ->setCellValue('AG2', '30')
                ->setCellValue('AH2', '31')
                ->setCellValue('AI1', 'Total');
            $spreadsheet->getActiveSheet()->mergeCells("A1:A2");
            $spreadsheet->getActiveSheet()->mergeCells("B1:B2");
            $spreadsheet->getActiveSheet()->mergeCells("C1:C2");
            $spreadsheet->getActiveSheet()->mergeCells("D1:AH1");
            $spreadsheet->getActiveSheet()->mergeCells("AI1:AI2");
            $kolom = 3;
            $nomor = 1;
            foreach ($tahfidz_query->result() as $absensi) {

                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $nomor)
                    ->setCellValue('B' . $kolom, $absensi->siswa_NIS)
                    ->setCellValue('C' . $kolom, $absensi->siswa_nama_lengkap)
                    ->setCellValue('D' . $kolom, $absensi->T1)
                    ->setCellValue('E' . $kolom, $absensi->T2)
                    ->setCellValue('F' . $kolom, $absensi->T3)
                    ->setCellValue('G' . $kolom, $absensi->T4)
                    ->setCellValue('H' . $kolom, $absensi->T5)
                    ->setCellValue('I' . $kolom, $absensi->T6)
                    ->setCellValue('J' . $kolom, $absensi->T7)
                    ->setCellValue('K' . $kolom, $absensi->T8)
                    ->setCellValue('L' . $kolom, $absensi->T9)
                    ->setCellValue('M' . $kolom, $absensi->T10)
                    ->setCellValue('N' . $kolom, $absensi->T11)
                    ->setCellValue('O' . $kolom, $absensi->T12)
                    ->setCellValue('P' . $kolom, $absensi->T13)
                    ->setCellValue('Q' . $kolom, $absensi->T14)
                    ->setCellValue('R' . $kolom, $absensi->T15)
                    ->setCellValue('S' . $kolom, $absensi->T16)
                    ->setCellValue('T' . $kolom, $absensi->T17)
                    ->setCellValue('U' . $kolom, $absensi->T18)
                    ->setCellValue('V' . $kolom, $absensi->T19)
                    ->setCellValue('W' . $kolom, $absensi->T20)
                    ->setCellValue('X' . $kolom, $absensi->T21)
                    ->setCellValue('Y' . $kolom, $absensi->T22)
                    ->setCellValue('Z' . $kolom, $absensi->T23)
                    ->setCellValue('AA' . $kolom, $absensi->T24)
                    ->setCellValue('AB' . $kolom, $absensi->T25)
                    ->setCellValue('AC' . $kolom, $absensi->T26)
                    ->setCellValue('AD' . $kolom, $absensi->T27)
                    ->setCellValue('AE' . $kolom, $absensi->T28)
                    ->setCellValue('AF' . $kolom, $absensi->T29)
                    ->setCellValue('AG' . $kolom, $absensi->T30)
                    ->setCellValue('AH' . $kolom, $absensi->T31)
                    ->setCellValue('AI' . $kolom, $absensi->total_baris);

                $kolom++;
                $nomor++;
            }
            for ($col = 'A'; $col !== 'AI'; $col++) {
                $spreadsheet->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
            }

            $spreadsheet->getActiveSheet()->setTitle('Laporan Tahfidz');

            $writer = new Xlsx($spreadsheet);
            $nama_file = "Report Tahfidz Ustadz/ah " . $mushrif_tahfidz_row->users_nama_lengkap . " | Tanggal : " . tgl_indo(date_to_eng($tgl_mulai)) . " Sampai " . tgl_indo(date_to_eng($tgl_akhir)) . ".xlsx";
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $nama_file . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        }

        $data['menu'] = "Report";
        $data['page'] = "Report Tahfidz " . $mushrif_tahfidz_row->users_nama_lengkap;
        $data['load_css_js'] = "report_tahfidz";
        $data['nama_mushrif'] = $mushrif_tahfidz_row->users_nama_lengkap;
        $data['mushrif_tahfidz_id'] = $mushrif_tahfidz_row->mushrif_tahfidz_id;
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['data_tahfidz'] = $tahfidz_query;
        $this->template->load('template/main_template', 'view_report_tahfidz', $data);
    }
}
