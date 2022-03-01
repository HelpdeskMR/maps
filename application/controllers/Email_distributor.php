<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Email_distributor extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->library('datatables');
		$this->load->model('Wf_program_model');
		$this->load->model('Promotion_header_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->library('session');
	}

	public function index()
	{
		$data = array(
			'button' => 'Send',
			'action' => site_url('email_distributor/send_distributor'),
			'promotion_number' => set_value('promotion_number'),
		);
		$this->template->load('template', 'email_distributor/email_distributor_form', $data);
	}

	public function send_distributor()
	{
		$promotion_number = $this->input->post('promotion_number', TRUE);
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
		$row_password = $this->Promotion_header_model->get_password_email();
		$password = $row_password->password;

		$count = count($alamat_email);
		if ($count > 50) {
			$alamat_email = array_chunk($alamat_email, 50);
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
	  </table>';

		if ($count > 50) {
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
			$this->email->to($alamat_email[0]);
			$this->email->cc($alamat_cc);
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
			$this->email->to($alamat_email[1]);
			$this->email->cc($alamat_cc);
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
			$this->email->to($alamat_email);
			$this->email->cc($alamat_cc);
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

		redirect(site_url('email_distributor'));
	}
}
