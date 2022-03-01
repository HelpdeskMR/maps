<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Bukti_potong extends CI_Controller
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
		$row_get_claimId = $this->Claim_model->get_all();
        $data = array(
			'action' => site_url('bukti_potong/bukti_potong_action'),
			'edit' => site_url('bukti_potong/edit_bukti_potong_action'),
            'row_get_claimId' => $row_get_claimId,
            'bukti_potong' => set_value('bukti_potong'),
        );
		$this->template->load('template', 'bukti_potong/bukti_potong_list', $data);
	}

	public function json_bukti_potong()
	{
		header('Content-Type: application/json');
		echo $this->Claim_model->json_bukti_potong();
	}

	public function json_history_bukti_potong()
	{
		header('Content-Type: application/json');
		echo $this->Claim_model->json_history_bukti_potong();
	}

	public function bukti_potong_action()
	{
        $claim_id = $this->input->post('claim_id', TRUE);
		$no_bukti_potong = $this->input->post('no_bukti_potong', TRUE);
        //upload file
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
			$config['max_size']	= 20000;
			$config['max_width']  = 1024;
			$config['max_height']  = 768;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$upload_buktiPotong = 'bukti_potong';
			if (!$this->upload->do_upload($upload_buktiPotong)) {
				$error = $this->upload->display_errors();
				$data_buktiPotong = array('file_name' => "");
			} else {
				$data_buktiPotong = $this->upload->data();
			}

            $data = array(
				'no_bukti_potong' => $no_bukti_potong,
				'bukti_potong' => $data_buktiPotong['file_name'],
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name'),
			);
            $this->Claim_model->update_buktiPotong($claim_id,$data);
            $this->session->set_flashdata('message', 'Create Record Success');
			redirect('bukti_potong');
	}

	public function edit_bukti_potong_action()
	{
        $claim_id = $this->input->post('claim_id', TRUE);
		$no_bukti_potong = $this->input->post('no_bukti_potong', TRUE);
		$row_claim = $this->Claim_model->get_by_id($claim_id);

        //upload file
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
			$config['max_size']	= 20000;
			$config['max_width']  = 1024;
			$config['max_height']  = 768;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$upload_buktiPotong = 'bukti_potong';
			if (!$this->upload->do_upload($upload_buktiPotong)) {
				$error = $this->upload->display_errors();
				$data_buktiPotong = array('file_name' => $row_claim->bukti_potong);
			} else {
				$data_buktiPotong = $this->upload->data();
			}

            $data = array(
				'no_bukti_potong' => $no_bukti_potong,
				'bukti_potong' => $data_buktiPotong['file_name'],
				'SecLogDate' => date('Y-m-d H:i:s'),
				'SecLogUser' => $this->session->userdata('full_name'),
			);
            $this->Claim_model->update_buktiPotong($claim_id,$data);
            $this->session->set_flashdata('message_edit', 'Create Record Success');
			redirect('bukti_potong');
	}
}
