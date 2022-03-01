<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Claim extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Claim_model');
		$this->load->model('Wf_claim_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->library('session');
	}

	public function index()
	{
		$kode_distributor = $this->session->userdata('kode_distributor');
		$store_code = $this->session->userdata('store_code');
		$region = $this->session->userdata('region_code');
		$row_promotion = $this->Claim_model->get_promotion($store_code, $kode_distributor, $region);
		$row_claim = $this->Claim_model->get_claim();
		$row_claim_history = $this->Claim_model->get_claim_history();
		$data = array(
			'button' => 'Create',
			'action' => site_url('claim/create_action'),
			'claim_id' => set_value('claim_id'),
			'tgl_claim' => set_value('tgl_claim'),
			'claim_number' => set_value('claim_number'),
			'promotion_number' => set_value('promotion_number'),
			'kode_distributor' => set_value('kode_distributor'),
			'nama_distributor' => set_value('nama_distributor'),
			'dpp' => set_value('dpp'),
			'ppn' => set_value('ppn'),
			'pph' => set_value('pph'),
			'total' => set_value('total'),
			'invoice_number' => set_value('invoice_number'),
			'invoice' => set_value('invoice'),
			'faktur_pajak_number' => set_value('faktur_pajak_number'),
			'faktur_pajak' => set_value('faktur_pajak'),
			'pkp' => set_value('pkp'),
			'npwp' => set_value('npwp'),
			'keterangan' => set_value('keterangan'),
			'pemohon' => set_value('pemohon'),
			'status' => set_value('status'),
			'payment_date' => set_value('payment_date'),
			'approval_scheme' => set_value('approval_scheme'),
			'SecLogDate' => set_value('SecLogDate'),
			'SecLogUser' => set_value('SecLogUser'),
			'row_promotion' => $row_promotion,
			'row_claim' => $row_claim,
			'row_claim_history' => $row_claim_history,
		);

		$this->template->load('template', 'claim/claim_form', $data);
	}



	public function create_action()
	{
		$this->_rules();

		$kode_distributor = $this->session->userdata('kode_distributor');
		$store_code = $this->session->userdata('store_code');
		$bulan = date("m");
		$tahun = date("Y");
		$kode = $this->Claim_model->buat_kode();
		$claim_number = "CLAIM/" . $bulan . "/" . $tahun . "/" . $kode;
		$promotion_number = $this->input->post('promotion_number', TRUE);

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			//upload file
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
			$config['max_size']	= 20000;
			// $config['max_width']  = 1024;
			// $config['max_height']  = 768;
			$config['file_name'] = str_replace('%','',$_FILES["invoice"]['name']);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$upload_invoice = 'invoice';
			if (!$this->upload->do_upload($upload_invoice)) {
				$error = $this->upload->display_errors();
				$data_invoice = array('file_name' => "");
			} else {
				$data_invoice = $this->upload->data();
			}

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
			$config['max_size']	= 20000;
			// $config['max_width']  = 1024;
			// $config['max_height']  = 768;
			$config['file_name'] = str_replace('%','',$_FILES["faktur_pajak"]['name']);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$upload_faktur = 'faktur_pajak';
			if (!$this->upload->do_upload($upload_faktur)) {
				$error = $this->upload->display_errors();
				$data_faktur = array('file_name' => "");
			} else {
				$data_faktur = $this->upload->data();
			}

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
			$config['max_size']	= 20000;
			// $config['max_width']  = 1024;
			// $config['max_height']  = 768;
			$config['file_name'] = str_replace('%','',$_FILES["dokumen"]['name']);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$dokumen = 'dokumen';
			if (!$this->upload->do_upload($dokumen)) {
				$error = $this->upload->display_errors();
				$data_dokumen = array('file_name' => "");
			} else {
				$data_dokumen = $this->upload->data();
			}

			$data = array(
				'tgl_claim' => $this->input->post('tgl_claim', TRUE),
				'claim_number' => $claim_number,
				'promotion_number' => $promotion_number,
				'kode_distributor' => $kode_distributor . $store_code,
				'nama_distributor' => $this->input->post('nama_distributor', TRUE),
				'dpp' => $this->input->post('dpp', TRUE),
				'ppn' => $this->input->post('ppn', TRUE),
				'pph' => $this->input->post('pph', TRUE),
				'total' => $this->input->post('total', TRUE),
				'invoice_number' => $this->input->post('invoice_number', TRUE),
				'invoice' => $data_invoice['file_name'],
				'faktur_pajak_number' => $this->input->post('faktur_pajak_number', TRUE),
				'faktur_pajak' => $data_faktur['file_name'],
				'dokumen' => $data_dokumen['file_name'],
				'pkp' => $this->input->post('pkp', TRUE),
				'npwp' => $this->input->post('npwp', TRUE),
				'keterangan' => $this->input->post('keterangan', TRUE),
				'mekanisme_claim' => $this->input->post('mekanisme_claim', TRUE),
				'pemohon' => $this->session->userdata('full_name'),
				'status' => 0,
				'approval_scheme' => 1,
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name'),
			);


			// $row = $this->Claim_model->get_budget_program($promotion_number);
			// $PromotionTotalSaldo = $row->promotion_total_saldo;

			// if ($this->input->post('total') > $PromotionTotalSaldo) {
			// 	$this->session->set_flashdata('over_budget', 'Over Budget untuk Total Klaim Rp. ' . $this->input->post('total') . ', Sisa Budget Program yang tersedia Rp. ' . $PromotionTotalSaldo . '');
			// 	redirect('claim');
			// } else {
			$this->Claim_model->insert($data);

			// $row = $this->Claim_model->get_budget_program($promotion_number);
			// // /* sku_total_usage */
			// $promotionTotalUsage = $row->promotion_total_usage;
			// $TotalClaim = $this->input->post('total');
			// $TotalPromotionUsage = $promotionTotalUsage + $TotalClaim;

			// // /* sku_total_saldo */
			// $PromotionTotalSaldo = $row->promotion_total_saldo;
			// $TotalPromotionSaldo = $PromotionTotalSaldo - $TotalClaim;

			// // /* UPDATE MASTER BUDGET */
			// $Usage = array(
			// 	'promotion_total_usage' => $TotalPromotionUsage,
			// 	'promotion_total_saldo' => $TotalPromotionSaldo,
			// 	'SecLogDate' => date('Y-m-d H:i:s'),
			// 	'SecLogUser' => $this->session->userdata('full_name'),
			// );

			// $this->Claim_model->update_usage($promotion_number, $Usage);

			/* CREATE APPROVAL CLAIM TO DISTRIBUTOR SERVICE*/
			// $onTopPromo = $this->Claim_model->get_onTopPromo($promotion_number);
			// $total_on_top_promo = $onTopPromo->total_on_top_promo;
			$SecLogDate = date('Y-m-d H:i:s');
			$SecLogUser = $this->session->userdata('full_name');
			// $insertArray = array();
			// $row = $this->Claim_model->get_approval($kode_distributor, $store_code, $total_on_top_promo);
			$row = $this->Claim_model->get_approval($kode_distributor);
			if ($store_code != Null || $store_code != '') {
				$insertArray = array(
					'no_claim' => $claim_number,
					'approval_scheme' => 1,
					'kode_distributor' => $kode_distributor,
					'store_code' => $store_code,
					'id_user_level' => 13,
					'id_users' => 39,
					'approve_by' => NULL,
					'approval_date' => NULL,
					'reject_by' => NULL,
					'reject_date' => NULL,
					'reject_reason' => NULL,
					'SecLogDate' => $SecLogDate,
					'SecLogUser' => $SecLogUser
				);
			} else {
				$insertArray = array(
					'no_claim' => $claim_number,
					'approval_scheme' => 1,
					'kode_distributor' => $kode_distributor,
					'store_code' => $store_code,
					'id_user_level' => 13,
					'id_users' => $row->id_users,
					'approve_by' => NULL,
					'approval_date' => NULL,
					'reject_by' => NULL,
					'reject_date' => NULL,
					'reject_reason' => NULL,
					'SecLogDate' => $SecLogDate,
					'SecLogUser' => $SecLogUser
				);
			}
			// $index = 1;
			// foreach ($row as $data_claim) {
			// $insertArray = array(
			// 	'no_claim' => $claim_number,
			// 	'approval_scheme' => 1,
			// 	'kode_distributor' => $kode_distributor,
			// 	'store_code' => $store_code,
			// 	'id_user_level' => 13,
			// 	'id_users' => 39,
			// 	'approve_by' => NULL,
			// 	'approval_date' => NULL,
			// 	'reject_by' => NULL,
			// 	'reject_date' => NULL,
			// 	'reject_reason' => NULL,
			// 	'SecLogDate' => $SecLogDate,
			// 	'SecLogUser' => $SecLogUser
			// );

			// 	array_push($insertArray, $new_add);
			// 	$index++;
			// }

			$this->Claim_model->insert_wf_claim($insertArray);
			$this->send($claim_number, $data);

			$this->session->set_flashdata('message', 'Create Record Success');
			redirect('claim');
			// }
		}
	}

	function get_promotion_name()
	{
		$promotion_number = $this->input->post('id', TRUE);
		$data = $this->Claim_model->get_promotion_name($promotion_number)->result();
		echo json_encode($data);
	}

	// public function json()
	// {
	// 	header('Content-Type: application/json');
	// 	echo $this->Claim_model->json();
	// }

	public function read($id)
	{
		$row = $this->Claim_model->get_by_id($id);
		$row_get_claimId = $this->Claim_model->get_all();
		$claim_number = $row->claim_number;
		$promotion_number = $row->promotion_number;
		$wf_claim = $this->Claim_model->wfClaim($claim_number);
		$row_budgetPromotion = $this->Claim_model->get_budgetPromotion($promotion_number);
		if ($row) {
			$data = array(
				'id' => $row->id,
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
				'row_get_claimId' => $row_get_claimId,
				'promotion_total_saldo' => $row->promotion_total_saldo,
				'promotion_total_cost' => $row->promotion_total_cost,
				'top' => set_value('top',  $row->top),
				// 'top' => $row->top,
				'due_date' => $row->due_date,
				'receive_status' => set_value('receive_status', $row->receive_status),
				'payment_plan' => $row->payment_plan,
				'payment_date' => $row->payment_date,
				'receive_date' => $row->receive_date,
				'wf_claim' => $wf_claim,
				'dpp_rev' => $row->dpp_rev,
				'ppn_rev' => $row->ppn_rev,
				'pph_rev' => $row->pph_rev,
				'total_rev' => $row->total_rev,
				'mekanisme_claim' => $row->mekanisme_claim,
				'status_name' => $row->status_name,
				'status' => $row->statusClaim,
				'wfLogDate' => $row->wfLogDate,
				'reject_reason' => $row->reject_reason,
				'no_bukti_potong' => $row->no_bukti_potong,
				'bukti_potong' => $row->bukti_potong,
				'row_budgetPromotion' => $row_budgetPromotion,
				'payment_method' => $row->payment_method,
			);
			$this->template->load('template', 'claim/form_claim_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_claim'));
		}
	}

	public function update($id)
	{
		$row = $this->Claim_model->get_by_id($id);
		$kode_distributor = $this->session->userdata('kode_distributor');
		$store_code = $this->session->userdata('store_code');
		$region = $this->session->userdata('region_code');
		$row_promotion = $this->Claim_model->get_promotion($store_code, $kode_distributor, $region);
		if ($row->receive_status == 0) {
			if ($row) {
				$data = array(
					'button' => 'Update',
					'action' => site_url('claim/update_action'),
					'claim_id' => set_value('claim_id', $row->claim_id),
					'tgl_claim' => set_value('tgl_claim', $row->tgl_claim),
					'claim_number' => set_value('claim_number', $row->claim_number),
					'promotion_number' => set_value('promotion_number', $row->promotion_number),
					'kode_distributor' => set_value('kode_distributor', $row->kode_distributor),
					'nama_distributor' => set_value('nama_distributor', $row->nama_distributor),
					'dpp' => set_value('dpp', number_format($row->dpp, 0, '.', '')),
					'ppn' => set_value('ppn', number_format($row->ppn, 0, '.', '')),
					'pph' => set_value('pph', number_format($row->pph, 0, '.', '')),
					'total' => set_value('total', number_format($row->total, 0, '.', '')),
					'invoice_number' => set_value('invoice_number', $row->invoice_number),
					'invoice' => set_value('invoice', $row->invoice),
					'faktur_pajak_number' => set_value('faktur_pajak_number', $row->faktur_pajak_number),
					'faktur_pajak' => set_value('faktur_pajak', $row->faktur_pajak),
					'dokumen' => set_value('dokumen', $row->dokumen),
					'mekanisme_claim' => set_value('mekanisme_claim', $row->mekanisme_claim),
					'pkp' => set_value('pkp', $row->pkp),
					'npwp' => set_value('npwp', $row->npwp),
					'keterangan' => set_value('keterangan', $row->keterangan),
					'pemohon' => set_value('pemohon', $row->pemohon),
					'status' => set_value('status', $row->status),
					'payment_date' => set_value('payment_date', $row->payment_date),
					'approval_scheme' => set_value('approval_scheme', $row->approval_scheme),
					'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
					'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
					'row_promotion' => $row_promotion,
					'nilai_ppn' => $row->dpp * ($row->ppn / 100),
					'nilai_pph' => $row->dpp * ($row->pph / 100),
				);
				$this->template->load('template', 'claim/claim_form_update', $data);
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('claim'));
			}
		} elseif ($this->session->userdata('id_user_level') == 13) {
			if ($row) {
				$data = array(
					'action' => site_url('wf_claim/update_action'),
					'id' => set_value('id', $row->id),
					'claim_id' => set_value('claim_id', $row->claim_id),
					'no_claim' => set_value('no_claim', $row->no_claim),
					'promotion_number' => set_value('promotion_number', $row->promotion_number),
					'kode_distributor' => set_value('kode_distributor', $row->kode_distributor),
					'nama_distributor' => set_value('nama_distributor', $row->nama_distributor),
					'promotion_name' => set_value('promotion_name', $row->promotion_name),
					'tgl_claim' => set_value('tgl_claim', $row->tgl_claim),
					'keterangan' => set_value('keterangan', $row->keterangan),
					'dpp' => set_value('dpp', $row->dpp),
					'ppn' => set_value('ppn', $row->ppn),
					'pph' => set_value('pph', $row->pph),
					'total' => set_value('total', $row->total),
					'invoice_number' => set_value('invoice_number', $row->invoice_number),
					'invoice' => set_value('invoice', $row->invoice),
					'faktur_pajak_number' => set_value('faktur_pajak_number', $row->faktur_pajak_number),
					'faktur_pajak' => set_value('faktur_pajak', $row->faktur_pajak),
					'dokumen' => set_value('dokumen', $row->dokumen),
					'npwp' => set_value('npwp', $row->npwp),
					'pkp' => set_value('pkp', $row->pkp),
					'dpp_rev' => set_value('dpp_rev'),
					'ppn_rev' => set_value('ppn_rev'),
					'pph_rev' => set_value('pph_rev'),
					'total_rev' => set_value('total_rev'),
					'mekanisme_claim' => set_value('mekanisme_claim', $row->mekanisme_claim),
					'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
					'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
					'row_promotion' => $row_promotion,
					'statusClaim' => $row->statusClaim,
					'payment_method' => set_value('payment_method', $row->payment_method),
				);
				$this->template->load('template', 'wf_claim/wf_claim_edit', $data);
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('claim'));
			}
		} else {
			$this->session->set_flashdata('error', 'Claim sudah di receive oleh team Distributor Service, mohon hubungi team Distributor Service untuk merevisi pengajuan claim.');
			redirect(site_url('claim'));
		}
	}

	public function update_action()
	{
		$id = $this->input->post('claim_id', TRUE);
		$promotion_number = $this->input->post('promotion_number', TRUE);
		$row_claim = $this->Claim_model->get_by_id($id);

		//upload file
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
		$config['max_size']    = 20000;
		// $config['max_width']  = 1024;
		// $config['max_height']  = 768;
		$config['file_name'] = str_replace('%','',$_FILES["invoice"]['name']);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$upload_invoice = 'invoice';
		if (!$this->upload->do_upload($upload_invoice)) {
			$error = $this->upload->display_errors();
			$data_invoice = array('file_name' => $row_claim->invoice);
		} else {
			$data_invoice = $this->upload->data();
		}

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
		$config['max_size']    = 20000;
		// $config['max_width']  = 1024;
		// $config['max_height']  = 768;
		$config['file_name'] = str_replace('%','',$_FILES["faktur_pajak"]['name']);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$upload_faktur = 'faktur_pajak';
		if (!$this->upload->do_upload($upload_faktur)) {
			$error = $this->upload->display_errors();
			$data_faktur = array('file_name' => $row_claim->faktur_pajak);
		} else {
			$data_faktur = $this->upload->data();
		}

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
		$config['max_size']    = 20000;
		// $config['max_width']  = 1024;
		// $config['max_height']  = 768;
		$config['file_name'] = str_replace('%','',$_FILES["dokumen"]['name']);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$dokumen = 'dokumen';
		if (!$this->upload->do_upload($dokumen)) {
			$error = $this->upload->display_errors();
			$data_dokumen = array('file_name' => $row_claim->dokumen);
		} else {
			$data_dokumen = $this->upload->data();
		}

		$data = array(
			'tgl_claim' => $this->input->post('tgl_claim', TRUE),
			'promotion_number' => $promotion_number,
			'kode_distributor' => $this->input->post('kode_distributor', TRUE),
			'nama_distributor' => $this->input->post('nama_distributor', TRUE),
			'dpp' => $this->input->post('dpp', TRUE),
			'ppn' => $this->input->post('ppn', TRUE),
			'pph' => $this->input->post('pph', TRUE),
			'total' => $this->input->post('total', TRUE),
			'invoice_number' => $this->input->post('invoice_number', TRUE),
			'invoice' => $data_invoice['file_name'],
			'faktur_pajak_number' => $this->input->post('faktur_pajak_number', TRUE),
			'faktur_pajak' => $data_faktur['file_name'],
			'dokumen' => $data_dokumen['file_name'],
			'pkp' => $this->input->post('pkp', TRUE),
			'npwp' => $this->input->post('npwp', TRUE),
			'keterangan' => $this->input->post('keterangan', TRUE),
			'mekanisme_claim' => $this->input->post('mekanisme_claim', TRUE),
			'SecLogDate' => date('Y-m-d H:i:s'),
			'SecLogUser' => $this->session->userdata('full_name'),
		);

		$this->Claim_model->update($id, $data);
		$this->session->set_flashdata('message', 'Update Record Success');
		redirect(site_url('claim'));
	}

	public function delete($id)
	{
		$row = $this->Form_claim_model->get_by_id($id);

		if ($row) {
			$this->Form_claim_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('claim'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('claim'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('tgl_claim', 'tgl claim', 'trim|required');
		// $this->form_validation->set_rules('claim_number', 'claim number', 'trim|required');
		$this->form_validation->set_rules('promotion_number', 'promotion number', 'trim|required');
		$this->form_validation->set_rules('kode_distributor', 'kode distributor', 'trim|required');
		$this->form_validation->set_rules('nama_distributor', 'nama distributor', 'trim|required');
		// $this->form_validation->set_rules('dpp', 'dpp', 'trim|required|numeric');
		// $this->form_validation->set_rules('ppn', 'ppn', 'trim|required|numeric');
		// $this->form_validation->set_rules('pph', 'pph', 'trim|required|numeric');
		// $this->form_validation->set_rules('total', 'total', 'trim|required|numeric');
		// $this->form_validation->set_rules('invoice_number', 'invoice number', 'trim|required');
		// $this->form_validation->set_rules('invoice', 'invoice', 'trim|required');
		// $this->form_validation->set_rules('faktur_pajak_number', 'faktur pajak number', 'trim|required');
		// $this->form_validation->set_rules('faktur_pajak', 'faktur pajak', 'trim|required');
		// $this->form_validation->set_rules('pkp', 'pkp', 'trim|required');
		// $this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
		// $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
		// $this->form_validation->set_rules('pemohon', 'pemohon', 'trim|required');
		// $this->form_validation->set_rules('status', 'status', 'trim|required');
		// $this->form_validation->set_rules('payment_date', 'payment date', 'trim|required');
		// $this->form_validation->set_rules('approval_scheme', 'approval scheme', 'trim|required');
		// $this->form_validation->set_rules('SecLogDate', 'seclogdate', 'trim|required');
		// $this->form_validation->set_rules('SecLogUser', 'secloguser', 'trim|required');
		$this->form_validation->set_rules('claim_id', 'claim_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$startDate = $this->input->post('startDate', TRUE);
		$endDate = $this->input->post('endDate', TRUE);
		$channel_code = $this->input->post('channel_code', TRUE);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle("Claim");

		$styleArray = [
			'borders' => [
				'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
				'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
				'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
				'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
			],
		];

		/* SHEET 1 */
		// $excel->setActiveSheetIndex(0);
		$sheet->setCellValue('U1', "Pengajuan Klaim");
		$sheet->setCellValue('Y1', "Klaim Revisi");
		$sheet->setCellValue('AC1', "Trading Term");
		$sheet->setCellValue('AF1', "Listing Cost");
		$sheet->setCellValue('AI1', "On Top Promo");
		$sheet->mergeCells('A1:A2');
		$sheet->mergeCells('B1:B2');
		$sheet->mergeCells('C1:C2');
		$sheet->mergeCells('D1:D2');
		$sheet->mergeCells('E1:E2');
		$sheet->mergeCells('F1:F2');
		$sheet->mergeCells('G1:G2');
		$sheet->mergeCells('H1:H2');
		$sheet->mergeCells('I1:I2');
		$sheet->mergeCells('J1:J2');
		$sheet->mergeCells('K1:K2');
		$sheet->mergeCells('L1:L2');
		$sheet->mergeCells('M1:M2');
		$sheet->mergeCells('N1:N2');
		$sheet->mergeCells('O1:O2');
		$sheet->mergeCells('P1:P2');
		$sheet->mergeCells('Q1:Q2');
		$sheet->mergeCells('R1:R2');
		$sheet->mergeCells('S1:S2');
		$sheet->mergeCells('T1:T2');
		$sheet->mergeCells('U1:X1');
		$sheet->mergeCells('Y1:AB1');
		$sheet->mergeCells('AC1:AE1');
		$sheet->mergeCells('AF1:AH1');
		$sheet->mergeCells('AI1:AK1');
		$sheet->mergeCells('AL1:AL2');
		$sheet->mergeCells('AM1:AM2');
		$sheet->mergeCells('AN1:AN2');
		$sheet->mergeCells('AO1:AO2');

		// $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		// $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		// $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A1', "No");
		$sheet->setCellValue('B1', "Tanggal Klaim");
		$sheet->setCellValue('C1', "No Klaim");
		$sheet->setCellValue('D1', "No Promosi");
		$sheet->setCellValue('E1', "Kode Distributor/Store");
		$sheet->setCellValue('F1', "Nama Distributor/Store");
		$sheet->setCellValue('G1', "No Invoice");
		$sheet->setCellValue('H1', "No Faktur Pajak");
		$sheet->setCellValue('I1', "Mekanisme Klaim");
		$sheet->setCellValue('J1', "Pkp");
		$sheet->setCellValue('K1', "Npwp");
		$sheet->setCellValue('L1', "Keterangan");
		$sheet->setCellValue('M1', "Pemohon");
		$sheet->setCellValue('N1', "Status");
		$sheet->setCellValue('O1', "Tanggal Terima");
		$sheet->setCellValue('P1', "Status Terima");
		$sheet->setCellValue('Q1', "Top");
		$sheet->setCellValue('R1', "Due Date");
		$sheet->setCellValue('S1', "Payment Plan");
		$sheet->setCellValue('T1', "Payment Date");
		$sheet->setCellValue('U2', "Dpp");
		$sheet->setCellValue('V2', "Ppn");
		$sheet->setCellValue('W2', "Pph");
		$sheet->setCellValue('X2', "Total Klaim");
		$sheet->setCellValue('Y2', "Dpp");
		$sheet->setCellValue('Z2', "Ppn");
		$sheet->setCellValue('AA2', "Pph");
		$sheet->setCellValue('AB2', "Total Revisi");
		$sheet->setCellValue('AC2', "Activity");
		$sheet->setCellValue('AD2', "GL Account");
		$sheet->setCellValue('AE2', "GL Account Name");
		$sheet->setCellValue('AF2', "Activity");
		$sheet->setCellValue('AG2', "GL Account");
		$sheet->setCellValue('AH2', "GL Account Name");
		$sheet->setCellValue('AI2', "Activity");
		$sheet->setCellValue('AJ2', "GL Account");
		$sheet->setCellValue('AK2', "GL Account Name");
		$sheet->setCellValue('AL1', "Type Channel");
		$sheet->setCellValue('AM1', "Payment Method");
		$sheet->setCellValue('AN1', "Store");
		$sheet->setCellValue('AO1', "Region");

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
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
		$sheet->getStyle('V1')->applyFromArray($styleArray);
		$sheet->getStyle('W1')->applyFromArray($styleArray);
		$sheet->getStyle('X1')->applyFromArray($styleArray);
		$sheet->getStyle('Y1')->applyFromArray($styleArray);
		$sheet->getStyle('Z1')->applyFromArray($styleArray);
		$sheet->getStyle('AA1')->applyFromArray($styleArray);
		$sheet->getStyle('AB1')->applyFromArray($styleArray);
		$sheet->getStyle('AC1')->applyFromArray($styleArray);
		$sheet->getStyle('AD1')->applyFromArray($styleArray);
		$sheet->getStyle('AE1')->applyFromArray($styleArray);
		$sheet->getStyle('AF1')->applyFromArray($styleArray);
		$sheet->getStyle('AG1')->applyFromArray($styleArray);
		$sheet->getStyle('AH1')->applyFromArray($styleArray);
		$sheet->getStyle('AI1')->applyFromArray($styleArray);
		$sheet->getStyle('AJ1')->applyFromArray($styleArray);
		$sheet->getStyle('AK1')->applyFromArray($styleArray);
		$sheet->getStyle('AL1')->applyFromArray($styleArray);
		$sheet->getStyle('AM1')->applyFromArray($styleArray);
		$sheet->getStyle('AN1')->applyFromArray($styleArray);
		$sheet->getStyle('AO1')->applyFromArray($styleArray);

		$sheet->getStyle('A2')->applyFromArray($styleArray);
		$sheet->getStyle('B2')->applyFromArray($styleArray);
		$sheet->getStyle('C2')->applyFromArray($styleArray);
		$sheet->getStyle('D2')->applyFromArray($styleArray);
		$sheet->getStyle('E2')->applyFromArray($styleArray);
		$sheet->getStyle('F2')->applyFromArray($styleArray);
		$sheet->getStyle('G2')->applyFromArray($styleArray);
		$sheet->getStyle('H2')->applyFromArray($styleArray);
		$sheet->getStyle('I2')->applyFromArray($styleArray);
		$sheet->getStyle('J2')->applyFromArray($styleArray);
		$sheet->getStyle('K2')->applyFromArray($styleArray);
		$sheet->getStyle('L2')->applyFromArray($styleArray);
		$sheet->getStyle('M2')->applyFromArray($styleArray);
		$sheet->getStyle('N2')->applyFromArray($styleArray);
		$sheet->getStyle('O2')->applyFromArray($styleArray);
		$sheet->getStyle('P2')->applyFromArray($styleArray);
		$sheet->getStyle('Q2')->applyFromArray($styleArray);
		$sheet->getStyle('R2')->applyFromArray($styleArray);
		$sheet->getStyle('S2')->applyFromArray($styleArray);
		$sheet->getStyle('T2')->applyFromArray($styleArray);
		$sheet->getStyle('U2')->applyFromArray($styleArray);
		$sheet->getStyle('V2')->applyFromArray($styleArray);
		$sheet->getStyle('W2')->applyFromArray($styleArray);
		$sheet->getStyle('X2')->applyFromArray($styleArray);
		$sheet->getStyle('Y2')->applyFromArray($styleArray);
		$sheet->getStyle('Z2')->applyFromArray($styleArray);
		$sheet->getStyle('AA2')->applyFromArray($styleArray);
		$sheet->getStyle('AB2')->applyFromArray($styleArray);
		$sheet->getStyle('AC2')->applyFromArray($styleArray);
		$sheet->getStyle('AD2')->applyFromArray($styleArray);
		$sheet->getStyle('AE2')->applyFromArray($styleArray);
		$sheet->getStyle('AF2')->applyFromArray($styleArray);
		$sheet->getStyle('AG2')->applyFromArray($styleArray);
		$sheet->getStyle('AH2')->applyFromArray($styleArray);
		$sheet->getStyle('AI2')->applyFromArray($styleArray);
		$sheet->getStyle('AJ2')->applyFromArray($styleArray);
		$sheet->getStyle('AK2')->applyFromArray($styleArray);
		$sheet->getStyle('AL2')->applyFromArray($styleArray);
		$sheet->getStyle('AM2')->applyFromArray($styleArray);
		$sheet->getStyle('AN2')->applyFromArray($styleArray);
		$sheet->getStyle('AO2')->applyFromArray($styleArray);

		$claim = $this->Claim_model->get_claim_excel($startDate, $endDate, $channel_code);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 3; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($claim as $data) {
			if ($data['pkp'] == 1) {
				$pkp = 'PKP';
			} else {
				$pkp = 'NON PKP';
			}
			if ($data['receive_status'] == 1) {
				$receive_status = 'Recieved';
			} else {
				$receive_status = '';
			}
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $data['tgl_claim']);
			$sheet->setCellValue('C' . $numrow, $data['claim_number']);
			$sheet->setCellValue('D' . $numrow, $data['promotion_number']);
			$sheet->setCellValue('E' . $numrow, $data['kode_distributor']);
			$sheet->setCellValue('F' . $numrow, $data['nama_distributor']);
			$sheet->setCellValue('G' . $numrow, $data['invoice_number']);
			$sheet->setCellValue('H' . $numrow, $data['faktur_pajak_number']);
			$sheet->setCellValue('I' . $numrow, $data['mekanisme_claim']);
			$sheet->setCellValue('J' . $numrow, $pkp);
			$sheet->setCellValue('K' . $numrow, $data['npwp']);
			$sheet->setCellValue('L' . $numrow, $data['keterangan']);
			$sheet->setCellValue('M' . $numrow, $data['pemohon']);
			$sheet->setCellValue('N' . $numrow, $data['status_name']);
			$sheet->setCellValue('O' . $numrow, $data['receive_date']);
			$sheet->setCellValue('P' . $numrow, $receive_status);
			$sheet->setCellValue('Q' . $numrow, $data['top']);
			$sheet->setCellValue('R' . $numrow, $data['due_date']);
			$sheet->setCellValue('S' . $numrow, $data['payment_plan']);
			$sheet->setCellValue('T' . $numrow, $data['payment_date']);
			$sheet->setCellValue('U' . $numrow, $data['dpp']);
			$sheet->setCellValue('V' . $numrow, $data['ppn']);
			$sheet->setCellValue('W' . $numrow, $data['pph']);
			$sheet->setCellValue('X' . $numrow, $data['total']);
			$sheet->setCellValue('Y' . $numrow, $data['dpp_rev']);
			$sheet->setCellValue('Z' . $numrow, $data['ppn_rev']);
			$sheet->setCellValue('AA' . $numrow, $data['pph_rev']);
			$sheet->setCellValue('AB' . $numrow, $data['total_rev']);
			$sheet->setCellValue('AC' . $numrow, $data['trading_activity_name']);
			$sheet->setCellValue('AD' . $numrow, $data['AccountCode_trading']);
			$sheet->setCellValue('AE' . $numrow, $data['CoaDesc_trading']);
			$sheet->setCellValue('AF' . $numrow, $data['listing_activity_name']);
			$sheet->setCellValue('AG' . $numrow, $data['AccountCode_listing']);
			$sheet->setCellValue('AH' . $numrow, $data['CoaDesc_listing']);
			$sheet->setCellValue('AI' . $numrow, $data['promo_activity_name']);
			$sheet->setCellValue('AJ' . $numrow, $data['AccountCode_promo']);
			$sheet->setCellValue('AK' . $numrow, $data['CoaDesc_promo']);
			$sheet->setCellValue('AL' . $numrow, $data['channel_name']);
			$sheet->setCellValue('AM' . $numrow, $data['payment_method']);
			$sheet->setCellValue('AN' . $numrow, $data['store_name']);
			$sheet->setCellValue('AO' . $numrow, $data['nama_region']);

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
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
			$sheet->getStyle('V' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('W' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('X' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('Y' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('Z' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AA' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AB' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AC' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AD' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AE' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AF' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AG' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AH' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AI' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AJ' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AK' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AL' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AM' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AN' . $numrow)->applyFromArray($styleArray);
			$sheet->getStyle('AO' . $numrow)->applyFromArray($styleArray);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
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
		$sheet->getColumnDimension('V')->setWidth(20);
		$sheet->getColumnDimension('W')->setWidth(20);
		$sheet->getColumnDimension('X')->setWidth(20);
		$sheet->getColumnDimension('Y')->setWidth(20);
		$sheet->getColumnDimension('Z')->setWidth(20);
		$sheet->getColumnDimension('AA')->setWidth(20);
		$sheet->getColumnDimension('AB')->setWidth(20);
		$sheet->getColumnDimension('AC')->setWidth(20);
		$sheet->getColumnDimension('AD')->setWidth(20);
		$sheet->getColumnDimension('AE')->setWidth(20);
		$sheet->getColumnDimension('AF')->setWidth(20);
		$sheet->getColumnDimension('AG')->setWidth(20);
		$sheet->getColumnDimension('AH')->setWidth(20);
		$sheet->getColumnDimension('AI')->setWidth(20);
		$sheet->getColumnDimension('AJ')->setWidth(20);
		$sheet->getColumnDimension('AK')->setWidth(20);
		$sheet->getColumnDimension('AL')->setWidth(20);
		$sheet->getColumnDimension('AM')->setWidth(20);
		$sheet->getColumnDimension('AN')->setWidth(20);
		$sheet->getColumnDimension('AO')->setWidth(20);

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Claim-' . date('Y-m-d') . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function send($claim_number, $data)
	{
		//Load data
		$row_data = $this->Claim_model->get_data($claim_number);
		$row_email = $this->Claim_model->get_email($claim_number, $data);
		$alamat_email = $row_email->email;

		$message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_email->full_name . ',<br/><br/>A request by ' . $row_data->nama_distributor . ' has been submitted that requires your approval.</p>
      </div>
		<div>
        <p>The request detail : <a href="' . site_url() . 'wf_claim/read/' . $row_data->claim_id . '">' . site_url() . 'wf_claim/read/' . $row_data->claim_id . '</a>.</p>
	  </div>
	  <table border="1" bordercolor="#333333">
		<thead>
        <tr>
          <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">FORM CLAIM</font></b></td>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td style="padding-left:20px; padding-right:20px;">Claim Number</td>
		<td style="padding-left:20px; padding-right:20px;">' . $row_data->claim_number . '</td>
	  	</tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Date</td>
		  <td style="padding-left:20px; padding-right:20px;">' . $row_data->tgl_claim . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Distributor/Store</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_distributor . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">DPP</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->dpp . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">PPN 10%</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->ppn . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">PPPH 23</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->pph . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Total Claim</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total) . '</td>
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
		$config['smtp_pass'] = 'MustikaGoogle@MR2022';
		$config['mailtype'] = 'html';

		$this->load->library('email', $config);

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
		$this->email->from('mustikaratu.mailer@gmail.co.id', 'MAPS');
		$this->email->to($alamat_email);
		// $this->email->to('development@mustika-ratu.co.id');
		$this->email->subject('Claim Number : ' . $claim_number . ' ');
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		} else {
			$this->session->set_flashdata("email_sent", "Error in sending Email.");
			// show_error($this->email->print_debugger());
		}
	}

	function pdf($id)
	{
		$row = $this->Claim_model->get_by_id($id);
		$row_get_claimId = $this->Claim_model->get_all();
		$claim_number = $row->claim_number;
		$promotion_number = $row->promotion_number;
		$wf_claim = $this->Claim_model->wfClaim($claim_number);
		$row_budgetPromotion = $this->Claim_model->get_budgetPromotion($promotion_number);
		$data = array(
			'id' => $row->id,
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
			'row_get_claimId' => $row_get_claimId,
			'promotion_total_saldo' => $row->promotion_total_saldo,
			'promotion_total_cost' => $row->promotion_total_cost,
			'top' => set_value('top',  $row->top),
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
			'wfLogDate' => $row->wfLogDate,
			'reject_reason' => $row->reject_reason,
			'no_bukti_potong' => $row->no_bukti_potong,
			'bukti_potong' => $row->bukti_potong,
			'wf_claim' => $wf_claim,
			'row_budgetPromotion' => $row_budgetPromotion,
			'payment_method' => $row->payment_method,
		);
		$this->load->view('claim/claim_pdf', $data);

		// Get output html
		$html = $this->output->get_output();

		// Load pdf library
		$this->load->library('pdf');

		$this->dompdf->loadHtml($html);
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Pengajuan-Claim.pdf", array("Attachment" => 0));
	}

	public function import()
	{
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('message', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('excel')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', $error);
			} else {
				$data = $this->upload->data();

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				$inputFileName = './assets/excel/' . $data['file_name'];
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				$objPHPExcel = $reader->load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray();
				$bulan = date("m");
				$tahun = date("Y");
				$kode = $this->Claim_model->kode_import();
				for ($i = 1, $kode; $i < count($sheetData); $i++, $kode++) {
					$claim_number = "CLAIM/" . $bulan . "/" . $tahun . "/" . str_pad($kode, 5, "0", STR_PAD_LEFT);
					$tanggal_claim = date("Y-m-d", strtotime($sheetData[$i]['0']));
					$promotion_number = $sheetData[$i]['1'];
					$kode_distributor = $sheetData[$i]['2'];
					$nama_distributor = $sheetData[$i]['3'];
					$dpp = $sheetData[$i]['4'];
					$ppn = $sheetData[$i]['5'];
					$pph = $sheetData[$i]['6'];
					$total_claim = $sheetData[$i]['7'];
					$invoice_number = $sheetData[$i]['8'];
					$faktur_pajak = $sheetData[$i]['9'];
					$pkp = $sheetData[$i]['10'];
					$npwp = $sheetData[$i]['11'];
					$keterangan = $sheetData[$i]['12'];
					$receive_date = date("Y-m-d", strtotime($sheetData[$i]['13']));
					$receive_status = $sheetData[$i]['14'];
					$top = $sheetData[$i]['15'];
					$due_date = $sheetData[$i]['16'];
					$payment_plan = $sheetData[$i]['17'];
					$payment_date = $sheetData[$i]['18'];
					$dpp_rev = $sheetData[$i]['19'];
					$ppn_rev = $sheetData[$i]['20'];
					$pph_rev = $sheetData[$i]['21'];
					$total_rev = $sheetData[$i]['22'];
					$mekanisme_claim = $sheetData[$i]['23'];
					$SecLogUser = $this->session->userdata('full_name');
					$SecLogDate = date('Y-m-d H:i:s');
					$pemohon = 'Uploaded';

					$check = $this->Claim_model->check_claim($claim_number);
					if ($check != 1) {
						$resultData[] = array(
							'tgl_claim' => $tanggal_claim,
							'claim_number' => $claim_number,
							'promotion_number' => $promotion_number,
							'kode_distributor' => $kode_distributor,
							'nama_distributor' => $nama_distributor,
							'dpp' => $dpp,
							'ppn' => $ppn,
							'pph' => $pph,
							'total' => $total_claim,
							'invoice_number' => $invoice_number,
							'faktur_pajak_number' => $faktur_pajak,
							'pkp' => $pkp,
							'npwp' => $npwp,
							'keterangan' => $keterangan,
							'status' => 4,
							'approval_scheme' => 0,
							'receive_date' => $receive_date,
							'receive_status' => $receive_status,
							'top' => $top,
							'due_date' => $due_date,
							'payment_plan' => $payment_plan,
							'payment_date' => $payment_date,
							'dpp_rev' => $dpp_rev,
							'ppn_rev' => $ppn_rev,
							'pph_rev' => $pph_rev,
							'total_rev' => $total_rev,
							'mekanisme_claim' => $mekanisme_claim,
							'SecLogUser' => $SecLogUser,
							'SecLogDate' => $SecLogDate,
							'pemohon' => $pemohon,
						);
					}
				}

				unlink('./assets/excel/' . $data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->Claim_model->insert_batch($resultData);
					if ($result > 0) {
						//POTONG BUDGET CLAIM
						$row_claimDpp = $this->Claim_model->get_claimDpp($resultData);
						if ($row_claimDpp > 0) {
							$index = 0;
							foreach ($row_claimDpp as $data_claim) {
								$claim_promotionNumber[$index] = $data_claim['promotion_number'];
								$claim_dpp[$index] = $data_claim['dpp'];
								$index++;
							}

							$row_budget_promotion = $this->Claim_model->get_budget_promotion($claim_promotionNumber);
							$index1 = 0;
							foreach ($row_budget_promotion as $data_budget) {
								$promotion_usage[$index1] = $data_budget['promotion_total_usage'];
								$promotion_saldo[$index1] = $data_budget['promotion_total_saldo'];
								$index1++;
							}

							$budgetArray = array();
							$lenght = count($claim_promotionNumber);
							for ($x = 0; $x < $lenght; $x++) {
								/* Budget Usage */
								$totalUsage_promotion[$x] = $promotion_usage[$x] + $claim_dpp[$x];
								/* Budget Saldo */
								$totalSaldo_promotion[$x] = $promotion_saldo[$x] - $claim_dpp[$x];
								/* Update Master Budget */
								$promotion_budget = array(
									'promotion_number' => $claim_promotionNumber[$x],
									'promotion_total_usage' => $totalUsage_promotion[$x],
									'promotion_total_saldo' => $totalSaldo_promotion[$x],
									'SecLogDate' => date('Y-m-d H:i:s'),
									'SecLogUser' => $this->session->userdata('full_name')
								);
								array_push($budgetArray, $promotion_budget);

								// if ($totalSaldo_promotion[$x] < 0) {
								// 	$this->session->set_flashdata('message', 'Data claim Gagal di Import ke database');
								// 	redirect(site_url('claim'));
								// } else {
								$this->Claim_model->update_budget_promotion($budgetArray);

								$this->session->set_flashdata('message', 'Data Claim Berhasil di Import ke database');
								redirect(site_url('claim'));
								// }
							}
						}
					}
				} else {
					$this->session->set_flashdata('message', 'Data claim Gagal di Import ke database');
					redirect(site_url('claim'));
				}
			}
		}
	}
}
