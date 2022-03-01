<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_rsm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_rsm_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/arc_rsm/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/arc_rsm/index/';
            $config['first_url'] = base_url() . 'index.php/arc_rsm/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Arc_rsm_model->total_rows($q);
        $arc_rsm = $this->Arc_rsm_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'arc_rsm_data' => $arc_rsm,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','arc_rsm/arc_rsm_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Arc_rsm_model->get_by_id($id);
        if ($row) {
            $data = array(
		'rsm_id' => $row->rsm_id,
		'nama_rsm' => $row->nama_rsm,
		'email' => $row->email,
		'region_code' => $row->region_code,
	    );
            $this->template->load('template','arc_rsm/arc_rsm_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_rsm'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_rsm/create_action'),
	    'rsm_id' => set_value('rsm_id'),
	    'nama_rsm' => set_value('nama_rsm'),
	    'email' => set_value('email'),
	    'region_code' => set_value('region_code'),
	);
        $this->template->load('template','arc_rsm/arc_rsm_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_rsm' => $this->input->post('nama_rsm',TRUE),
		'email' => $this->input->post('email',TRUE),
		'region_code' => $this->input->post('region_code',TRUE),
	    );

            $this->Arc_rsm_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_rsm'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_rsm_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_rsm/update_action'),
		'rsm_id' => set_value('rsm_id', $row->rsm_id),
		'nama_rsm' => set_value('nama_rsm', $row->nama_rsm),
		'email' => set_value('email', $row->email),
		'region_code' => set_value('region_code', $row->region_code),
	    );
            $this->template->load('template','arc_rsm/arc_rsm_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_rsm'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('rsm_id', TRUE));
        } else {
            $data = array(
		'nama_rsm' => $this->input->post('nama_rsm',TRUE),
		'email' => $this->input->post('email',TRUE),
		'region_code' => $this->input->post('region_code',TRUE),
	    );

            $this->Arc_rsm_model->update($this->input->post('rsm_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_rsm'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_rsm_model->get_by_id($id);

        if ($row) {
            $this->Arc_rsm_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_rsm'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_rsm'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_rsm', 'nama rsm', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('region_code', 'region code', 'trim|required');

	$this->form_validation->set_rules('rsm_id', 'rsm_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Arc_rsm.php */
/* Location: ./application/controllers/Arc_rsm.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-01 09:00:36 */
/* http://harviacode.com */