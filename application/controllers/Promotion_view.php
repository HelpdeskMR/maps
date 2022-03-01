<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Promotion_view extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Promotion_header_model');
		$this->load->model('Wf_program_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$row_get_promotionId = $this->Promotion_header_model->get_all_data();
		$row_data = $this->Promotion_header_model->promotion_view();
		$data = array('row_get_promotionId' => $row_get_promotionId, 'row_data' => $row_data);
		$this->template->load('template', 'promotion_header/promotion_view', $data);
	}

	public function read($id)
	{
		$row = $this->Promotion_header_model->get_by_id($id);
		$promotion_number = $row->promotion_number;
		$row_product = $this->Promotion_header_model->get_product($promotion_number);
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
				'total_product_baseline' => $row->total_product_baseline,
				'total_product_incremental' => $row->total_product_incremental,
				'total_listing_cost' => $row->total_listing_cost,
				'total_on_top_promo' => $row->total_on_top_promo,
				'nama_departemen' => $row->nama_departemen,
				'channel_name' => $row->channel_name,
				'nama_region' => $row->nama_region,
				'nama_area' => $row->nama_area,
				'store_name' => $row->store_name,
				'upload_file' => $row->upload_file,
				'upload_activity' => $row->upload_activity,
				'status_name' => $row->status_name,
			);
			$this->template->load('template', 'promotion_header/promotion_view_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('promotion_form'));
		}
	}

	function pdf($id)
	{
		$row_export = $this->Promotion_header_model->promotion_export($id);
		$promotion_number = $row_export->promotion_number;
		$row_product_export = $this->Promotion_header_model->get_product_export($promotion_number);
		$data = array(
			'promotion_id' => $row_export->promotion_id,
			'kode_perusahaan' => $row_export->kode_perusahaan,
			'date_create' => $row_export->date_create,
			'promotion_number' => $row_export->promotion_number,
			'kode_departemen' => $row_export->kode_departemen,
			'promotion_name' => $row_export->promotion_name,
			'periode_awal' => $row_export->periode_awal,
			'periode_akhir' => $row_export->periode_akhir,
			'fiscal_year' => $row_export->fiscal_year,
			'channel_code' => $row_export->channel_code,
			'region_code' => $row_export->region_code,
			'kode_area' => $row_export->kode_area,
			'store_code' => $row_export->store_code,
			'sales_background' => $row_export->sales_background,
			'sales_strategy' => $row_export->sales_strategy,
			'sales_objective' => $row_export->sales_objective,
			'sales_mechanism' => $row_export->sales_mechanism,
			'status' => $row_export->status,
			'pemohon' => $row_export->pemohon,
			'SecLogUser' => $row_export->SecLogUser,
			'SecLogDate' => $row_export->SecLogDate,
			'row_product' => $row_product_export,
			'total_product_baseline' => $row_export->total_product_baseline,
			'total_product_incremental' => $row_export->total_product_incremental,
			'total_listing_cost' => $row_export->total_listing_cost,
			'total_on_top_promo' => $row_export->total_on_top_promo,
			'nama_departemen' => $row_export->nama_departemen,
			'channel_name' => $row_export->channel_name,
			'nama_region' => $row_export->nama_region,
			'nama_area' => $row_export->nama_area,
			'store_name' => $row_export->store_name,
		);
		$this->load->view('promotion_header/promotion_view_pdf', $data);

		// Get output html
		$html = $this->output->get_output();

		// Load pdf library
		$this->load->library('pdf');

		$this->dompdf->loadHtml($html);
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Promotion.pdf", array("Attachment" => 0));
	}
}