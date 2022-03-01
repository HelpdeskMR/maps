<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Category_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/category/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/category/index/';
            $config['first_url'] = base_url() . 'index.php/category/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Category_model->total_rows($q);
        $category = $this->Category_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'category_data' => $category,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','category/category_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Category_model->get_by_id($id);
        if ($row) {
            $data = array(
		'category_id' => $row->category_id,
		'category_name' => $row->category_name,
	    );
            $this->template->load('template','category/category_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('category/create_action'),
	    'category_id' => set_value('category_id'),
	    'category_name' => set_value('category_name'),
	);
        $this->template->load('template','category/category_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'category_name' => $this->input->post('category_name',TRUE),
	    );

            $this->Category_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('category'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Category_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('category/update_action'),
		'category_id' => set_value('category_id', $row->category_id),
		'category_name' => set_value('category_name', $row->category_name),
	    );
            $this->template->load('template','category/category_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('category_id', TRUE));
        } else {
            $data = array(
		'category_name' => $this->input->post('category_name',TRUE),
	    );

            $this->Category_model->update($this->input->post('category_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('category'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Category_model->get_by_id($id);

        if ($row) {
            $this->Category_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('category'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('category_name', 'category name', 'trim|required');

	$this->form_validation->set_rules('category_id', 'category_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Category.php */
/* Location: ./application/controllers/Category.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-01 08:59:32 */
/* http://harviacode.com */