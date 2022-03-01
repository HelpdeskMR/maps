<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Wf_program extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    is_login();
    $this->load->model('Wf_program_model');
    $this->load->model('Promotion_header_model');
    $this->load->library('form_validation');
    $this->load->library('datatables');
    $this->load->library('session');
  }

  public function index()
  {
    $row_get_promotionId = $this->Promotion_header_model->get_all_data();
    $data = array('row_get_promotionId' => $row_get_promotionId);
    $this->template->load('template', 'wf_program/wf_program_list', $data);
  }

  public function json()
  {
    header('Content-Type: application/json');
    echo $this->Wf_program_model->json();
  }


  public function create()
  {
    $data = array(
      'button' => 'Create',
      'action' => site_url('wf_program/create_action'),
      'id' => set_value('id'),
      'no_p3' => set_value('no_p3'),
      'approval_scheme' => set_value('approval_scheme'),
      'id_user_level' => set_value('id_user_level'),
      'approve_by' => set_value('approve_by'),
      'approval_date' => set_value('approval_date'),
      'SecLogDate' => set_value('SecLogDate'),
      'SecLogUser' => set_value('SecLogUser'),
    );
    $this->template->load('template', 'wf_program/wf_program_form', $data);
  }

  public function create_action()
  {

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $data = array(
        'promotion_number' => $this->input->post('promotion_number', TRUE),
        'approval_scheme' => $this->input->post('approval_scheme', TRUE),
        'id_user_level' => $this->input->post('id_user_level', TRUE),
        'approve_by' => $this->input->post('approve_by', TRUE),
        'approval_date' => $this->input->post('approval_date', TRUE),
        'SecLogDate' => $this->input->post('SecLogDate', TRUE),
        'SecLogUser' => $this->input->post('SecLogUser', TRUE),
      );

      $this->Wf_program_model->insert($data);
      $this->session->set_flashdata('message', 'Create Record Success 2');
      redirect(site_url('wf_program'));
    }
  }

  public function read($id)
  {
    $row = $this->Promotion_header_model->get_by_id($id);
    $promotion_number = $row->promotion_number;
    $kode_departemen = $row->kode_departemen;
    $type = $row->type;
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
    $row_financial_kpi = $this->Promotion_header_model->get_financial_kpi($promotion_number, $kode_departemen);
    if($type == "2") {
      $row_product = $this->Promotion_header_model->get_product_gratis($promotion_number);
    } else {
      $row_product = $this->Promotion_header_model->get_product($promotion_number);
    }
    $row_listing_cost = $this->Promotion_header_model->get_listing_cost($promotion_number);
    $row_on_top_promo = $this->Promotion_header_model->get_on_top_promo($promotion_number, $kode_departemen);
    $row_trading_term = $this->Promotion_header_model->get_trading($promotion_number);
    $row_total_trading_term = $this->Promotion_header_model->get_total_trading($promotion_number);
    $row_get_promotionId = $this->Promotion_header_model->get_all_data();
    foreach ($row_on_top_promo as $data) {
      $gl_account_onTopPromo = $data->gl_account_code;
    }
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
        'business_unit_name' => $row->business_unit_name,
        'brand_name' => $row->brand_name,
        'series_name' => $row->series_name,
        'gl_account_onTopPromo' => $gl_account_onTopPromo,
        'type' => $type,
      );
      $this->template->load('template', 'wf_program/wf_program_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wf_program'));
    }
  }

  /* APPROVAL PROGRAM */
  public function approve_action($promotion_id)
  {
    $row = $this->Wf_program_model->get_by_id($promotion_id);
    if ($row) {
      $promotion_number = $row->promotion_number;
      $kode_departemen = $row->kode_departemen;
      $channel_code = $row->channel_code;
      $region_code = $row->region_code;
      /*UPDATE WORKFLOW*/
      $data = array(
        'approve_by' => $this->session->userdata('full_name'),
        'approval_date' => date('Y-m-d H:i:s')
      );
      $this->Wf_program_model->update_wf_program($row->approval_scheme, $row->promotion_number,  $data);

      /* UPDATE PROMOTION */
      $wf_program = $this->Wf_program_model->get_wf_program($promotion_number);
      if (empty($wf_program)) {
        $data_program = array(
          'status' => 4,
          'approval_scheme' => ($row->approval_scheme),
          'SecLogUser' => $this->session->userdata('full_name'),
          'SecLogDate' => date('Y-m-d H:i:s'),
        );
        if ($region_code != 0) {
          $this->send_distributor($promotion_number);
        }
      } else {
        $data_program = array(
          'status' => 1,
          'approval_scheme' => ($row->approval_scheme) + 1,
          'SecLogUser' => $this->session->userdata('full_name'),
          'SecLogDate' => date('Y-m-d H:i:s'),
        );

        // $this->send($promotion_number, $data_program);
      }

      $this->Wf_program_model->update_promotion($promotion_number, $data_program);
      // $this->send_notifikasi($promotion_number, $data_program);

      $this->session->set_flashdata('alert', 'Approval Success');
      redirect(site_url('wf_program'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wf_program'));
    }
  }

  /* REJECT PROGRAM */
  public function reject_action()
  {
    $promotion_id = $this->input->post('promotion_id', TRUE);

    $row = $this->Wf_program_model->get_by_id($promotion_id);
    if ($row) {
      $promotion_number = $row->promotion_number;
      $fiscal_year = $row->fiscal_year;

      /*UPDATE WORKFLOW*/
      $data = array(
        'reject_by' => $this->session->userdata('full_name'),
        'reject_date' => date('Y-m-d H:i:s'),
        'reject_reason' => $this->input->post('reject_reason', TRUE)
      );
      $this->Wf_program_model->update_wf_program($row->approval_scheme, $row->promotion_number,  $data);

      /*UPDATE PROGRAM*/
      $data_program = array(
        'status' => 2,
        'SecLogUser' => $this->session->userdata('full_name'),
        'SecLogDate' => date('Y-m-d H:i:s'),
      );
      $this->Wf_program_model->update_promotion($promotion_number, $data_program);

      /* LISTING COST UPDATE BUDGET */
      // if (array_filter($promotion_number)) {
      $row_listing = $this->Wf_program_model->listing_coa_segment($promotion_number);
      if ($row_listing > 0) {
        $index = 0;
        foreach ($row_listing as $listing_segment) {
          $listingCoaSegment[$index] = $listing_segment['gl_coa_segment'];
          $listing_amount[$index] = $listing_segment['amount'];
          $index++;
        }
        if (array_filter($listingCoaSegment)) {
          /* LISTING COST GL BUDGET */
          $row_listing_budget = $this->Wf_program_model->listing_budget_amount($listingCoaSegment);
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

          $this->Wf_program_model->update_budget_listing($budgetListingArray, $fiscal_year);
        }
      }

      /* ON TOP PROMO */
      // if (array_filter($promotion_number)) {
      $row_ontopPromo = $this->Wf_program_model->get_ontopPromo($promotion_number);
      // $gl_coa_segment = $row_ontopPromo['gl_coa_segment'];
      if ($row_ontopPromo > 0) {
        $index3 = 0;
        foreach ($row_ontopPromo as $data_ontopPromo) {
          $ontopPromo_coaSegment[$index3] = $data_ontopPromo['gl_coa_segment'];
          $ontopPromo_amount[$index3] = $data_ontopPromo['amount'];
          $index3++;
        }
        if (array_filter($ontopPromo_coaSegment)) {
          $row_ontopPromo_budget = $this->Wf_program_model->get_ontopPromo_budget_amount($ontopPromo_coaSegment);
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

          $this->Wf_program_model->update_budget_onTopPromo($budgetArray, $fiscal_year);
        }
      }

      /* TRADING TERM */
      // if (array_filter($promotion_number)) {
      $row_tradingTerm = $this->Wf_program_model->get_tradingTerm($promotion_number);
      // $gl_coa_segment_tradingTerm = $row_tradingTerm['gl_coa_segment'];
      if ($row_tradingTerm > 0) {
        $index5 = 0;
        foreach ($row_tradingTerm as $data_tradingTerm) {
          $tradingTerm_coaSegment[$index5] = $data_tradingTerm['gl_coa_segment'];
          $tradingTerm_amount[$index5] = $data_tradingTerm['amount'];
          $index5++;
        }
        if (array_filter($tradingTerm_coaSegment)) {
          $row_tradingTerm_budget = $this->Wf_program_model->get_tradingTerm_budget_amount($tradingTerm_coaSegment);
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

          $this->Wf_program_model->update_budget_tradingTerm($tradingTerm_budgetArray, $fiscal_year);
        }
      }

      $this->send_reject($promotion_number, $data_program, $data);
      $this->session->set_flashdata('alert', 'Reject Success');
      redirect(site_url('wf_program'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wf_program'));
    }
  }

  public function excel()
  {
    $this->load->helper('exportexcel');
    $namaFile = "wf_program.xls";
    $judul = "wf_program";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Approval Scheme");
    xlsWriteLabel($tablehead, $kolomhead++, "Id User Level");
    xlsWriteLabel($tablehead, $kolomhead++, "Approve By");
    xlsWriteLabel($tablehead, $kolomhead++, "Approval Date");
    xlsWriteLabel($tablehead, $kolomhead++, "SecLogDate");
    xlsWriteLabel($tablehead, $kolomhead++, "SecLogUser");

    foreach ($this->Wf_program_model->get_all() as $data) {
      $kolombody = 0;

      //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
      xlsWriteNumber($tablebody, $kolombody++, $nourut);
      xlsWriteLabel($tablebody, $kolombody++, $data->no_p3);
      xlsWriteNumber($tablebody, $kolombody++, $data->approval_scheme);
      xlsWriteNumber($tablebody, $kolombody++, $data->id_user_level);
      xlsWriteLabel($tablebody, $kolombody++, $data->approve_by);
      xlsWriteLabel($tablebody, $kolombody++, $data->approval_date);
      xlsWriteLabel($tablebody, $kolombody++, $data->SecLogDate);
      xlsWriteLabel($tablebody, $kolombody++, $data->SecLogUser);

      $tablebody++;
      $nourut++;
    }

    xlsEOF();
    exit();
  }

  public function send($promotion_number, $data_program)
  {
    //Load data
    $row_data = $this->Wf_program_model->get_data($promotion_number);
    $row_email = $this->Wf_program_model->get_email($promotion_number, $data_program);
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
    // $this->email->to($alamat_email);
    $this->email->bcc('development@mustika-ratu.co.id');
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
    $row_data = $this->Wf_program_model->get_data($promotion_number);
    $row_cc = $this->Wf_program_model->get_cc($promotion_number, $data_program);
    $alamat_email = $row_data->email;

    $index = 0;
    foreach ($row_cc as $cc) {
      $email_cc[$index] = $cc['email'];
      $index++;
    }

    $message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_data->pemohon . ',<br/><br/>Your request has been rejected by ' . $data['reject_by'] . '.<br/>Reject date : ' . $data['reject_date'] . '.<br/>Reject reason : ' . $data['reject_reason'] . '.</p>
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
    // $this->email->to($alamat_email);
    // $this->email->cc($email_cc);
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

  public function send_distributor($promotion_number)
  {
    //Load data
    $row_data = $this->Wf_program_model->get_data($promotion_number);
    $row_email = $this->Wf_program_model->get_email_distributor($promotion_number);
    $row_cc = $this->Wf_program_model->get_email_cc($promotion_number, $row_data->region_code, $row_data->kode_area);
    $row_approval = $this->Wf_program_model->get_approval($promotion_number);
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
    $row_password = $this->Promotion_header_model->get_password_email();
    $password = $row_password->password;

    $count = count($alamat_email);
		if ($count > 40) {
			$alamat_email = array_chunk($alamat_email, 40);
		} else {
			$alamat_email = array($alamat_email);
		}

    // print_r($alamat_email);
    // print_r($alamat_cc);
    // print_r($password);
    // die;
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
	  </table>
    <div><p>Approval List : </p></div>
    <table border="1" bordercolor="#333333">
      <thead>
        <th bgcolor="#3C8DBC" style="padding-right: 10px; text-align: center;"><font color="#FFFFFF">No</font></th>
        <th bgcolor="#3C8DBC" style="padding-right: 70px; text-align: center;"><center><font color="#FFFFFF">Status</font></center></th>
        <th bgcolor="#3C8DBC" style="padding-right: 70px; text-align: center;"><center><font color="#FFFFFF">Approved/Rejected By</font></center></th>
        <th bgcolor="#3C8DBC" style="padding-right: 120px; text-align: center;"><center><font color="#FFFFFF">Date</font></center></th>
		  </thead>
      <tbody>';
      foreach ($row_approval as $approval) {
        $message .= "<tr>"."<td width='250px'>".$approval['approval_scheme']."</td>"."<td>Approved</td>"."<td>".$approval['full_name']."</td>"."<td>".$approval['approval_date']."</td>"."</tr>";
      }
      $message .= '</tbody>
    </table>';

    if ($count > 40) {
      //Send Email1
      $config['protocol'] = 'smtp';
      $config['charset'] = 'iso-8859-1';
      $config['wordwrap'] = TRUE;
      $config['smtp_host'] = 'ssl://smtp.googlemail.com';
      $config['smtp_port'] = 465;
      $config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
      $config['smtp_pass'] = $password;
      $config['mailtype'] = 'html';

      $this->load->library('email', $config);

      $this->email->initialize($config);

      $this->email->set_newline("\r\n");
      $this->email->from('mustikaratu.mailer@gmail.com', 'MAPS');
      // $this->email->to($alamat_email[0]);
      // $this->email->cc($alamat_cc);
      $this->email->bcc('development@mustika-ratu.co.id');
      $this->email->subject('Promotion Number : ' . $promotion_number . ' ');
      $this->email->message($message);

      if ($this->email->send()) {
        $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
        // print_r('berhasil');
        // die;
      } else {
        $this->session->set_flashdata("email_sent", "Error in sending Email.");
        // show_error($this->email->print_debugger());
        // print_r('ga berhasil');
        // die;
      }

      //Send Email2
      $config['protocol'] = 'smtp';
      $config['charset'] = 'iso-8859-1';
      $config['wordwrap'] = TRUE;
      $config['smtp_host'] = 'ssl://smtp.googlemail.com';
      $config['smtp_port'] = 465;
      $config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
      $config['smtp_pass'] = $password;
      $config['mailtype'] = 'html';

      $this->load->library('email', $config);

      $this->email->initialize($config);

      $this->email->set_newline("\r\n");
      $this->email->from('mustikaratu.mailer@gmail.com', 'MAPS');
      // $this->email->to($alamat_email[1]);
      // $this->email->cc($alamat_cc);
      $this->email->bcc('development@mustika-ratu.co.id');
      $this->email->subject('Promotion Number : ' . $promotion_number . ' ');
      $this->email->message($message);

      if ($this->email->send()) {
        $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
        // print_r('berhasil');
        // die;
      } else {
        $this->session->set_flashdata("email_sent", "Error in sending Email.");
        // show_error($this->email->print_debugger());
        // print_r('ga berhasil');
        // die;
      }
    } else {
      //Send Email
      $config['protocol'] = 'smtp';
      $config['charset'] = 'iso-8859-1';
      $config['wordwrap'] = TRUE;
      $config['smtp_host'] = 'ssl://smtp.googlemail.com';
      $config['smtp_port'] = 465;
      $config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
      $config['smtp_pass'] = $password;
      $config['mailtype'] = 'html';

      $this->load->library('email', $config);

      $this->email->initialize($config);

      $this->email->set_newline("\r\n");
      $this->email->from('mustikaratu.mailer@gmail.com', 'MAPS');
      // $this->email->to($alamat_email);
      // $this->email->cc($alamat_cc);
      $this->email->bcc('development@mustika-ratu.co.id');
      $this->email->subject('Promotion Number : ' . $promotion_number . ' ');
      $this->email->message($message);

      if ($this->email->send()) {
        $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
        // print_r('berhasil');
        // die;
      } else {
        $this->session->set_flashdata("email_sent", "Error in sending Email.");
        // show_error($this->email->print_debugger());
        // print_r('ga berhasil');
        // die;
      }
    }
  }
}
