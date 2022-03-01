<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Wf_edit_budget extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    is_login();
    $this->load->model('Wf_edit_budget_model');
    $this->load->model('Promotion_header_model');
    $this->load->library('form_validation');
    $this->load->library('datatables');
    $this->load->library('session');
  }

  public function index()
  {
    $row_get_promotionId = $this->Promotion_header_model->get_all_data();
    $data = array('row_get_promotionId' => $row_get_promotionId);
    $this->template->load('template', 'wf_edit_budget/wf_edit_budget_list', $data);
  }

  public function json()
  {
    header('Content-Type: application/json');
    echo $this->Wf_edit_budget_model->json();
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
    $row_get_promotionId = $this->Promotion_header_model->get_all_data();
    if ($row) {
      $data = array(
        'id' => $row->approval_scheme,
        'button_approve' => 'APPROVE',
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
        'upload_file' => $row->upload_file,
        'upload_activity' => $row->upload_activity,
        'row_trading_term' => $row_trading_term,
        'total_trading_amount' => $row_total_trading_term->total_amount,
        'total_trading_percent' => $row_total_trading_term->total_incremental_sales,
        'row_get_promotionId' => $row_get_promotionId,
      );
      $this->template->load('template', 'wf_edit_budget/wf_edit_budget_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wf_edit_budget'));
    }
  }

  /* APPROVAL PROGRAM */
  public function approve_action($promotion_id)
  {
    $row = $this->Wf_edit_budget_model->get_additionalBudget($promotion_id);
    if ($row) {
      $promotion_number = $row->promotion_number;
      $fiscal_year = $row->fiscal_year;

      /*UPDATE WORKFLOW*/
      $data = array(
        'approve_by' => $this->session->userdata('full_name'),
        'approval_date' => date('Y-m-d H:i:s')
      );

      $this->Wf_edit_budget_model->update_wf_edit_budget($row->approval_scheme, $row->promotion_number, $data);

      /* UPDATE ADDITIONAL BUDGET PROMOTION */
      $wf_edit_budget = $this->Wf_edit_budget_model->get_wf_edit_budget($promotion_number);
      if (empty($wf_edit_budget)) {

        /* BUDGET TRADING TERM */
        $budget = "Trading Term";
        $row_tradingTerm = $this->Promotion_header_model->get_additionalBudget($promotion_number, $budget);
        // $check_tradingTerm = array_filter($row_tradingTerm);
        if (is_null($row_tradingTerm) == false) {
          $index6 = 0;
          foreach ($row_tradingTerm as $data_tradingTerm) {
            $tradingTerm_coaSegment[$index6] = $data_tradingTerm['gl_coa_segment'];
            $tradingTerm_amount[$index6] = $data_tradingTerm['additional_amount'];
            $index6++;
          }
          // $check_tradingSegment = array_filter($tradingTerm_coaSegment);
          // if ($check_tradingSegment != NULL) {
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
          // }
        }

        /* LISTING COST UPDATE BUDGET */
        $budget = "Listing Cost";
        $row_listing = $this->Promotion_header_model->get_additionalBudget($promotion_number, $budget);
        // $check_listingCost = array_filter($row_listing);
        if (is_null($row_listing) == false) {
          $index = 0;
          foreach ($row_listing as $listing_segment) {
            $listingCoaSegment[$index] = $listing_segment['gl_coa_segment'];
            $listing_amount[$index] = $listing_segment['additional_amount'];
            $index++;
          }
          // $check_listingSegment = array_filter($listingCoaSegment);
          // if ($check_listingSegment != NULL) {
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
            $totalUsageListing[$x] = $listingBudgetUsage[$x] + $listing_amount[$x];
            $totalSaldoListing[$x] = $listingBudgetSaldo[$x] - $listing_amount[$x];

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
          // }
        }

        /* BUDGET ON TOP PROMO */
        $budget = "On Top Promo";
        $row_ontopPromo = $this->Promotion_header_model->get_additionalBudget($promotion_number, $budget);
        // $check_onTopPromo = array_filter($row_ontopPromo);
        if (is_null($row_ontopPromo) == false) {
          $index3 = 0;
          foreach ($row_ontopPromo as $data_ontopPromo) {
            $ontopPromo_coaSegment[$index3] = $data_ontopPromo['gl_coa_segment'];
            $ontopPromo_amount[$index3] = $data_ontopPromo['additional_amount'];
            $index3++;
          }
          // $check_promoSegment = array_filter($ontopPromo_coaSegment);
          // if ($check_promoSegment != NULL) {
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
          // }
        }

        /* Form Promotion Budget */
        $row_promotionBudget = $this->Promotion_header_model->get_promotionBudget($promotion_number);
        $promotion_total_usage = $row_promotionBudget->promotion_total_usage;
        $promotion_total_cost = $row->total_listing_cost + $row->total_on_top_promo + $row->total_trading_term;

        $total_promotion = array(
          'promotion_total_cost' => $promotion_total_cost,
          'promotion_total_saldo' => $promotion_total_cost - $promotion_total_usage,
          'SecLogUser' => $this->session->userdata('full_name'),
          'SecLogDate' => date('Y-m-d H:i:s')
        );

        $this->Promotion_header_model->update_total_promotion($promotion_number, $total_promotion);

        $data_program = array(
          'status' => 1,
          'approval_scheme' => ($row->approval_scheme),
          'SecLogUser' => $this->session->userdata('full_name'),
          'SecLogDate' => date('Y-m-d H:i:s'),
        );

        $this->Wf_edit_budget_model->update_additionalBudget($promotion_number, $data_program);
      } else {
        $data_program = array(
          'approval_scheme' => ($row->approval_scheme) + 1,
          'SecLogUser' => $this->session->userdata('full_name'),
          'SecLogDate' => date('Y-m-d H:i:s'),
        );

        $this->send($promotion_number, $data_program);
        $this->Wf_edit_budget_model->update_additionalBudget($promotion_number, $data_program);
      }

      // $this->send_notifikasi($promotion_number, $data_program);

      $this->session->set_flashdata('alert', 'Approval Success');
      redirect(site_url('wf_edit_budget'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wf_edit_budget'));
    }
  }

  /* REJECT PROGRAM */
  public function reject_action()
  {
    $promotion_id = $this->input->post('promotion_id', TRUE);

    $row = $this->Wf_edit_budget_model->get_additionalBudget($promotion_id);
    if ($row) {
      $promotion_number = $row->promotion_number;
      $fiscal_year = $row->fiscal_year;
      $date_create = $row->date_create;
      $kode_departemen = $row->kode_departemen;
      $channel_code = $row->channel_code;
      $region_code = $row->region_code;
      $store_code = $row->store_code;

      /*UPDATE WORKFLOW*/
      $data = array(
        'reject_by' => $this->session->userdata('full_name'),
        'reject_date' => date('Y-m-d H:i:s'),
        'reject_reason' => $this->input->post('reject_reason', TRUE)
      );
      $this->Wf_edit_budget_model->update_wf_edit_budget($row->approval_scheme, $row->promotion_number,  $data);

      /*UPDATE PROGRAM*/
      $data_program = array(
        'status' => 2,
        'SecLogUser' => $this->session->userdata('full_name'),
        'SecLogDate' => date('Y-m-d H:i:s'),
      );
      $this->Wf_edit_budget_model->update_additionalBudget($promotion_number, $data_program);

      //Delete Treding Term
      $this->Wf_edit_budget_model->delete_tradingTerm($promotion_number, $date_create);

      //Delete Listing Cost
      $this->Wf_edit_budget_model->delete_listingCost($promotion_number, $date_create);

      //Delete On Top Promo
      $this->Wf_edit_budget_model->delete_onTopPromo($promotion_number, $date_create);

      //Total Promotion Form
      $row_listingCost = $this->Wf_edit_budget_model->row_listingCost($promotion_number);
      $row_tradingTerm = $this->Wf_edit_budget_model->row_tradingTerm($promotion_number);
      $row_onTopPromo = $this->Wf_edit_budget_model->row_onTopPromo($promotion_number);

      $row_total_listing_cost = $row_listingCost->total_listing_cost;
      $row_total_on_top_promo = $row_onTopPromo->total_on_top_promo;
      $row_total_trading_term = $row_tradingTerm->total_trading_term;

      $row_product = $this->Promotion_header_model->get_totalProduct();

      $total_product_baseline = $row_product->baseline_sales;
      $total_product_incremental = $row_product->incremental_sales;
      $total_listing_cost = $row_total_listing_cost;
      $total_on_top_promo = $row_total_on_top_promo;
      $total_trading_term = $row_total_trading_term;

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

      $this->send_reject($promotion_number, $data_program, $data);
      $this->session->set_flashdata('alert', 'Reject Success');
      redirect(site_url('wf_program'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wf_program'));
    }
  }

  public function send($promotion_number, $data_program)
  {
    //Load data
    $row_data = $this->Wf_edit_budget_model->get_data($promotion_number);
    $row_email = $this->Wf_edit_budget_model->get_email($promotion_number, $data_program);
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

  public function send_reject($promotion_number, $data_program, $data)
  {
    //Load data
    $row_data = $this->Wf_edit_budget_model->get_data($promotion_number);
    // $row_cc = $this->Wf_edit_budget_model->get_cc($promotion_number, $data_program);
    $alamat_email = $row_data->email;

    // $index = 0;
    // foreach ($row_cc as $cc) {
    //   $email_cc[$index] = $cc['email'];
    //   $index++;
    // }

    $message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_data->pemohon . ',<br/><br/>Your request has been rejected by ' . $data['reject_by'] . '.<br/>Reject date : ' . $data['reject_date'] . '.<br/>Reject reason : ' . $data['reject_reason'] . '.</p>
      </div>
		<div>
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
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->additional_budget . '</td>
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
    // $this->email->cc($email_cc);
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

  public function send_notifikasi($promotion_number, $data_program)
  {
    //Load data
    $row_data = $this->Wf_program_model->get_data($promotion_number);
    $row_cc = $this->Wf_program_model->get_cc($promotion_number, $data_program);
    $alamat_email = $row_data->email;

    $index = 0;
    foreach ($row_cc as $cc) {
      $email_cc[$index] = $cc['email'];
      $index++;
    }

    $message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_data->pemohon . ',<br/><br/>Your request has been approved by ' . $data_program['SecLogUser'] . '.<br/>Approved date :  ' . $data_program['SecLogDate'] . '</p>
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
    // $this->email->to($alamat_email);
    // $this->email->cc($email_cc);
    $this->email->to('development@mustika-ratu.co.id');
    $this->email->subject('Promotion Number : ' . $promotion_number . ' ');
    $this->email->message($message);

    if ($this->email->send()) {
      $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
    } else {
      // $this->session->set_flashdata("email_sent","Error in sending Email.");
      show_error($this->email->print_debugger());
    }
  }

  public function send_distributor($promotion_number, $data_program)
  {
    //Load data
    $row_data = $this->Wf_program_model->get_data($promotion_number);
    $row_email = $this->Wf_program_model->get_email_distributor($promotion_number);
    $row_cc = $this->Wf_program_model->get_email_cc($promotion_number, $row_data->region_code, $row_data->kode_area);
    $index = 0;
    foreach ($row_email as $data) {
      $alamat_email[$index] = $data['email'];
      $index++;
    }
    $index1 = 0;
    foreach ($row_cc as $data) {
      $alamat_cc[$index1] = $data['email'];
      $index1++;
    }
    $message = '<div>
        <p>Yth. Bapak/Ibu Distributor dan Cabang,<br/><br/>Berikut Promosi yang akan berjalan :</p>
      </div>
		<div>
        <p>Promotion detail : <a href="' . site_url() . 'promotion_view/read/' . $row_data->promotion_id . '">' . site_url() . 'promotion_view/read/' . $row_data->promotion_id . '</a>.</p>
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
          <td style="padding-left:20px; padding-right:20px;">Promotion Name</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->promotion_name . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Start Period</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->periode_awal . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">End Period</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->periode_akhir . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Department</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_departemen . '</td>
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
          <td style="padding-left:20px; padding-right:20px;">Mechanism</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->sales_mechanism . '</td>
        </tr>
		</tbody>
	  </table>';

    if ($row_email != NULL || $row_email != '') {
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
      // $this->email->to($alamat_email);
      // $this->email->cc($alamat_cc);
      $this->email->to('development@mustika-ratu.co.id');
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
}
