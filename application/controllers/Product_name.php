<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_name extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Product_name_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'product_name/product_name_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Product_name_model->json();
    }

    public function read($id)
    {
        $row = $this->Product_name_model->get_by_id($id);
        if ($row) {
            $data = array(
                'product_name_id' => $row->product_name_id,
                'product_code' => $row->product_code,
                'product_name' => $row->product_name,
                'category_1' => $row->category_1,
                'category_2' => $row->category_2,
                'business_unit_id' => $row->business_unit_id,
            );
            $this->template->load('template', 'product_name/product_name_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_name'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('product_name/create_action'),
            'product_name_id' => set_value('product_name_id'),
            'product_code' => set_value('product_code'),
            'product_name' => set_value('product_name'),
            'category_1' => set_value('category_1'),
            'category_2' => set_value('category_2'),
            'business_unit_id' => set_value('business_unit_id'),
        );
        $this->template->load('template', 'product_name/product_name_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'product_code' => $this->input->post('product_code', TRUE),
                'product_name' => $this->input->post('product_name', TRUE),
                'category_1' => $this->input->post('category_1', TRUE),
                'category_2' => $this->input->post('category_2', TRUE),
                'business_unit_id' => $this->input->post('business_unit_id', TRUE),
            );

            $this->Product_name_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('product_name'));
        }
    }

    public function update($id)
    {
        $row = $this->Product_name_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('product_name/update_action'),
                'product_name_id' => set_value('product_name_id', $row->product_name_id),
                'product_code' => set_value('product_code', $row->product_code),
                'product_name' => set_value('product_name', $row->product_name),
                'category_1' => set_value('category_1', $row->category_1),
                'category_2' => set_value('category_2', $row->category_2),
                'business_unit_id' => set_value('business_unit_id', $row->business_unit_id),
            );
            $this->template->load('template', 'product_name/product_name_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_name'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('product_name_id', TRUE));
        } else {
            $data = array(
                'product_code' => $this->input->post('product_code', TRUE),
                'product_name' => $this->input->post('product_name', TRUE),
                'category_1' => $this->input->post('category_1', TRUE),
                'category_2' => $this->input->post('category_2', TRUE),
                'business_unit_id' => $this->input->post('business_unit_id', TRUE),
            );

            $this->Product_name_model->update($this->input->post('product_name_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('product_name'));
        }
    }

    public function delete($id)
    {
        $row = $this->Product_name_model->get_by_id($id);

        if ($row) {
            $this->Product_name_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('product_name'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_name'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('product_code', 'product code', 'trim|required');
        $this->form_validation->set_rules('product_name', 'product name', 'trim|required');

        $this->form_validation->set_rules('product_name_id', 'product_name_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Product_name.php */
/* Location: ./application/controllers/Product_name.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-08-19 08:44:47 */
/* http://harviacode.com */