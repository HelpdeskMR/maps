<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Reminders extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    is_login();
    $this->load->model('Reminders_model');
    $this->load->library('form_validation');
    $this->load->library('datatables');
    $this->load->library('session');
  }

  function index()
  {
    $data = array(
      'id_users' => set_value('id_users'),
    );
    $this->template->load('template', 'reminders/reminders', $data);
  }

  public function send_notif_finance()
  {
    //Load data
    $id_user = 14;
    // $id_user = $this->input->post('user', TRUE);
    $row_data = $this->Reminders_model->get_data_for_finance($id_user);
    $row_email = $this->Reminders_model->get_email($id_user);
    $alamat_email = $row_email->email;

    $message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_email->full_name . ',<br/>
        <br/>Mohon cek <b>Request Promotion</b> yang masih menunggu approve Bapak/Ibu ' . $row_email->full_name . ', berikut list nya :</p>
      </div>
	  <table border="1" bordercolor="#333333">
		<thead>
        <tr>
          <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">LIST PROMOTION FORM</font></b></td>
		</tr>
		</thead>
		<tbody>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Promotion NUmber</td>
          <td style="padding-left:20px; padding-right:20px;">';
    foreach ($row_data as $data) {
      $message .= '<p><a href="' . site_url() . 'wf_program/read/' . $data['promotion_id'] . '">' . $data['promotion_number'] . '</a></p><br/>';
    }
    $message .= '</td>
        </tr>
		</tbody>
	  </table>';

    //Send Email
    $this->load->library('email');

    $config['protocol'] = 'smtp';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;
    // $config['_smtp_auth'] = TRUE;
    $config['smtp_host'] = 'smtp.googlemail.com';
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
    $this->email->cc('development@mustika-ratu.co.id');
    $this->email->subject('Email Notification');
    $this->email->message($message);

    if ($this->email->send()) {
      $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
      redirect(site_url('reminders'));
    } else {
      $this->session->set_flashdata("email_sent", "Error in sending Email.");
      // show_error($this->email->print_debugger());
    }
  }

  public function send_notifikasi($promotion_number, $data_program)
  {
    //Load data
    $row_data = $this->Reminders_model->get_data($promotion_number);
    $row_cc = $this->Reminders_model->get_cc($promotion_number, $data_program);
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
    $this->email->to($alamat_email);
    $this->email->cc($email_cc);
    $this->email->subject('Promotion Number : ' . $promotion_number . ' ');
    $this->email->message($message);

    if ($this->email->send()) {
      $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
    } else {
      // $this->session->set_flashdata("email_sent","Error in sending Email.");
      show_error($this->email->print_debugger());
    }
  }
}
