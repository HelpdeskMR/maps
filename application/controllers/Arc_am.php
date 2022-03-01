<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_am extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_am_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/arc_am/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/arc_am/index/';
            $config['first_url'] = base_url() . 'index.php/arc_am/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Arc_am_model->total_rows($q);
        $arc_am = $this->Arc_am_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'arc_am_data' => $arc_am,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','arc_am/arc_am_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Arc_am_model->get_by_id($id);
        if ($row) {
            $data = array(
		'am_id' => $row->am_id,
		'nama_am' => $row->nama_am,
		'region_code' => $row->region_code,
		'email' => $row->email,
	    );
            $this->template->load('template','arc_am/arc_am_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_am'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_am/create_action'),
	    'am_id' => set_value('am_id'),
	    'nama_am' => set_value('nama_am'),
	    'region_code' => set_value('region_code'),
	    'email' => set_value('email'),
	);
        $this->template->load('template','arc_am/arc_am_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_am' => $this->input->post('nama_am',TRUE),
		'region_code' => $this->input->post('region_code',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Arc_am_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_am'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_am_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_am/update_action'),
		'am_id' => set_value('am_id', $row->am_id),
		'nama_am' => set_value('nama_am', $row->nama_am),
		'region_code' => set_value('region_code', $row->region_code),
		'email' => set_value('email', $row->email),
	    );
            $this->template->load('template','arc_am/arc_am_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_am'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('am_id', TRUE));
        } else {
            $data = array(
		'nama_am' => $this->input->post('nama_am',TRUE),
		'region_code' => $this->input->post('region_code',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Arc_am_model->update($this->input->post('am_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_am'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_am_model->get_by_id($id);

        if ($row) {
            $this->Arc_am_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_am'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_am'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_am', 'nama am', 'trim|required');
	$this->form_validation->set_rules('region_code', 'region code', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');

	$this->form_validation->set_rules('am_id', 'am_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Arc_am.php */
/* Location: ./application/controllers/Arc_am.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-01 08:57:36 */
/* http://harviacode.com */