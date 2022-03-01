<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approval_program extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Approval_program_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'approval_program/approval_program_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Approval_program_model->json();
    }

    public function read($id)
    {
        $row = $this->Approval_program_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->approval_id,
                'id_users' => $row->id_users,
                'id_user_level' => $row->id_user_level,
                'kode_departemen' => $row->kode_departemen,
                'SecLogDate' => $row->SecLogDate,
                'SecLogUser' => $row->SecLogUser,
            );
            $this->template->load('template', 'approval_program/approval_program_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('approval_program'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('approval_program/create_action'),
            'approval_id' => set_value('approval_id'),
            'id_users' => set_value('id_users'),
            'id_user_level' => set_value('id_user_level'),
            'kode_departemen' => set_value('kode_departemen'),
            'SecLogDate' => set_value('SecLogDate'),
            'SecLogUser' => set_value('SecLogUser'),
        );
        $this->template->load('template', 'approval_program/approval_program_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_users' => $this->input->post('id_users', TRUE),
                'id_user_level' => $this->input->post('id_user_level', TRUE),
                'kode_departemen' => $this->input->post('kode_departemen', TRUE),
                'SecLogUser' => $this->session->userdata('full_name'),
                'SecLogDate' => date('Y-m-d H:i:s'),
            );

            $this->Approval_program_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('approval_program'));
        }
    }

    public function update($id)
    {
        $row = $this->Approval_program_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('approval_program/update_action'),
                'approval_id' => set_value('id', $row->approval_id),
                'id_users' => set_value('id_users', $row->id_users),
                'id_user_level' => set_value('id_user_level', $row->id_user_level),
                'kode_departemen' => set_value('kode_departemen', $row->kode_departemen),
                'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
                'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
            );
            $this->template->load('template', 'approval_program/approval_program_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('approval_program'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('approval_id', TRUE));
        } else {
            $data = array(
                'id_users' => $this->input->post('id_users', TRUE),
                'id_user_level' => $this->input->post('id_user_level', TRUE),
                'kode_departemen' => $this->input->post('kode_departemen', TRUE),
                'SecLogDate' => $this->input->post('SecLogDate', TRUE),
                'SecLogUser' => $this->input->post('SecLogUser', TRUE),
            );

            $this->Approval_program_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('approval_program'));
        }
    }

    public function delete($id)
    {
        $row = $this->Approval_program_model->get_by_id($id);

        if ($row) {
            $this->Approval_program_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('approval_program'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('approval_program'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('approval_scheme', 'approval scheme', 'trim|required');
        $this->form_validation->set_rules('id_user_level', 'id user level', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "approval_program.xls";
        $judul = "approval_program";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Approval Scheme");
        xlsWriteLabel($tablehead, $kolomhead++, "Id User Level");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Departemen");
        xlsWriteLabel($tablehead, $kolomhead++, "SecLogDate");
        xlsWriteLabel($tablehead, $kolomhead++, "SecLogUser");

        foreach ($this->Approval_program_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->approval_scheme);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_user_level);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode_departemen);
            xlsWriteLabel($tablebody, $kolombody++, $data->SecLogDate);
            xlsWriteLabel($tablebody, $kolombody++, $data->SecLogUser);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Approval_program.php */
/* Location: ./application/controllers/Approval_program.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-30 11:14:19 */
/* http://harviacode.com */
