<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Payment extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Claim_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->library('session');
	}

	public function index()
	{
        $row_get_claimId = $this->Claim_model->get_all();
        $data = array(
            'row_get_claimId' => $row_get_claimId,
            'payment_plan' => set_value('payment_plan'),
            'payment_date' => set_value('payment_date'),
        );
		$this->template->load('template', 'payment/payment_list', $data);
	}

	public function json_payment()
	{
		header('Content-Type: application/json');
		echo $this->Claim_model->json_payment();
	}

    public function payment_action()
    {
        $claim_id = $this->input->post('claim_id', TRUE);
        $payment_plan = $this->input->post('payment_plan', TRUE);
        if(!empty($payment_plan)){
            $plan = $payment_plan;
        } else {
            $plan = NULL;
        }
        $payment_date = $this->input->post('payment_date', TRUE);
        if(!empty($payment_date)){
            $date = $payment_date;
        } else {
            $date = NULL;
        }

        /*UPDATE FORM CLAIM */
        $data = array(
            'payment_plan' => $plan,
            'payment_date' => $date,
            'SecLogDate' => date('Y-m-d H:i:s'),
			'SecLogUser' => $this->session->userdata('full_name'),
        );

        $this->Claim_model->update_payment($data, $claim_id);
        $this->session->set_flashdata('message', 'Update Record Success');
	    redirect(site_url('payment'));
    }
}
