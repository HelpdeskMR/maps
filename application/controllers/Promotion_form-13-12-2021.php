<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Promotion_form extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Promotion_header_model');
		$this->load->model('Wf_program_model');
		$this->load->model('Wf_edit_budget_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$row_get_promotionId = $this->Promotion_header_model->get_all_data();
		$data = array('row_get_promotionId' => $row_get_promotionId);
		$this->template->load('template', 'promotion_header/promotion_header_list', $data);
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Promotion_header_model->json();
	}

	public function jsonCancel()
	{
		header('Content-Type: application/json');
		echo $this->Promotion_header_model->jsonCancel();
	}

	public function jsonHistory()
	{
		header('Content-Type: application/json');
		echo $this->Promotion_header_model->jsonHistory();
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
		$row_approve_scheme1 = $this->Promotion_header_model->get_approve_scheme1($promotion_number);
		$row_approve_scheme2 = $this->Promotion_header_model->get_approve_scheme2($promotion_number);
		$row_approve_scheme3 = $this->Promotion_header_model->get_approve_scheme3($promotion_number);
		$row_approve_scheme4 = $this->Promotion_header_model->get_approve_scheme4($promotion_number);
		$row_approve_scheme5 = $this->Promotion_header_model->get_approve_scheme5($promotion_number);
		$row_approve_scheme6 = $this->Promotion_header_model->get_approve_scheme6($promotion_number);
		$row_approve_scheme7 = $this->Promotion_header_model->get_approve_scheme7($promotion_number);
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
			$this->template->load('template', 'promotion_header/promotion_header_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('promotion_form'));
		}
	}

	public function create()
	{
		$kode_departemen = $this->session->userdata('kode_departemen');
		$row_departemen = $this->Promotion_header_model->get_departemen($kode_departemen);
		$data = array(
			'button' => 'Create',
			'action' => site_url('promotion_form/create_action'),
			'promotion_id' => set_value('promotion_id'),
			'kode_perusahaan' => set_value('kode_perusahaan'),
			'date_create' => set_value('date_create'),
			'promotion_number' => set_value('promotion_number'),
			'kode_departemen' => set_value('kode_departemen'),
			'promotion_name' => set_value('promotion_name'),
			'periode_awal' => set_value('periode_awal'),
			'periode_akhir' => set_value('periode_akhir'),
			'fiscal_year' => set_value('fiscal_year'),
			'channel_code' => set_value('channel_code'),
			'channel_name' => set_value(''),
			'region_code' => set_value('region_code'),
			'region_name' => set_value(''),
			'kode_area' => set_value('kode_area'),
			'store_code' => set_value('store_code'),
			'store_name' => set_value(''),
			'sales_background' => set_value('sales_background'),
			'sales_strategy' => set_value('sales_strategy'),
			'sales_objective' => set_value('sales_objective'),
			'sales_mechanism' => set_value('sales_mechanism'),
			'status' => set_value('status'),
			'pemohon' => set_value('pemohon'),
			'SecLogUser' => set_value('SecLogUser'),
			'SecLogDate' => set_value('SecLogDate'),
			'product_code' => set_value('product_code'),
			'product_name' => set_value('product_name'),
			'category_id' => set_value('category_id'),
			'listing_activity_id' => set_value('listing_activity_id'),
			'promo_gl_coa' => set_value('promo_gl_coa'),
			'listing_gl_coa' => set_value('listing_gl_coa'),
			'promo_activity_id' => set_value('promo_activity_id'),
			'baseline_sales' => set_value('baseline_sales'),
			'incremental_sales' => set_value('incremental_sales'),
			'listing_amount' => set_value('listing_amount'),
			'listing_percent' => set_value('listing_percent'),
			'listing_source_of_fund' => set_value('listing_source_of_fund'),
			'listing_remarks' => set_value('listing_remarks'),
			'promo_amount' => set_value('promo_amount'),
			'promo_percent' => set_value('promo_percent'),
			'promo_source_of_fund' => set_value('promo_source_of_fund'),
			'promo_remarks' => set_value('promo_remarks'),
			'error_upload' => set_value('error_upload'),
			'trading_activity_id' => set_value('trading_activity_id'),
			'trading_amount' => set_value('trading_amount'),
			'percent_incremental_sales' => set_value('percent_incremental_sales'),
			'trading_account_code' => set_value('trading_account_code'),
			'approval_user' => set_value('approval_user'),
			'approval_user_level' => set_value('approval_user_level'),
			'row_departemen' => $row_departemen,
			'kode_departemen' => $kode_departemen,
		);
		$this->template->load('template', 'promotion_header/promotion_header_form', $data);
	}

	/* 
	//-- CREATE ACTION --// 
	*/
	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {

			$kode_departemen = $this->input->post('kode_departemen', TRUE);
			$alias_dept = $this->Promotion_header_model->get_dept($kode_departemen);
			$store_code = $this->input->post('store_code', TRUE);
			$region_code = $this->input->post('region_code', TRUE);
			$channel_code = $this->input->post('channel_code', TRUE);
			$channel_name = $this->Promotion_header_model->get_channel_name($channel_code);
			$alias_channel = $this->Promotion_header_model->get_alias_channel($channel_code);
			$fiscal_year = $this->input->post('fiscal_year', TRUE);
			$kode_distributor = $this->input->post('kode_distributor', TRUE);

			$kode = $this->Promotion_header_model->buat_kode($kode_departemen);

			$bulan = date("m");
			$tahun = date("Y");
			// $promotion_number = $kode . "/" . $alias_dept . "/" . $channel_name . "/" . $bulan . "/" . $tahun;
			// $promotion_number =  $alias_dept . "/" . $channel_name . "/" . $bulan . "/" . $tahun . "/" . $kode;
			$promotion_number =  $alias_dept . "/" . $alias_channel . "/" . $bulan . "/" . $tahun . "/" . $kode;

			$this->insertPromotionForm($promotion_number);
			$this->insertFinancialKpi($promotion_number);

			/* PRODUCT */

			$product_name = $this->input->post('product_name', TRUE);
			$category_1 = $this->input->post('category_1', TRUE);
			$category_2 = $this->input->post('category_2', TRUE);
			$baseline_sales = str_replace(".", "", $this->input->post('baseline_sales', TRUE));
			$incremental_sales = str_replace(".", "", $this->input->post('incremental_sales', TRUE));

			if (array_filter($product_name) && array_filter($category_1) && array_filter($category_2)) {
				$productArray = array();

				$index = 0;
				foreach ($product_name as $data_product) {
					$add_data = array(
						'product_code' => $data_product,
						'promotion_number' => $promotion_number,
						'category_1' => $category_1[$index],
						'category_2' => $category_2[$index],
						'baseline_sales' => $baseline_sales[$index],
						'incremental_sales' => $incremental_sales[$index],
						'SecLogDate' => date('Y-m-d H:i:s'),
						'SecLogUser' => $this->session->userdata('full_name')
					);
					array_push($productArray, $add_data);
					$index++;
				}
				$this->Promotion_header_model->insert_product($productArray);
			} else {
				$baseline_sales = array('0');
				$incremental_sales = array('0');
			}
			/*
				LISTING COST 
			*/

			$listing_activity = $this->input->post('listing_activity');
			$listing_account_code = $this->input->post('listing_account_code');
			$listing_amount = str_replace(".", "", $this->input->post('listing_amount'));
			$listing_source_of_fund = $this->input->post('listing_source_of_fund');
			$listing_remarks = $this->input->post('listing_remarks');

			$listingActivity = array_filter($listing_activity);
			$listingAccountCode = array_filter($listing_account_code);
			$listingAmount = array_filter($listing_amount);

			if ($listingActivity != NULL) {
				$lenght = count($listing_activity);
				for ($x = 0; $x < $lenght; $x++) {
					$listing_percent_incremental_sales[$x] = (is_numeric($listing_amount[$x]) / is_numeric(array_sum($incremental_sales))) * 100;
				}
			}
			if ($listingActivity != NULL && $listingAccountCode != NULL && $listingAmount != NULL) {
				$listingArray = array();

				$index1 = 0;
				foreach ($listing_activity as $data_listing) {
					$add_data = array(
						'listing_activity' => $data_listing,
						'promotion_number' => $promotion_number,
						'gl_coa_segment' => "01" . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('store_code', TRUE) . $this->input->post('region_code', TRUE) . "-" . $listing_account_code[$index1],
						'gl_account_code' => $listing_account_code[$index1],
						'amount' => $listing_amount[$index1],
						'incremental_sales' => $listing_percent_incremental_sales[$index1],
						'source_fund' => $listing_source_of_fund[$index1],
						'remark' => $listing_remarks[$index1],
						'SecLogDate' => date('Y-m-d H:i:s'),
						'SecLogUser' => $this->session->userdata('full_name')
					);

					array_push($listingArray, $add_data);
					$index1++;
				}
				$this->Promotion_header_model->insert_listing($listingArray);

				/* 
				 LISTING FEE BUDGET
				*/

				$row_listing_fee_data = $this->Promotion_header_model->get_listing_fee_data($promotion_number);
				$listingFee_coaSegment = $row_listing_fee_data->gl_coa_segment;
				if ($row_listing_fee_data->gl_coa_segment > 0) {
					$listingFee_amount = $row_listing_fee_data->amount;
					$row_listingFee_budget = $this->Promotion_header_model->get_listingFee_budget_amount($listingFee_coaSegment);

					/* LISTING FEE  Budget Usage  */
					$listingFee_budgetUsage = $row_listingFee_budget->BudgetUsage;
					$totalUsage_listingFee = $listingFee_budgetUsage + $listingFee_amount;

					/* LISTING FEE Budget Saldo  */
					$listingFee_budgetSaldo = $row_listingFee_budget->BudgetSaldo;
					$totalSaldo_listingFee = $listingFee_budgetSaldo - $listingFee_amount;

					/* LISTING FEE Update Master Budget  */
					$data_listingFee = array(
						'BudgetUsage' => $totalUsage_listingFee,
						'BudgetSaldo' => $totalSaldo_listingFee,
						'SecLogDate' => date('Y-m-d H:i:s'),
						'SecLogUser' => $this->session->userdata('full_name')
					);

					$this->Promotion_header_model->update_listingFee($listingFee_coaSegment, $data_listingFee, $fiscal_year);
				}


				/* LISTING SUPPORT BUDGET  */

				$listing_support_data = $this->Promotion_header_model->get_listing_support_data($promotion_number);
				if ($listing_support_data->gl_coa_segment > 0) {
					$listingSupport_coaSegment = $listing_support_data->gl_coa_segment;
					$listingSupport_amount = $listing_support_data->amount;
					$listingSupport_budget = $this->Promotion_header_model->get_listingSupport_budget_amount($listingSupport_coaSegment);

					/* LISTING SUPPORT  Budget Usage */

					$listingSupport_budgetUsage = $listingSupport_budget->BudgetUsage;
					$totalUsage_listingSupport = $listingSupport_budgetUsage + $listingSupport_amount;

					/* LISTING SUPPORT Budget Saldo  */

					$listingSupport_budgetSaldo = $listingSupport_budget->BudgetSaldo;
					$totalSaldo_listingSupport = $listingSupport_budgetSaldo - $listingSupport_amount;

					/* LISTING SUPPORT Update Master Budget  */

					$listingSupport = array(
						'BudgetUsage' => $totalUsage_listingSupport,
						'BudgetSaldo' => $totalSaldo_listingSupport,
						'SecLogDate' => date('Y-m-d H:i:s'),
						'SecLogUser' => $this->session->userdata('full_name')
					);

					$this->Promotion_header_model->update_listingSupport($listingSupport_coaSegment, $listingSupport, $fiscal_year);
				}
			} else {
			}

			/*
			 	ON TOP PROMO 
			 */

			$promo_activity = $this->input->post('promo_activity', TRUE);
			$promo_account_code = $this->input->post('promo_account_code', TRUE);
			$promo_amount = str_replace(".", "", $this->input->post('promo_amount', TRUE));
			$promo_source_of_fund = $this->input->post('promo_source_of_fund', TRUE);
			$promo_remarks = $this->input->post('promo_remarks', TRUE);

			$promoActivity = array_filter($promo_activity);
			$promoAccountCode = array_filter($promo_account_code);
			$promoAmount = array_filter($promo_amount);

			if ($promoActivity != NULL) {
				$lenght = count($promo_activity);
				for ($x = 0; $x < $lenght; $x++) {
					$promo_percent_incremental_sales[$x] = (is_numeric($promo_amount[$x]) / is_numeric(array_sum($incremental_sales))) * 100;
				}
			}
			if ($promoActivity != NULL && $promoAccountCode != NULL && $promoAmount != NULL) {
				$promoArray = array();

				$index2 = 0;
				foreach ($promo_activity as $data_promo) {
					$add_data = array(
						'promo_activity_name' => $data_promo,
						'promotion_number' => $promotion_number,
						'gl_coa_segment' => "01" . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('store_code', TRUE) . $this->input->post('region_code', TRUE) . "-" . $promo_account_code[$index2],
						'gl_account_code' => $promo_account_code[$index2],
						'amount' => $promo_amount[$index2],
						'incremental_sales' => $promo_percent_incremental_sales[$index2],
						'source_fund' => $promo_source_of_fund[$index2],
						'remark' => $promo_remarks[$index2],
						'SecLogDate' => date('Y-m-d H:i:s'),
						'SecLogUser' => $this->session->userdata('full_name')
					);

					array_push($promoArray, $add_data);
					$index2++;
				}

				$this->Promotion_header_model->insert_promo($promoArray);

				/* BUDGET ON TOP PROMO */

				$row_ontopPromo = $this->Promotion_header_model->get_ontopPromo($promotion_number);
				if ($row_ontopPromo > 0) {
					$index3 = 0;
					foreach ($row_ontopPromo as $data_ontopPromo) {
						$ontopPromo_coaSegment[$index3] = $data_ontopPromo['gl_coa_segment'];
						$ontopPromo_amount[$index3] = $data_ontopPromo['amount'];
						$index3++;
					}

					$row_ontopPromo_budget = $this->Promotion_header_model->get_ontopPromo_budget_amount($ontopPromo_coaSegment);
					$index4 = 0;
					foreach ($row_ontopPromo_budget as $data_budget) {
						$ontopPromo_usage[$index4] = $data_budget['BudgetUsage'];
						$ontopPromo_saldo[$index4] = $data_budget['BudgetSaldo'];
						$index4++;
					}

					$budgetArray = array();
					$lenght = count($ontopPromo_coaSegment);
					for ($x = 0; $x < $lenght; $x++) {

						/* Budget Usage */
						$totalUsage_ontopPromo[$x] = $ontopPromo_usage[$x] + $ontopPromo_amount[$x];

						/* Budget Saldo */
						$totalSaldo_ontopPromo[$x] = $ontopPromo_saldo[$x] - $ontopPromo_amount[$x];

						/* Update Master Budget */

						$ontopPromo_budget = array(
							'gl_coa_segment' => $ontopPromo_coaSegment[$x],
							'BudgetUsage' => $totalUsage_ontopPromo[$x],
							'BudgetSaldo' => $totalSaldo_ontopPromo[$x],
							'SecLogDate' => date('Y-m-d H:i:s'),
							'SecLogUser' => $this->session->userdata('full_name')
						);

						array_push($budgetArray, $ontopPromo_budget);
					}

					$this->Promotion_header_model->update_budget_onTopPromo($budgetArray, $fiscal_year);
				}
			}

			/*
			 TRADING TERM 
			 */

			$trading_activity = $this->input->post('trading_activity', TRUE);
			$trading_account_code = $this->input->post('trading_account_code', TRUE);
			$trading_amount = str_replace(".", "", $this->input->post('trading_amount', TRUE));
			$trading_percent_incremental_sales = $this->input->post('percent_incremental_sales', TRUE);

			$tradingActivity = array_filter($trading_activity);
			$tradingAccountCode = array_filter($trading_account_code);
			$tradingAmount = array_filter($trading_amount);

			if ($tradingActivity != NULL && $tradingAccountCode != NULL && $tradingAmount != NULL) {
				$tradingArray = array();

				$index5 = 0;
				foreach ($trading_activity as $data_trading) {
					$add_data = array(
						'trading_activity_name' => $data_trading,
						'promotion_number' => $promotion_number,
						'gl_coa_segment' => "01" . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('store_code', TRUE) . $this->input->post('region_code', TRUE) . "-" . $trading_account_code[$index5],
						'gl_account_code' => $trading_account_code[$index5],
						'amount' => $trading_amount[$index5],
						'incremental_sales' => $trading_percent_incremental_sales[$index5],
						'SecLogDate' => date('Y-m-d H:i:s'),
						'SecLogUser' => $this->session->userdata('full_name')
					);

					array_push($tradingArray, $add_data);
					$index5++;
				}

				$this->Promotion_header_model->insert_trading($tradingArray);

				/* BUDGET TRADING TERM */

				$row_tradingTerm = $this->Promotion_header_model->get_tradingTerm($promotion_number);
				if ($row_tradingTerm > 0) {
					$index6 = 0;
					foreach ($row_tradingTerm as $data_tradingTerm) {
						$tradingTerm_coaSegment[$index6] = $data_tradingTerm['gl_coa_segment'];
						$tradingTerm_amount[$index6] = $data_tradingTerm['amount'];
						$index6++;
					}

					$row_tradingTerm_budget = $this->Promotion_header_model->get_tradingTerm_budget_amount($tradingTerm_coaSegment);
					$index7 = 0;
					foreach ($row_tradingTerm_budget as $data_budget) {
						$tradingTerm_usage[$index7] = $data_budget['BudgetUsage'];
						$tradingTerm_saldo[$index7] = $data_budget['BudgetSaldo'];
						$index7++;
					}

					$budget_tradingArray = array();
					$lenght = count($tradingTerm_coaSegment);
					for ($x = 0; $x < $lenght; $x++) {

						/* Budget Usage */
						$totalUsage_tradingTerm[$x] = $tradingTerm_usage[$x] + $tradingTerm_amount[$x];

						/* Budget Saldo */
						$totalSaldo_tradingTerm[$x] = $tradingTerm_saldo[$x] - $tradingTerm_amount[$x];

						/* Update Master Budget */

						$tradingTerm_budget = array(
							'gl_coa_segment' => $tradingTerm_coaSegment[$x],
							'BudgetUsage' => $totalUsage_tradingTerm[$x],
							'BudgetSaldo' => $totalSaldo_tradingTerm[$x],
							'SecLogDate' => date('Y-m-d H:i:s'),
							'SecLogUser' => $this->session->userdata('full_name')
						);

						array_push($budget_tradingArray, $tradingTerm_budget);
					}

					$this->Promotion_header_model->update_budget_tradingTerm($budget_tradingArray, $fiscal_year);
				}
			}

			/*
			 FINANCIAL KPI - Update Sales - HET 
			 */

			$salesHet_baseline = array_sum($baseline_sales);
			$salesHet_incremental = array_sum($incremental_sales);
			$salesHet_total = $salesHet_baseline + $salesHet_incremental;

			$data_salesHet = array(
				'baseline' => $salesHet_baseline,
				'incremental' => $salesHet_incremental,
				'total' => $salesHet_total
			);

			$this->Promotion_header_model->update_salesHet($promotion_number, $data_salesHet);

			/* 
			FINANCIAL KPI - Update Distributor/Store Margin 
			*/

			$row_margin = $this->Promotion_header_model->get_margin($kode_departemen, $store_code, $channel_code, $region_code);
			$margin = $row_margin->margin;
			if ($margin != null) {
				$margin_baseline = ($salesHet_baseline * $margin) / 100;
				$margin_incremental = ($salesHet_incremental * $margin) / 100;
				$margin_total = $margin_baseline + $margin_incremental;
				//baseline
				if ($salesHet_baseline != 0) {
					$margin_baselineHet = ($margin_baseline / $salesHet_baseline) * 100;
				} else {
					$margin_baselineHet = 0;
				}
				//incremental
				if ($salesHet_incremental != 0) {
					$margin_incrementalHet = ($margin_incremental / $salesHet_incremental) * 100;
				} else {
					$margin_incrementalHet = 0;
				}
				//total
				if ($salesHet_total != 0) {
					$margin_totalHet = ($margin_total / $salesHet_total) * 100;
				} else {
					$margin_totalHet = 0;
				}

				$data_margin = array(
					'baseline' => $margin_baseline,
					'baseline_het' => $margin_baselineHet,
					'incremental' => $margin_incremental,
					'incremental_het' => $margin_incrementalHet,
					'total' => $margin_total,
					'total_het' => $margin_totalHet
				);

				$this->Promotion_header_model->update_margin($promotion_number, $data_margin);
			}

			/* 
			FINANCIAL KPI - Update Net Amount 
			*/

			if ($margin != null) {
				$netAmount_baseline = $salesHet_baseline - $margin_baseline;
				$netAmount_incremental = $salesHet_incremental - $margin_incremental;
				$netAmount_total = $salesHet_total - $margin_total;
			} else {
				$margin_baseline_null = 0;
				$margin_incremental_null = 0;
				$margin_total_null = 0;
				$netAmount_baseline = $salesHet_baseline - $margin_baseline_null;
				$netAmount_incremental = $salesHet_incremental - $margin_incremental_null;
				$netAmount_total = $salesHet_total - $margin_total_null;
			}
			//baseline
			if ($salesHet_baseline != 0) {
				$netAmount_baselineHet = ($netAmount_baseline / $salesHet_baseline) * 100;
			} else {
				$netAmount_baselineHet = 0;
			}
			//incremental
			if ($salesHet_incremental != 0) {
				$netAmount_incrementalHet = ($netAmount_incremental / $salesHet_incremental) * 100;
			} else {
				$netAmount_incrementalHet = 0;
			}
			//total
			if ($salesHet_total != 0) {
				$netAmount_totalHet = ($netAmount_total / $salesHet_total) * 100;
			} else {
				$netAmount_totalHet = 0;
			}
			$data_netAmount = array(
				'baseline' => $netAmount_baseline,
				'baseline_het' => $netAmount_baselineHet,
				'incremental' => $netAmount_incremental,
				'incremental_het' => $netAmount_incrementalHet,
				'total' => $netAmount_total,
				'total_het' => $netAmount_totalHet
			);

			$this->Promotion_header_model->update_netAmount($promotion_number, $data_netAmount);

			/* 
			FINANCIAL KPI - Update Trading Term
			*/

			$row_trading_term = $this->Promotion_header_model->get_trading_term($kode_departemen, $store_code, $channel_code);
			$margin_trading_term = number_format($row_trading_term->trading_term, 2);

			if ($margin_trading_term != 0) {
				$tradingTerm_baseline = ($margin_trading_term * $salesHet_baseline) / 100;
				$tradingTerm_incremental = ($margin_trading_term * $salesHet_incremental) / 100;
				$tradingTerm_total = $tradingTerm_baseline + $tradingTerm_incremental;
			} else {
				$margin_null = 0;
				$tradingTerm_baseline = ($margin_null * $salesHet_baseline) / 100;
				$tradingTerm_incremental = ($margin_null * $salesHet_incremental) / 100;
				$tradingTerm_total = $tradingTerm_baseline + $tradingTerm_incremental;
			}
			//baseline
			if ($salesHet_baseline != 0) {
				$tradingTerm_baselineHet = ($tradingTerm_baseline / $salesHet_baseline) * 100;
			} else {
				$tradingTerm_baselineHet = 0;
			}
			//incremental
			if ($salesHet_incremental != 0) {
				$tradingTerm_incrementalHet = ($tradingTerm_incremental / $salesHet_incremental) * 100;
			} else {
				$tradingTerm_incrementalHet = 0;
			}
			//total
			if ($salesHet_total != 0) {
				$tradingTerm_totalHet = ($tradingTerm_total / $salesHet_total) * 100;
			} else {
				$tradingTerm_totalHet = 0;
			}
			$data_tradingTerm = array(
				'baseline' => $tradingTerm_baseline,
				'baseline_het' => $tradingTerm_baselineHet,
				'incremental' => $tradingTerm_incremental,
				'incremental_het' => $tradingTerm_incrementalHet,
				'total' => $tradingTerm_total,
				'total_het' => $tradingTerm_totalHet
			);

			$this->Promotion_header_model->update_tradingTerm($promotion_number, $data_tradingTerm);

			/* 
			FINANCIAL KPI - Update Listing
			*/

			$listing_incremental = array_sum($listing_amount);
			$listing_total = $listing_incremental;
			//incremental
			if ($salesHet_incremental != 0) {
				$listing_incrementalHet = ($listing_incremental / $salesHet_incremental) * 100;
			} else {
				$listing_incrementalHet = 0;
			}
			//total
			if ($salesHet_total != 0) {
				$listing_totalHet = ($listing_total / $salesHet_total) * 100;
			} else {
				$listing_totalHet = 0;
			}
			$data_listing = array(
				'incremental' => $listing_incremental,
				'incremental_het' => $listing_incrementalHet,
				'total' => $listing_total,
				'total_het' => $listing_totalHet
			);

			$this->Promotion_header_model->update_listing($promotion_number, $data_listing);

			/* 
			FINANCIAL KPI - Update On Top Promo 
			*/

			$promo_incremental = array_sum($promo_amount);
			$promo_total = $promo_incremental;
			//incremental
			if ($salesHet_incremental != 0) {
				$promo_incrementalHet = ($promo_incremental / $salesHet_incremental) * 100;
			} else {
				$promo_incrementalHet = 0;
			}
			//total
			if ($salesHet_total != 0) {
				$promo_totalHet = ($promo_total / $salesHet_total) * 100;
			} else {
				$promo_totalHet = 0;
			}
			$data_promo = array(
				'incremental' => $promo_incremental,
				'incremental_het' => $promo_incrementalHet,
				'total' => $promo_total,
				'total_het' => $promo_totalHet
			);

			$this->Promotion_header_model->update_onTopPromo($promotion_number, $data_promo);

			/* 
			FINANCIAL KPI -  Update Cost 
			*/

			$cost_baseline = $tradingTerm_baseline;
			$cost_incremental = $tradingTerm_incremental + $listing_incremental + $promo_incremental;
			$cost_total = $tradingTerm_total + $listing_total + $promo_total;
			//baseline
			if ($salesHet_baseline != 0) {
				$cost_baselineHet = ($cost_baseline / $salesHet_baseline) * 100;
			} else {
				$cost_baselineHet = 0;
			}
			//incremental
			if ($salesHet_incremental != 0) {
				$cost_incrementalHet = ($cost_incremental / $salesHet_incremental) * 100;
			} else {
				$cost_incrementalHet = 0;
			}
			//total
			if ($salesHet_total != 0) {
				$cost_totalHet = ($cost_total / $salesHet_total) * 100;
			} else {
				$cost_totalHet = 0;
			}
			$data_cost = array(
				'baseline' => $cost_baseline,
				'baseline_het' => $cost_baselineHet,
				'incremental' => $cost_incremental,
				'incremental_het' => $cost_incrementalHet,
				'total' => $cost_total,
				'total_het' => $cost_totalHet
			);

			$this->Promotion_header_model->update_cost($promotion_number, $data_cost);

			/* 
			FINANCIAL KPI - Update Net Sales 
			 */

			$netSales_baseline = $netAmount_baseline - $cost_baseline;
			$netSales_incremental = $netAmount_incremental - $cost_incremental;
			$netSales_total = $netAmount_total - $cost_total;
			//baseline
			if ($salesHet_baseline != 0) {
				$netSales_baselineHet = ($netSales_baseline / $salesHet_baseline) * 100;
			} else {
				$netSales_baselineHet = 0;
			}
			//incremental
			if ($salesHet_incremental != 0) {
				$netSales_incrementalHet = ($netSales_incremental / $salesHet_incremental) * 100;
			} else {
				$netSales_incrementalHet = 0;
			}
			//total
			if ($salesHet_total != 0) {
				$netSales_totalHet = ($netSales_total / $salesHet_total) * 100;
			} else {
				$netSales_totalHet = 0;
			}
			$data_netSales = array(
				'baseline' => $netSales_baseline,
				'baseline_het' => $netSales_baselineHet,
				'incremental' => $netSales_incremental,
				'incremental_het' => $netSales_incrementalHet,
				'total' => $netSales_total,
				'total_het' => $netSales_totalHet
			);

			$this->Promotion_header_model->update_netSales($promotion_number, $data_netSales);


			/* Total Promotion Form*/

			$total_product_baseline = array_sum($baseline_sales);
			$total_product_incremental = array_sum($incremental_sales);
			$total_listing_cost = array_sum($listing_amount);
			$total_on_top_promo = array_sum($promo_amount);
			$total_trading_term = array_sum($trading_amount);

			$total = array(
				'total_product_baseline' => $total_product_baseline,
				'total_product_incremental' => $total_product_incremental,
				'total_listing_cost' => $total_listing_cost,
				'total_on_top_promo' => $total_on_top_promo,
				'total_trading_term' => $total_trading_term
			);

			$this->Promotion_header_model->update_total($promotion_number, $total);

			// Insert Approval Program
			$this->insertApprovalProgram($promotion_number, $kode_departemen, $channel_code, $store_code, $region_code, $total_listing_cost, $total_on_top_promo);

			/* Form Promotion Budget */
			$row_id = $this->Promotion_header_model->get_id($promotion_number);
			$promotion_id = $row_id->promotion_id;
			$promotion_total_cost = $total_listing_cost + $total_on_top_promo + $total_trading_term;

			$total_promotion = array(
				'promotion_number' => $promotion_number,
				'promotion_id' => $promotion_id,
				'promotion_total_cost' => $promotion_total_cost,
				'promotion_total_usage' => 0,
				'promotion_total_saldo' => $promotion_total_cost,
				'status' => 0,
				'SecLogUser' => $this->session->userdata('full_name'),
				'SecLogDate' => date('Y-m-d H:i:s')
			);

			$this->Promotion_header_model->insert_total_promotion($total_promotion);

			//Insert Distributor List
			if ($kode_distributor != NULL || $kode_distributor != '') {
				$distributorArray = array();
				$index8 = 0;
				foreach ($kode_distributor as $data_distributor) {
					$add_data = array(
						'kode_distributor' => $data_distributor,
						'promotion_number' => $promotion_number,
						'SecLogDate' => date('Y-m-d H:i:s'),
						'SecLogUser' => $this->session->userdata('full_name')
					);
					array_push($distributorArray, $add_data);
					$index8++;
				}
				$this->Promotion_header_model->insert_distributor($distributorArray);
			}

			$this->send($promotion_number);

			$this->session->set_flashdata('message', 'Create Record Success 2');
			redirect(site_url('promotion_form/read/' . $promotion_id . ''));
		}
	}

	public function insertPromotionForm($promotion_number)
	{
		/* PROMOTION FORM */

		//upload file
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls|xlsx|pdf';
		$config['max_size']	= 200000;
		$config['max_width']  = 1024;
		$config['max_height']  = 768;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$upload = 'upload_file';
		if (!$this->upload->do_upload($upload)) {
			$error = $this->upload->display_errors();
			$this->session->set_flashdata("message", "<div class='alert bg-danger' role='alert'>
		 	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		 	    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>  " . $error . "  </div>");
			$data_file = array('file_name' => "");
		} else {
			$data_file = $this->upload->data();
		}

		$upload_activity = 'upload_activity';
		if (!$this->upload->do_upload($upload_activity)) {
			$error = $this->upload->display_errors();
			$this->session->set_flashdata("message", "<div class='alert bg-danger' role='alert'>
					  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					  <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>  " . $error . "  </div>");
			$data_activity = array('file_name' => "");
		} else {
			$data_activity = $this->upload->data();
		}

		$data = array(
			'kode_perusahaan' => '01',
			'date_create' => $this->input->post('date_create', TRUE),
			'promotion_number' => $promotion_number,
			'kode_departemen' => $this->input->post('kode_departemen', TRUE),
			'promotion_name' => $this->input->post('promotion_name', TRUE),
			'periode_awal' => $this->input->post('periode_awal', TRUE),
			'periode_akhir' => $this->input->post('periode_akhir', TRUE),
			'fiscal_year' => $this->input->post('fiscal_year', TRUE),
			'channel_code' => $this->input->post('channel_code', TRUE),
			'region_code' => $this->input->post('region_code', TRUE),
			'kode_area' => $this->input->post('kode_area', TRUE),
			'store_code' => $this->input->post('store_code', TRUE),
			'sales_background' => $this->input->post('sales_background', TRUE),
			'sales_strategy' => $this->input->post('sales_strategy', TRUE),
			'sales_objective' => $this->input->post('sales_objective', TRUE),
			'sales_mechanism' => $this->input->post('sales_mechanism', TRUE),
			'status' => 0,
			'approval_scheme' => 1,
			'pemohon' => $this->session->userdata('full_name'),
			'upload_file' => $data_file['file_name'],
			'upload_activity' => $data_activity['file_name'],
			'SecLogUser' => $this->session->userdata('full_name'),
			'SecLogDate' => date('Y-m-d H:i:s'),
		);

		$this->Promotion_header_model->insert($data);
	}

	public function insertFinancialKpi($promotion_number)
	{
		/* Financial KPI  */

		$row = $this->Promotion_header_model->financial_desc();
		$SecLogDate = date('Y-m-d H:i:s');
		$SecLogUser = $this->session->userdata('full_name');
		$insertArray = array();

		foreach ($row as $data_program) {
			$new_add = array(
				'promotion_number' => $promotion_number,
				'description' => $data_program['financial_name'],
				'SecLogDate' => $SecLogDate,
				'SecLogUser' => $SecLogUser
			);

			array_push($insertArray, $new_add);
		}
		$this->Promotion_header_model->insert_financial_kpi($insertArray);
	}

	public function insertApprovalProgram($promotion_number, $kode_departemen, $channel_code, $store_code, $region_code, $total_listing_cost, $total_on_top_promo)
	{
		/* APPROVAL PROGRAM */

		$total_budget = $total_listing_cost + $total_on_top_promo;
		// $row_approval = $this->Promotion_header_model->get_approval($kode_departemen, $channel_code, $store_code, $region_code, $total_budget, $total_on_top_promo);
		// $row = $this->Promotion_header_model->get_list_approval();
		if ($kode_departemen == '0312') {
			$row_approval = $this->Promotion_header_model->get_approval_ka($kode_departemen, $channel_code, $store_code, $total_on_top_promo, $total_budget);
		} elseif ($kode_departemen == '0305') {
			$row_approval = $this->Promotion_header_model->get_approval_tm($kode_departemen, $channel_code, $region_code, $store_code, $total_budget);
		} else {
			$row_approval = $this->Promotion_header_model->get_approval_ec($kode_departemen, $channel_code, $total_budget);
		}

		$SecLogDate = date('Y-m-d H:i:s');
		$SecLogUser = $this->session->userdata('full_name');

		$insertArray = array();

		$index = 1;
		$index2 = 0;
		foreach ($row_approval as $data_program) {
			$new_add = array(
				'promotion_number' => $promotion_number,
				'kode_departemen' => $kode_departemen,
				'channel_code' => $channel_code,
				'store_code' => $store_code,
				'region_code' => $region_code,
				'approval_scheme' => $index,
				'id_user_level' => $data_program['id_user_level'],
				'id_users' => $data_program['id_users'],
				'approve_by' => NULL,
				'approval_date' => NULL,
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' =>  $this->session->userdata('full_name')
			);

			array_push($insertArray, $new_add);
			$index++;
			$index2++;
		}

		$this->Promotion_header_model->insert_wf_program($insertArray);
	}

	/* 
	//-- UPDATE --// 
	*/
	public function update($id)
	{
		$row = $this->Promotion_header_model->get_by_id($id);
		$kode_departemen = $this->session->userdata('kode_departemen');
		$row_departemen = $this->Promotion_header_model->get_departemen($kode_departemen);
		$row_product = $this->Promotion_header_model->get_product($row->promotion_number);
		$row_onTopPromo = $this->Promotion_header_model->get_on_top_promo($row->promotion_number);
		$row_listingCost = $this->Promotion_header_model->get_listing_cost($row->promotion_number);
		$row_tradingTerm = $this->Promotion_header_model->get_trading($row->promotion_number);
		$row_distributor = $this->Promotion_header_model->get_list_distributor($row->promotion_number);
		$row_listProduct = $this->Promotion_header_model->get_listProduct();
		$row_listCategory = $this->Promotion_header_model->get_listCategory();
		if ($row->channel_code == '001' || $row->channel_code == '004') {
			$gl_coa_segment = "01" . "-" . $row->kode_departemen . "-" . $row->channel_code . "-" . $row->store_code;
		} else {
			$gl_coa_segment = "01" . "-" . $row->kode_departemen . "-" . $row->channel_code . "-" . $row->region_code;
		}
		$row_listBudget = $this->Promotion_header_model->get_listBudget($gl_coa_segment);
		if ($row) {
			$data = array(
				'button' => 'Create',
				'action' => site_url('promotion_form/update_action'),
				'promotion_id' => set_value('promotion_id', $row->promotion_id),
				'kode_perusahaan' => set_value('kode_perusahaan', $row->kode_perusahaan),
				'date_create' => set_value('date_create', $row->date_create),
				'promotion_number' => set_value('promotion_number', $row->promotion_number),
				'kode_departemen' => set_value('kode_departemen', $row->kode_departemen),
				'promotion_name' => set_value('promotion_name', $row->promotion_name),
				'periode_awal' => set_value('periode_awal', $row->periode_awal),
				'periode_akhir' => set_value('periode_akhir', $row->periode_akhir),
				'fiscal_year' => set_value('fiscal_year', $row->fiscal_year),
				'channel_code' => set_value('channel_code', $row->channel_code),
				'channel_name' => set_value('channel_name', $row->channel_name),
				'region_code' => set_value('region_code', $row->region_code),
				'region_name' => set_value('region_name', $row->nama_region),
				'kode_area' => set_value('kode_area', $row->kode_area),
				'nama_area' => set_value('nama_area', $row->nama_area),
				'store_code' => set_value('store_code', $row->store_code),
				'store_name' => set_value('store_name', $row->store_name),
				'sales_background' => set_value('sales_background', $row->sales_background),
				'sales_strategy' => set_value('sales_strategy', $row->sales_strategy),
				'sales_objective' => set_value('sales_objective', $row->sales_objective),
				'sales_mechanism' => set_value('sales_mechanism', $row->sales_mechanism),
				'status' => set_value('status', $row->status),
				'pemohon' => set_value('pemohon', $row->pemohon),
				'row_departemen' => $row_departemen,
				'row_product' => $row_product,
				'total_product_baseline' => set_value('total_product_baseline', $row->total_product_baseline),
				'total_product_incremental' => set_value('total_product_incremental', $row->total_product_incremental),
				'total_listing_cost' => set_value('total_listing_cost', $row->total_listing_cost),
				'total_on_top_promo' => set_value('total_on_top_promo', $row->total_on_top_promo),
				'approval_scheme' => set_value('approval_scheme', $row->approval_scheme),
				'upload_file' => set_value('upload_file', $row->upload_file),
				'upload_activity' => set_value('upload_activity', $row->upload_activity),
				'nama_departemen' => set_value('nama_departemen', $row->nama_departemen),
				'status_name' => set_value('status_name', $row->status_name),
				'row_onTopPromo' => $row_onTopPromo,
				'row_listingCost' => $row_listingCost,
				'row_tradingTerm' => $row_tradingTerm,
				'product_code' => set_value('product_code'),
				'product_name' => set_value('product_name'),
				'category_id' => set_value('category_id'),
				'listing_activity_id' => set_value('listing_activity_id'),
				'promo_gl_coa' => set_value('promo_gl_coa'),
				'listing_gl_coa' => set_value('listing_gl_coa'),
				'promo_activity_id' => set_value('promo_activity_id'),
				'baseline_sales' => set_value('baseline_sales'),
				'incremental_sales' => set_value('incremental_sales'),
				'listing_amount' => set_value('listing_amount'),
				'listing_percent' => set_value('listing_percent'),
				'listing_source_of_fund' => set_value('listing_source_of_fund'),
				'listing_remarks' => set_value('listing_remarks'),
				'promo_amount' => set_value('promo_amount'),
				'promo_percent' => set_value('promo_percent'),
				'promo_source_of_fund' => set_value('promo_source_of_fund'),
				'promo_remarks' => set_value('promo_remarks'),
				'trading_activity_id' => set_value('trading_activity_id'),
				'trading_amount' => set_value('trading_amount'),
				'percent_incremental_sales' => set_value('percent_incremental_sales'),
				'trading_account_code' => set_value('trading_account_code'),
				'row_distributor' => $row_distributor,
				'row_listProduct' => $row_listProduct,
				'row_listCategory' => $row_listCategory,
				'row_listBudget' => $row_listBudget,
			);
			$this->template->load('template', 'promotion_header/promotion_header_update', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('promotion_form'));
		}
	}

	/* // UPDATE ACTION */
	public function update_action()
	{
		//Promotion
		$promotion_id = $this->input->post('promotion_id', TRUE);
		$row_promotion = $this->Promotion_header_model->get_by_id($promotion_id);
		$promotion_number = $row_promotion->promotion_number;
		$kode_departemen = $row_promotion->kode_departemen;
		$channel_code = $row_promotion->channel_code;
		$region_code = $row_promotion->region_code;
		$store_code = $row_promotion->store_code;
		$kode_distributor = $this->input->post('kode_distributor', TRUE);
		if ($row_promotion->channel_code == '001' || $row_promotion->channel_code == '004') {
			$gl_coa_segment = "01" . "-" . $row_promotion->kode_departemen . "-" . $row_promotion->channel_code . "-" . $row_promotion->store_code;
		} else {
			$gl_coa_segment = "01" . "-" . $row_promotion->kode_departemen . "-" . $row_promotion->channel_code . "-" . $row_promotion->region_code;
		}
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
		$config['max_size']    = 20000;
		$config['max_width']  = 1024;
		$config['max_height']  = 768;
		$config['file_name'] = str_replace('%', '', $_FILES["upload_file"]['name']);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$upload_file = 'upload_file';
		if (!$this->upload->do_upload($upload_file)) {
			$data_file = array('file_name' => $row_promotion->upload_file);
		} else {
			$data_file = $this->upload->data();
		}

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
		$config['max_size']    = 20000;
		$config['max_width']  = 1024;
		$config['max_height']  = 768;
		$config['file_name'] = str_replace('%', '', $_FILES["upload_activity"]['name']);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$upload_activity = 'upload_activity';
		if (!$this->upload->do_upload($upload_activity)) {
			$data_activity = array('file_name' => $row_promotion->upload_activity);
		} else {
			$data_activity = $this->upload->data();
		}

		$data_promotion = array(
			'promotion_name' => $this->input->post('promotion_name', TRUE),
			'periode_awal' => $this->input->post('periode_awal', TRUE),
			'periode_akhir' => $this->input->post('periode_akhir', TRUE),
			'upload_file' => $data_file['file_name'],
			'upload_activity' => $data_activity['file_name'],
			'sales_background' => $this->input->post('sales_background', TRUE),
			'sales_strategy' => $this->input->post('sales_strategy', TRUE),
			'sales_objective' => $this->input->post('sales_objective', TRUE),
			'sales_mechanism' => $this->input->post('sales_mechanism', TRUE),
		);

		$this->Promotion_header_model->promotion_update($data_promotion, $promotion_id);

		//update Distributor List
		$this->Promotion_header_model->delete_listDistributor($promotion_number);

		$distributorArray = array();
		$index8 = 0;
		foreach ($kode_distributor as $data_distributor) {
			$add_data = array(
				'kode_distributor' => $data_distributor,
				'promotion_number' => $promotion_number,
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name')
			);
			array_push($distributorArray, $add_data);
			$index8++;
		}
		$this->Promotion_header_model->insert_distributor($distributorArray);


		//Product
		$this->Promotion_header_model->delete_listProduct($promotion_number);

		$product_name = $this->input->post('product_name', TRUE);
		$category_1 = $this->input->post('category_1', TRUE);
		$category_2 = $this->input->post('category_2', TRUE);
		$baseline_sales = str_replace(".", "", $this->input->post('baseline_sales', TRUE));
		$incremental_sales = str_replace(".", "", $this->input->post('incremental_sales', TRUE));

		if (array_filter($product_name) && array_filter($category_1) && array_filter($category_2)) {
			$productArray = array();

		$index = 0;
		foreach ($product_name as $data_product) {
			$add_data = array(
				'product_code' => $data_product,
				'promotion_number' => $promotion_number,
				'category_1' => $category_1[$index],
				'category_2' => $category_2[$index],
				'baseline_sales' => $baseline_sales[$index],
				'incremental_sales' => $incremental_sales[$index],
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name')
			);
			array_push($productArray, $add_data);
			$index++;
		}
		$this->Promotion_header_model->insert_product($productArray);
		} else {
			$baseline_sales = array('0');
			$incremental_sales = array('0');
		}

		/*
			TRADING TERM 
		*/

		$trading_activity = $this->input->post('trading_activity', TRUE);
		$trading_account_code = $this->input->post('trading_account_code', TRUE);
		$trading_amount = str_replace(".", "", $this->input->post('trading_amount', TRUE));
		$trading_percent_incremental_sales = $this->input->post('percent_incremental_sales', TRUE);

		$tradingActivity = array_filter($trading_activity);
		$tradingAccountCode = array_filter($trading_account_code);
		$tradingAmount = array_filter($trading_amount);

		if ($tradingActivity != NULL && $tradingAccountCode != NULL && $tradingAmount != NULL) {
			$tradingArray = array();
			$additionalTrading = array();

			$index5 = 0;
			foreach ($trading_activity as $data_trading) {
				$add_data = array(
					'trading_activity_name' => $data_trading,
					'promotion_number' => $promotion_number,
					'gl_coa_segment' => $gl_coa_segment . "-" . $trading_account_code[$index5],
					'gl_account_code' => $trading_account_code[$index5],
					'amount' => $trading_amount[$index5],
					'incremental_sales' => $trading_percent_incremental_sales[$index5],
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name')
				);

				$add_additionalTrading = array(
					'promotion_number' => $promotion_number,
					'date_create' => date('Y-m-d H:i:s'),
					'budget' => "Trading Term",
					'gl_coa_segment' => $gl_coa_segment . "-" . $trading_account_code[$index5],
					'additional_amount' => $trading_amount[$index5],
					'status' => 0,
					'approval_scheme' => 1,
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name')
				);

				array_push($tradingArray, $add_data);
				array_push($additionalTrading, $add_additionalTrading);
				$index5++;
			}

			$this->Promotion_header_model->insert_trading($tradingArray);
			$this->Promotion_header_model->insert_additionalTrading($additionalTrading);
		}

		/*
			LISTING COST 
		*/

		$listing_activity = $this->input->post('listing_activity');
		$listing_account_code = $this->input->post('listing_account_code');
		$listing_amount = str_replace(".", "", $this->input->post('listing_amount'));
		$listing_source_of_fund = $this->input->post('listing_source_of_fund');
		$listing_remarks = $this->input->post('listing_remarks');

		$listingActivity = array_filter($listing_activity);
		$listingAccountCode = array_filter($listing_account_code);
		$listingAmount = array_filter($listing_amount);

		if ($listingActivity != NULL) {
			$lenght = count($listing_activity);
			for ($x = 0; $x < $lenght; $x++) {
				$listing_percent_incremental_sales[$x] = (is_numeric($listing_amount[$x]) / is_numeric(array_sum($incremental_sales))) * 100;
			}
		}
		if ($listingActivity != NULL && $listingAccountCode != NULL && $listingAmount != NULL) {
			$listingArray = array();
			$additionalListing = array();

			$index1 = 0;
			foreach ($listing_activity as $data_listing) {
				$add_data = array(
					'listing_activity' => $data_listing,
					'promotion_number' => $promotion_number,
					'gl_coa_segment' => $gl_coa_segment . "-" . $listing_account_code[$index1],
					'gl_account_code' => $listing_account_code[$index1],
					'amount' => $listing_amount[$index1],
					'incremental_sales' => $listing_percent_incremental_sales[$index1],
					'source_fund' => $listing_source_of_fund[$index1],
					'remark' => $listing_remarks[$index1],
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name')
				);

				$add_additionalListing = array(
					'promotion_number' => $promotion_number,
					'date_create' => date('Y-m-d H:i:s'),
					'budget' => "Listing Cost",
					'gl_coa_segment' => $gl_coa_segment . "-" . $listing_account_code[$index1],
					'additional_amount' => $listing_amount[$index1],
					'status' => 0,
					'approval_scheme' => 1,
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name')
				);

				array_push($listingArray, $add_data);
				array_push($additionalListing, $add_additionalListing);
				$index1++;
			}
			$this->Promotion_header_model->insert_listing($listingArray);
			$this->Promotion_header_model->insert_additionalListing($additionalListing);
		}

		/*
			ON TOP PROMO 
		*/

		$promo_activity = $this->input->post('promo_activity', TRUE);
		$promo_account_code = $this->input->post('promo_account_code', TRUE);
		$promo_amount = str_replace(".", "", $this->input->post('promo_amount', TRUE));
		$promo_source_of_fund = $this->input->post('promo_source_of_fund', TRUE);
		$promo_remarks = $this->input->post('promo_remarks', TRUE);

		$promoActivity = array_filter($promo_activity);
		$promoAccountCode = array_filter($promo_account_code);
		$promoAmount = array_filter($promo_amount);

		if ($promoActivity != NULL) {
			$lenght = count($promo_activity);
			for ($x = 0; $x < $lenght; $x++) {
				$promo_percent_incremental_sales[$x] = (is_numeric($promo_amount[$x]) / is_numeric(array_sum($incremental_sales))) * 100;
			}
		}
		if ($promoActivity != NULL && $promoAccountCode != NULL && $promoAmount != NULL) {
			$promoArray = array();
			$additionalPromo = array();

			$index2 = 0;
			foreach ($promo_activity as $data_promo) {
				$add_data = array(
					'promo_activity_name' => $data_promo,
					'promotion_number' => $promotion_number,
					'gl_coa_segment' => $gl_coa_segment . "-" . $promo_account_code[$index2],
					'gl_account_code' => $promo_account_code[$index2],
					'amount' => $promo_amount[$index2],
					'incremental_sales' => $promo_percent_incremental_sales[$index2],
					'source_fund' => $promo_source_of_fund[$index2],
					'remark' => $promo_remarks[$index2],
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name')
				);

				$add_additionalPromo = array(
					'promotion_number' => $promotion_number,
					'date_create' => date('Y-m-d H:i:s'),
					'budget' => "On Top Promo",
					'gl_coa_segment' => $gl_coa_segment . "-" . $promo_account_code[$index2],
					'additional_amount' => $promo_amount[$index2],
					'status' => 0,
					'approval_scheme' => 1,
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name')
				);

				array_push($promoArray, $add_data);
				array_push($additionalPromo, $add_additionalPromo);
				$index2++;
			}

			$this->Promotion_header_model->insert_promo($promoArray);
			$this->Promotion_header_model->insert_additionalPromo($additionalPromo);
		}

		/* Total Promotion Form*/

		$row_total_listing_cost = $row_promotion->total_listing_cost;
		$row_total_on_top_promo = $row_promotion->total_on_top_promo;
		$row_total_trading_term = $row_promotion->total_trading_term;

		$row_product = $this->Promotion_header_model->get_totalProduct($promotion_number);

		$total_product_baseline = $row_product->baseline_sales;
		$total_product_incremental = $row_product->incremental_sales;
		if (is_null($listingActivity) == false) {
			$total_listingAmount = array_sum($listing_amount);
			$total_listing_cost = $total_listingAmount + $row_total_listing_cost;
		} else {
			$total_listing_cost = $row_total_listing_cost;
		}
		if (is_null($promoActivity) == false) {
			$total_onTopPromoAmount = array_sum($promo_amount);
			$total_on_top_promo = $total_onTopPromoAmount + $row_total_on_top_promo;
		} else {
			$total_on_top_promo = $row_total_on_top_promo;
		}
		if (is_null($tradingActivity) == false) {
			$total_tradingTermAmount = array_sum($trading_amount);
			$total_trading_term = $total_tradingTermAmount + $row_total_trading_term;
		} else {
			$total_trading_term = $row_total_trading_term;
		}

		$total = array(
			'total_product_baseline' => $total_product_baseline,
			'total_product_incremental' => $total_product_incremental,
			'total_listing_cost' => $total_listing_cost,
			'total_on_top_promo' => $total_on_top_promo,
			'total_trading_term' => $total_trading_term
		);

		$this->Promotion_header_model->update_total($promotion_number, $total);

		/*
        FINANCIAL KPI - Update Sales - HET 
        */

		$salesHet_baseline = $row_product->baseline_sales;
		$salesHet_incremental = $row_product->incremental_sales;
		$salesHet_total = $salesHet_baseline + $salesHet_incremental;

		$data_salesHet = array(
			'baseline' => $salesHet_baseline,
			'incremental' => $salesHet_incremental,
			'total' => $salesHet_total
		);

		$this->Promotion_header_model->update_salesHet($promotion_number, $data_salesHet);

		/* 
        FINANCIAL KPI - Update Distributor/Store Margin 
        */

		$row_margin = $this->Promotion_header_model->get_margin($kode_departemen, $store_code, $channel_code, $region_code);
		$margin = $row_margin->margin;
		if ($margin != null) {
			$margin_baseline = ($salesHet_baseline * $margin) / 100;
			$margin_incremental = ($salesHet_incremental * $margin) / 100;
			$margin_total = $margin_baseline + $margin_incremental;
			//baseline
			if ($salesHet_baseline != 0) {
				$margin_baselineHet = ($margin_baseline / $salesHet_baseline) * 100;
			} else {
				$margin_baselineHet = 0;
			}
			//incremental
			if ($salesHet_incremental != 0) {
				$margin_incrementalHet = ($margin_incremental / $salesHet_incremental) * 100;
			} else {
				$margin_incrementalHet = 0;
			}
			//total
			if ($salesHet_total != 0) {
				$margin_totalHet = ($margin_total / $salesHet_total) * 100;
			} else {
				$margin_totalHet = 0;
			}

			$data_margin = array(
				'baseline' => $margin_baseline,
				'baseline_het' => $margin_baselineHet,
				'incremental' => $margin_incremental,
				'incremental_het' => $margin_incrementalHet,
				'total' => $margin_total,
				'total_het' => $margin_totalHet
			);

			$this->Promotion_header_model->update_margin($promotion_number, $data_margin);
		}

		/* 
          FINANCIAL KPI - Update Net Amount 
          */

		if ($margin != null) {
			$netAmount_baseline = $salesHet_baseline - $margin_baseline;
			$netAmount_incremental = $salesHet_incremental - $margin_incremental;
			$netAmount_total = $salesHet_total - $margin_total;
		} else {
			$margin_baseline_null = 0;
			$margin_incremental_null = 0;
			$margin_total_null = 0;
			$netAmount_baseline = $salesHet_baseline - $margin_baseline_null;
			$netAmount_incremental = $salesHet_incremental - $margin_incremental_null;
			$netAmount_total = $salesHet_total - $margin_total_null;
		}
		//baseline
		if ($salesHet_baseline != 0) {
			$netAmount_baselineHet = ($netAmount_baseline / $salesHet_baseline) * 100;
		} else {
			$netAmount_baselineHet = 0;
		}
		//incremental
		if ($salesHet_incremental != 0) {
			$netAmount_incrementalHet = ($netAmount_incremental / $salesHet_incremental) * 100;
		} else {
			$netAmount_incrementalHet = 0;
		}
		//total
		if ($salesHet_total != 0) {
			$netAmount_totalHet = ($netAmount_total / $salesHet_total) * 100;
		} else {
			$netAmount_totalHet = 0;
		}
		$data_netAmount = array(
			'baseline' => $netAmount_baseline,
			'baseline_het' => $netAmount_baselineHet,
			'incremental' => $netAmount_incremental,
			'incremental_het' => $netAmount_incrementalHet,
			'total' => $netAmount_total,
			'total_het' => $netAmount_totalHet
		);

		$this->Promotion_header_model->update_netAmount($promotion_number, $data_netAmount);

		/* 
          FINANCIAL KPI - Update Trading Term
          */

		$row_trading_term = $this->Promotion_header_model->get_trading_term($kode_departemen, $store_code, $channel_code);
		$margin_trading_term = number_format($row_trading_term->trading_term, 2);

		if ($margin_trading_term != 0) {
			$tradingTerm_baseline = ($margin_trading_term * $salesHet_baseline) / 100;
			$tradingTerm_incremental = ($margin_trading_term * $salesHet_incremental) / 100;
			$tradingTerm_total = $tradingTerm_baseline + $tradingTerm_incremental;
		} else {
			$margin_null = 0;
			$tradingTerm_baseline = ($margin_null * $salesHet_baseline) / 100;
			$tradingTerm_incremental = ($margin_null * $salesHet_incremental) / 100;
			$tradingTerm_total = $tradingTerm_baseline + $tradingTerm_incremental;
		}
		//baseline
		if ($salesHet_baseline != 0) {
			$tradingTerm_baselineHet = ($tradingTerm_baseline / $salesHet_baseline) * 100;
		} else {
			$tradingTerm_baselineHet = 0;
		}
		//incremental
		if ($salesHet_incremental != 0) {
			$tradingTerm_incrementalHet = ($tradingTerm_incremental / $salesHet_incremental) * 100;
		} else {
			$tradingTerm_incrementalHet = 0;
		}
		//total
		if ($salesHet_total != 0) {
			$tradingTerm_totalHet = ($tradingTerm_total / $salesHet_total) * 100;
		} else {
			$tradingTerm_totalHet = 0;
		}
		$data_tradingTerm = array(
			'baseline' => $tradingTerm_baseline,
			'baseline_het' => $tradingTerm_baselineHet,
			'incremental' => $tradingTerm_incremental,
			'incremental_het' => $tradingTerm_incrementalHet,
			'total' => $tradingTerm_total,
			'total_het' => $tradingTerm_totalHet
		);

		$this->Promotion_header_model->update_tradingTerm($promotion_number, $data_tradingTerm);

		/* 
          FINANCIAL KPI - Update Listing
          */

		$listing_incremental = $this->Promotion_header_model->get_listingTotal($promotion_number);
		$listing_total = $listing_incremental->amount;
		//incremental
		if ($salesHet_incremental != 0) {
			$listing_incrementalHet = ($listing_incremental->amount / $salesHet_incremental) * 100;
		} else {
			$listing_incrementalHet = 0;
		}
		//total
		if ($salesHet_total != 0) {
			$listing_totalHet = ($listing_total / $salesHet_total) * 100;
		} else {
			$listing_totalHet = 0;
		}
		$data_listing = array(
			'incremental' => $listing_incremental->amount,
			'incremental_het' => $listing_incrementalHet,
			'total' => $listing_total,
			'total_het' => $listing_totalHet
		);

		$this->Promotion_header_model->update_listing($promotion_number, $data_listing);

		/* 
          FINANCIAL KPI - Update On Top Promo 
          */

		$promo_incremental = $this->Promotion_header_model->get_promoTotal($promotion_number);
		$promo_total = $promo_incremental->amount;
		//incremental
		if ($salesHet_incremental != 0) {
			$promo_incrementalHet = ($promo_incremental->amount / $salesHet_incremental) * 100;
		} else {
			$promo_incrementalHet = 0;
		}
		//total
		if ($salesHet_total != 0) {
			$promo_totalHet = ($promo_total / $salesHet_total) * 100;
		} else {
			$promo_totalHet = 0;
		}
		$data_promo = array(
			'incremental' => $promo_incremental->amount,
			'incremental_het' => $promo_incrementalHet,
			'total' => $promo_total,
			'total_het' => $promo_totalHet
		);

		$this->Promotion_header_model->update_onTopPromo($promotion_number, $data_promo);

		/* 
          FINANCIAL KPI -  Update Cost 
          */

		$cost_baseline = $tradingTerm_baseline;
		$cost_incremental = $tradingTerm_incremental + $listing_incremental->amount + $promo_incremental->amount;
		$cost_total = $tradingTerm_total + $listing_total + $promo_total;
		//baseline
		if ($salesHet_baseline != 0) {
			$cost_baselineHet = ($cost_baseline / $salesHet_baseline) * 100;
		} else {
			$cost_baselineHet = 0;
		}
		//incremental
		if ($salesHet_incremental != 0) {
			$cost_incrementalHet = ($cost_incremental / $salesHet_incremental) * 100;
		} else {
			$cost_incrementalHet = 0;
		}
		//total
		if ($salesHet_total != 0) {
			$cost_totalHet = ($cost_total / $salesHet_total) * 100;
		} else {
			$cost_totalHet = 0;
		}
		$data_cost = array(
			'baseline' => $cost_baseline,
			'baseline_het' => $cost_baselineHet,
			'incremental' => $cost_incremental,
			'incremental_het' => $cost_incrementalHet,
			'total' => $cost_total,
			'total_het' => $cost_totalHet
		);

		$this->Promotion_header_model->update_cost($promotion_number, $data_cost);

		/* 
          FINANCIAL KPI - Update Net Sales 
           */

		$netSales_baseline = $netAmount_baseline - $cost_baseline;
		$netSales_incremental = $netAmount_incremental - $cost_incremental;
		$netSales_total = $netAmount_total - $cost_total;
		//baseline
		if ($salesHet_baseline != 0) {
			$netSales_baselineHet = ($netSales_baseline / $salesHet_baseline) * 100;
		} else {
			$netSales_baselineHet = 0;
		}
		//incremental
		if ($salesHet_incremental != 0) {
			$netSales_incrementalHet = ($netSales_incremental / $salesHet_incremental) * 100;
		} else {
			$netSales_incrementalHet = 0;
		}
		//total
		if ($salesHet_total != 0) {
			$netSales_totalHet = ($netSales_total / $salesHet_total) * 100;
		} else {
			$netSales_totalHet = 0;
		}
		$data_netSales = array(
			'baseline' => $netSales_baseline,
			'baseline_het' => $netSales_baselineHet,
			'incremental' => $netSales_incremental,
			'incremental_het' => $netSales_incrementalHet,
			'total' => $netSales_total,
			'total_het' => $netSales_totalHet
		);

		$this->Promotion_header_model->update_netSales($promotion_number, $data_netSales);

		//Approval Edit Promotion Budget
		if ($promoAmount != NULL || $listingAmount != NULL || $tradingAmount != NULL) {
			$row_approval = $this->Promotion_header_model->get_approval_editPromotion($promotion_number);
			$insertArray = array();

			$index = 1;
			$index2 = 0;
			foreach ($row_approval as $data_program) {
				$new_add = array(
					'promotion_number' => $promotion_number,
					// 'kode_departemen' => $kode_departemen,
					// 'channel_code' => $channel_code,
					// 'store_code' => $store_code,
					// 'region_code' => $region_code,
					'approval_scheme' => $index,
					'id_user_level' => $data_program['id_user_level'],
					'id_users' => $data_program['id_users'],
					'approve_by' => NULL,
					'approval_date' => NULL,
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' =>  $this->session->userdata('full_name')
				);

				array_push($insertArray, $new_add);
				$index++;
				$index2++;
			}

			$this->Promotion_header_model->insert_wf_edit($insertArray);
			$this->send_editBudget($promotion_number, $new_add);
		}

		$this->session->set_flashdata('message', 'Update Record Success 2');
		redirect(site_url('promotion_form'));
	}

	/* DELETE */
	public function delete()
	{
		$id = $this->input->post('promotion_id', TRUE);
		$reason = $this->input->post('delete_reason', TRUE);
		$row = $this->Promotion_header_model->get_by_id($id);
		$status_promotion = $row->status;
		if ($status_promotion == 0) {
			if ($row) {
				$promotion_number = $row->promotion_number;
				$fiscal_year = $row->fiscal_year;

				/* LISTING COST UPDATE BUDGET */
				$row_listing = $this->Promotion_header_model->listing_coa_segment($promotion_number);
				if ($row_listing > 0) {
					$index = 0;
					foreach ($row_listing as $listing_segment) {
						$listingCoaSegment[$index] = $listing_segment['gl_coa_segment'];
						$listing_amount[$index] = $listing_segment['amount'];
						$index++;
					}
					if (array_filter($listingCoaSegment)) {
						/* LISTING COST GL BUDGET */
						$row_listing_budget = $this->Promotion_header_model->listing_budget_amount($listingCoaSegment);
						$index1 = 0;
						foreach ($row_listing_budget as $listing_budget) {
							$listingBudgetUsage[$index1] = $listing_budget['BudgetUsage'];
							$listingBudgetSaldo[$index1] = $listing_budget['BudgetSaldo'];
							$index1++;
						}

						/* LISTING COST UPDATE GL BUDGET */
						$budgetListingArray = array();
						$lenghtListing = count($listingCoaSegment);
						for ($x = 0; $x < $lenghtListing; $x++) {
							$totalUsageListing[$x] = $listingBudgetUsage[$x] - $listing_amount[$x];
							$totalSaldoListing[$x] = $listingBudgetSaldo[$x] + $listing_amount[$x];

							$listingDataBudget = array(
								'gl_coa_segment' => $listingCoaSegment[$x],
								'BudgetUsage' => $totalUsageListing[$x],
								'BudgetSaldo' => $totalSaldoListing[$x],
								'SecLogDate' => date('Y-m-d H:i:s'),
								'SecLogUser' => $this->session->userdata('full_name')
							);
							array_push($budgetListingArray, $listingDataBudget);
						}

						$this->Promotion_header_model->update_budget_listing($budgetListingArray, $fiscal_year);
					}
				}

				/* ON TOP PROMO */
				$row_ontopPromo = $this->Promotion_header_model->get_ontopPromo($promotion_number);
				if ($row_ontopPromo > 0) {
					$index3 = 0;
					foreach ($row_ontopPromo as $data_ontopPromo) {
						$ontopPromo_coaSegment[$index3] = $data_ontopPromo['gl_coa_segment'];
						$ontopPromo_amount[$index3] = $data_ontopPromo['amount'];
						$index3++;
					}
					if (array_filter($ontopPromo_coaSegment)) {
						$row_ontopPromo_budget = $this->Promotion_header_model->get_ontopPromo_budget_amount($ontopPromo_coaSegment);
						$index4 = 0;
						foreach ($row_ontopPromo_budget as $data_budget) {
							$ontopPromo_usage[$index4] = $data_budget['BudgetUsage'];
							$ontopPromo_saldo[$index4] = $data_budget['BudgetSaldo'];
							$index4++;
						}

						$budgetArray = array();
						$lenght = count($ontopPromo_coaSegment);
						for ($x = 0; $x < $lenght; $x++) {
							$totalUsage_ontopPromo[$x] = $ontopPromo_usage[$x] - $ontopPromo_amount[$x];
							$totalSaldo_ontopPromo[$x] = $ontopPromo_saldo[$x] + $ontopPromo_amount[$x];

							/* Update Master Budget */

							$ontopPromo_budget = array(
								'gl_coa_segment' => $ontopPromo_coaSegment[$x],
								'BudgetUsage' => $totalUsage_ontopPromo[$x],
								'BudgetSaldo' => $totalSaldo_ontopPromo[$x],
								'SecLogDate' => date('Y-m-d H:i:s'),
								'SecLogUser' => $this->session->userdata('full_name')
							);

							array_push($budgetArray, $ontopPromo_budget);
						}

						$this->Promotion_header_model->update_budget_onTopPromo($budgetArray, $fiscal_year);
					}
				}

				/* TRADING TERM */
				$row_tradingTerm = $this->Promotion_header_model->get_tradingTerm($promotion_number);
				if ($row_tradingTerm > 0) {
					$index5 = 0;
					foreach ($row_tradingTerm as $data_tradingTerm) {
						$tradingTerm_coaSegment[$index5] = $data_tradingTerm['gl_coa_segment'];
						$tradingTerm_amount[$index5] = $data_tradingTerm['amount'];
						$index5++;
					}
					if (array_filter($tradingTerm_coaSegment)) {
						$row_tradingTerm_budget = $this->Promotion_header_model->get_tradingTerm_budget_amount($tradingTerm_coaSegment);
						$index6 = 0;
						foreach ($row_tradingTerm_budget as $data_budget_tradingTerm) {
							$tradingTerm_usage[$index6] = $data_budget_tradingTerm['BudgetUsage'];
							$tradingTerm_saldo[$index6] = $data_budget_tradingTerm['BudgetSaldo'];
							$index6++;
						}

						$tradingTerm_budgetArray = array();
						$lenght = count($tradingTerm_coaSegment);
						for ($x = 0; $x < $lenght; $x++) {
							$totalUsage_tradingTerm[$x] = $tradingTerm_usage[$x] - $tradingTerm_amount[$x];
							$totalSaldo_tradingTerm[$x] = $tradingTerm_saldo[$x] + $tradingTerm_amount[$x];

							/* Update Master Budget */

							$tradingTerm_budget = array(
								'gl_coa_segment' => $tradingTerm_coaSegment[$x],
								'BudgetUsage' => $totalUsage_tradingTerm[$x],
								'BudgetSaldo' => $totalSaldo_tradingTerm[$x],
								'SecLogDate' => date('Y-m-d H:i:s'),
								'SecLogUser' => $this->session->userdata('full_name')
							);

							array_push($tradingTerm_budgetArray, $tradingTerm_budget);
						}

						$this->Promotion_header_model->update_budget_tradingTerm($tradingTerm_budgetArray, $fiscal_year);
					}
				}

				$data = array(
					'status' => 3,
					'SecLogUser' => $this->session->userdata('full_name'),
					'SecLogDate' => date('Y-m-d H:i:s'),
				);
				$this->Promotion_header_model->update_promotion($promotion_number, $data);

				// $this->Promotion_header_model->delete_product($promotion_number);
				// $this->Promotion_header_model->delete_listing_cost($promotion_number);
				// $this->Promotion_header_model->delete_on_top_promo($promotion_number);
				// $this->Promotion_header_model->delete_trading_term($promotion_number);
				// $this->Promotion_header_model->delete_financial_kpi($promotion_number);
				// $this->Promotion_header_model->delete_wf_program($promotion_number);
				// $this->Promotion_header_model->delete_form_promotion_budget($promotion_number);
				// $this->Promotion_header_model->delete($id);
				$this->send_deleted($promotion_number, $reason);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('promotion_form'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('promotion_form'));
			}
		} else {
			$this->session->set_flashdata('message', 'Status sudah di Approve');
			redirect(site_url('promotion_form'));
		}
	}

	function get_channel()
	{
		$kode_departemen = $this->input->post('id', TRUE);
		$data = $this->Promotion_header_model->get_channel($kode_departemen)->result();
		echo json_encode($data);
	}

	function get_store()
	{
		$channel_code = $this->input->post('id', TRUE);
		$kode_departemen = $this->input->post('kode_departemen', TRUE);
		$data = $this->Promotion_header_model->get_store($channel_code, $kode_departemen)->result();
		echo json_encode($data);
	}

	function get_region()
	{
		$channel_code = $this->input->post('id', TRUE);
		$kode_departemen = $this->input->post('kode_departemen', TRUE);
		$data = $this->Promotion_header_model->get_region($channel_code, $kode_departemen)->result();
		echo json_encode($data);
	}

	function get_area()
	{
		$region_code = $this->input->post('id', TRUE);
		$data = $this->Promotion_header_model->get_area($region_code)->result();
		echo json_encode($data);
	}

	function get_coaSegment()
	{
		$coa_segment = $this->input->post('id', TRUE);
		$data = $this->Promotion_header_model->get_coaSegment($coa_segment)->result();
		echo json_encode($data);
	}

	function get_product_category_1()
	{
		$product_code = $this->input->post('id', TRUE);
		$data = $this->Promotion_header_model->get_product_category_1($product_code)->result();
		echo json_encode($data);
	}

	function get_product_category_2()
	{
		$product_code = $this->input->post('id', TRUE);
		$data = $this->Promotion_header_model->get_product_category_2($product_code)->result();
		echo json_encode($data);
	}

	function get_budgetSaldo_promo()
	{
		$coa_segment = $this->input->post('id', TRUE);
		$promoAmount = str_replace(".", "", $this->input->post('promo', TRUE));
		$year = $this->input->post('year', TRUE);
		$data = $this->Promotion_header_model->get_budgetSaldo_promo($coa_segment, $promoAmount, $year);
		echo json_encode($data);
	}

	function get_budgetSaldo_listing()
	{
		$coa_segment = $this->input->post('id', TRUE);
		$listingAmount = str_replace(".", "", $this->input->post('listing', TRUE));
		$year = $this->input->post('year', TRUE);
		$data = $this->Promotion_header_model->get_budgetSaldo_promo($coa_segment, $listingAmount, $year);
		echo json_encode($data);
	}

	function get_budgetSaldo_trading()
	{
		$coa_segment = $this->input->post('id', TRUE);
		$tradingAmount = str_replace(".", "", $this->input->post('trading', TRUE));
		$year = $this->input->post('year', TRUE);
		$data = $this->Promotion_header_model->get_budgetSaldo_trading($coa_segment, $tradingAmount, $year);
		echo json_encode($data);
	}

	function get_distributor()
	{
		$region_code = $this->input->post('id', TRUE);
		$data = $this->Promotion_header_model->get_distributor($region_code)->result();
		echo json_encode($data);
	}

	public function _rules()
	{
		$this->form_validation->set_rules('date_create', 'date create', 'trim|required');
		$this->form_validation->set_rules('kode_departemen', 'kode departemen', 'trim|required');
		$this->form_validation->set_rules('promotion_name', 'promotion name', 'trim|required');
		// $this->form_validation->set_rules('user', 'user', 'trim|required');
		// $this->form_validation->set_rules('promotion_period', 'promotion period', 'trim|required');

		// $this->form_validation->set_rules('product', 'File', 'trim|required');
		$this->form_validation->set_rules('fiscal_year', 'fiscal year', 'trim|required');
		$this->form_validation->set_rules('channel_code', 'channel code', 'trim|required');
		$this->form_validation->set_rules('sales_background', 'sales background', 'trim|required');
		// $this->form_validation->set_rules('sales_strategy', 'sales strategy', 'trim|required');
		$this->form_validation->set_rules('sales_objective', 'sales objective', 'trim|required');
		// $this->form_validation->set_rules('sales_mechanism', 'sales mechanism', 'trim|required');
		$this->form_validation->set_rules('promotion_id', 'promotion_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	function pdf($id)
	{
		$row_export = $this->Promotion_header_model->promotion_export($id);
		$promotion_number = $row_export->promotion_number;
		$percent_listing = ($row_export->total_listing_cost / $row_export->total_product_incremental) * 100;
		$percent_listing_incremental_sales = number_format($percent_listing, 2);
		$percen_promo = ($row_export->total_on_top_promo / $row_export->total_product_incremental) * 100;;
		$percen_promo_incremental_sales = number_format($percen_promo, 2);
		$row_financial_kpi_export = $this->Promotion_header_model->get_financial_kpi_export($promotion_number);
		$row_product_export = $this->Promotion_header_model->get_product_export($promotion_number);
		$row_listing_cost_export = $this->Promotion_header_model->get_listing_cost_export($promotion_number);
		$row_on_top_promo_export = $this->Promotion_header_model->get_on_top_promo_export($promotion_number);
		$row_trading_term = $this->Promotion_header_model->get_trading_export($promotion_number);
		$row_total_trading_term = $this->Promotion_header_model->get_total_trading_export($promotion_number);
		$row_approve = $this->Promotion_header_model->get_approve_export($promotion_number);
		$row_reject = $this->Promotion_header_model->get_reject_export($promotion_number);
		$row_approve_scheme1 = $this->Promotion_header_model->get_approve_scheme1_export($promotion_number);
		$row_approve_scheme2 = $this->Promotion_header_model->get_approve_scheme2_export($promotion_number);
		$row_approve_scheme3 = $this->Promotion_header_model->get_approve_scheme3_export($promotion_number);
		$row_approve_scheme4 = $this->Promotion_header_model->get_approve_scheme4_export($promotion_number);
		$row_approve_scheme5 = $this->Promotion_header_model->get_approve_scheme5_export($promotion_number);
		$row_approve_scheme6 = $this->Promotion_header_model->get_approve_scheme6_export($promotion_number);
		$row_approve_scheme7 = $this->Promotion_header_model->get_approve_scheme7_export($promotion_number);
		$row_wf_program_max = $this->Promotion_header_model->get_wf_program_max_export($promotion_number);
		$row_approval_program_max = $this->Promotion_header_model->get_approval_program_max_export();
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
			'row_listing_cost' => $row_listing_cost_export,
			'row_on_top_promo' => $row_on_top_promo_export,
			'row_financial_kpi' => $row_financial_kpi_export,
			'total_product_baseline' => $row_export->total_product_baseline,
			'total_product_incremental' => $row_export->total_product_incremental,
			'total_listing_cost' => $row_export->total_listing_cost,
			'total_on_top_promo' => $row_export->total_on_top_promo,
			'nama_departemen' => $row_export->nama_departemen,
			'channel_name' => $row_export->channel_name,
			'nama_region' => $row_export->nama_region,
			'nama_area' => $row_export->nama_area,
			'store_name' => $row_export->store_name,
			'listing_incremental_sales' => $percent_listing_incremental_sales,
			'promo_incremental_sales' => $percen_promo_incremental_sales,
			'row_trading_term' => $row_trading_term,
			'total_trading_amount' => $row_total_trading_term->total_amount,
			'total_trading_percent' => $row_total_trading_term->total_incremental_sales,
			'row_approve' => $row_approve,
			'row_reject' => $row_reject,
			'row_approve_scheme1' => $row_approve_scheme1,
			'row_approve_scheme2' => $row_approve_scheme2,
			'row_approve_scheme3' => $row_approve_scheme3,
			'row_approve_scheme4' => $row_approve_scheme4,
			'row_approve_scheme5' => $row_approve_scheme5,
			'row_approve_scheme6' => $row_approve_scheme6,
			'row_approve_scheme7' => $row_approve_scheme7,
			'row_wf_program_max' => $row_wf_program_max->max_wf_program,
			'row_approval_program_max' => $row_approval_program_max->max_approval_program,
		);
		$this->load->view('promotion_header/promotion_pdf', $data);

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

	public function send($promotion_number)
	{
		//Load data
		$row_data = $this->Promotion_header_model->get_data($promotion_number);
		$row_email = $this->Promotion_header_model->get_email($row_data->approval_scheme, $promotion_number);
		$alamat_email = $row_email->email;

		$message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_email->full_name . ',<br/><br/>A request by ' . $row_data->pemohon . ' has been submitted that requires your approval.</p>
      </div>
		<div>
        <p>The request detail : <a href="' . site_url() . 'wf_program/read/' . $row_data->promotion_id . '">' . site_url() . 'wf_program/read/' . $row_data->promotion_id . '</a>.</p>
	  </div>
	  <table border="1" bordercolor="#333333">
		<thead>
        <tr>
          <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">PROMOTION FORM</font></b></td>
		</tr>
		</thead>
		<tbody>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Date</td>
		  <td style="padding-left:20px; padding-right:20px;">' . $row_data->date_create . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Department</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_departemen . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Promotion Name</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->promotion_name . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Channel</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->channel_name . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Region</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_region . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Area</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_area . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Store</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->store_name . '</td>
        </tr>
        <tr>
		  <td style="padding-left:20px; padding-right:20px;">Total Product (Baseline)</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_product_baseline) . '</td>
		</tr>
		<tr>
		  <td style="padding-left:20px; padding-right:20px;">Total Product (Incremental)</td>
		  <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_product_incremental) . '</td>
		</tr>
		<tr>
		  <td style="padding-left:20px; padding-right:20px;">Total Listing Cost</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_listing_cost) . '</td>
		</tr>
		<tr>
		  <td style="padding-left:20px; padding-right:20px;">Total On Top Promo</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_on_top_promo) . '</td>
		</tr>
		</tbody>
	  </table>';

		//Send Email
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
		$config['smtp_pass'] = 'mustikagoogle';
		$config['mailtype'] = 'html';

		$this->load->library('email', $config);

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
		$this->email->from('mustikaratu.mailer@gmail.com', 'MAPS');
		$this->email->to($alamat_email);
		// $this->email->to('development@mustika-ratu.co.id');
		$this->email->subject('Promotion Number : ' . $promotion_number . ' ');
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		} else {
			$this->session->set_flashdata("email_sent", "Error in sending Email.");
			// show_error($this->email->print_debugger());
		}
	}

	public function send_deleted($promotion_number, $reason)
	{
		//Load data
		$row_data = $this->Promotion_header_model->get_data($promotion_number);
		$row_email = $this->Promotion_header_model->get_email($row_data->approval_scheme, $promotion_number);
		$alamat_email = $row_email->email;

		$message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_email->full_name . ',<br/><br/>A request by ' . $row_data->pemohon . ' has been deleted.</p>
	  </div>
	  <div>
        <p>The Reason : ' . $reason . '</p>
	  </div>
	  <table border="1" bordercolor="#333333">
		<thead>
        <tr>
          <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">PROMOTION FORM</font></b></td>
		</tr>
		</thead>
		<tbody>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Date</td>
		  <td style="padding-left:20px; padding-right:20px;">' . $row_data->date_create . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Department</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_departemen . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Promotion Name</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->promotion_name . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Channel</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->channel_name . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Region</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_region . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Area</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_area . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Store</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->store_name . '</td>
        </tr>
        <tr>
		  <td style="padding-left:20px; padding-right:20px;">Total Product (Baseline)</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_product_baseline) . '</td>
		</tr>
		<tr>
		  <td style="padding-left:20px; padding-right:20px;">Total Product (Incremental)</td>
		  <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_product_incremental) . '</td>
		</tr>
		<tr>
		  <td style="padding-left:20px; padding-right:20px;">Total Listing Cost</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_listing_cost) . '</td>
		</tr>
		<tr>
		  <td style="padding-left:20px; padding-right:20px;">Total On Top Promo</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_on_top_promo) . '</td>
		</tr>
		</tbody>
	  </table>';

		//Send Email
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
		$config['smtp_pass'] = 'mustikagoogle';
		$config['mailtype'] = 'html';

		$this->load->library('email', $config);

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
		$this->email->from('mustikaratu.mailer@gmail.com', 'MAPS');
		$this->email->to($alamat_email);
		// $this->email->to('development@mustika-ratu.co.id');
		$this->email->subject('Promotion Number : ' . $promotion_number . ' ');
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		} else {
			$this->session->set_flashdata("email_sent", "Error in sending Email.");
			// show_error($this->email->print_debugger());
		}
	}

	public function export_excel()
	{
		$yearPeriode = $this->input->post('YearPeriod');
		$department = $this->input->post('kode_departemen');
		$status = $this->input->post('status_code');
		$month = $this->input->post('month');

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle("Promotion");

		$styleArray = [
			'borders' => [
				'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
				'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
				'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
				'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
			],
		];

		$sheet->setCellValue('A1', "No");
		$sheet->setCellValue('B1', "Date Create");
		$sheet->setCellValue('C1', "Department Name");
		$sheet->setCellValue('D1', "Promotion Number");
		$sheet->setCellValue('E1', "Promotion Name");
		$sheet->setCellValue('F1', "Start Period");
		$sheet->setCellValue('G1', "End Period");
		$sheet->setCellValue('H1', "Fiscal Year");
		$sheet->setCellValue('I1', "Channel Name");
		$sheet->setCellValue('J1', "Region Name");
		$sheet->setCellValue('K1', "Area Name");
		$sheet->setCellValue('L1', "Store Name");
		$sheet->setCellValue('M1', "Coa");
		$sheet->setCellValue('N1', "Trading Term");
		$sheet->setCellValue('O1', "Listing Cost");
		$sheet->setCellValue('P1', "On Top Promo");
		$sheet->setCellValue('Q1', "Amount All Cost");
		$sheet->setCellValue('R1', "Product Baseline");
		$sheet->setCellValue('S1', "Product Incremental");
		$sheet->setCellValue('T1', "Amount Sales");
		$sheet->setCellValue('U1', "Status");

		$sheet->getStyle('A1')->applyFromArray($styleArray);
		$sheet->getStyle('B1')->applyFromArray($styleArray);
		$sheet->getStyle('C1')->applyFromArray($styleArray);
		$sheet->getStyle('D1')->applyFromArray($styleArray);
		$sheet->getStyle('E1')->applyFromArray($styleArray);
		$sheet->getStyle('F1')->applyFromArray($styleArray);
		$sheet->getStyle('G1')->applyFromArray($styleArray);
		$sheet->getStyle('H1')->applyFromArray($styleArray);
		$sheet->getStyle('I1')->applyFromArray($styleArray);
		$sheet->getStyle('J1')->applyFromArray($styleArray);
		$sheet->getStyle('K1')->applyFromArray($styleArray);
		$sheet->getStyle('L1')->applyFromArray($styleArray);
		$sheet->getStyle('M1')->applyFromArray($styleArray);
		$sheet->getStyle('N1')->applyFromArray($styleArray);
		$sheet->getStyle('O1')->applyFromArray($styleArray);
		$sheet->getStyle('P1')->applyFromArray($styleArray);
		$sheet->getStyle('Q1')->applyFromArray($styleArray);
		$sheet->getStyle('R1')->applyFromArray($styleArray);
		$sheet->getStyle('S1')->applyFromArray($styleArray);
		$sheet->getStyle('T1')->applyFromArray($styleArray);
		$sheet->getStyle('U1')->applyFromArray($styleArray);

		$promotion = $this->Promotion_header_model->get_promotion_excel($status, $yearPeriode, $department, $month);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($promotion as $data) {
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $data->date_create);
			$sheet->setCellValue('C' . $numrow, $data->nama_departemen);
			$sheet->setCellValue('D' . $numrow, $data->promotion_number);
			$sheet->setCellValue('E' . $numrow, $data->promotion_name);
			$sheet->setCellValue('F' . $numrow, $data->periode_awal);
			$sheet->setCellValue('G' . $numrow, $data->periode_akhir);
			$sheet->setCellValue('H' . $numrow, $data->fiscal_year);
			$sheet->setCellValue('I' . $numrow, $data->channel_name);
			$sheet->setCellValue('J' . $numrow, $data->nama_region);
			$sheet->setCellValue('K' . $numrow, $data->nama_area);
			$sheet->setCellValue('L' . $numrow, $data->store_name);
			$sheet->setCellValue('M' . $numrow, $data->gl_account_code);
			$sheet->setCellValue('N' . $numrow, $data->amount_trading);
			$sheet->setCellValue('O' . $numrow, $data->amount_listing);
			$sheet->setCellValue('P' . $numrow, $data->amount_promo);
			$sheet->setCellValue('Q' . $numrow, $data->all_cost);
			$sheet->setCellValue('R' . $numrow, $data->total_product_baseline);
			$sheet->setCellValue('S' . $numrow, $data->total_product_incremental);
			$sheet->setCellValue('T' . $numrow, $data->amount_sales);
			$sheet->setCellValue('U' . $numrow, $data->status_name);

			$sheet->getStyle('A' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('B' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('C' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('D' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('E' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('F' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('G' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('H' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('I' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('J' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('K' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('L' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('M' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('N' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('O' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('P' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('Q' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('R' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('S' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('T' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('U' . $numrow)->applyFromArray($styleArray);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		$sheet->getColumnDimension('A')->setWidth(5);
		$sheet->getColumnDimension('B')->setWidth(20);
		$sheet->getColumnDimension('C')->setWidth(20);
		$sheet->getColumnDimension('D')->setWidth(20);
		$sheet->getColumnDimension('E')->setWidth(20);
		$sheet->getColumnDimension('F')->setWidth(20);
		$sheet->getColumnDimension('G')->setWidth(20);
		$sheet->getColumnDimension('H')->setWidth(20);
		$sheet->getColumnDimension('I')->setWidth(20);
		$sheet->getColumnDimension('J')->setWidth(20);
		$sheet->getColumnDimension('K')->setWidth(20);
		$sheet->getColumnDimension('L')->setWidth(20);
		$sheet->getColumnDimension('M')->setWidth(20);
		$sheet->getColumnDimension('N')->setWidth(20);
		$sheet->getColumnDimension('O')->setWidth(20);
		$sheet->getColumnDimension('P')->setWidth(20);
		$sheet->getColumnDimension('Q')->setWidth(20);
		$sheet->getColumnDimension('R')->setWidth(20);
		$sheet->getColumnDimension('S')->setWidth(20);
		$sheet->getColumnDimension('T')->setWidth(20);
		$sheet->getColumnDimension('U')->setWidth(20);

		//Sheet Product
		$sheet2 = $spreadsheet->createSheet();
		$sheet2->setTitle('Product');
		$sheet2->setCellValue('A1', "No");
		$sheet2->setCellValue('B1', "Date Create");
		$sheet2->setCellValue('C1', "Department Name");
		$sheet2->setCellValue('D1', "Promotion Number");
		$sheet2->setCellValue('E1', "Promotion Name");
		$sheet2->setCellValue('F1', "Category 1");
		$sheet2->setCellValue('G1', "Category 2");
		$sheet2->setCellValue('H1', "Product Code");
		$sheet2->setCellValue('I1', "Product Name");
		$sheet2->setCellValue('J1', "Baseline Sales");
		$sheet2->setCellValue('K1', "Incremental Sales");

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet2->getStyle('A1')->applyFromArray($styleArray);
		$sheet2->getStyle('B1')->applyFromArray($styleArray);
		$sheet2->getStyle('C1')->applyFromArray($styleArray);
		$sheet2->getStyle('D1')->applyFromArray($styleArray);
		$sheet2->getStyle('E1')->applyFromArray($styleArray);
		$sheet2->getStyle('F1')->applyFromArray($styleArray);
		$sheet2->getStyle('G1')->applyFromArray($styleArray);
		$sheet2->getStyle('H1')->applyFromArray($styleArray);
		$sheet2->getStyle('I1')->applyFromArray($styleArray);
		$sheet2->getStyle('J1')->applyFromArray($styleArray);
		$sheet2->getStyle('K1')->applyFromArray($styleArray);

		$product = $this->Promotion_header_model->get_product_excel($status, $yearPeriode, $department, $month);
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 2

		foreach ($product as $dataProduct) {
			$sheet2->setCellValue('A' . $numrow, $no);
			$sheet2->setCellValue('B' . $numrow, $dataProduct->date_create);
			$sheet2->setCellValue('C' . $numrow, $dataProduct->nama_departemen);
			$sheet2->setCellValue('D' . $numrow, $dataProduct->promotion_number);
			$sheet2->setCellValue('E' . $numrow, $dataProduct->promotion_name);
			$sheet2->setCellValue('F' . $numrow, $dataProduct->category_name1);
			$sheet2->setCellValue('G' . $numrow, $dataProduct->category_name2);
			$sheet2->setCellValue('H' . $numrow, $dataProduct->product_code);
			$sheet2->setCellValue('I' . $numrow, $dataProduct->product_name);
			$sheet2->setCellValue('J' . $numrow, $dataProduct->baseline_sales);
			$sheet2->setCellValue('K' . $numrow, $dataProduct->incremental_sales);

			$sheet2->getStyle('A' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('B' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('C' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('D' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('E' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('F' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('G' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('H' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('I' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('J' . $numrow)->applyFromArray($styleArray);
			$sheet2->getStyle('K' . $numrow)->applyFromArray($styleArray);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		$sheet2->getColumnDimension('A')->setWidth(5);
		$sheet2->getColumnDimension('B')->setWidth(20);
		$sheet2->getColumnDimension('C')->setWidth(20);
		$sheet2->getColumnDimension('D')->setWidth(20);
		$sheet2->getColumnDimension('E')->setWidth(20);
		$sheet2->getColumnDimension('F')->setWidth(20);
		$sheet2->getColumnDimension('G')->setWidth(20);
		$sheet2->getColumnDimension('H')->setWidth(20);
		$sheet2->getColumnDimension('I')->setWidth(20);
		$sheet2->getColumnDimension('J')->setWidth(20);
		$sheet2->getColumnDimension('K')->setWidth(20);

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="REPORT_PROMOTION_' . $data->nama_departemen . '_' . date('d-M-Y') . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	/* CANCEL PROGRAM */
	public function cancel()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('promotion_form/cancel_action'),
			'promotion_number' => set_value('promotion_number'),
		);
		$this->template->load('template', 'promotion_header/promotion_header_cancel', $data);
	}

	public function cancel_action()
	{
		$promotion_number = $this->input->post('promotion_number', TRUE);
		$reason_cancel = $this->input->post('reason_cancel', TRUE);

		$row = $this->Promotion_header_model->get_by_number($promotion_number);
		if ($row) {
			$promotion_number = $row->promotion_number;
			$fiscal_year = $row->fiscal_year;

			/*UPDATE PROGRAM*/
			$data_program = array(
				'status' => 5,
				'SecLogUser' => $this->session->userdata('full_name'),
				'SecLogDate' => date('Y-m-d H:i:s'),
			);
			$this->Promotion_header_model->update_promotion($promotion_number, $data_program);

			/* LISTING COST UPDATE BUDGET */
			$row_listing = $this->Promotion_header_model->listing_coa_segment($promotion_number);
			if ($row_listing > 0) {
				$index = 0;
				foreach ($row_listing as $listing_segment) {
					$listingCoaSegment[$index] = $listing_segment['gl_coa_segment'];
					$listing_amount[$index] = $listing_segment['amount'];
					$index++;
				}
				if (array_filter($listingCoaSegment)) {
					/* LISTING COST GL BUDGET */
					$row_listing_budget = $this->Promotion_header_model->listing_budget_amount($listingCoaSegment);
					$index1 = 0;
					foreach ($row_listing_budget as $listing_budget) {
						$listingBudgetUsage[$index1] = $listing_budget['BudgetUsage'];
						$listingBudgetSaldo[$index1] = $listing_budget['BudgetSaldo'];
						$index1++;
					}

					/* LISTING COST UPDATE GL BUDGET */
					$budgetListingArray = array();
					$lenghtListing = count($listingCoaSegment);
					for ($x = 0; $x < $lenghtListing; $x++) {
						$totalUsageListing[$x] = $listingBudgetUsage[$x] - $listing_amount[$x];
						$totalSaldoListing[$x] = $listingBudgetSaldo[$x] + $listing_amount[$x];

						$listingDataBudget = array(
							'gl_coa_segment' => $listingCoaSegment[$x],
							'BudgetUsage' => $totalUsageListing[$x],
							'BudgetSaldo' => $totalSaldoListing[$x],
							'SecLogDate' => date('Y-m-d H:i:s'),
							'SecLogUser' => $this->session->userdata('full_name')
						);
						array_push($budgetListingArray, $listingDataBudget);
					}

					$this->Promotion_header_model->update_budget_listing($budgetListingArray, $fiscal_year);
				}
			}

			/* ON TOP PROMO */
			$row_ontopPromo = $this->Promotion_header_model->get_ontopPromo($promotion_number);
			if ($row_ontopPromo > 0) {
				$index3 = 0;
				foreach ($row_ontopPromo as $data_ontopPromo) {
					$ontopPromo_coaSegment[$index3] = $data_ontopPromo['gl_coa_segment'];
					$ontopPromo_amount[$index3] = $data_ontopPromo['amount'];
					$index3++;
				}
				if (array_filter($ontopPromo_coaSegment)) {
					$row_ontopPromo_budget = $this->Promotion_header_model->get_ontopPromo_budget_amount($ontopPromo_coaSegment);
					$index4 = 0;
					foreach ($row_ontopPromo_budget as $data_budget) {
						$ontopPromo_usage[$index4] = $data_budget['BudgetUsage'];
						$ontopPromo_saldo[$index4] = $data_budget['BudgetSaldo'];
						$index4++;
					}

					$budgetArray = array();
					$lenght = count($ontopPromo_coaSegment);
					for ($x = 0; $x < $lenght; $x++) {
						$totalUsage_ontopPromo[$x] = $ontopPromo_usage[$x] - $ontopPromo_amount[$x];
						$totalSaldo_ontopPromo[$x] = $ontopPromo_saldo[$x] + $ontopPromo_amount[$x];

						/* Update Master Budget */

						$ontopPromo_budget = array(
							'gl_coa_segment' => $ontopPromo_coaSegment[$x],
							'BudgetUsage' => $totalUsage_ontopPromo[$x],
							'BudgetSaldo' => $totalSaldo_ontopPromo[$x],
							'SecLogDate' => date('Y-m-d H:i:s'),
							'SecLogUser' => $this->session->userdata('full_name')
						);

						array_push($budgetArray, $ontopPromo_budget);
					}

					$this->Promotion_header_model->update_budget_onTopPromo($budgetArray, $fiscal_year);
				}
			}

			/* TRADING TERM */
			$row_tradingTerm = $this->Promotion_header_model->get_tradingTerm($promotion_number);
			if ($row_tradingTerm > 0) {
				$index5 = 0;
				foreach ($row_tradingTerm as $data_tradingTerm) {
					$tradingTerm_coaSegment[$index5] = $data_tradingTerm['gl_coa_segment'];
					$tradingTerm_amount[$index5] = $data_tradingTerm['amount'];
					$index5++;
				}
				if (array_filter($tradingTerm_coaSegment)) {
					$row_tradingTerm_budget = $this->Promotion_header_model->get_tradingTerm_budget_amount($tradingTerm_coaSegment);
					$index6 = 0;
					foreach ($row_tradingTerm_budget as $data_budget_tradingTerm) {
						$tradingTerm_usage[$index6] = $data_budget_tradingTerm['BudgetUsage'];
						$tradingTerm_saldo[$index6] = $data_budget_tradingTerm['BudgetSaldo'];
						$index6++;
					}

					$tradingTerm_budgetArray = array();
					$lenght = count($tradingTerm_coaSegment);
					for ($x = 0; $x < $lenght; $x++) {
						$totalUsage_tradingTerm[$x] = $tradingTerm_usage[$x] - $tradingTerm_amount[$x];
						$totalSaldo_tradingTerm[$x] = $tradingTerm_saldo[$x] + $tradingTerm_amount[$x];

						/* Update Master Budget */

						$tradingTerm_budget = array(
							'gl_coa_segment' => $tradingTerm_coaSegment[$x],
							'BudgetUsage' => $totalUsage_tradingTerm[$x],
							'BudgetSaldo' => $totalSaldo_tradingTerm[$x],
							'SecLogDate' => date('Y-m-d H:i:s'),
							'SecLogUser' => $this->session->userdata('full_name')
						);

						array_push($tradingTerm_budgetArray, $tradingTerm_budget);
					}

					$this->Promotion_header_model->update_budget_tradingTerm($tradingTerm_budgetArray, $fiscal_year);
				}
			}

			$this->send_cancel($promotion_number, $data_program, $reason_cancel);
			$this->session->set_flashdata('alert', 'Cancelled Promotion Success');
			redirect(site_url('promotion_form'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('promotion_form'));
		}
	}

	public function send_cancel($promotion_number, $data_program, $reason_cancel)
	{
		//Load data
		$row_data = $this->Wf_program_model->get_data($promotion_number);
		$alamat_email = $row_data->email;

		$message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_data->pemohon . ',<br/><br/>Your Promotion has been Cancelled by ' . $data_program['SecLogUser'] . '.<br/>Cancelled date : ' . $data_program['SecLogDate'] . '.<br/>Cancelled reason : ' . $reason_cancel . '.</p>
      </div>
	  <table border="1" bordercolor="#333333">
		<thead>
        <tr>
          <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">PROMOTION FORM</font></b></td>
		</tr>
		</thead>
		<tbody>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Date</td>
		  <td style="padding-left:20px; padding-right:20px;">' . $row_data->date_create . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Department</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_departemen . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Promotion Name</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->promotion_name . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Channel</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->channel_name . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Region</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_region . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Area</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_area . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Store</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->store_name . '</td>
        </tr>
        <tr>
		  <td style="padding-left:20px; padding-right:20px;">Total Product (Baseline)</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_product_baseline) . '</td>
		</tr>
		<tr>
		  <td style="padding-left:20px; padding-right:20px;">Total Product (Incremental)</td>
		  <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_product_incremental) . '</td>
		</tr>
		<tr>
		  <td style="padding-left:20px; padding-right:20px;">Total Listing Cost</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_listing_cost) . '</td>
		</tr>
		<tr>
		  <td style="padding-left:20px; padding-right:20px;">Total On Top Promo</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total_on_top_promo) . '</td>
		</tr>
		</tbody>
	  </table>';

		//Send Email
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
		$config['smtp_pass'] = 'mustikagoogle';
		$config['mailtype'] = 'html';

		$this->load->library('email', $config);

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
		$this->email->from('mustikaratu.mailer@gmail.co.id', 'MAPS');
		$this->email->to($alamat_email);
		// $this->email->to('development@mustika-ratu.com');
		$this->email->subject('Promotion Number : ' . $promotion_number . ' ');
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		} else {
			$this->session->set_flashdata("email_sent", "Error in sending Email.");
			// show_error($this->email->print_debugger());
		}
	}

	public function send_editBudget($promotion_number, $new_add)
	{
		//Load data
		$row_data = $this->Wf_edit_budget_model->get_data($promotion_number);
		$row_email = $this->Wf_edit_budget_model->get_email($promotion_number, $new_add);
		$alamat_email = $row_email->email;
		$additional_amount = number_format($row_data->additional_amount);

		$message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_email->full_name . ',<br/><br/></p>
      </div>
		<div>
        <p>A request edit promotion budget has been submitted that requires your approval.</p>
        <p>The request detail : <a href="' . site_url() . 'wf_edit_budget/read/' . $row_data->promotion_id . '">' . site_url() . 'wf_edit_budget/read/' . $row_data->promotion_id . '</a>.</p>
	  </div>
	  <table border="1" bordercolor="#333333">
		<thead>
        <tr>
          <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">PROMOTION FORM</font></b></td>
		</tr>
		</thead>
		<tbody>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Promotion Number</td>
		      <td style="padding-left:20px; padding-right:20px;">' . $row_data->promotion_number . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Request Budget</td>
		      <td style="padding-left:20px; padding-right:20px;">' . $additional_amount . '</td>
        </tr>
		</tbody>
	  </table>';

		//Send Email
		$this->load->library('email');

		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		// $config['_smtp_auth'] = TRUE;
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
		$config['smtp_pass'] = 'mustikagoogle';
		$config['mailtype'] = 'html';
		// $config['smtp_crypto'] = 'tls';
		// $config['smtp_timeout'] = '4';

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
		$this->email->from('mustikaratu.mailer@gmail.com', 'MAPS');
		$this->email->to($alamat_email);
		// $this->email->to('development@mustika-ratu.co.id');
		$this->email->subject('Promotion Number : ' . $promotion_number . ' ');
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		} else {
			$this->session->set_flashdata("email_sent", "Error in sending Email.");
			// show_error($this->email->print_debugger());
		}
	}
}
