<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_distributor_margin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_distributor_margin_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','arc_distributor_margin/arc_distributor_margin_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Arc_distributor_margin_model->json();
    }

    public function read($id) 
    {
        $row = $this->Arc_distributor_margin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'distributor_margin_id' => $row->distributor_margin_id,
		'kode_departemen' => $row->kode_departemen,
		'channel_code' => $row->channel_code,
		'store_code' => $row->store_code,
		'region_code' => $row->region_code,
		'margin' => $row->margin,
		'SecLogUser' => $row->SecLogUser,
		'SeclogDate' => $row->SeclogDate,
	    );
            $this->template->load('template','arc_distributor_margin/arc_distributor_margin_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_distributor_margin'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_distributor_margin/create_action'),
	    'distributor_margin_id' => set_value('distributor_margin_id'),
	    'kode_departemen' => set_value('kode_departemen'),
	    'channel_code' => set_value('channel_code'),
	    'store_code' => set_value('store_code'),
	    'region_code' => set_value('region_code'),
	    'margin' => set_value('margin'),
	    'SecLogUser' => set_value('SecLogUser'),
	    'SeclogDate' => set_value('SeclogDate'),
	);
        $this->template->load('template','arc_distributor_margin/arc_distributor_margin_form', $data);
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
		'region_code' => $this->input->post('region_code',TRUE),
		'margin' => $this->input->post('margin',TRUE),
		'SecLogUser' => $this->session->userdata('full_name'),
		'SeclogDate' => date('Y-m-d H:i:s'),
	    );

            $this->Arc_distributor_margin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_distributor_margin'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_distributor_margin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_distributor_margin/update_action'),
		'distributor_margin_id' => set_value('distributor_margin_id', $row->distributor_margin_id),
		'kode_departemen' => set_value('kode_departemen', $row->kode_departemen),
		'channel_code' => set_value('channel_code', $row->channel_name),
		'store_code' => set_value('store_code', $row->store_name),
		'region_code' => set_value('region_code', $row->nama_region),
		'margin' => set_value('margin', $row->margin),
		'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
		'SeclogDate' => set_value('SeclogDate', $row->SeclogDate),
	    );
            $this->template->load('template','arc_distributor_margin/arc_distributor_margin_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_distributor_margin'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('distributor_margin_id', TRUE));
        } else {
            $data = array(
		'kode_departemen' => $this->input->post('kode_departemen',TRUE),
		'channel_code' => $this->input->post('channel_code',TRUE),
		'store_code' => $this->input->post('store_code',TRUE),
		'region_code' => $this->input->post('region_code',TRUE),
		'margin' => $this->input->post('margin',TRUE),
		'SecLogUser' => $this->session->userdata('full_name'),
		'SeclogDate' => date('Y-m-d H:i:s'),
	    );

            $this->Arc_distributor_margin_model->update($this->input->post('distributor_margin_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_distributor_margin'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_distributor_margin_model->get_by_id($id);

        if ($row) {
            $this->Arc_distributor_margin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_distributor_margin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_distributor_margin'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_departemen', 'kode departemen', 'trim|required');
	$this->form_validation->set_rules('channel_code', 'channel code', 'trim|required');
	// $this->form_validation->set_rules('store_code', 'store code', 'trim|required');
	// $this->form_validation->set_rules('region_code', 'region code', 'trim|required');
	$this->form_validation->set_rules('margin', 'margin', 'trim|required|numeric');
	// $this->form_validation->set_rules('SecLogUser', 'secloguser', 'trim|required');
	// $this->form_validation->set_rules('SeclogDate', 'seclogdate', 'trim|required');

	$this->form_validation->set_rules('distributor_margin_id', 'distributor_margin_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_channel()
	{
		$kode_departemen = $this->input->post('id', TRUE);
		$data = $this->Arc_distributor_margin_model->get_channel($kode_departemen)->result();
		echo json_encode($data);
	}

	function get_store()
	{
		$channel_code = $this->input->post('id', TRUE);
		$data = $this->Arc_distributor_margin_model->get_store($channel_code)->result();
		echo json_encode($data);
	}

	function get_region()
	{
		$channel_code = $this->input->post('id', TRUE);
		$data = $this->Arc_distributor_margin_model->get_region($channel_code)->result();
		echo json_encode($data);
	}

}

/* End of file Arc_distributor_margin.php */
/* Location: ./application/controllers/Arc_distributor_margin.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-10-14 03:47:04 */
/* http://harviacode.com */