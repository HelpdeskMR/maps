<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approval_scheme extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Approval_scheme_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','approval_scheme/approval_scheme_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Approval_scheme_model->json();
    }

    public function read($id) 
    {
        $row = $this->Approval_scheme_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'approval_scheme' => $row->approval_scheme,
	    );
            $this->template->load('template','approval_scheme/approval_scheme_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('approval_scheme'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('approval_scheme/create_action'),
	    'id' => set_value('id'),
	    'approval_scheme' => set_value('approval_scheme'),
	);
        $this->template->load('template','approval_scheme/approval_scheme_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'approval_scheme' => $this->input->post('approval_scheme',TRUE),
	    );

            $this->Approval_scheme_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('approval_scheme'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Approval_scheme_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('approval_scheme/update_action'),
		'id' => set_value('id', $row->id),
		'approval_scheme' => set_value('approval_scheme', $row->approval_scheme),
	    );
            $this->template->load('template','approval_scheme/approval_scheme_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('approval_scheme'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'approval_scheme' => $this->input->post('approval_scheme',TRUE),
	    );

            $this->Approval_scheme_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('approval_scheme'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Approval_scheme_model->get_by_id($id);

        if ($row) {
            $this->Approval_scheme_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('approval_scheme'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('approval_scheme'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('approval_scheme', 'approval scheme', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Approval_scheme.php */
/* Location: ./application/controllers/Approval_scheme.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-30 14:50:13 */
/* http://harviacode.com */