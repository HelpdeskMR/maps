<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wf_claim extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Wf_claim_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'wf_claim/wf_claim_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        $id_user_level = $this->session->userdata('id_user_level');
        $scheme = $this->Wf_claim_model->get_scheme($id_user_level);

        if ($scheme == 1) {
            echo $this->Wf_claim_model->json();
        } else {
            echo $this->Wf_claim_model->json_scheme();
        }
    }

    
    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('wf_claim/create_action'),
            'id' => set_value('id'),
            'no_klaim' => set_value('no_klaim'),
            'approval_scheme' => set_value('approval_scheme'),
            'id_user_level' => set_value('id_user_level'),
            'approve_by' => set_value('approve_by'),
            'approval_date' => set_value('approval_date'),
            'reject_by' => set_value('reject_by'),
            'reject_date' => set_value('reject_date'),
            'SecLogDate' => set_value('SecLogDate'),
            'SecLogUser' => set_value('SecLogUser'),
        );
        $this->template->load('template', 'wf_claim/wf_claim_form', $data);
    }

    public function create_action()
    {
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_klaim' => $this->input->post('no_klaim', TRUE),
                'approval_scheme' => $this->input->post('approval_scheme', TRUE),
                'id_user_level' => $this->input->post('id_user_level', TRUE),
                'approve_by' => $this->input->post('approve_by', TRUE),
                'approval_date' => $this->input->post('approval_date', TRUE),
                'reject_by' => $this->input->post('reject_by', TRUE),
                'reject_date' => $this->input->post('reject_date', TRUE),
                'SecLogDate' => $this->input->post('SecLogDate', TRUE),
                'SecLogUser' => $this->input->post('SecLogUser', TRUE),
            );

            $this->Wf_claim_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('wf_claim'));
        }
    }

    public function update($id)
    {
        $row = $this->Wf_claim_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button_approve' => 'Approve',
                'button_reject' => 'REJECT',
                'action' => site_url('wf_claim/update_action'),
                'id' => set_value('id', $row->id),
                'claim_id' => set_value('claim_id', $row->claim_id),
                'no_klaim' => set_value('no_klaim', $row->no_klaim),
                'kode_distributor' => set_value('kode_distributor', $row->kode_distributor),
                'nama_distributor' => set_value('nama_distributor', $row->nama_distributor),
                'tgl_klaim' => set_value('tgl_klaim', $row->tgl_klaim),
                'no_p3' => set_value('no_p3', $row->no_p3),
                'program_id' => set_value('program_id', $row->program_id),
                'nama_program' => $row->nama_program,
                'deskripsi' => set_value('deskripsi', $row->deskripsi),
                'claim_dpp' => set_value('claim_dpp', $row->claim_dpp),
                'claim_ppn' => set_value('claim_ppn', $row->claim_ppn),
                'claim_pph' => set_value('claim_pph', $row->claim_pph),
                'total_claim' => set_value('total_claim', $row->total_claim),
                'faktur_pajak' => set_value('faktur_pajak', $row->faktur_pajak),
                'npwp' => set_value('npwp', $row->npwp),
                'pemohon' => set_value('Pemohon', $row->pemohon),
                'approval_scheme' => set_value('approval_scheme', $row->approval_scheme),
                'id_user_level' => set_value('id_user_level', $row->id_user_level),
                'approve_by' => set_value('approve_by', $row->approve_by),
                'approval_date' => set_value('approval_date', $row->approval_date),
                'reject_by' => set_value('reject_by', $row->reject_by),
                'reject_date' => set_value('reject_date', $row->reject_date),
                'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
                'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
                'gl_coa_desc' => set_value('SecLogUser', $row->gl_coa_desc),
            );
            $this->template->load('template', 'wf_claim/wf_claim_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wf_claim'));
        }
    }

    public function update_action()
    {
        /* Update WF Claim */
            $data = array(
            'approve_by' => $this->session->userdata('full_name'),
            'approval_date' => date('Y-m-d H:i:s')
            );
            $this->Wf_claim_model->update($this->input->post('id', TRUE), $data);

        $id_user_level = $this->session->userdata('id_user_level');
        $scheme = $this->Wf_claim_model->get_scheme($id_user_level);

        if ($scheme == 1) {
            $status = 1;
        } else {
            $status = 3;
        }

        /* Update Form Claim */
        $data = array(
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'claim_dpp' => $this->input->post('claim_dpp', TRUE),
                'claim_ppn' => $this->input->post('claim_ppn', TRUE),
                'claim_pph' => $this->input->post('claim_pph', TRUE),
                'total_claim' => $this->input->post('total_claim', TRUE),
                'faktur_pajak' => $this->input->post('faktur_pajak', TRUE),
                'npwp' => $this->input->post('npwp', TRUE),
                'status' => $status,
                'SecLogUser' => $this->session->userdata('full_name'),
                'SecLogDate' => date('Y-m-d H:i:s'),
            );
        $this->Wf_claim_model->update_claim($this->input->post('claim_id', TRUE), $data);

        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('wf_claim'));
        
    }

    /* REJECT CLAIM */
    public function reject_action($id)
    {
        $row = $this->Wf_claim_model->get_by_id($id);
        if ($row) {
            /*UPDATE WF CLAIM*/
            $data = array(
                'reject_by' => $this->session->userdata('full_name'),
                'reject_date' => date('Y-m-d H:i:s')
            );
            $this->Wf_claim_model->update($id, $data);

            /*UPDATE CLAIM*/
            $data_claim = array(
                'status' => 2,
                'SecLogUser' => $this->session->userdata('full_name'),
                'SecLogDate' => date('Y-m-d H:i:s'),
            );
            $this->Wf_claim_model->update_claim($row->no_klaim, $data_claim);

            /* UPDATE BUDGET CLAIM */
            $no_p3 = $row->no_p3;
            $row_budget = $this->Wf_claim_model->get_budget_amount($no_p3);

            /* SKU TOTAL USAGE */
            $SkuTotalUsage = $row_budget->sku_total_usage;
            $TotalClaim = $row->total_claim;
            $SkuTotalUsage = $SkuTotalUsage - $TotalClaim;

            /* SKU TOTAL SALDO */
            $SkuTotalSaldo = $row_budget->sku_total_saldo;
            $TotalSkuSaldo = $SkuTotalSaldo + $TotalClaim;

            /* UPDATE MASTER BUDGET */
            $BudgetUsage = array(
                'sku_total_usage' => $SkuTotalUsage,
                'sku_total_saldo' => $TotalSkuSaldo,
                'SecLogDate' => date('Y-m-d H:i:s'),
                'SecLogUser' => $this->session->userdata('full_name'),
            );

            $this->Wf_claim_model->update_usage($no_p3, $BudgetUsage);

            $this->session->set_flashdata('alert', 'Reject Success');
            redirect(site_url('wf_claim'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wf_claim'));
        }
    }

    

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "wf_claim.xls";
        $judul = "wf_claim";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No Klaim");
        xlsWriteLabel($tablehead, $kolomhead++, "Approval Scheme");
        xlsWriteLabel($tablehead, $kolomhead++, "Id User Level");
        xlsWriteLabel($tablehead, $kolomhead++, "Approve By");
        xlsWriteLabel($tablehead, $kolomhead++, "Approval Date");
        xlsWriteLabel($tablehead, $kolomhead++, "Reject By");
        xlsWriteLabel($tablehead, $kolomhead++, "Reject Date");
        xlsWriteLabel($tablehead, $kolomhead++, "SecLogDate");
        xlsWriteLabel($tablehead, $kolomhead++, "SecLogUser");

        foreach ($this->Wf_claim_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_klaim);
            xlsWriteNumber($tablebody, $kolombody++, $data->approval_scheme);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_user_level);
            xlsWriteLabel($tablebody, $kolombody++, $data->approve_by);
            xlsWriteLabel($tablebody, $kolombody++, $data->approval_date);
            xlsWriteLabel($tablebody, $kolombody++, $data->reject_by);
            xlsWriteLabel($tablebody, $kolombody++, $data->reject_date);
            xlsWriteLabel($tablebody, $kolombody++, $data->SecLogDate);
            xlsWriteLabel($tablebody, $kolombody++, $data->SecLogUser);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Wf_claim.php */
/* Location: ./application/controllers/Wf_claim.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-19 04:32:13 */
/* http://harviacode.com */
