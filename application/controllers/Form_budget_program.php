<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form_budget_program extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Form_budget_program_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','form_budget_program/form_budget_program_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Form_budget_program_model->json();
    }

    public function read($id) 
    {
        $row = $this->Form_budget_program_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'no_p3' => $row->no_p3,
		'program_id' => $row->program_id,
		'gl_coa' => $row->gl_coa,
		'gl_coa_segment' => $row->gl_coa_segment,
		'sku_total_cost' => $row->sku_total_cost,
		'sku_total_usage' => $row->sku_total_usage,
		'sku_total_saldo' => $row->sku_total_saldo,
		'SecLogDate' => $row->SecLogDate,
		'SecLogUser' => $row->SecLogUser,
	    );
            $this->template->load('template','form_budget_program/form_budget_program_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('form_budget_program'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('form_budget_program/create_action'),
	    'id' => set_value('id'),
	    'no_p3' => set_value('no_p3'),
	    'program_id' => set_value('program_id'),
	    'gl_coa' => set_value('gl_coa'),
	    'gl_coa_segment' => set_value('gl_coa_segment'),
	    'sku_total_cost' => set_value('sku_total_cost'),
	    'sku_total_usage' => set_value('sku_total_usage'),
	    'sku_total_saldo' => set_value('sku_total_saldo'),
	    'SecLogDate' => set_value('SecLogDate'),
	    'SecLogUser' => set_value('SecLogUser'),
	);
        $this->template->load('template','form_budget_program/form_budget_program_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'no_p3' => $this->input->post('no_p3',TRUE),
		'program_id' => $this->input->post('program_id',TRUE),
		'gl_coa' => $this->input->post('gl_coa',TRUE),
		'gl_coa_segment' => $this->input->post('gl_coa_segment',TRUE),
		'sku_total_cost' => $this->input->post('sku_total_cost',TRUE),
		'sku_total_usage' => $this->input->post('sku_total_usage',TRUE),
		'sku_total_saldo' => $this->input->post('sku_total_saldo',TRUE),
		'SecLogDate' => $this->input->post('SecLogDate',TRUE),
		'SecLogUser' => $this->input->post('SecLogUser',TRUE),
	    );

            $this->Form_budget_program_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('form_budget_program'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Form_budget_program_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('form_budget_program/update_action'),
		'id' => set_value('id', $row->id),
		'no_p3' => set_value('no_p3', $row->no_p3),
		'program_id' => set_value('program_id', $row->program_id),
		'gl_coa' => set_value('gl_coa', $row->gl_coa),
		'gl_coa_segment' => set_value('gl_coa_segment', $row->gl_coa_segment),
		'sku_total_cost' => set_value('sku_total_cost', $row->sku_total_cost),
		'sku_total_usage' => set_value('sku_total_usage', $row->sku_total_usage),
		'sku_total_saldo' => set_value('sku_total_saldo', $row->sku_total_saldo),
		'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
		'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
	    );
            $this->template->load('template','form_budget_program/form_budget_program_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('form_budget_program'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'no_p3' => $this->input->post('no_p3',TRUE),
		'program_id' => $this->input->post('program_id',TRUE),
		'gl_coa' => $this->input->post('gl_coa',TRUE),
		'gl_coa_segment' => $this->input->post('gl_coa_segment',TRUE),
		'sku_total_cost' => $this->input->post('sku_total_cost',TRUE),
		'sku_total_usage' => $this->input->post('sku_total_usage',TRUE),
		'sku_total_saldo' => $this->input->post('sku_total_saldo',TRUE),
		'SecLogDate' => $this->input->post('SecLogDate',TRUE),
		'SecLogUser' => $this->input->post('SecLogUser',TRUE),
	    );

            $this->Form_budget_program_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('form_budget_program'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Form_budget_program_model->get_by_id($id);

        if ($row) {
            $this->Form_budget_program_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('form_budget_program'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('form_budget_program'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_p3', 'no p3', 'trim|required');
	$this->form_validation->set_rules('program_id', 'program id', 'trim|required');
	$this->form_validation->set_rules('gl_coa', 'gl coa', 'trim|required');
	$this->form_validation->set_rules('gl_coa_segment', 'gl coa segment', 'trim|required');
	$this->form_validation->set_rules('sku_total_cost', 'sku total cost', 'trim|required|numeric');
	$this->form_validation->set_rules('sku_total_usage', 'sku total usage', 'trim|required|numeric');
	$this->form_validation->set_rules('sku_total_saldo', 'sku total saldo', 'trim|required|numeric');
	$this->form_validation->set_rules('SecLogDate', 'seclogdate', 'trim|required');
	$this->form_validation->set_rules('SecLogUser', 'secloguser', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "form_budget_program.xls";
        $judul = "form_budget_program";
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
	xlsWriteLabel($tablehead, $kolomhead++, "No P3");
	xlsWriteLabel($tablehead, $kolomhead++, "Program Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Gl Coa");
	xlsWriteLabel($tablehead, $kolomhead++, "Gl Coa Segment");
	xlsWriteLabel($tablehead, $kolomhead++, "Sku Total Cost");
	xlsWriteLabel($tablehead, $kolomhead++, "Sku Total Usage");
	xlsWriteLabel($tablehead, $kolomhead++, "Sku Total Saldo");
	xlsWriteLabel($tablehead, $kolomhead++, "SecLogDate");
	xlsWriteLabel($tablehead, $kolomhead++, "SecLogUser");

	foreach ($this->Form_budget_program_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_p3);
	    xlsWriteNumber($tablebody, $kolombody++, $data->program_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gl_coa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gl_coa_segment);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sku_total_cost);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sku_total_usage);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sku_total_saldo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->SecLogDate);
	    xlsWriteLabel($tablebody, $kolombody++, $data->SecLogUser);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Form_budget_program.php */
/* Location: ./application/controllers/Form_budget_program.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-23 03:48:32 */
/* http://harviacode.com */