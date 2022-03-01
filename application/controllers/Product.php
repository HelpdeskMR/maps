<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Product_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','product/product_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Product_model->json();
    }

    public function read($id) 
    {
        $row = $this->Product_model->get_by_id($id);
        if ($row) {
            $data = array(
		'product_id' => $row->product_id,
		'product_name' => $row->product_name,
		'product_code' => $row->product_code,
		'category_1' => $row->category_1,
		'category_2' => $row->category_2,
		'baseline_sales' => $row->baseline_sales,
		'incremental_sales' => $row->incremental_sales,
		'SecLogUser' => $row->SecLogUser,
		'SecLogDate' => $row->SecLogDate,
	    );
            $this->template->load('template','product/product_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('product/create_action'),
	    'product_id' => set_value('product_id'),
	    'product_name' => set_value('product_name'),
	    'product_code' => set_value('product_code'),
	    'category_1' => set_value('category_1'),
	    'category_2' => set_value('category_2'),
	    'baseline_sales' => set_value('baseline_sales'),
	    'incremental_sales' => set_value('incremental_sales'),
	    'SecLogUser' => set_value('SecLogUser'),
	    'SecLogDate' => set_value('SecLogDate'),
	);
        $this->template->load('template','product/product_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'product_name' => $this->input->post('product_name',TRUE),
		'product_code' => $this->input->post('product_code',TRUE),
		'category_1' => $this->input->post('category_1',TRUE),
		'category_2' => $this->input->post('category_2',TRUE),
		'baseline_sales' => $this->input->post('baseline_sales',TRUE),
		'incremental_sales' => $this->input->post('incremental_sales',TRUE),
		'SecLogUser' => $this->input->post('SecLogUser',TRUE),
		'SecLogDate' => $this->input->post('SecLogDate',TRUE),
	    );

            $this->Product_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('product'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Product_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('product/update_action'),
		'product_id' => set_value('product_id', $row->product_id),
		'product_name' => set_value('product_name', $row->product_name),
		'product_code' => set_value('product_code', $row->product_code),
		'category_1' => set_value('category_1', $row->category_1),
		'category_2' => set_value('category_2', $row->category_2),
		'baseline_sales' => set_value('baseline_sales', $row->baseline_sales),
		'incremental_sales' => set_value('incremental_sales', $row->incremental_sales),
		'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
		'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
	    );
            $this->template->load('template','product/product_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('product_id', TRUE));
        } else {
            $data = array(
		'product_name' => $this->input->post('product_name',TRUE),
		'product_code' => $this->input->post('product_code',TRUE),
		'category_1' => $this->input->post('category_1',TRUE),
		'category_2' => $this->input->post('category_2',TRUE),
		'baseline_sales' => $this->input->post('baseline_sales',TRUE),
		'incremental_sales' => $this->input->post('incremental_sales',TRUE),
		'SecLogUser' => $this->input->post('SecLogUser',TRUE),
		'SecLogDate' => $this->input->post('SecLogDate',TRUE),
	    );

            $this->Product_model->update($this->input->post('product_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('product'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Product_model->get_by_id($id);

        if ($row) {
            $this->Product_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('product'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('product_name', 'product name', 'trim|required');
	$this->form_validation->set_rules('product_code', 'product code', 'trim|required');
	$this->form_validation->set_rules('category_1', 'category 1', 'trim|required');
	$this->form_validation->set_rules('category_2', 'category 2', 'trim|required');
	$this->form_validation->set_rules('baseline_sales', 'baseline sales', 'trim|required|numeric');
	$this->form_validation->set_rules('incremental_sales', 'incremental sales', 'trim|required|numeric');
	$this->form_validation->set_rules('SecLogUser', 'secloguser', 'trim|required');
	$this->form_validation->set_rules('SecLogDate', 'seclogdate', 'trim|required');

	$this->form_validation->set_rules('product_id', 'product_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-08-19 06:50:17 */
/* http://harviacode.com */