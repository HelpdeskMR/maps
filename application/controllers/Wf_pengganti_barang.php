<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Wf_pengganti_barang extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    is_login();
    $this->load->model('Wf_pengganti_barang_model');
    $this->load->model('Promotion_header_model');
    $this->load->model('Pengganti_barang_model');
    $this->load->library('form_validation');
    $this->load->library('datatables');
    $this->load->library('session');
  }

  public function index()
  {
    $row_pengganti_barang = $this->Wf_pengganti_barang_model->get_all_data();
    $data = array('row_pengganti_barang' => $row_pengganti_barang);
    $this->template->load('template', 'wf_pengganti_barang/wf_pengganti_barang_list', $data);
  }

  public function read($code)
  {
    $row_pengganti_barang = $this->Pengganti_barang_model->get_by_code($code);
    $id = $row_pengganti_barang->claim_number;
    $code = $row_pengganti_barang->code_pengganti_barang;
    $row = $this->Pengganti_barang_model->get_by_number($id);
    $row_product = $this->Pengganti_barang_model->get_product($code);
    if ($row) {
      $data = array(
        'claim_id' => $row->claim_id,
        'tgl_claim' => $row->tgl_claim,
        'claim_number' => $row->claim_number,
        'promotion_number' => $row->promotion_number,
        'promotion_name' => $row->promotion_name,
        'kode_distributor' => $row->kode_distributor,
        'nama_distributor' => $row->nama_distributor,
        'dpp' => $row->dpp,
        'ppn' => $row->ppn,
        'pph' => $row->pph,
        'total' => $row->total,
        'invoice_number' => $row->invoice_number,
        'invoice' => $row->invoice,
        'faktur_pajak_number' => $row->faktur_pajak_number,
        'faktur_pajak' => $row->faktur_pajak,
        'dokumen' => $row->dokumen,
        'pkp' => $row->pkp,
        'npwp' => $row->npwp,
        'keterangan' => $row->keterangan,
        'top' => $row->top,
        'due_date' => $row->due_date,
        'receive_status' => set_value('receive_status', $row->receive_status),
        'payment_plan' => $row->payment_plan,
        'payment_date' => $row->payment_date,
        'receive_date' => $row->receive_date,
        'dpp_rev' => $row->dpp_rev,
        'ppn_rev' => $row->ppn_rev,
        'pph_rev' => $row->pph_rev,
        'total_rev' => $row->total_rev,
        'mekanisme_claim' => $row->mekanisme_claim,
        'status_name' => $row->status_name,
        'status' => $row->statusClaim,
        'no_bukti_potong' => $row->no_bukti_potong,
        'bukti_potong' => $row->bukti_potong,
        'payment_method' => $row->payment_method,
        'row_pengganti_barang' => $row_pengganti_barang,
        'row_product' => $row_product,
        'code' => $code,
      );
      $this->template->load('template', 'wf_pengganti_barang/wf_pengganti_barang_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('wf_pengganti_barang'));
    }
  }

  /* APPROVAL PROGRAM */
  public function approve_action($code)
  {
    $row_pengganti_barang = $this->Wf_pengganti_barang_model->get_data($code);

    $wf_pengganti_barang = array(
      'approve_by' => $this->session->userdata('full_name'),
      'approval_date' => date('Y-m-d H:i:s')
    );
    $this->Wf_pengganti_barang_model->update_approval($wf_pengganti_barang, $code, $row_pengganti_barang->approval_scheme);

    $approval_check = $this->Wf_pengganti_barang_model->check_approval($code);
    if (empty($approval_check)) {
      $update_pengganti_barang = array(
        'status' => 4,
        'approval_scheme' => $row_pengganti_barang->approval_scheme,
        'SecLogDate' => date('Y-m-d H:i:s'),
        'SecLogUser' => $this->session->userdata('full_name')
      );

      $this->Wf_pengganti_barang_model->update_pengganti_barang($update_pengganti_barang, $code);
    } else {
      $update_pengganti_barang = array(
        'approval_scheme' => $row_pengganti_barang->approval_scheme + 1,
        'SecLogDate' => date('Y-m-d H:i:s'),
        'SecLogUser' => $this->session->userdata('full_name')
      );

      $this->Wf_pengganti_barang_model->update_pengganti_barang($update_pengganti_barang, $code);
      $this->send($code);
    }

    $this->session->set_flashdata('message', 'Update Record Success');
    redirect(site_url('wf_pengganti_barang'));
  }

  /* REJECT PROGRAM */
  public function reject_action()
  {
    $code = $this->input->post('code', TRUE);
    $reject_reason = $this->input->post('reject_reason', TRUE);

    $row_pengganti_barang = $this->Wf_pengganti_barang_model->get_data($code);

    $wf_pengganti_barang = array(
      'reject_by' => $this->session->userdata('full_name'),
      'reject_date' => date('Y-m-d H:i:s'),
      'reject_reason' => $reject_reason,
    );
    $this->Wf_pengganti_barang_model->update_approval($wf_pengganti_barang, $code, $row_pengganti_barang->approval_scheme);

    $update_pengganti_barang = array(
      'status' => 2,
      'SecLogDate' => date('Y-m-d H:i:s'),
      'SecLogUser' => $this->session->userdata('full_name')
    );

    $this->Wf_pengganti_barang_model->update_pengganti_barang($update_pengganti_barang, $code);
    $this->send_reject($code);

    $this->session->set_flashdata('message', 'Update Record Success');
    redirect(site_url('wf_pengganti_barang'));
  }

  public function send($code)
  {
    //Load data
    $row_approval = $this->Wf_pengganti_barang_model->get_approval_send($code);
		$email = $row_approval->email;
		$full_name = $row_approval->full_name;
		$row_password = $this->Promotion_header_model->get_password_email();
		$password = $row_password->password;

    $message = '<div>
        <p>Yth. Bapak/Ibu ' . $full_name . ',<br/><br/>A request by <b>Product Gratis</b> has been submitted that requires your approval.</p>
      </div>
		<div>
        <p>The request detail : <a href="' . site_url() . 'wf_pengganti_barang/read/' . $code . '">' . site_url() . 'wf_pengganti_barang/read/' . $code . '</a>.</p>
	  </div>';

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
    // $this->email->to($email);
    $this->email->bcc('development@mustika-ratu.co.id');
    $this->email->subject('Product Gratis : ' . $code . ' ');
    $this->email->message($message);

    if ($this->email->send()) {
      $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
    } else {
      $this->session->set_flashdata("email_sent", "Error in sending Email.");
      // show_error($this->email->print_debugger());
    }
  }

  public function send_reject($code)
  {
    //Load data
    $row_approval = $this->Wf_pengganti_barang_model->get_approval_send($code);
    $reject_by = $row_approval->reject_by;
    $reject_date = $row_approval->reject_date;
    $reject_reason = $row_approval->reject_reason;
		$row_password = $this->Promotion_header_model->get_password_email();
		$password = $row_password->password;

    $message = '<div>
        <p>Yth. Bapak/Ibu Distributor Service,<br/><br/>Your request has been rejected by ' . $reject_by . '.<br/>Reject date : ' . $reject_date . '.<br/>Reject reason : ' . $reject_reason . '.</p>
      </div>
		<div>
        <p>The request detail : <a href="' . site_url() . 'pengganti_barang/read/' . $code . '">' . site_url() . 'pengganti_barang/read/' . $code . '</a>.</p>
	  </div>';

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
    // $this->email->to('distributor.service@mustika-ratu.co.id');
    $this->email->cc('development@mustika-ratu.co.id');
    $this->email->subject('Product Gratis : ' . $code . ' ');
    $this->email->message($message);

    if ($this->email->send()) {
      $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
    } else {
      $this->session->set_flashdata("email_sent", "Error in sending Email.");
      // show_error($this->email->print_debugger());
    }
  }
}
