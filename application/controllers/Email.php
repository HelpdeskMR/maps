<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Email extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->library('datatables');
		// $this->load->library('email');
	}

	public function index()
	{
		$data = array(
			'button' => 'Send',
			'action' => site_url('email/send_email'),
			'alamat_email' => set_value('alamat_email'),
			'message' => set_value('message'),
			'subject' => set_value('subject'),
		);
		$this->template->load('template', 'email/email_form', $data);
	}

	public function send_email()
	{
		//Load data
		$alamat_email = $this->input->post('alamat_email', TRUE);
		$message = $this->input->post('message', TRUE);
		$subject = $this->input->post('subject', TRUE);
		$port = $this->input->post('port', TRUE);

		// $config = array(
		// 	'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		// 	'smtp_host' => 'smtp.googlemail.com',
		// 	'smtp_port' => 465,
		// 	'smtp_user' => 'mustikaratu.mailer@gmail.com',
		// 	'smtp_pass' => 'mustikagoogle',
		// 	'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
		// 	'mailtype' => 'html', //plaintext 'text' mails or 'html'
		// 	'smtp_timeout' => '4', //in seconds
		// 	'charset' => 'iso-8859-1',
		// 	'wordwrap' => TRUE
		// );
		// $this->load->library('email', $config);
		// $this->email->set_newline("\r\n");

		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'smtp.office365.com';
		$config['smtp_port'] = $port;
		$config['smtp_user'] = 'development@mustika-ratu.co.id';
		$config['smtp_pass'] = 'Mustika@dev';
		$config['mailtype'] = 'html';
		$config['smtp_crypto'] = 'tls';

		$this->load->library('email', $config);

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
		$this->email->from('development@mustika-ratu.co.id', 'MAPS');
		$this->email->to($alamat_email);
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
			redirect('email');
		} else {
			show_error($this->email->print_debugger());
			// $this->session->set_flashdata("email_sent", $error);
			redirect('email');
		}
	}
}
