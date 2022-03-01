<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Series extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Series_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/series/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/series/index/';
            $config['first_url'] = base_url() . 'index.php/series/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Series_model->total_rows($q);
        $series = $this->Series_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'series_data' => $series,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','series/series_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Series_model->get_by_id($id);
        if ($row) {
            $data = array(
		'series_code' => $row->series_code,
		'series_name' => $row->series_name,
		'series_alias' => $row->series_alias,
		'brand_code' => $row->brand_code,
	    );
            $this->template->load('template','series/series_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('series'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('series/create_action'),
	    'series_code' => set_value('series_code'),
	    'series_name' => set_value('series_name'),
	    'series_alias' => set_value('series_alias'),
	    'brand_code' => set_value('brand_code'),
	);
        $this->template->load('template','series/series_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'series_name' => $this->input->post('series_name',TRUE),
		'series_alias' => $this->input->post('series_alias',TRUE),
		'brand_code' => $this->input->post('brand_code',TRUE),
	    );

            $this->Series_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('series'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Series_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('series/update_action'),
		'series_code' => set_value('series_code', $row->series_code),
		'series_name' => set_value('series_name', $row->series_name),
		'series_alias' => set_value('series_alias', $row->series_alias),
		'brand_code' => set_value('brand_code', $row->brand_code),
	    );
            $this->template->load('template','series/series_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('series'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('series_code', TRUE));
        } else {
            $data = array(
		'series_name' => $this->input->post('series_name',TRUE),
		'series_alias' => $this->input->post('series_alias',TRUE),
		'brand_code' => $this->input->post('brand_code',TRUE),
	    );

            $this->Series_model->update($this->input->post('series_code', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('series'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Series_model->get_by_id($id);

        if ($row) {
            $this->Series_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('series'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('series'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('series_name', 'series name', 'trim|required');
	$this->form_validation->set_rules('series_alias', 'series alias', 'trim|required');
	$this->form_validation->set_rules('brand_code', 'brand code', 'trim|required');

	$this->form_validation->set_rules('series_code', 'series_code', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Series.php */
/* Location: ./application/controllers/Series.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-01 08:59:01 */
/* http://harviacode.com */