<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Claim_list extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Claim_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->library('session');
	}

	public function index()
	{
		$this->template->load('template', 'claim_list/claim_list');
	}

	public function json()
	{
		header('Content-Type: application/json');
		$id_user_level = $this->session->userdata('id_user_level');
		$nama_level = $this->Claim_model->get_nama_level($id_user_level);

		if ($nama_level == 'Distributor') {
			echo $this->Claim_model->json_distributor();
		} else {
			echo $this->Claim_model->json();
		}

		// echo $this->Claim_model->json();
	}

	public function read($id)
	{
		$row = $this->Claim_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('form_claim/update_action'),
				'claim_id' => set_value('claim_id', $row->claim_id),
				'kode_distributor' => set_value('kode_distributor', $row->kode_distributor),
				'nama_distributor' => set_value('nama_distributor', $row->nama_distributor),
				'tgl_claim' => set_value('tgl_claim', $row->tgl_claim),
				'promotion_number' => set_value('promotion_number', $row->promotion_number),
				'promotion_id' => set_value('promotion_id', $row->promotion_id),
				'deskripsi' => set_value('deskripsi', $row->deskripsi),
				'claim_dpp' => set_value('claim_dpp', $row->claim_dpp),
				'claim_ppn' => set_value('claim_ppn', $row->claim_ppn),
				'claim_pph' => set_value('claim_pph', $row->claim_pph),
				'total_claim' => set_value('total_claim', $row->total_claim),
				'faktur_pajak' => set_value('faktur_pajak', $row->faktur_pajak),
				'npwp' => set_value('npwp', $row->npwp),
				'pemohon' => set_value('Pemohon', $row->pemohon),
				'document_claim' => set_value('document_claim', $row->document_claim),
				'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
				'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
			);
			$this->template->load('template', 'claim_list/form_claim_read', $data);
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
				'button' => 'Ajukan',
				'action' => site_url('form_claim/create_action'),
				'form_id' => set_value('form_id', $row->form_id),
				'no_p3' => set_value('no_p3', $row->no_p3),
				'nama_program' => set_value('nama_program', $row->nama_program),
				'program_id' => set_value('program_id', $row->program_id),
				'tgl_klaim' => set_value('tgl_klaim'),
				'deskripsi' => set_value('deskripsi'),
				'claim_dpp' => set_value('claim_dpp'),
				'claim_ppn' => set_value('claim_ppn'),
				'claim_pph' => set_value('claim_pph'),
				'total_claim' => set_value('total_claim'),
				'faktur_pajak' => set_value('faktur_pajak'),
				'npwp' => set_value('npwp'),
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

		$id = $this->input->post('form_id', TRUE);

		$kode_distributor = $this->session->userdata('email');
		$bulan = date("m");
		$tahun = date("Y");
		$kode = $this->Form_claim_model->buat_kode();

		$no_klaim = $kode . "/CLAIM/" . $kode_distributor . "/" . $bulan . "/" . $tahun;
		$no_p3 = $this->input->post('no_p3', TRUE);

		if ($this->form_validation->run() == FALSE) {
			// redirect('form_claim/create');
			$this->create($id);
		} else {
			$data = array(
				'kode_distributor' => $kode_distributor,
				'nama_distributor' => $this->input->post('nama_distributor', TRUE),
				'no_klaim' => $no_klaim,
				'tgl_klaim' => $this->input->post('tgl_klaim', TRUE),
				'no_p3' => $no_p3,
				'program_id' => $this->input->post('program_id', TRUE),
				'deskripsi' => $this->input->post('deskripsi', TRUE),
				'claim_dpp' => $this->input->post('claim_dpp', TRUE),
				'claim_ppn' => $this->input->post('claim_ppn', TRUE),
				'claim_pph' => $this->input->post('claim_pph', TRUE),
				'total_claim' => $this->input->post('total_claim', TRUE),
				'faktur_pajak' => $this->input->post('faktur_pajak', TRUE),
				'npwp' => $this->input->post('npwp', TRUE),
				'pemohon' => $this->session->userdata('full_name'),
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name'),
			);


			$row = $this->Form_claim_model->get_budget_program($no_p3);
			$SkuTotalSaldo = $row->sku_total_saldo;

			if ($this->input->post('total_claim') > $SkuTotalSaldo) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Over Budget untuk Total Klaim <b><u>Rp. ' . $this->input->post('total_claim') . '</u></b>, Sisa Budget Program yang tersedia <b><u> Rp. ' . $SkuTotalSaldo . ' </u></b> &nbsp; &nbsp; <a href=' . site_url('form_claim/create/' . $id . '') . ' class="btn btn-info"> OK </a></div>');

				redirect('form_claim/create/' . $id . '');
			} else {
				$this->Form_claim_model->insert($data);

				$row = $this->Form_claim_model->get_budget_program($no_p3);
				/* sku_total_usage */
				$SkuTotalUsage = $row->sku_total_usage;
				$TotalSku = $this->input->post('total_claim');
				$TotalSkuTotalUsage = $SkuTotalUsage + $TotalSku;

				/* sku_total_saldo */
				$SkuTotalSaldo = $row->sku_total_saldo;
				$TotalSkuTotalSaldo = $SkuTotalSaldo - $TotalSku;

				/* UPDATE MASTER BUDGET */
				$Usage = array(
					'sku_total_usage' => $TotalSkuTotalUsage,
					'sku_total_saldo' => $TotalSkuTotalSaldo,
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name'),
				);

				$this->Form_claim_model->update_usage($no_p3, $Usage);

				$this->session->set_flashdata('message', 'Create Record Success 2');
				redirect(site_url('form_claim'));
			}
		}
	}

	public function update($id)
	{
		$row = $this->Claim_model->get_by_id($id);

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
				'claim_dpp' => set_value('claim_dpp', $row->claim_dpp),
				'claim_ppn' => set_value('claim_ppn', $row->claim_ppn),
				'claim_pph' => set_value('claim_pph', $row->claim_pph),
				'total_claim' => set_value('total_claim', $row->total_claim),
				'faktur_pajak' => set_value('faktur_pajak', $row->faktur_pajak),
				'npwp' => set_value('npwp', $row->npwp),
				'pemohon' => set_value('Pemohon', $row->pemohon),
				'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
				'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
			);
			$this->template->load('template', 'claim_list/form_claim_form', $data);
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
		$this->form_validation->set_rules('tgl_klaim', 'tgl klaim', 'trim|required');
		$this->form_validation->set_rules('no_p3', 'no p3', 'trim|required');
		$this->form_validation->set_rules('program_id', 'program id', 'trim|required');
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
		xlsWriteLabel($tablehead, $kolomhead++, "Claim Dpp");
		xlsWriteLabel($tablehead, $kolomhead++, "Claim Ppn");
		xlsWriteLabel($tablehead, $kolomhead++, "Claim Pph");
		xlsWriteLabel($tablehead, $kolomhead++, "Total Claim");
		xlsWriteLabel($tablehead, $kolomhead++, "Faktur Pajak");
		xlsWriteLabel($tablehead, $kolomhead++, "Npwp");
		xlsWriteLabel($tablehead, $kolomhead++, "Pemohon");
		xlsWriteLabel($tablehead, $kolomhead++, "SecLogDate");
		xlsWriteLabel($tablehead, $kolomhead++, "SecLogUser");

		foreach ($this->Claim_model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteNumber($tablebody, $kolombody++, $data->kode_distributor);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_distributor);
			xlsWriteLabel($tablebody, $kolombody++, $data->tgl_klaim);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_p3);
			xlsWriteNumber($tablebody, $kolombody++, $data->program_id);
			xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
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

/* End of file Form_claim.php */
/* Location: ./application/controllers/Form_claim.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-28 03:23:04 */
/* http://harviacode.com */
