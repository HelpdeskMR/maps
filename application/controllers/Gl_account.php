<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Gl_account extends CI_Controller {
	function __construct() {
		parent::__construct();
		is_login();
		$this->load->model('Gl_account_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index() {
		$this->template->load('template', 'gl_account/gl_account_list');
	}

	public function json() {
		header('Content-Type: application/json');
		echo $this->Gl_account_model->json();
	}

	public function read($id) {
		$row = $this->Gl_account_model->get_by_id($id);
		if ($row) {
			$data = array(
				'coa_id' => $row->coa_id,
				'gl_coa' => $row->gl_coa,
				'gl_coa_desc' => $row->gl_coa_desc,
				'is_aktif' => $row->is_aktif,
				'SecLogUser' => $row->SecLogUser,
				'SecLogDate' => $row->SecLogDate,
			);
			$this->template->load('template', 'gl_account/gl_account_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('gl_account'));
		}
	}

	public function create() {
		$data = array(
			'button' => 'Create',
			'action' => site_url('gl_account/create_action'),
			'coa_id' => set_value('coa_id'),
			'gl_coa' => set_value('gl_coa'),
			'gl_coa_desc' => set_value('gl_coa_desc'),
			'is_aktif' => set_value('is_aktif'),
			'SecLogUser' => set_value('SecLogUser'),
			'SecLogDate' => set_value('SecLogDate'),
		);
		$this->template->load('template', 'gl_account/gl_account_form', $data);
	}

	public function create_action() {
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'gl_coa' => $this->input->post('gl_coa', TRUE),
				'gl_coa_desc' => $this->input->post('gl_coa_desc', TRUE),
				'is_aktif' => $this->input->post('is_aktif', TRUE),
				'SecLogUser' => $this->session->userdata('full_name'),
				'SecLogDate' => date('Y-m-d H:i:s'),
			);

			$this->Gl_account_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success 2');
			redirect(site_url('gl_account'));
		}
	}

	public function update($id) {
		$row = $this->Gl_account_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('gl_account/update_action'),
				'coa_id' => set_value('coa_id', $row->coa_id),
				'gl_coa' => set_value('gl_coa', $row->gl_coa),
				'gl_coa_desc' => set_value('gl_coa_desc', $row->gl_coa_desc),
				'is_aktif' => set_value('is_aktif', $row->is_aktif),
				'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
				'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
			);
			$this->template->load('template', 'gl_account/gl_account_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('gl_account'));
		}
	}

	public function update_action() {
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('coa_id', TRUE));
		} else {
			$data = array(
				'gl_coa' => $this->input->post('gl_coa', TRUE),
				'gl_coa_desc' => $this->input->post('gl_coa_desc', TRUE),
				'is_aktif' => $this->input->post('is_aktif', TRUE),
				'SecLogUser' => $this->session->userdata('full_name'),
				'SecLogDate' => date('Y-m-d H:i:s'),
			);

			$this->Gl_account_model->update($this->input->post('coa_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('gl_account'));
		}
	}

	public function delete($id) {
		$row = $this->Gl_account_model->get_by_id($id);

		if ($row) {
			$this->Gl_account_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('gl_account'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('gl_account'));
		}
	}

	public function _rules() {
		$this->form_validation->set_rules('gl_coa', 'gl coa', 'trim|required');
		$this->form_validation->set_rules('gl_coa_desc', 'gl coa desc', 'trim|required');

		$this->form_validation->set_rules('coa_id', 'coa_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel() {
		$this->load->helper('exportexcel');
		$namaFile = "gl_account.xls";
		$judul = "gl_account";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Gl Coa");
		xlsWriteLabel($tablehead, $kolomhead++, "Gl Coa Desc");
		xlsWriteLabel($tablehead, $kolomhead++, "is_aktif");
		xlsWriteLabel($tablehead, $kolomhead++, "SecLogUser");
		xlsWriteLabel($tablehead, $kolomhead++, "SecLogDate");

		foreach ($this->Gl_account_model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->gl_coa);
			xlsWriteLabel($tablebody, $kolombody++, $data->gl_coa_desc);
			xlsWriteLabel($tablebody, $kolombody++, $data->IsActive);
			xlsWriteLabel($tablebody, $kolombody++, $data->SecLogUser);
			xlsWriteLabel($tablebody, $kolombody++, $data->SecLogDate);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

}

/* End of file Gl_account.php */
/* Location: ./application/controllers/Gl_account.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-17 09:19:19 */
/* http://harviacode.com */