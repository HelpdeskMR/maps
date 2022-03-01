<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Tracking_model');
        $this->load->library('session');
    }

    public function index()
    {
        // Tracking Key Account
        $row_approval_program_header_ka = $this->Tracking_model->get_approval_program_header_ka();
        $index = 0;
        foreach ($row_approval_program_header_ka as $approval_program_ka) {
            $approval_scheme_ka[$index] =$approval_program_ka['approval_scheme'];
            $index++;
        }
        $lenght_approval_scheme_ka = count($approval_scheme_ka);
        $row_wf_program_ka = $this->Tracking_model->get_wf_program_ka($lenght_approval_scheme_ka);

        // Tracking Trade Marketing GT & MTI
        $row_approval_program_header_tm = $this->Tracking_model->get_approval_program_header_tm();
        $index1 = 0;
        foreach ($row_approval_program_header_tm as $approval_program_tm) {
            $approval_scheme_tm[$index1] =$approval_program_tm['approval_scheme'];
            $index1++;
        }
        $lenght_approval_scheme_tm = count($approval_scheme_tm);
        $row_wf_program_tm = $this->Tracking_model->get_wf_program_tm($lenght_approval_scheme_tm);

        // Tracking Trade Marketing MTKA
        $row_approval_program_header_tm_mtka = $this->Tracking_model->get_approval_program_header_tm_mtka();
        $index2 = 0;
        foreach ($row_approval_program_header_tm_mtka as $approval_program_tm_mtka) {
            $approval_scheme_tm_mtka[$index2] =$approval_program_tm_mtka['approval_scheme'];
            $index2++;
        }
        $lenght_approval_scheme_tm_mtka = count($approval_scheme_tm_mtka);
        $row_wf_program_tm_mtka = $this->Tracking_model->get_wf_program_tm_mtka($lenght_approval_scheme_tm_mtka);

        $data = array(
            'kode_departemen' => $this->session->userdata('kode_departemen'),
            'row_approval_program_header_ka' => $row_approval_program_header_ka,
            'row_wf_program_ka' => $row_wf_program_ka,
            'lenght_approval_scheme_ka' => $lenght_approval_scheme_ka,
            'row_approval_program_header_tm' => $row_approval_program_header_tm,
            'row_wf_program_tm' => $row_wf_program_tm,
            'lenght_approval_scheme_tm' => $lenght_approval_scheme_tm,
            'row_approval_program_header_tm_mtka' => $row_approval_program_header_tm_mtka,
            'row_wf_program_tm_mtka' => $row_wf_program_tm_mtka,
            'lenght_approval_scheme_tm_mtka' => $lenght_approval_scheme_tm_mtka,
        );

        $this->template->load('template', 'tracking', $data);
    }

    public function form()
    {
        //$this->load->view('table');
        $this->template->load('template', 'form');
    }

    function autocomplate()
    {
        autocomplate_json('tbl_user', 'full_name');
    }

    function __autocomplate()
    {
        $this->db->like('nama_lengkap', $_GET['term']);
        $this->db->select('nama_lengkap');
        $products = $this->db->get('pegawai')->result();
        foreach ($products as $product) {
            $return_arr[] = $product->nama_lengkap;
        }

        echo json_encode($return_arr);
    }

    function pdf()
    {
        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'JUDUL HEADER', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'JUDUL SUB HEADER', 0, 1, 'C');
        $pdf->Output();
    }
}
