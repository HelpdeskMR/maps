<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengganti_barang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Claim_model');
		$this->load->model('Pengganti_barang_model');
		$this->load->model('Promotion_header_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->library('session');
	}

	public function index()
	{
		$row_pengganti_barang = $this->Pengganti_barang_model->get_all();
		$row_pengganti_barang_history = $this->Pengganti_barang_model->get_all_history();
		$data = array(
			'row_pengganti_barang' => $row_pengganti_barang,
			'row_pengganti_barang_history' => $row_pengganti_barang_history,
		);

		$this->template->load('template', 'pengganti_barang/pengganti_barang_list', $data);
	}

	public function create()
	{
		$row_claim_barang = $this->Pengganti_barang_model->get_claim_barang();
		$data = array(
			'button' => 'Create',
			'action' => site_url('pengganti_barang/create_action'),
			'date_create' => set_value('date_create'),
			'claim_number' => set_value('claim_number'),
			'code_pengganti_barang' => set_value('code_pengganti_barang'),
			'product_code' => set_value('product_code'),
			'qty' => set_value('qty'),
			'SecLogDate' => set_value('SecLogDate'),
			'SecLogUser' => set_value('SecLogUser'),
			'row_claim_barang' => $row_claim_barang,
		);

		$this->template->load('template', 'pengganti_barang/pengganti_barang_form', $data);
	}

	public function create_action()
	{
		$kode = $this->Pengganti_barang_model->check_kode();
		$code_pengganti_barang = "PG-" . $kode;

		$date_create = $this->input->post('date_create', TRUE);
		$claim_number = $this->input->post('claim_number', TRUE);
		$product_name = $this->input->post('product_name', TRUE);
		$qty = $this->input->post('qty', TRUE);

		$pengganti_barang = array(
			'claim_number' => $claim_number,
			'code_pengganti_barang' => $code_pengganti_barang,
			'date_create' => $date_create,
			'status' => 1,
			'approval_scheme' => 1,
			'SecLogDate' => date('Y-m-d H:i:s'),
			'SecLogUser' => $this->session->userdata('full_name')
		);

		$this->Pengganti_barang_model->insert_pengganti_barang($pengganti_barang);

		if (array_filter($product_name)) {
			$productArray = array();

			$index = 0;
			foreach ($product_name as $data_product) {
				$add_product = array(
					'code_pengganti_barang' => $code_pengganti_barang,
					'product_code' => $data_product,
					'qty' => $qty[$index],
				);
				array_push($productArray, $add_product);
				$index++;
			}
			$this->Pengganti_barang_model->insert_product($productArray);
		}

		$row_list_approval = $this->Pengganti_barang_model->get_list_approval();
		$approvalArray = array();

		$index1 = 1;
		foreach ($row_list_approval as $data_approval) {
			$add_approval = array(
				'code_pengganti_barang' => $code_pengganti_barang,
				'approval_scheme' => $index1,
				'id_users' => $data_approval->id_users,
				'id_user_level' => $data_approval->id_user_level,
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name')
			);
			array_push($approvalArray, $add_approval);
			$index1++;
		}

		$this->Pengganti_barang_model->insert_approval($approvalArray);
		$this->send($code_pengganti_barang);

		$this->session->set_flashdata('message', 'Create Success');
		redirect(site_url('pengganti_barang'));
	}

	public function read($code)
	{
		$row_pengganti_barang = $this->Pengganti_barang_model->get_by_code($code);
		$id = $row_pengganti_barang->claim_number;
		$code = $row_pengganti_barang->code_pengganti_barang;
		$row = $this->Pengganti_barang_model->get_by_number($id);
		$row_product = $this->Pengganti_barang_model->get_product($code);
		$row_approval = $this->Pengganti_barang_model->get_approval($code);
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
				'row_approval' => $row_approval,
				'row_product' => $row_product,
			);
			$this->template->load('template', 'pengganti_barang/pengganti_barang_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('pengganti_barang'));
		}
	}

	function update($code)
	{
		$row_pengganti_barang = $this->Pengganti_barang_model->get_by_code($code);
		$claim_number = $row_pengganti_barang->claim_number;
		$code_pengganti_barang = $row_pengganti_barang->code_pengganti_barang;
		$date_create = $row_pengganti_barang->date_create;
		$row_claim_barang = $this->Pengganti_barang_model->get_claim_barang();
		$row_product = $this->Pengganti_barang_model->get_product($code);
		$data = array(
			'button' => 'Edit',
			'action' => site_url('pengganti_barang/update_action'),
			'date_create' => $date_create,
			'claim_number' => $claim_number,
			'code_pengganti_barang' => $code_pengganti_barang,
			'row_claim_barang' => $row_claim_barang,
			'product_code' => set_value('product_code'),
			'qty' => set_value('qty'),
			'row_product' => $row_product,
		);

		$this->template->load('template', 'pengganti_barang/pengganti_barang_form', $data);
	}

	function update_action()
	{
		$code_pengganti_barang = $this->input->post('code_pengganti_barang', TRUE);
		$date_create = $this->input->post('date_create', TRUE);
		$claim_number = $this->input->post('claim_number', TRUE);
		$product_name = $this->input->post('product_name', TRUE);
		$qty = $this->input->post('qty', TRUE);
		$row_pengganti_barang = $this->Pengganti_barang_model->get_by_code($code_pengganti_barang);

		//delete list product
		$this->Pengganti_barang_model->delete_by_code($code_pengganti_barang);

		if($row_pengganti_barang->status == 2 || $row_pengganti_barang->status == 3) {
			$pengganti_barang = array(
				'claim_number' => $claim_number,
				'date_create' => $date_create,
				'status' => 1,
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name')
			);

			$this->Pengganti_barang_model->update_pengganti_barang($pengganti_barang, $code_pengganti_barang);

			$wf_pengganti_barang = array(
				'approve_by' => NULL,
				'approval_date' => NULL,
				'reject_by' => NULL,
				'reject_date' => NULL,
				'reject_reason' => NULL,
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name')
			);

			$this->Pengganti_barang_model->update_wf_pengganti_barang($wf_pengganti_barang, $code_pengganti_barang);
			$this->send($code_pengganti_barang);
		} else {
			$pengganti_barang = array(
				'claim_number' => $claim_number,
				'date_create' => $date_create,
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name')
			);

			$this->Pengganti_barang_model->update_pengganti_barang($pengganti_barang, $code_pengganti_barang);
		}

		if (array_filter($product_name)) {
			$productArray = array();

			$index = 0;
			foreach ($product_name as $data_product) {
				$add_product = array(
					'code_pengganti_barang' => $code_pengganti_barang,
					'product_code' => $data_product,
					'qty' => $qty[$index],
				);
				array_push($productArray, $add_product);
				$index++;
			}
			$this->Pengganti_barang_model->insert_product($productArray);
		}

		$this->session->set_flashdata('message', 'Update Success');
		redirect(site_url('pengganti_barang'));
	}

	function delete($code)
	{
		$pengganti_barang = array(
			'status' => 3,
			'SecLogDate' => date('Y-m-d H:i:s'),
			'SecLogUser' => $this->session->userdata('full_name')
		);
		$this->Pengganti_barang_model->update_pengganti_barang($pengganti_barang, $code);

		$this->session->set_flashdata('message', 'Delete Success');
		redirect(site_url('pengganti_barang'));
	}

	function send($code_pengganti_barang)
	{
		$row_approval = $this->Pengganti_barang_model->get_approval_send($code_pengganti_barang);
		$email = $row_approval->email;
		$full_name = $row_approval->full_name;
		$row_password = $this->Promotion_header_model->get_password_email();
		$password = $row_password->password;

		$message = '<div>
        <p>Yth. Bapak/Ibu ' . $full_name . ',<br/><br/>A request <b>Product Gratis</b> has been submitted that requires your approval.</p>
      	</div>
		<div>
        <p>The request detail : <a href="' . site_url() . 'wf_pengganti_barang/read/' . $code_pengganti_barang . '">' . site_url() . 'wf_pengganti_barang/read/' . $code_pengganti_barang . '</a>.</p>
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
		$this->email->cc('development@mustika-ratu.co.id');
		$this->email->subject('Product Gratis : ' . $code_pengganti_barang . ' ');
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		} else {
			$this->session->set_flashdata("email_sent", "Error in sending Email.");
			// show_error($this->email->print_debugger());
		}
	}
}
