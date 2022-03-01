<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approval_claim extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Approval_claim_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'approval_claim/approval_claim_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Approval_claim_model->json();
    }

    public function read($id)
    {
        $row = $this->Approval_claim_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'approval_scheme' => $row->approval_scheme,
                'id_user_level' => $row->id_user_level,
                'region_id' => $row->region_id,
                'SecLogDate' => $row->SecLogDate,
                'SecLogUser' => $row->SecLogUser,
            );
            $this->template->load('template', 'approval_claim/approval_claim_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('approval_claim'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('approval_claim/create_action'),
            'id' => set_value('id'),
            'approval_scheme' => set_value('approval_scheme'),
            'id_user_level' => set_value('id_user_level'),
            'region_id' => set_value('region_id'),
            'SecLogDate' => set_value('SecLogDate'),
            'SecLogUser' => set_value('SecLogUser'),
        );
        $this->template->load('template', 'approval_claim/approval_claim_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'approval_scheme' => $this->input->post('approval_scheme', TRUE),
                'id_user_level' => $this->input->post('id_user_level', TRUE),
                'region_id' => $this->input->post('region_id', TRUE),
                'SecLogDate' => date('Y-m-d H:i:s'),
                'SecLogUser' => $this->session->userdata('full_name'),
            );

            $this->Approval_claim_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('approval_claim'));
        }
    }

    public function update($id)
    {
        $row = $this->Approval_claim_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('approval_claim/update_action'),
                'id' => set_value('id', $row->id),
                'approval_scheme' => set_value('approval_scheme', $row->approval_scheme),
                'id_user_level' => set_value('id_user_level', $row->id_user_level),
                'region_id' => set_value('region_id', $row->region_id),
                'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
                'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
            );
            $this->template->load('template', 'approval_claim/approval_claim_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('approval_claim'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'approval_scheme' => $this->input->post('approval_scheme', TRUE),
                'id_user_level' => $this->input->post('id_user_level', TRUE),
                'region_id' => $this->input->post('region_id', TRUE),
                'SecLogDate' => date('Y-m-d H:i:s'),
                'SecLogUser' => $this->session->userdata('full_name'),
            );

            $this->Approval_claim_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('approval_claim'));
        }
    }

    public function delete($id)
    {
        $row = $this->Approval_claim_model->get_by_id($id);

        if ($row) {
            $this->Approval_claim_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('approval_claim'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('approval_claim'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('approval_scheme', 'approval scheme', 'trim|required');
        $this->form_validation->set_rules('id_user_level', 'id user level', 'trim|required');
        // $this->form_validation->set_rules('region_id', 'region_id', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}