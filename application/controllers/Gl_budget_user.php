<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gl_budget_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Gl_budget_model_user');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','gl_budget/gl_budget_list_user');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Gl_budget_model_user->json();
    }

    public function read($id) 
    {
        $row = $this->Gl_budget_model_user->get_by_id($id);
        if ($row) {
            $data = array(
		'budget_id' => $row->budget_id,
		'kode_perusahaan' => $row->kode_perusahaan,
		'kode_departemen' => $row->kode_departemen,
		'gl_coa' => $row->gl_coa,
		'gl_coa_segment' => $row->gl_coa_segment,
		'YearPeriod' => $row->YearPeriod,
		'BudgetAmount' => $row->BudgetAmount,
		'BudgetUsage' => $row->BudgetUsage,
		'BudgetSaldo' => $row->BudgetSaldo,
		'SecLogUser' => $row->SecLogUser,
		'SecLogDate' => $row->SecLogDate,
	    );
            $this->template->load('template','gl_budget/gl_budget_read_user', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gl_budget_user'));
        }
    }

    
    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "gl_budget.xls";
        $judul = "gl_budget";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Perusahaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Departemen");
	xlsWriteLabel($tablehead, $kolomhead++, "Gl Coa");
	xlsWriteLabel($tablehead, $kolomhead++, "Gl Coa Segment");
	xlsWriteLabel($tablehead, $kolomhead++, "YearPeriod");
	xlsWriteLabel($tablehead, $kolomhead++, "BudgetAmount");
	xlsWriteLabel($tablehead, $kolomhead++, "BudgetUsage");
	xlsWriteLabel($tablehead, $kolomhead++, "BudgetSaldo");
	xlsWriteLabel($tablehead, $kolomhead++, "SecLogUser");
	xlsWriteLabel($tablehead, $kolomhead++, "SecLogDate");

	foreach ($this->Gl_budget_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_perusahaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_departemen);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gl_coa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gl_coa_segment);
	    xlsWriteNumber($tablebody, $kolombody++, $data->YearPeriod);
	    xlsWriteNumber($tablebody, $kolombody++, $data->BudgetAmount);
	    xlsWriteNumber($tablebody, $kolombody++, $data->BudgetUsage);
	    xlsWriteNumber($tablebody, $kolombody++, $data->BudgetSaldo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->SecLogUser);
	    xlsWriteLabel($tablebody, $kolombody++, $data->SecLogDate);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}