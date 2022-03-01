<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_channel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_channel_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','arc_channel/arc_channel_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Arc_channel_model->json();
    }

    public function read($id) 
    {
        $row = $this->Arc_channel_model->get_by_id($id);
        if ($row) {
            $data = array(
		'channel_id' => $row->channel_id,
		'channel_code' => $row->channel_code,
		'channel_name' => $row->channel_name,
		'kode_departemen' => $row->kode_departemen,
	    );
            $this->template->load('template','arc_channel/arc_channel_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_channel'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_channel/create_action'),
	    'channel_id' => set_value('channel_id'),
	    'channel_code' => set_value('channel_code'),
	    'channel_name' => set_value('channel_name'),
	    'kode_departemen' => set_value('kode_departemen'),
	);
        $this->template->load('template','arc_channel/arc_channel_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'channel_code' => $this->input->post('channel_code',TRUE),
		'channel_name' => $this->input->post('channel_name',TRUE),
		'kode_departemen' => $this->input->post('kode_departemen',TRUE),
	    );

            $this->Arc_channel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_channel'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_channel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_channel/update_action'),
		'channel_id' => set_value('channel_id', $row->channel_id),
		'channel_code' => set_value('channel_code', $row->channel_code),
		'channel_name' => set_value('channel_name', $row->channel_name),
		'kode_departemen' => set_value('kode_departemen', $row->kode_departemen),
	    );
            $this->template->load('template','arc_channel/arc_channel_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_channel'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('channel_id', TRUE));
        } else {
            $data = array(
		'channel_code' => $this->input->post('channel_code',TRUE),
		'channel_name' => $this->input->post('channel_name',TRUE),
		'kode_departemen' => $this->input->post('kode_departemen',TRUE),
	    );

            $this->Arc_channel_model->update($this->input->post('channel_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_channel'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_channel_model->get_by_id($id);

        if ($row) {
            $this->Arc_channel_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_channel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_channel'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('channel_code', 'channel code', 'trim|required');
	$this->form_validation->set_rules('channel_name', 'channel name', 'trim|required');
	$this->form_validation->set_rules('kode_departemen', 'kode departemen', 'trim|required');

	$this->form_validation->set_rules('channel_id', 'channel_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Arc_channel.php */
/* Location: ./application/controllers/Arc_channel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-08-12 04:53:48 */
/* http://harviacode.com */