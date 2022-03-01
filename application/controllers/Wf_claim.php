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
        $this->load->model('Claim_model');
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
        echo $this->Wf_claim_model->json();
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

    public function read($id)
    {
        $row = $this->Wf_claim_model->get_form_claim($id);
        $row_get_claimId = $this->Claim_model->get_all();
        $row_approval = $this->Wf_claim_model->get_approval();
        $promotion_number = $row->promotion_number;
        $row_budgetPromotion = $this->Claim_model->get_budgetPromotion($promotion_number);
        if ($row) {
            $data = array(
                'action' => site_url('wf_claim/update_receive'),
                'id' => $row->id,
                'claim_id' => $row->claim_id,
                'tgl_claim' => $row->tgl_claim,
                'claim_number' => $row->claim_number,
                'promotion_number' => $row->promotion_number,
                'promotion_name' => $row->promotion_name,
                'kode_distributor' => $row->kode_distributor,
                'nama_distributor' => $row->nama_distributor,
                'dpp' => $row->dpp,
                'ppn' => $row->ppn,
                'pph' => $row->pph,
                'total' => $row->total,
                'invoice_number' => $row->invoice_number,
                'invoice' => $row->invoice,
                'faktur_pajak_number' => $row->faktur_pajak_number,
                'faktur_pajak' => $row->faktur_pajak,
                'dokumen' => $row->dokumen,
                'pkp' => $row->pkp,
                'npwp' => $row->npwp,
                'keterangan' => $row->keterangan,
                'row_get_claimId' => $row_get_claimId,
                'promotion_total_saldo' => $row->promotion_total_saldo,
                'promotion_total_cost' => $row->promotion_total_cost,
                'top' => set_value('top',  $row->top),
                // 'top' => $row->top,
                'due_date' => $row->due_date,
                'receive_status' => set_value('receive_status', $row->receive_status),
                'payment_plan' => $row->payment_plan,
                'payment_date' => $row->payment_date,
                'receive_date' => $row->receive_date,
                'row_approval' => $row_approval,
                'dpp_rev' => $row->dpp_rev,
                'ppn_rev' => $row->ppn_rev,
                'pph_rev' => $row->pph_rev,
                'total_rev' => $row->total_rev,
                'mekanisme_claim' => $row->mekanisme_claim,
                'row_budgetPromotion' => $row_budgetPromotion,
                'payment_method' => $row->payment_method,
            );
            $this->template->load('template', 'wf_claim/wf_claim_read', $data);
        }
    }

    public function update($id)
    {
        $row = $this->Wf_claim_model->get_form_claim($id);
        $kode_distributor = $this->session->userdata('kode_distributor');
		$store_code = $this->session->userdata('store_code');
		$region = $this->session->userdata('region_code');
		// $row_promotion = $this->Claim_model->get_promotion($store_code, $kode_distributor, $region);
        if($kode_distributor = $this->session->userdata('kode_distributor') != NULL){
            $row_promotion = $this->Claim_model->get_promotion($store_code, $kode_distributor, $region);
        } else {
            $row_promotion = $this->Wf_claim_model->get_promotion();
        }
        if ($row) {
            $data = array(
                'action' => site_url('wf_claim/update_action'),
                'id' => set_value('id', $row->id),
                'claim_id' => set_value('claim_id', $row->claim_id),
                'no_claim' => set_value('no_claim', $row->no_claim),
                'promotion_number' => set_value('promotion_number', $row->promotion_number),
                'kode_distributor' => set_value('kode_distributor', $row->kode_distributor),
                'nama_distributor' => set_value('nama_distributor', $row->nama_distributor),
                'promotion_name' => set_value('promotion_name', $row->promotion_name),
                'tgl_claim' => set_value('tgl_claim', $row->tgl_claim),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'dpp' => set_value('dpp', $row->dpp),
                'ppn' => set_value('ppn', $row->ppn),
                'pph' => set_value('pph', $row->pph),
                'total' => set_value('total', $row->total),
                'invoice_number' => set_value('invoice_number', $row->invoice_number),
                'invoice' => set_value('invoice', $row->invoice),
                'faktur_pajak_number' => set_value('faktur_pajak_number', $row->faktur_pajak_number),
                'faktur_pajak' => set_value('faktur_pajak', $row->faktur_pajak),
                'dokumen' => set_value('dokumen', $row->dokumen),
                'npwp' => set_value('npwp', $row->npwp),
                'pkp' => set_value('pkp', $row->pkp),
                'dpp_rev' => set_value('dpp_rev'),
                'ppn_rev' => set_value('ppn_rev'),
                'pph_rev' => set_value('pph_rev'),
                'total_rev' => set_value('total_rev'),
                'mekanisme_claim' => set_value('mekanisme_claim', $row->mekanisme_claim),
                'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
                'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
                'row_promotion' => $row_promotion,
                'statusClaim' => $row->statusClaim,
                'payment_method' => set_value('payment_method', $row->payment_method),
            );
            $this->template->load('template', 'wf_claim/wf_claim_edit', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wf_claim'));
        }
    }

    public function update_action()
    {
        $id = $this->input->post('claim_id', TRUE);
        $promotion_number = $this->input->post('promotion_number', TRUE);
        $row_claim = $this->Wf_claim_model->get_form_claim($id);

        //upload file
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
        $config['max_size']    = 20000;
        // $config['max_width']  = 1024;
        // $config['max_height']  = 768;
        $config['file_name'] = str_replace('%','',$_FILES["invoice"]['name']);

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $upload_invoice = 'invoice';
        if (!$this->upload->do_upload($upload_invoice)) {
            $error = $this->upload->display_errors();
            $data_invoice = array('file_name' => $row_claim->invoice);
        } else {
            $data_invoice = $this->upload->data();
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
        $config['max_size']    = 20000;
        // $config['max_width']  = 1024;
        // $config['max_height']  = 768;
        $config['file_name'] = str_replace('%','',$_FILES["faktur_pajak"]['name']);

        $upload_faktur = 'faktur_pajak';
        if (!$this->upload->do_upload($upload_faktur)) {
            $error = $this->upload->display_errors();
            $data_faktur = array('file_name' => $row_claim->faktur_pajak);
        } else {
            $data_faktur = $this->upload->data();
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|doc|docx|jpg|jpeg';
        $config['max_size']    = 20000;
        // $config['max_width']  = 1024;
        // $config['max_height']  = 768;
        $config['file_name'] = str_replace('%','',$_FILES["dokumen"]['name']);

        $dokumen = 'dokumen';
        if (!$this->upload->do_upload($dokumen)) {
            $error = $this->upload->display_errors();
            $data_dokumen = array('file_name' => $row_claim->dokumen);
        } else {
            $data_dokumen = $this->upload->data();
        }

        $data = array(
            'tgl_claim' => $this->input->post('tgl_claim', TRUE),
            'promotion_number' => $promotion_number,
            'kode_distributor' => $this->input->post('kode_distributor', TRUE),
            'nama_distributor' => $this->input->post('nama_distributor', TRUE),
            'dpp' => $this->input->post('dpp', TRUE),
            'ppn' => $this->input->post('ppn', TRUE),
            'pph' => $this->input->post('pph', TRUE),
            'total' => $this->input->post('total', TRUE),
            'invoice_number' => $this->input->post('invoice_number', TRUE),
            'invoice' => $data_invoice['file_name'],
            'faktur_pajak_number' => $this->input->post('faktur_pajak_number', TRUE),
            'faktur_pajak' => $data_faktur['file_name'],
            'dokumen' => $data_dokumen['file_name'],
            'pkp' => $this->input->post('pkp', TRUE),
            'npwp' => $this->input->post('npwp', TRUE),
            'keterangan' => $this->input->post('keterangan', TRUE),
            'dpp_rev' => $this->input->post('dpp_rev', TRUE),
            'ppn_rev' => $this->input->post('ppn_rev', TRUE),
            'pph_rev' => $this->input->post('pph_rev', TRUE),
            'total_rev' => $this->input->post('total_rev', TRUE),
            'mekanisme_claim' => $this->input->post('mekanisme_claim', TRUE),
            'SecLogDate' => date('Y-m-d H:i:s'),
            'SecLogUser' => $this->session->userdata('full_name'),
            'payment_method' => $this->input->post('payment_method', TRUE),
        );

        $this->Claim_model->update($id, $data);

        if ($row_claim->statusClaim == 1) {
            // PENGEMBALIAN BUDGET
            $row = $this->Claim_model->get_budget_program($row_claim->promotion_number);
            // /* sku_total_usage */
            $promotionTotalUsage = $row->promotion_total_usage;
            $TotalClaim = $this->input->post('dpp', TRUE);
            $TotalPromotionUsage = $promotionTotalUsage - $TotalClaim;

            // /* sku_total_saldo */
            $PromotionTotalSaldo = $row->promotion_total_saldo;
            $TotalPromotionSaldo = $PromotionTotalSaldo + $TotalClaim;

            // /* UPDATE MASTER BUDGET */
            $Usage = array(
                'promotion_total_usage' => $TotalPromotionUsage,
                'promotion_total_saldo' => $TotalPromotionSaldo,
                'SecLogDate' => date('Y-m-d H:i:s'),
                'SecLogUser' => $this->session->userdata('full_name'),
            );

            $this->Claim_model->update_usage($promotion_number, $Usage);

            // PEMOTONGAN BUDGET REVISI
            $rowRev = $this->Claim_model->get_budget_program($promotion_number);
            // /* sku_total_usage */
            $promotionTotalUsage = $rowRev->promotion_total_usage;
            $TotalClaim = $this->input->post('dpp_rev', TRUE);
            $TotalPromotionUsage = $promotionTotalUsage + $TotalClaim;

            // /* sku_total_saldo */
            $PromotionTotalSaldo = $rowRev->promotion_total_saldo;
            $TotalPromotionSaldo = $PromotionTotalSaldo - $TotalClaim;

            // /* UPDATE MASTER BUDGET */
            $Usage = array(
                'promotion_total_usage' => $TotalPromotionUsage,
                'promotion_total_saldo' => $TotalPromotionSaldo,
                'SecLogDate' => date('Y-m-d H:i:s'),
                'SecLogUser' => $this->session->userdata('full_name'),
            );

            $this->Claim_model->update_usage($promotion_number, $Usage);
        }

        $this->session->set_flashdata('message', 'Update Record Success');
        redirect('wf_claim');
    }

    public function update_receive()
    {
        $id = $this->input->post('claim_id', TRUE);
        $data = array(
            'receive_date' => date('Y-m-d H:i:s'),
            'receive_status' => 1,
            'SecLogDate' => date('Y-m-d H:i:s'),
            'SecLogUser' => $this->session->userdata('full_name'),
        );

        $this->Wf_claim_model->update_receive_claim($id, $data);

        $this->session->set_flashdata('message', 'Update Record Success');
        redirect('wf_claim/read/' . $id . '');
    }

    /* APPROVAL CLAIM */
    public function approve_action()
    {
        $claim_id = $this->input->post('claim_id', TRUE);
        $claim_number_form = $this->input->post('claim_number', TRUE);
        $row = $this->Wf_claim_model->get_by_id($claim_number_form);
        $approval_code = $this->input->post('approval', TRUE);
        if ($row) {
            $claim_number = $row->claim_number;
            $promotion_number = $row->promotion_number;
            $total = $row->total;
            if ($row->dpp_rev == 0) {
                $dpp = $row->dpp;
            } else {
                $dpp = $row->dpp_rev;
            }
            $store_code = $row->store_code;
            $kode_distributor = $row->kode_distributor;
            $total_on_top_promo = $row->total_on_top_promo;

            if ($this->session->userdata('id_user_level') == 13) {
                //Cek Budget
                $row_budget = $this->Claim_model->get_budget_program($promotion_number);
                $PromotionTotalSaldo = $row_budget->promotion_total_saldo;

                if ($dpp > $PromotionTotalSaldo) {
                    $this->session->set_flashdata('over_budget', 'Over Budget untuk Total Klaim Rp. ' . $dpp . ', Sisa Budget Program yang tersedia Rp. ' . $PromotionTotalSaldo . '');
                    $this->read($claim_id);
                } else {

                    /*UPDATE WORKFLOW*/
                    $data = array(
                        'approve_by' => $this->session->userdata('full_name'),
                        'approval_date' => date('Y-m-d H:i:s')
                    );
                    $this->Wf_claim_model->update_wf_claim($row->approval_scheme, $claim_number, $data);

                    /*UPDATE APPROVAL LIST */
                    $row_approvalList = $this->Wf_claim_model->get_approvalList($approval_code, $store_code, $total_on_top_promo);
                    $index1 = 2;
                    $approvalArray = array();
                    foreach ($row_approvalList as $data) {
                        $add_data = array(
                            'no_claim' => $claim_number,
                            'approval_scheme' => $index1,
                            'kode_distributor' => $kode_distributor,
                            'store_code' => $store_code,
                            'id_user_level' => $data['id_user_level'],
                            'id_users' => $data['id_users'],
                            'approve_by' => NULL,
                            'approval_date' => NULL,
                            'reject_by' => NULL,
                            'reject_date' => NULL,
                            'reject_reason' => NULL,
                            'SecLogDate' => date('Y-m-d H:i:s'),
                            'SecLogUser' => $this->session->userdata('full_name'),
                        );
                        array_push($approvalArray, $add_data);
                        $index1++;
                    }
                    $this->Wf_claim_model->insert_approvalList($approvalArray);

                    /* UPDATE FORM CLAIM */
                    $wf_claim = $this->Wf_claim_model->get_wf_claim($claim_number);
                    $top = $this->input->post('top', TRUE);
                    $receive_date = $this->input->post('receive_date', TRUE);
                    $payment_method = $this->input->post('payment_method', TRUE);
                    // $date = date('Y-m-d');
                    $due_date = date('Y-m-d', strtotime('+' . $top . ' days', strtotime($receive_date))) . PHP_EOL;
                    if (empty($wf_claim)) {
                        $data_claim = array(
                            'status' => 4,
                            'approval_scheme' => ($row->approval_scheme),
                            'SecLogUser' => $this->session->userdata('full_name'),
                            'SecLogDate' => date('Y-m-d H:i:s'),
                        );
                    } else {
                        $data_claim = array(
                            'status' => 1,
                            'approval_scheme' => ($row->approval_scheme) + 1,
                            'top' => $top,
                            'due_date' => $due_date,
                            'payment_method' => $payment_method,
                            'SecLogUser' => $this->session->userdata('full_name'),
                            'SecLogDate' => date('Y-m-d H:i:s'),
                        );

                        $this->send($claim_number, $data_claim);
                    }

                    $this->Wf_claim_model->update_form_claim($claim_id, $data_claim);

                    //POTONG BUDGET

                    if ($row->dpp_rev == 0) {
                        $dppClaim = $row->dpp;
                    } else {
                        $dppClaim = $row->dpp_rev;
                    }

                    $row = $this->Claim_model->get_budget_program($promotion_number);
                    // /* sku_total_usage */
                    $promotionTotalUsage = $row->promotion_total_usage;
                    // $TotalClaim = $this->input->post('total');
                    // $TotalClaim = $this->input->post('dpp');
                    $TotalClaim = $dppClaim;
                    $TotalPromotionUsage = $promotionTotalUsage + $TotalClaim;

                    // /* sku_total_saldo */
                    $PromotionTotalSaldo = $row->promotion_total_saldo;
                    $TotalPromotionSaldo = $PromotionTotalSaldo - $TotalClaim;

                    // /* UPDATE MASTER BUDGET */
                    $Usage = array(
                        'promotion_total_usage' => $TotalPromotionUsage,
                        'promotion_total_saldo' => $TotalPromotionSaldo,
                        'SecLogDate' => date('Y-m-d H:i:s'),
                        'SecLogUser' => $this->session->userdata('full_name'),
                    );

                    $this->Claim_model->update_usage($promotion_number, $Usage);

                    $this->session->set_flashdata('alert', 'Approval Success');
                    redirect(site_url('wf_claim'));
                }
            } else {

                /*UPDATE WORKFLOW*/
                $data = array(
                    'approve_by' => $this->session->userdata('full_name'),
                    'approval_date' => date('Y-m-d H:i:s')
                );
                $this->Wf_claim_model->update_wf_claim($row->approval_scheme, $claim_number, $data);

                /* UPDATE FORM CLAIM */
                $wf_claim = $this->Wf_claim_model->get_wf_claim($claim_number);
                if (empty($wf_claim)) {
                    $data_claim = array(
                        'status' => 4,
                        'approval_scheme' => ($row->approval_scheme),
                        'SecLogUser' => $this->session->userdata('full_name'),
                        'SecLogDate' => date('Y-m-d H:i:s'),
                    );
                } else {
                    $data_claim = array(
                        'status' => 1,
                        'approval_scheme' => ($row->approval_scheme) + 1,
                        'SecLogUser' => $this->session->userdata('full_name'),
                        'SecLogDate' => date('Y-m-d H:i:s'),
                    );

                    $this->send($claim_number, $data_claim);
                }
                $this->Wf_claim_model->update_form_claim($claim_id, $data_claim);
                // $this->Wf_claim_model->update_form_claim($claim_number, $data_claim);
                $this->session->set_flashdata('alert', 'Approval Success');
                redirect(site_url('wf_claim'));
            }

            // $this->session->set_flashdata('alert', 'Approval Success');
            // redirect(site_url('wf_claim'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wf_claim'));
        }
    }

    /* REJECT CLAIM */
    public function reject_action()
    {
        $claim_id = $this->input->post('claim_id', TRUE);

        $row = $this->Wf_claim_model->get_form_claim($claim_id);
        if ($row) {
            $claim_number = $row->claim_number;
            $promotion_number = $row->promotion_number;

            if ($this->session->userdata('id_user_level') == 13) {
                /*UPDATE WORKFLOW*/
                $data = array(
                    'reject_by' => $this->session->userdata('full_name'),
                    'reject_date' => date('Y-m-d H:i:s'),
                    'reject_reason' => $this->input->post('reject_reason', TRUE)
                );
                $this->Wf_claim_model->update_wfClaim($row->approval_scheme, $row->claim_number, $data);

                /*UPDATE CLAIM*/
                $data_claim = array(
                    'status' => 2,
                    'SecLogUser' => $this->session->userdata('full_name'),
                    'SecLogDate' => date('Y-m-d H:i:s'),
                );
                $this->Wf_claim_model->update_formClaim($claim_number, $data_claim);
            } else {
                /*UPDATE WORKFLOW*/
                $data = array(
                    'reject_by' => $this->session->userdata('full_name'),
                    'reject_date' => date('Y-m-d H:i:s'),
                    'reject_reason' => $this->input->post('reject_reason', TRUE)
                );
                $this->Wf_claim_model->update_wfClaim($row->approval_scheme, $row->claim_number, $data);

                /*UPDATE CLAIM*/
                $data_claim = array(
                    'status' => 2,
                    'SecLogUser' => $this->session->userdata('full_name'),
                    'SecLogDate' => date('Y-m-d H:i:s'),
                );
                $this->Wf_claim_model->update_formClaim($claim_number, $data_claim);

                /* FORM PROMOTION BUDGET UPDATE */
                // $total_claim = $row->total;
                if($row->dpp_rev == 0) {
                    $total_claim = $row->dpp;
                } else {
                    $total_claim = $row->dpp_rev;
                }
                $row_budget = $this->Wf_claim_model->get_promotion_budget($promotion_number);

                $promotion_total_usage = $row_budget->promotion_total_usage - $total_claim;
                $promotion_total_saldo = $row_budget->promotion_total_saldo + $total_claim;

                $dataPromotionBudget = array(
                    'promotion_total_usage' => $promotion_total_usage,
                    'promotion_total_saldo' => $promotion_total_saldo,
                    'SecLogDate' => date('Y-m-d H:i:s'),
                    'SecLogUser' => $this->session->userdata('full_name')
                );

                $this->Wf_claim_model->update_promotion_budget($dataPromotionBudget, $promotion_number);
            }
            $this->send_reject($claim_number, $data_claim, $data);
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

    public function send($claim_number, $data_claim)
    {
        //Load data
        $row_data = $this->Wf_claim_model->get_data($claim_number);
        $row_email = $this->Wf_claim_model->get_email($claim_number, $data_claim);
        $alamat_email = $row_email->email;

        $message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_email->full_name . ',<br/><br/>A request by ' . $row_data->nama_distributor . ' has been submitted that requires your approval.</p>
      </div>
		<div>
        <p>The request detail : <a href="' . site_url() . 'wf_claim/read/' . $row_data->claim_id . '">' . site_url() . 'wf_claim/read/' . $row_data->claim_id . '</a>.</p>
	  </div>
	  <table border="1" bordercolor="#333333">
		<thead>
        <tr>
          <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">FORM CLAIM</font></b></td>
		</tr>
		</thead>
		<tbody>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Date</td>
		  <td style="padding-left:20px; padding-right:20px;">' . $row_data->tgl_claim . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Distributor/Store</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_distributor . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">DPP</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->dpp . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">PPN 10%</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->ppn . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">PPPH 23</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->pph . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Total Claim</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total) . '</td>
        </tr>
		</tbody>
	  </table>';

        //Send Email
        $config['protocol'] = 'smtp';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
        $config['smtp_pass'] = 'mustikagoogle';
        $config['mailtype'] = 'html';

        $this->load->library('email', $config);

        $this->email->initialize($config);

        $this->email->set_newline("\r\n");
        $this->email->from('mustikaratu.mailer@gmail.co.id', 'MAPS');
        $this->email->to($alamat_email);
        // $this->email->to('development@mustika-ratu.co.id');
        $this->email->subject('Claim Number : ' . $claim_number . ' ');
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
        } else {
            $this->session->set_flashdata("email_sent", "Error in sending Email.");
            // show_error($this->email->print_debugger());
        }
    }

    public function send_reject($claim_number, $data_claim, $data)
    {
        //Load data
        $row_data = $this->Wf_claim_model->get_data_reject($claim_number);
        // $row_cc = $this->Wf_claim_model->get_cc($claim_number, $data_claim);
        $alamat_email = $row_data->email;

        // $index = 0;
        // foreach ($row_cc as $cc){
        //     $email_cc[$index] = $cc['email'];
        //     $index++;
        // }

        $message = '<div>
        <p>Yth. Bapak/Ibu ' . $row_data->full_name . ',<br/><br/>Your request has been rejected by ' . $data['reject_by'] . '.<br/>Reject date : ' . $data['reject_date'] . '.<br/>Reject reason : ' . $data['reject_reason'] . '.</p>
      </div>
	  <table border="1" bordercolor="#333333">
		<thead>
        <tr>
          <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">FORM CLAIM</font></b></td>
		</tr>
		</thead>
		<tbody>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Date</td>
		  <td style="padding-left:20px; padding-right:20px;">' . $row_data->tgl_claim . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Distributor/Store</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->nama_distributor . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">DPP</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->dpp . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">PPN 10%</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->ppn . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">PPPH 23</td>
          <td style="padding-left:20px; padding-right:20px;">' . $row_data->pph . '</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Total Claim</td>
          <td style="padding-left:20px; padding-right:20px;">' . number_format($row_data->total) . '</td>
        </tr>
		</tbody>
	  </table>';

        //Send Email
        $config['protocol'] = 'smtp';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
        $config['smtp_pass'] = 'mustikagoogle';
        $config['mailtype'] = 'html';

        $this->load->library('email', $config);

        $this->email->initialize($config);

        $this->email->set_newline("\r\n");
        $this->email->from('mustikaratu.mailer@gmail.co.id', 'MAPS');
        $this->email->to($alamat_email);
        // $this->email->to('development@mustika-ratu.co.id');
        // $this->email->cc($email_cc);
        $this->email->subject('Claim Number : ' . $claim_number . ' ');
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
        } else {
            $this->session->set_flashdata("email_sent", "Error in sending Email.");
            // show_error($this->email->print_debugger());
        }
    }
}

/* End of file Wf_claim.php */
/* Location: ./application/controllers/Wf_claim.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-19 04:32:13 */
/* http://harviacode.com */
