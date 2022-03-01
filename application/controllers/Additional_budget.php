<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Additional_budget extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Promotion_header_model');
        $this->load->model('Wf_edit_budget_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    function index()
    {
        $this->template->load('template', 'additional_budget/additional_budget_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Promotion_header_model->json_additionalBudget();
    }

    

    public function read($id)
	{
		$row = $this->Promotion_header_model->get_by_id($id);
		$promotion_number = $row->promotion_number;
		if ($row->total_product_incremental != 0) {
			$percent_listing = ($row->total_listing_cost / $row->total_product_incremental) * 100;
			$percent_listing_incremental_sales = number_format($percent_listing, 2);
		} else {
			$percent_listing_incremental_sales = 0;
		}
		if ($row->total_product_incremental != 0) {
			$percen_promo = ($row->total_on_top_promo / $row->total_product_incremental) * 100;
			$percen_promo_incremental_sales = number_format($percen_promo, 2);
		} else {
			$percen_promo_incremental_sales = 0;
		}
		$row_financial_kpi = $this->Promotion_header_model->get_financial_kpi($promotion_number);
		$row_product = $this->Promotion_header_model->get_product($promotion_number);
		$row_listing_cost = $this->Promotion_header_model->get_listing_cost($promotion_number);
		$row_on_top_promo = $this->Promotion_header_model->get_on_top_promo($promotion_number);
		$row_trading_term = $this->Promotion_header_model->get_trading($promotion_number);
		$row_total_trading_term = $this->Promotion_header_model->get_total_trading($promotion_number);
		$row_approve_scheme1 = $this->Promotion_header_model->get_approve_edit1($promotion_number);
		$row_approve_scheme2 = $this->Promotion_header_model->get_approve_edit2($promotion_number);
		$row_approve_scheme3 = $this->Promotion_header_model->get_approve_edit3($promotion_number);
		$row_approve_scheme4 = $this->Promotion_header_model->get_approve_edit4($promotion_number);
		$row_approve_scheme5 = $this->Promotion_header_model->get_approve_edit5($promotion_number);
		$row_approve_scheme6 = $this->Promotion_header_model->get_approve_edit6($promotion_number);
		$row_approve_scheme7 = $this->Promotion_header_model->get_approve_edit7($promotion_number);
		$row_wf_program_max = $this->Promotion_header_model->get_wf_program_max($promotion_number);
		$row_approval_program_max = $this->Promotion_header_model->get_approval_program_max();
		$row_reject_reason = $this->Promotion_header_model->get_reject_reason($promotion_number);
		if ($row_reject_reason != NULL) {
			$reject_reason = $row_reject_reason->reject_reason;
		} else {
			$reject_reason = null;
		}
		if ($row) {
			$data = array(
				'promotion_id' => $row->promotion_id,
				'kode_perusahaan' => $row->kode_perusahaan,
				'date_create' => $row->date_create,
				'promotion_number' => $row->promotion_number,
				'kode_departemen' => $row->kode_departemen,
				'promotion_name' => $row->promotion_name,
				'periode_awal' => $row->periode_awal,
				'periode_akhir' => $row->periode_akhir,
				'fiscal_year' => $row->fiscal_year,
				'channel_code' => $row->channel_code,
				'region_code' => $row->region_code,
				'kode_area' => $row->kode_area,
				'store_code' => $row->store_code,
				'sales_background' => $row->sales_background,
				'sales_strategy' => $row->sales_strategy,
				'sales_objective' => $row->sales_objective,
				'sales_mechanism' => $row->sales_mechanism,
				'status' => $row->status,
				'pemohon' => $row->pemohon,
				'SecLogUser' => $row->SecLogUser,
				'SecLogDate' => $row->SecLogDate,
				'row_product' => $row_product,
				'row_listing_cost' => $row_listing_cost,
				'row_on_top_promo' => $row_on_top_promo,
				'row_financial_kpi' => $row_financial_kpi,
				'total_product_baseline' => $row->total_product_baseline,
				'total_product_incremental' => $row->total_product_incremental,
				'total_listing_cost' => $row->total_listing_cost,
				'total_on_top_promo' => $row->total_on_top_promo,
				'nama_departemen' => $row->nama_departemen,
				'channel_name' => $row->channel_name,
				'nama_region' => $row->nama_region,
				'nama_area' => $row->nama_area,
				'store_name' => $row->store_name,
				'listing_incremental_sales' => $percent_listing_incremental_sales,
				'promo_incremental_sales' => $percen_promo_incremental_sales,
				'row_trading_term' => $row_trading_term,
				'total_trading_amount' => $row_total_trading_term->total_amount,
				'total_trading_percent' => $row_total_trading_term->total_incremental_sales,
				'upload_file' => $row->upload_file,
				'upload_activity' => $row->upload_activity,
				'row_approve_scheme1' => $row_approve_scheme1,
				'row_approve_scheme2' => $row_approve_scheme2,
				'row_approve_scheme3' => $row_approve_scheme3,
				'row_approve_scheme4' => $row_approve_scheme4,
				'row_approve_scheme5' => $row_approve_scheme5,
				'row_approve_scheme6' => $row_approve_scheme6,
				'row_approve_scheme7' => $row_approve_scheme7,
				'row_wf_program_max' => $row_wf_program_max->max_wf_program,
				'row_approval_program_max' => $row_approval_program_max->max_approval_program,
				'row_reject_reason' => $reject_reason,
			);
			$this->template->load('template', 'additional_budget/additional_budget_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('promotion_form'));
		}
	}
}
