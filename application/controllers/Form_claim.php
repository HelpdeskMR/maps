<?php

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
	}

	public function index()
	{
		$this->template->load('template', 'form_claim/form_claim_list');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Form_claim_model->json();
	}

	public function read($id)
	{
		$row = $this->Form_claim_model->get_by_id($id);
		if ($row) {
			$data = array(
				'claim_id' => $row->claim_id,
				'tgl_claim' => $row->tgl_claim,
				'claim_number' => $row->claim_number,
				'promotion_number' => $row->promotion_number,
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
				'pkp' => $row->pkp,
				'npwp' => $row->npwp,
				'keterangan' => $row->keterangan,
				'pemohon' => $row->pemohon,
				'status' => $row->status,
				'payment_date' => $row->payment_date,
				'approval_scheme' => $row->approval_scheme,
				'SecLogDate' => $row->SecLogDate,
				'SecLogUser' => $row->SecLogUser,
			);
			$this->template->load('template', 'form_claim/form_claim_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_claim'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('form_claim/create_action'),
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
		);
		$this->template->load('template', 'form_claim/form_claim_form', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'tgl_claim' => $this->input->post('tgl_claim', TRUE),
				'claim_number' => $this->input->post('claim_number', TRUE),
				'promotion_number' => $this->input->post('promotion_number', TRUE),
				'kode_distributor' => $this->input->post('kode_distributor', TRUE),
				'nama_distributor' => $this->input->post('nama_distributor', TRUE),
				'dpp' => $this->input->post('dpp', TRUE),
				'ppn' => $this->input->post('ppn', TRUE),
				'pph' => $this->input->post('pph', TRUE),
				'total' => $this->input->post('total', TRUE),
				'invoice_number' => $this->input->post('invoice_number', TRUE),
				'invoice' => $this->input->post('invoice', TRUE),
				'faktur_pajak_number' => $this->input->post('faktur_pajak_number', TRUE),
				'faktur_pajak' => $this->input->post('faktur_pajak', TRUE),
				'pkp' => $this->input->post('pkp', TRUE),
				'npwp' => $this->input->post('npwp', TRUE),
				'keterangan' => $this->input->post('keterangan', TRUE),
				'pemohon' => $this->input->post('pemohon', TRUE),
				'status' => $this->input->post('status', TRUE),
				'payment_date' => $this->input->post('payment_date', TRUE),
				'approval_scheme' => $this->input->post('approval_scheme', TRUE),
				'SecLogDate' => $this->input->post('SecLogDate', TRUE),
				'SecLogUser' => $this->input->post('SecLogUser', TRUE),
			);

			$this->Form_claim_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success 2');
			redirect(site_url('form_claim'));
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
				'tgl_claim' => set_value('tgl_claim', $row->tgl_claim),
				'claim_number' => set_value('claim_number', $row->claim_number),
				'promotion_number' => set_value('promotion_number', $row->promotion_number),
				'kode_distributor' => set_value('kode_distributor', $row->kode_distributor),
				'nama_distributor' => set_value('nama_distributor', $row->nama_distributor),
				'dpp' => set_value('dpp', $row->dpp),
				'ppn' => set_value('ppn', $row->ppn),
				'pph' => set_value('pph', $row->pph),
				'total' => set_value('total', $row->total),
				'invoice_number' => set_value('invoice_number', $row->invoice_number),
				'invoice' => set_value('invoice', $row->invoice),
				'faktur_pajak_number' => set_value('faktur_pajak_number', $row->faktur_pajak_number),
				'faktur_pajak' => set_value('faktur_pajak', $row->faktur_pajak),
				'pkp' => set_value('pkp', $row->pkp),
				'npwp' => set_value('npwp', $row->npwp),
				'keterangan' => set_value('keterangan', $row->keterangan),
				'pemohon' => set_value('pemohon', $row->pemohon),
				'status' => set_value('status', $row->status),
				'payment_date' => set_value('payment_date', $row->payment_date),
				'approval_scheme' => set_value('approval_scheme', $row->approval_scheme),
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
				'tgl_claim' => $this->input->post('tgl_claim', TRUE),
				'claim_number' => $this->input->post('claim_number', TRUE),
				'promotion_number' => $this->input->post('promotion_number', TRUE),
				'kode_distributor' => $this->input->post('kode_distributor', TRUE),
				'nama_distributor' => $this->input->post('nama_distributor', TRUE),
				'dpp' => $this->input->post('dpp', TRUE),
				'ppn' => $this->input->post('ppn', TRUE),
				'pph' => $this->input->post('pph', TRUE),
				'total' => $this->input->post('total', TRUE),
				'invoice_number' => $this->input->post('invoice_number', TRUE),
				'invoice' => $this->input->post('invoice', TRUE),
				'faktur_pajak_number' => $this->input->post('faktur_pajak_number', TRUE),
				'faktur_pajak' => $this->input->post('faktur_pajak', TRUE),
				'pkp' => $this->input->post('pkp', TRUE),
				'npwp' => $this->input->post('npwp', TRUE),
				'keterangan' => $this->input->post('keterangan', TRUE),
				'pemohon' => $this->input->post('pemohon', TRUE),
				'status' => $this->input->post('status', TRUE),
				'payment_date' => $this->input->post('payment_date', TRUE),
				'approval_scheme' => $this->input->post('approval_scheme', TRUE),
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
		$this->form_validation->set_rules('claim_number', 'claim number', 'trim|required');
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
}

/* End of file Form_claim.php */
/* Location: ./application/controllers/Form_claim.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-09 17:01:20 */
/* http://harviacode.com */