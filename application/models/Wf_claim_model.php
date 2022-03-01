<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wf_claim_model extends CI_Model
{

    public $table = 'wf_claim';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $id_user_level = $this->session->userdata('id_user_level');
        $id_user = $this->session->userdata('id_users');
        $status = array('0', '1');
        $this->datatables->select('wf_claim.id,
            wf_claim.no_claim,
            wf_claim.approval_scheme,
            wf_claim.kode_distributor,
            wf_claim.store_code,
            wf_claim.id_user_level,
            wf_claim.id_users,
            wf_claim.approve_by,
            wf_claim.approval_date,
            wf_claim.reject_by,
            wf_claim.reject_date,
            wf_claim.reject_reason,
            form_claim.claim_id,
            form_claim.nama_distributor,
            form_claim.tgl_claim,
            form_claim.total,
            form_claim.promotion_number,
            form_claim.dpp,
            form_claim.ppn,
            form_claim.pph,
            form_claim.dpp_rev,
            form_claim.ppn_rev,
            form_claim.pph_rev,
            form_claim.total_rev,
            form_claim.mekanisme_claim
        ');
        $this->datatables->from('wf_claim');
        $this->datatables->join('form_claim', 'wf_claim.no_claim = form_claim.claim_number AND wf_claim.approval_scheme = form_claim.approval_scheme', 'left');
        $this->datatables->where('wf_claim.id_user_level', $id_user_level);
        $this->datatables->where('wf_claim.id_users', $id_user);
        $this->datatables->where('wf_claim.reject_date', NULL);
        $this->datatables->where_in('form_claim.status', $status);
        if ($id_user_level == 13 || $id_user_level == 19 || $id_user_level == 20 || $id_user_level == 12 || $id_user_level == 23) {
            $this->datatables->add_column('action', anchor(site_url('wf_claim/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i> Detail', array('class' => 'btn btn-success btn-sm')) . " 
        " . anchor(site_url('wf_claim/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit', array('class' => 'btn btn-warning btn-sm')), 'claim_id');
        } else {
            $this->datatables->add_column('action', anchor(site_url('wf_claim/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i> Detail', array('class' => 'btn btn-success btn-sm')), 'claim_id');
        }

        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($claim_number)
    {
        $this->db->select('wf_claim.id,
        wf_claim.no_claim,
        wf_claim.approval_scheme,
        wf_claim.kode_distributor,
        wf_claim.store_code,
        wf_claim.id_user_level,
        wf_claim.id_users,
        wf_claim.approve_by,
        wf_claim.approval_date,
        wf_claim.reject_by,
        wf_claim.reject_date,
        wf_claim.reject_reason,
        form_claim.claim_id,
        form_claim.tgl_claim,
        form_claim.claim_number,
        form_claim.promotion_number,
        form_claim.nama_distributor,
        form_claim.dpp,
        form_claim.ppn,
        form_claim.pph,
        form_claim.total,
        form_claim.invoice_number,
        form_claim.invoice,
        form_claim.faktur_pajak_number,
        form_claim.faktur_pajak,
        form_claim.dokumen,
        form_claim.pkp,
        form_claim.npwp,
        form_claim.keterangan,
        form_claim.pemohon,
        form_claim.`status`,
        form_claim.approval_scheme,
        form_claim.receive_date,
        form_claim.receive_status,
        form_claim.top,
        form_claim.due_date,
        form_claim.payment_plan,
        form_claim.payment_date,
        form_claim.dpp_rev,
        form_claim.ppn_rev,
        form_claim.pph_rev,
        form_claim.total_rev,
        form_promotion.total_on_top_promo', false);
        $this->db->join('form_claim', 'wf_claim.no_claim = form_claim.claim_number','left');
        $this->db->join('form_promotion', 'form_claim.promotion_number = form_promotion.promotion_number','left');
        $this->db->where('wf_claim.no_claim', $claim_number);
        return $this->db->get($this->table)->row();
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_claim($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get('form_claim')->row();
    }

    function get_form_claim($id)
    {   
        $this->db->select('wf_claim.id,
        wf_claim.no_claim,
        wf_claim.approval_scheme,
        wf_claim.kode_distributor,
        wf_claim.store_code,
        wf_claim.id_user_level,
        wf_claim.id_users,
        wf_claim.approve_by,
        wf_claim.approval_date,
        wf_claim.reject_by,
        wf_claim.reject_date,
        wf_claim.reject_reason,
        form_claim.claim_id,
        form_claim.tgl_claim,
        form_claim.claim_number,
        form_claim.promotion_number,
        form_claim.kode_distributor,
        form_claim.nama_distributor,
        form_claim.dpp,
        form_claim.ppn,
        form_claim.pph,
        form_claim.total,
        form_claim.invoice_number,
        form_claim.invoice,
        form_claim.faktur_pajak_number,
        form_claim.faktur_pajak,
        form_claim.dokumen,
        form_claim.pkp,
        form_claim.npwp,
        form_claim.keterangan,
        form_claim.pemohon,
        form_claim.`status` AS statusClaim,
        form_claim.approval_scheme,
        form_claim.receive_date,
        form_claim.receive_status,
        form_claim.top,
        form_claim.due_date,
        form_claim.payment_plan,
        form_claim.payment_date,
        form_claim.dpp_rev,
        form_claim.ppn_rev,
        form_claim.pph_rev,
        form_claim.total_rev,
        form_claim.mekanisme_claim,
        form_claim.payment_method,
        form_claim.SecLogDate,
        form_claim.SecLogUser,
        form_promotion.promotion_id,
        form_promotion.kode_perusahaan,
        form_promotion.date_create,
        form_promotion.periode_awal,
        form_promotion.periode_akhir,
        form_promotion.promotion_number AS promotionNumber_form,
        form_promotion.kode_departemen,
        form_promotion.promotion_name,
        form_promotion.promotion_period,
        form_promotion.fiscal_year,
        form_promotion.channel_code,
        form_promotion.region_code,
        form_promotion.kode_area,
        form_promotion.store_code,
        form_promotion.sales_background,
        form_promotion.sales_strategy,
        form_promotion.sales_objective,
        form_promotion.sales_mechanism,
        form_promotion.`status`,
        form_promotion.pemohon,
        form_promotion.total_product_baseline,
        form_promotion.total_product_incremental,
        form_promotion.total_listing_cost,
        form_promotion.total_on_top_promo,
        form_promotion.total_trading_term,
        form_promotion.approval_scheme as scheme_promotion,
        form_promotion.upload_file,
        form_promotion.upload_activity,
        form_promotion_budget.id,
        form_promotion_budget.promotion_number AS promotionNumber_budget,
        form_promotion_budget.promotion_id,
        form_promotion_budget.promotion_total_cost,
        form_promotion_budget.promotion_total_usage,
        form_promotion_budget.promotion_total_saldo,
        form_promotion_budget.`status`', false);
        $this->db->join('form_claim', 'wf_claim.no_claim = form_claim.claim_number');
        $this->db->join('form_promotion', 'form_claim.promotion_number = form_promotion.promotion_number');
        $this->db->join('form_promotion_budget', 'form_promotion.promotion_number = form_promotion_budget.promotion_number');
        $this->db->where('form_claim.claim_id', $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = null)
    {
        $this->db->like('id', $q);
        $this->db->or_like('no_klaim', $q);
        $this->db->or_like('approval_scheme', $q);
        $this->db->or_like('id_user_level', $q);
        $this->db->or_like('approve_by', $q);
        $this->db->or_like('approval_date', $q);
        $this->db->or_like('reject_by', $q);
        $this->db->or_like('reject_date', $q);
        $this->db->or_like('SecLogDate', $q);
        $this->db->or_like('SecLogUser', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('no_klaim', $q);
        $this->db->or_like('approval_scheme', $q);
        $this->db->or_like('id_user_level', $q);
        $this->db->or_like('approve_by', $q);
        $this->db->or_like('approval_date', $q);
        $this->db->or_like('reject_by', $q);
        $this->db->or_like('reject_date', $q);
        $this->db->or_like('SecLogDate', $q);
        $this->db->or_like('SecLogUser', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // update Form Claim
    function update_claim($claim_id, $data)
    {
        $this->db->where('claim_id', $claim_id);
        $this->db->update('form_claim', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_scheme($id_user_level)
    {
        $this->db->select('*', false);
        $this->db->where('id_user_level', $id_user_level);
        $this->db->order_by('approval_scheme', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get('approval_claim');
        $data = $query->row();
        $alias = $data->approval_scheme;
        return $alias;
    }

    // Get budget
    function get_budget_amount($no_p3)
    {
        $this->db->select('*', FALSE);
        $this->db->where('no_p3', $no_p3);
        $this->db->limit(1);
        $query = $this->db->get('form_budget_program');
        $data = $query->row();
        return $data;
    }

    // update budget claim
    function update_usage($no_p3, $BudgetUsage)
    {
        $this->db->where('no_p3', $no_p3);
        $this->db->update('form_budget_program', $BudgetUsage);
    }

    // update data
    function update_wf_claim($approval_scheme, $claim_number, $data)
    {
        $this->db->where('approval_scheme', $approval_scheme);
        $this->db->where('no_claim', $claim_number);
        $this->db->update('wf_claim', $data);
    }

    function get_wf_claim($claim_number)
    {
        $this->db->select('approve_by', FALSE);
        $this->db->join('form_claim', 'wf_claim.no_claim = form_claim.claim_number');
        $this->db->where('form_claim.claim_number', $claim_number);
        $this->db->where('(wf_claim.approve_by is NULL)', NULL, FALSE);
        return $this->db->get('wf_claim')->row();
    }

    /*UPDATE STATUS PROMOTION*/
    function update_form_claim($claim_id, $data_claim)
    {
        $this->db->where('claim_id', $claim_id);
        $this->db->update('form_claim', $data_claim);
    }

    /*UPDATE STATUS PROMOTION*/
    function update_receive_claim($id, $data)
    {
        $this->db->where('claim_id', $id);
        $this->db->update('form_claim',  $data);
    }

    function get_data($claim_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('claim_number', $claim_number);
        $query = $this->db->get('form_claim');
        $data = $query->row();
        return $data;
    }

    function get_email($claim_number, $data_claim)
    {
        $this->db->select('wf_claim.id,
        wf_claim.no_claim,
        wf_claim.approval_scheme,
        wf_claim.kode_distributor,
        wf_claim.store_code,
        wf_claim.id_user_level,
        wf_claim.id_users,
        wf_claim.approve_by,
        wf_claim.approval_date,
        wf_claim.reject_by,
        wf_claim.reject_date,
        wf_claim.reject_reason,
        wf_claim.SecLogDate,
        wf_claim.SecLogUser,
        tbl_user.full_name,
        tbl_user.email', FALSE);
        $this->db->join('tbl_user', 'wf_claim.id_users = tbl_user.id_users', 'left');
        $this->db->where('wf_claim.no_claim', $claim_number);
        $this->db->where('wf_claim.approval_scheme', $data_claim['approval_scheme']);
        $query = $this->db->get('wf_claim');
        $data = $query->row();
        return $data;
    }

    // update data
    function update_wfClaim($approval_scheme, $claim_number, $data)
    {
        $this->db->where('approval_scheme', $approval_scheme);
        $this->db->where('no_claim', $claim_number);
        $this->db->update('wf_claim', $data);
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    /*UPDATE STATUS PROMOTION*/
    function update_formClaim($claim_number, $data_claim)
    {
        $this->db->where('claim_number', $claim_number);
        $this->db->update('form_claim', $data_claim);
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    // Get Form Promotion Budget
    function get_promotion_budget($promotion_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $query = $this->db->get('form_promotion_budget');
        $data = $query->row();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function update_promotion_budget($dataPromotionBudget, $promotion_number)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->update('form_promotion_budget', $dataPromotionBudget);
    }

    function get_data_reject($claim_number)
    {
        $this->db->select('form_claim.claim_id,
        form_claim.tgl_claim,
        form_claim.claim_number,
        form_claim.promotion_number,
        form_claim.kode_distributor,
        form_claim.nama_distributor,
        form_claim.dpp,
        form_claim.ppn,
        form_claim.pph,
        form_claim.total,
        form_claim.invoice_number,
        form_claim.invoice,
        form_claim.faktur_pajak_number,
        form_claim.faktur_pajak,
        form_claim.pkp,
        form_claim.npwp,
        form_claim.keterangan,
        form_claim.pemohon,
        form_claim.`status`,
        form_claim.payment_date,
        form_claim.approval_scheme,
        form_claim.SecLogDate,
        form_claim.SecLogUser,
        tbl_user.full_name,
        tbl_user.email', FALSE);
        $this->db->join('tbl_user', 'form_claim.kode_distributor = tbl_user.kode_distributor', 'left');
        $this->db->where('form_claim.claim_number', $claim_number);
        $query = $this->db->get('form_claim');
        $data = $query->row();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approval()
    {
        $this->db->select('DISTINCT approval_code, approval_name', false);
        $query = $this->db->get('approval_claim');
        $data = $query->result_array();
        return $data;
    }

    function get_approvalList($approval_code, $store_code, $total_on_top_promo)
    {
        if($store_code != NULL || $store_code != ''){
            if($total_on_top_promo == 0) {
                $query = $this->db->query("SELECT * FROM (SELECT * FROM `approval_claim` WHERE approval_code = '".$approval_code."') AS approvalClaim WHERE  kode_departemen IS NULL OR store_code = '".$store_code."' ORDER BY approval_scheme");
            } else {
                $query = $this->db->query("SELECT * FROM (SELECT * FROM `approval_claim` WHERE approval_code = '".$approval_code."') AS approvalClaim WHERE  kode_departemen IS NULL OR channel_code IS NULL OR store_code = '".$store_code."' ORDER BY approval_scheme");
            }
        } else {
            $query = $this->db->query("SELECT * FROM (SELECT * FROM `approval_claim` WHERE approval_code = '".$approval_code."') AS approvalClaim WHERE  kode_departemen IS NULL OR channel_code IS NULL OR store_code = '".$store_code."' ORDER BY approval_scheme");
        }
        return $query->result_array();
        // $data = $query->result_array();
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function insert_approvalList($approvalArray)
    {
        $this->db->insert_batch('wf_claim', $approvalArray);
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_promotion()
    {
        $this->db->select('promotion_number, promotion_name', FALSE);
        $this->db->where('status', 4);
        $data = $this->db->get('form_promotion')->result_array();
        return $data;
    }
}
