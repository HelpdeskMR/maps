<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_trading_term extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_trading_term_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','arc_trading_term/arc_trading_term_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Arc_trading_term_model->json();
    }

    public function read($id) 
    {
        $row = $this->Arc_trading_term_model->get_by_id($id);
        if ($row) {
            $data = array(
		'trading_term_id' => $row->trading_term_id,
		'kode_departemen' => $row->kode_departemen,
		'channel_code' => $row->channel_code,
		'store_code' => $row->store_code,
		'trading_term' => $row->trading_term,
		'SecLogUser' => $row->SecLogUser,
		'SeclogDate' => $row->SeclogDate,
	    );
            $this->template->load('template','arc_trading_term/arc_trading_term_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_trading_term'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_trading_term/create_action'),
	    'trading_term_id' => set_value('trading_term_id'),
	    'kode_departemen' => set_value('kode_departemen'),
	    'channel_code' => set_value('channel_code'),
	    'store_code' => set_value('store_code'),
	    'trading_term' => set_value('trading_term'),
	    'SecLogUser' => set_value('SecLogUser'),
	    'SeclogDate' => set_value('SeclogDate'),
	);
        $this->template->load('template','arc_trading_term/arc_trading_term_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_departemen' => $this->input->post('kode_departemen',TRUE),
		'channel_code' => $this->input->post('channel_code',TRUE),
		'store_code' => $this->input->post('store_code',TRUE),
		'trading_term' => $this->input->post('trading_term',TRUE),
		'SecLogUser' => $this->session->userdata('full_name'),
		'SeclogDate' => date('Y-m-d H:i:s'),
	    );

            $this->Arc_trading_term_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_trading_term'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_trading_term_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_trading_term/update_action'),
		'trading_term_id' => set_value('trading_term_id', $row->trading_term_id),
		'kode_departemen' => set_value('kode_departemen', $row->kode_departemen),
		'channel_code' => set_value('channel_code', $row->channel_name),
		'store_code' => set_value('store_code', $row->store_code),
		'trading_term' => set_value('trading_term', $row->trading_term),
		'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
		'SeclogDate' => set_value('SeclogDate', $row->SeclogDate),
	    );
            $this->template->load('template','arc_trading_term/arc_trading_term_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_trading_term'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('trading_term_id', TRUE));
        } else {
            $data = array(
		'kode_departemen' => $this->input->post('kode_departemen',TRUE),
		'channel_code' => $this->input->post('channel_code',TRUE),
		'store_code' => $this->input->post('store_code',TRUE),
		'trading_term' => $this->input->post('trading_term',TRUE),
		'SecLogUser' => $this->session->userdata('full_name'),
		'SeclogDate' => date('Y-m-d H:i:s'),
	    );

            $this->Arc_trading_term_model->update($this->input->post('trading_term_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_trading_term'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_trading_term_model->get_by_id($id);

        if ($row) {
            $this->Arc_trading_term_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_trading_term'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_trading_term'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_departemen', 'kode departemen', 'trim|required');
	$this->form_validation->set_rules('channel_code', 'channel code', 'trim|required');
	$this->form_validation->set_rules('store_code', 'store code', 'trim|required');
	// $this->form_validation->set_rules('gl_coa', 'gl coa', 'trim|required');
	$this->form_validation->set_rules('trading_term', 'trading term', 'trim|required|numeric');
	// $this->form_validation->set_rules('SecLogUser', 'secloguser', 'trim|required');
	// $this->form_validation->set_rules('SeclogDate', 'seclogdate', 'trim|required');

	$this->form_validation->set_rules('trading_term_id', 'trading_term_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_channel()
	{
		$kode_departemen = $this->input->post('id', TRUE);
		$data = $this->Arc_trading_term_model->get_channel($kode_departemen)->result();
		echo json_encode($data);
	}

}

/* End of file Arc_trading_term.php */
/* Location: ./application/controllers/Arc_trading_term.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-10-14 05:13:40 */
/* http://harviacode.com */