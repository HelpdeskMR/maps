<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Form_claim extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Form_claim_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->library('session');
	}

	public function index()
	{
		// $this->template->load('template','form_claim/form_claim_list');
		$this->template->load('template', 'form_claim/program_list');
	}

	public function json_program()
	{
		header('Content-Type: application/json');
		echo $this->Form_claim_model->json_program();
	}

	public function read($id)
	{
		$row = $this->Form_claim_model->get_by_id($id);
		if ($row) {
			$data = array(
				'claim_id' => $row->claim_id,
				'kode_distributor' => $row->kode_distributor,
				'nama_distributor' => $row->nama_distributor,
				'tgl_klaim' => $row->tgl_klaim,
				'no_p3' => $row->no_p3,
				'program_id' => $row->program_id,
				'deskripsi' => $row->deskripsi,
				'pkp' => $row->pkp,
				'claim_dpp' => $row->claim_dpp,
				'claim_ppn' => $row->claim_ppn,
				'claim_pph' => $row->claim_pph,
				'total_claim' => $row->total_claim,
				'faktur_pajak' => $row->faktur_pajak,
				'npwp' => $row->npwp,
				'Pemohon' => $row->Pemohon,
				'SecLogDate' => $row->SecLogDate,
				'SecLogUser' => $row->SecLogUser,
			);
			$this->template->load('template', 'form_claim/form_claim_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_claim'));
		}
	}

	public function create($id)
	{
		$row = $this->Form_claim_model->get_program($id);

		if ($row) {
			$data = array(
				'button' => 'Submit',
				'action' => site_url('form_claim/create_action'),
				'promotion_id' => set_value('promotion_id', $row->promotion_id),
				'promotion_number' => set_value('promotion_number', $row->promotion_number),
				'promotion_name' => set_value('promotion_name', $row->promotion_name),
				'tgl_klaim' => set_value('tgl_klaim'),
				'deskripsi' => set_value('deskripsi'),
				'pkp' => set_value('pkp'),
				'claim_dpp' => set_value('claim_dpp'),
				'claim_ppn' => set_value('claim_ppn'),
				'claim_pph' => set_value('claim_pph'),
				'total_claim' => set_value('total_claim'),
				'faktur_pajak' => set_value('faktur_pajak'),
				'npwp' => set_value('npwp', $row->npwp),
				'Pemohon' => set_value('Pemohon'),
				'SecLogDate' => set_value('SecLogDate'),
				'SecLogUser' => set_value('SecLogUser'),

			);
			$this->template->load('template', 'form_claim/form_claim_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_claim'));
		}
	}

	public function create_action()
	{
		$this->_rules();

		$id = $this->input->post('promotion_id', TRUE);
		$kode_distributor = $this->session->userdata('kode_distributor');
		$bulan = date("m");
		$tahun = date("Y");
		$kode = $this->Form_claim_model->buat_kode();
		$no_claim = $kode . "/CLAIM/" . $kode_distributor . "/" . $bulan . "/" . $tahun;
		$promotion_number = $this->input->post('promotion_number', TRUE);

		if ($this->form_validation->run() == FALSE) {
			// redirect('form_claim/create');
			$this->create($id);
		} else {

			//upload file
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar';
			$config['max_size']	= 20000;
			$config['max_width']  = 1024;
			$config['max_height']  = 768;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$upload = 'document_claim';
			if (!$this->upload->do_upload($upload)) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata("message", "<div class='alert bg-danger' role='alert'>
		 	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		 	    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>  " . $error . "  </div>");
				$data_file = array('file_name' => "");
			} else {
				$data_file = $this->upload->data();
			}

			$data = array(
				'kode_distributor' => $kode_distributor,
				'nama_distributor' => $this->input->post('nama_distributor', TRUE),
				'no_claim' => $no_claim,
				'tgl_claim' => $this->input->post('tgl_claim', TRUE),
				'promotion_number' => $promotion_number,
				'promotion_id' => $this->input->post('promotion_id', TRUE),
				'deskripsi' => $this->input->post('deskripsi', TRUE),
				'pkp' => $this->input->post('pkp', TRUE),
				'claim_dpp' => $this->input->post('claim_dpp', TRUE),
				'claim_ppn' => $this->input->post('claim_ppn', TRUE),
				'claim_pph' => $this->input->post('claim_pph', TRUE),
				'total_claim' => $this->input->post('total_claim', TRUE),
				'faktur_pajak' => $this->input->post('faktur_pajak', TRUE),
				'npwp' => $this->input->post('npwp', TRUE),
				'pemohon' => $this->session->userdata('full_name'),
				'document_claim' => $data_file['file_name'],
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name'),
			);


			$row = $this->Form_claim_model->get_budget_program($promotion_number);
			$PromotionTotalSaldo = $row->promotion_total_saldo;

			if ($this->input->post('total_claim') > $PromotionTotalSaldo) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Over Budget untuk Total Klaim <b><u>Rp. ' . $this->input->post('total_claim') . '</u></b>, Sisa Budget Program yang tersedia <b><u> Rp. ' . $PromotionTotalSaldo . ' </u></b> &nbsp; &nbsp; <a href=' . site_url('form_claim/create/' . $id . '') . ' class="btn btn-info"> OK </a></div>');

				redirect('form_claim/create/' . $id . '');
			} else {
				$this->Form_claim_model->insert($data);

				$row = $this->Form_claim_model->get_budget_program($promotion_number);
				/* sku_total_usage */
				$promotionTotalUsage = $row->promotion_total_usage;
				$TotalClaim = $this->input->post('total_claim');
				$TotalPromotionUsage = $promotionTotalUsage + $TotalClaim;

				/* sku_total_saldo */
				$PromotionTotalSaldo = $row->promotion_total_saldo;
				$TotalPromotionSaldo = $PromotionTotalSaldo - $TotalClaim;

				/* UPDATE MASTER BUDGET */
				$Usage = array(
					'promotion_total_usage' => $TotalPromotionUsage,
					'promotion_total_saldo' => $TotalPromotionSaldo,
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name'),
				);

				$this->Form_claim_model->update_usage($promotion_number, $Usage);

				// //

				/* CREATE APPROVAL CLAIM */
				// $row_region = $this->Form_claim_model->get_region($promotion_number);
				// $region_code = $row_region->region_code;
				$SecLogDate = date('Y-m-d H:i:s');
				$SecLogUser = $this->session->userdata('full_name');
				$insertArray = array();
				$row = $this->Form_claim_model->get_approval($kode_distributor);

				foreach ($row as $data_claim) {
					$new_add = array(
						'no_claim' => $no_claim,
						'approval_scheme' => $data_claim['approval_scheme'],
						'id_user_level' => $data_claim['id_user_level'],
						'id_users' => $data_claim['id_users'],
						'approve_by' => NULL,
						'approval_date' => NULL,
						'reject_by' => NULL,
						'reject_date' => NULL,
						'reject_reason' => NULL,
						'SecLogDate' => $SecLogDate,
						'SecLogUser' => $SecLogUser
					);

					array_push($insertArray, $new_add);
				}

				$this->Form_claim_model->insert_wf_claim($insertArray);

				$this->session->set_flashdata('message', 'Create Record Success 2');
				redirect(site_url('form_claim'));
			}
		}
	}

	public function update($id)
	{
		$row = $this->Form_claim_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('form_claim/update_action'),
				'claim_id' => set_value('claim_id', $row->claim_id),
				'kode_distributor' => set_value('kode_distributor', $row->kode_distributor),
				'nama_distributor' => set_value('nama_distributor', $row->nama_distributor),
				'tgl_klaim' => set_value('tgl_klaim', $row->tgl_klaim),
				'no_p3' => set_value('no_p3', $row->no_p3),
				'program_id' => set_value('program_id', $row->program_id),
				'deskripsi' => set_value('deskripsi', $row->deskripsi),
				'pkp' => set_value('pkp', $row->pkp),
				'claim_dpp' => set_value('claim_dpp', $row->claim_dpp),
				'claim_ppn' => set_value('claim_ppn', $row->claim_ppn),
				'claim_pph' => set_value('claim_pph', $row->claim_pph),
				'total_claim' => set_value('total_claim', $row->total_claim),
				'faktur_pajak' => set_value('faktur_pajak', $row->faktur_pajak),
				'npwp' => set_value('npwp', $row->npwp),
				'Pemohon' => set_value('Pemohon', $row->Pemohon),
				'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
				'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
			);
			$this->template->load('template', 'form_claim/form_claim_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_claim'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('claim_id', TRUE));
		} else {
			$data = array(
				'kode_distributor' => $this->input->post('kode_distributor', TRUE),
				'nama_distributor' => $this->input->post('nama_distributor', TRUE),
				'tgl_klaim' => $this->input->post('tgl_klaim', TRUE),
				'no_p3' => $this->input->post('no_p3', TRUE),
				'program_id' => $this->input->post('program_id', TRUE),
				'deskripsi' => $this->input->post('deskripsi', TRUE),
				'pkp' => $this->input->post('pkp', TRUE),
				'claim_dpp' => $this->input->post('claim_dpp', TRUE),
				'claim_ppn' => $this->input->post('claim_ppn', TRUE),
				'claim_pph' => $this->input->post('claim_pph', TRUE),
				'total_claim' => $this->input->post('total_claim', TRUE),
				'faktur_pajak' => $this->input->post('faktur_pajak', TRUE),
				'npwp' => $this->input->post('npwp', TRUE),
				'Pemohon' => $this->input->post('Pemohon', TRUE),
				'SecLogDate' => $this->input->post('SecLogDate', TRUE),
				'SecLogUser' => $this->input->post('SecLogUser', TRUE),
			);

			$this->Form_claim_model->update($this->input->post('claim_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('form_claim'));
		}
	}

	public function delete($id)
	{
		$row = $this->Form_claim_model->get_by_id($id);

		if ($row) {
			$this->Form_claim_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('form_claim'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_claim'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('tgl_claim', 'tgl claim', 'trim|required');
		// $this->form_validation->set_rules('no_p3', 'no p3', 'trim|required');
		// $this->form_validation->set_rules('program_id', 'program id', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
		$this->form_validation->set_rules('claim_dpp', 'claim dpp', 'trim|required|numeric');
		$this->form_validation->set_rules('claim_ppn', 'claim ppn', 'trim|required|numeric');
		$this->form_validation->set_rules('claim_pph', 'claim pph', 'trim|required|numeric');
		$this->form_validation->set_rules('total_claim', 'total claim', 'trim|required|numeric');
		$this->form_validation->set_rules('faktur_pajak', 'faktur pajak', 'trim|required');
		$this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "form_claim.xls";
		$judul = "form_claim";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Distributor");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Distributor");
		xlsWriteLabel($tablehead, $kolomhead++, "Tgl Klaim");
		xlsWriteLabel($tablehead, $kolomhead++, "No P3");
		xlsWriteLabel($tablehead, $kolomhead++, "Program Id");
		xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
		xlsWriteLabel($tablehead, $kolomhead++, "PKP");
		xlsWriteLabel($tablehead, $kolomhead++, "Claim Dpp");
		xlsWriteLabel($tablehead, $kolomhead++, "Claim Ppn");
		xlsWriteLabel($tablehead, $kolomhead++, "Claim Pph");
		xlsWriteLabel($tablehead, $kolomhead++, "Total Claim");
		xlsWriteLabel($tablehead, $kolomhead++, "Faktur Pajak");
		xlsWriteLabel($tablehead, $kolomhead++, "Npwp");
		xlsWriteLabel($tablehead, $kolomhead++, "Pemohon");
		xlsWriteLabel($tablehead, $kolomhead++, "SecLogDate");
		xlsWriteLabel($tablehead, $kolomhead++, "SecLogUser");

		foreach ($this->Form_claim_model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteNumber($tablebody, $kolombody++, $data->kode_distributor);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_distributor);
			xlsWriteLabel($tablebody, $kolombody++, $data->tgl_klaim);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_p3);
			xlsWriteNumber($tablebody, $kolombody++, $data->program_id);
			xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
			xlsWriteLabel($tablebody, $kolombody++, $data->pkp);
			xlsWriteNumber($tablebody, $kolombody++, $data->claim_dpp);
			xlsWriteNumber($tablebody, $kolombody++, $data->claim_ppn);
			xlsWriteNumber($tablebody, $kolombody++, $data->claim_pph);
			xlsWriteNumber($tablebody, $kolombody++, $data->total_claim);
			xlsWriteLabel($tablebody, $kolombody++, $data->faktur_pajak);
			xlsWriteLabel($tablebody, $kolombody++, $data->npwp);
			xlsWriteLabel($tablebody, $kolombody++, $data->Pemohon);
			xlsWriteLabel($tablebody, $kolombody++, $data->SecLogDate);
			xlsWriteLabel($tablebody, $kolombody++, $data->SecLogUser);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

	function get_p3()
	{
		$data = $this->Form_claim_model->get_p3()->result();
		echo json_encode($data);
	}
}
