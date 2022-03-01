<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Wf_allocation extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Gl_budget_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'wf_allocation/wf_allocation_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Gl_budget_model->json_allocation();
    }

    public function read($id)
    {
        $row_from = $this->Gl_budget_model->get_budgetAllocationFrom($id);
        $row_to = $this->Gl_budget_model->get_budgetAllocationTo($id);
        $data = array(
            'id_budget_allocation' => $row_to->id_budget_allocation,
            'allocation_code' => $row_to->allocation_code,
            'date_create' => $row_to->date_create,
            'gl_coa_segment_from' => $row_to->gl_coa_segment_from,
            'gl_coa_segment_to' => $row_to->gl_coa_segment_to,
            'amount_allocation' => $row_to->amount_allocation,
            'SecLogDate' => $row_to->SecLogDate,
            'SecLogUser' => $row_to->SecLogUser,
            'nama_perusahaan_to' => $row_to->nama_perusahaan,
            'business_unit_name_to' => $row_to->business_unit_name,
            'nama_departemen_to' => $row_to->nama_departemen,
            'channel_name_to' => $row_to->channel_name,
            'store_name_to' => $row_to->store_name,
            'nama_region_to' => $row_to->nama_region,
            'brand_name_to' => $row_to->brand_name,
            'series_name_to' => $row_to->series_name,
            'gl_coa_desc_to' => $row_to->gl_coa_desc,
            'BusgetSaldo_to' => $row_to->BudgetSaldo,
            'nama_perusahaan_from' => $row_from->nama_perusahaan,
            'business_unit_name_from' => $row_from->business_unit_name,
            'nama_departemen_from' => $row_from->nama_departemen,
            'channel_name_from' => $row_from->channel_name,
            'store_name_from' => $row_from->store_name,
            'nama_region_from' => $row_from->nama_region,
            'brand_name_from' => $row_from->brand_name,
            'series_name_from' => $row_from->series_name,
            'gl_coa_desc_from' => $row_from->gl_coa_desc,
            'BusgetSaldo_from' => $row_from->BudgetSaldo,
        );
        $this->template->load('template', 'wf_allocation/wf_allocation_read', $data);
    }

    function approve_action($id)
    {
        $row = $this->Gl_budget_model->get_budget_allocation($id);
        //From
        $row_budgetFrom = $this->Gl_budget_model->get_budgetFrom($row->gl_coa_segment_from);
        $budgetAmount_from = $row_budgetFrom->BudgetAmount;
        $budgetSaldo_from = $row_budgetFrom->BudgetSaldo;

        $data_from = array(
            'BudgetAmount' => $budgetAmount_from - $row->amount_allocation,
            'BudgetSaldo' => $budgetSaldo_from - $row->amount_allocation,
        );

        $this->Gl_budget_model->update_budgetAllocation($row->gl_coa_segment_from, $data_from);

        //To
        $row_budgetTo = $this->Gl_budget_model->get_budgetTo($row->gl_coa_segment_to);
        $budgetAmount_to = $row_budgetTo->BudgetAmount;
        $budgetSaldo_to = $row_budgetTo->BudgetSaldo;

        $data_to = array(
            'BudgetAmount' => $budgetAmount_to + $row->amount_allocation,
            'BudgetSaldo' => $budgetSaldo_to + $row->amount_allocation,
        );

        $this->Gl_budget_model->update_budgetAllocation($row->gl_coa_segment_to, $data_to);

        //data budget allocation
        $data_allocation = array(
            'status' => 4,
            'SecLogUser' => $this->session->userdata('full_name'),
            'SecLogDate' => date('Y-m-d H:i:s'),
        );

        $this->Gl_budget_model->update_dataAllocation($id, $data_allocation);

        //wf budget allocation
        $data_wf_allocation = array(
            'approve' => $this->session->userdata('full_name'),
            'approve_date' => date('Y-m-d H:i:s'),
            'SecLogUser' => $this->session->userdata('full_name'),
            'SecLogDate' => date('Y-m-d H:i:s'),
        );

        $this->Gl_budget_model->update_wfAllocation($row->allocation_code, $data_wf_allocation);
        $this->send($data_allocation);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('wf_allocation'));
    }

    function reject_action()
    {
        $id = $this->input->post('id_budget_allocation', TRUE);
        $allocation_code = $this->input->post('allocation_code', TRUE);
        $reject_reason = $this->input->post('reject_reason', TRUE);

        //data budget allocation
        $data_allocation = array(
            'status' => 2,
            'SecLogUser' => $this->session->userdata('full_name'),
            'SecLogDate' => date('Y-m-d H:i:s'),
        );

        $this->Gl_budget_model->update_dataAllocation($id, $data_allocation);

        //wf budget allocation
        $data_wf_allocation = array(
            'reject' => $this->session->userdata('full_name'),
            'reject_date' => date('Y-m-d H:i:s'),
            'reject_reason' => $reject_reason,
            'SecLogUser' => $this->session->userdata('full_name'),
            'SecLogDate' => date('Y-m-d H:i:s'),
        );

        $this->Gl_budget_model->update_wfAllocation($allocation_code, $data_wf_allocation);
        $this->send($data_allocation);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('wf_allocation'));
    }

    public function send($data_allocation)
	{
        if($data_allocation['status'] == 4) {
		    $message = '<div><p>Yth. Bapak/Ibu Wulan Ambar,<br/><br/>the request you submitted has been approved.</p></div>';
        } else {
            $message = '<div><p>Yth. Bapak/Ibu Wulan Ambar,<br/><br/>the request you submitted has been rejected.</p></div>';
        }

		//Send Email
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
		$config['smtp_pass'] = 'mustikagoogle@2022';
		$config['mailtype'] = 'html';

		$this->load->library('email', $config);

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
		$this->email->from('mustikaratu.mailer@gmail.com', 'MAPS');
		$this->email->to('wulan.ambar@mustika-ratu.co.id');
		$this->email->bcc('development@mustika-ratu.co.id');
		$this->email->subject('Notification Allocation Budget');
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		} else {
			$this->session->set_flashdata("email_sent", "Error in sending Email.");
			// show_error($this->email->print_debugger());
		}
	}
}
