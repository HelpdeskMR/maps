<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Brand_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/brand/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/brand/index/';
            $config['first_url'] = base_url() . 'index.php/brand/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Brand_model->total_rows($q);
        $brand = $this->Brand_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'brand_data' => $brand,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','brand/brand_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Brand_model->get_by_id($id);
        if ($row) {
            $data = array(
		'brand_id' => $row->brand_id,
		'brand_code' => $row->brand_code,
		'brand_name' => $row->brand_name,
		'kode_departemen' => $row->kode_departemen,
	    );
            $this->template->load('template','brand/brand_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('brand'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('brand/create_action'),
	    'brand_id' => set_value('brand_id'),
	    'brand_code' => set_value('brand_code'),
	    'brand_name' => set_value('brand_name'),
	    'kode_departemen' => set_value('kode_departemen'),
	);
        $this->template->load('template','brand/brand_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'brand_code' => $this->input->post('brand_code',TRUE),
		'brand_name' => $this->input->post('brand_name',TRUE),
		'kode_departemen' => $this->input->post('kode_departemen',TRUE),
	    );

            $this->Brand_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('brand'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Brand_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('brand/update_action'),
		'brand_id' => set_value('brand_id', $row->brand_id),
		'brand_code' => set_value('brand_code', $row->brand_code),
		'brand_name' => set_value('brand_name', $row->brand_name),
		'kode_departemen' => set_value('kode_departemen', $row->kode_departemen),
	    );
            $this->template->load('template','brand/brand_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('brand'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('brand_id', TRUE));
        } else {
            $data = array(
		'brand_code' => $this->input->post('brand_code',TRUE),
		'brand_name' => $this->input->post('brand_name',TRUE),
		'kode_departemen' => $this->input->post('kode_departemen',TRUE),
	    );

            $this->Brand_model->update($this->input->post('brand_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('brand'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Brand_model->get_by_id($id);

        if ($row) {
            $this->Brand_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('brand'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('brand'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('brand_code', 'brand code', 'trim|required');
	$this->form_validation->set_rules('brand_name', 'brand name', 'trim|required');
	$this->form_validation->set_rules('kode_departemen', 'kode departemen', 'trim|required');

	$this->form_validation->set_rules('brand_id', 'brand_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Brand.php */
/* Location: ./application/controllers/Brand.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-01 08:58:38 */
/* http://harviacode.com */