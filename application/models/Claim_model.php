<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Claim_model extends CI_Model
{

    public $table = 'form_claim';
    public $id = 'claim_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // function json()
    // {

    //     if ($this->session->userdata('id_user_level') == 17){
    //         $kode_distributor = $this->session->userdata('kode_distributor');
    //         $this->datatables->select('form_claim.claim_id,
    //         form_claim.tgl_claim,
    //         form_claim.claim_number,
    //         form_claim.promotion_number,
    //         form_claim.dpp,
    //         form_claim.ppn,
    //         form_claim.pph,
    //         form_claim.total,
    //         form_claim.kode_distributor,
    //         form_claim.nama_distributor,
    //         form_claim.invoice_number,
    //         form_claim.invoice,
    //         form_claim.faktur_pajak_number,
    //         form_claim.faktur_pajak,
    //         form_claim.pkp,
    //         form_claim.npwp,
    //         form_claim.keterangan,
    //         form_claim.`status`,
    //         form_claim.payment_date,
    //         form_claim.approval_scheme,
    //         form_claim.total_rev,
    //         tbl_promotion_status.status_name,
    //         form_claim.receive_date,
    //         form_claim.receive_status,
    //         form_claim.top,
    //         form_claim.due_date,
    //         form_claim.payment_plan,
    //         form_claim.payment_date,
    //         form_claim.mekanisme_claim');
    //         $this->datatables->from('form_claim');
    //         $this->datatables->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
    //         $this->datatables->where('form_claim.kode_distributor', $kode_distributor);
    //         $this->datatables->add_column('action', anchor(site_url('claim/update/$1'), '<i class="fa fa-edit" aria-hidden="true"></i>', array('class' => 'btn btn-block btn-warning btn-xs')) . "  ", 'claim_id');
    //         $this->datatables->add_column('claimNumber', anchor(site_url('claim/read/$1'), '$2') . "  ", 'claim_id,claim_number');
    //         return $this->datatables->generate();
    //     } elseif ($this->session->userdata('id_user_level') == 24) {
    //         $kode_distributor = $this->session->userdata('kode_distributor');
    //         $this->datatables->select('form_claim.claim_id,
    //         form_claim.tgl_claim,
    //         form_claim.claim_number,
    //         form_claim.promotion_number,
    //         form_claim.dpp,
    //         form_claim.ppn,
    //         form_claim.pph,
    //         form_claim.total,
    //         form_claim.kode_distributor,
    //         form_claim.nama_distributor,
    //         form_claim.invoice_number,
    //         form_claim.invoice,
    //         form_claim.faktur_pajak_number,
    //         form_claim.faktur_pajak,
    //         form_claim.pkp,
    //         form_claim.npwp,
    //         form_claim.keterangan,
    //         form_claim.`status`,
    //         form_claim.payment_date,
    //         form_claim.approval_scheme,
    //         form_claim.total_rev,
    //         tbl_promotion_status.status_name,
    //         form_claim.receive_date,
    //         form_claim.receive_status,
    //         form_claim.top,
    //         form_claim.due_date,
    //         form_claim.payment_plan,
    //         form_claim.payment_date,
    //         form_claim.mekanisme_claim');
    //         $this->datatables->from('form_claim');
    //         $this->datatables->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
    //         $this->datatables->where('form_claim.kode_distributor', $kode_distributor);
    //         $this->datatables->add_column('action', anchor(site_url('claim/update/$1'), '<i class="fa fa-edit" aria-hidden="true"></i>', array('class' => 'btn btn-block btn-warning btn-xs')) . "  ", 'claim_id');
    //         $this->datatables->add_column('claimNumber', anchor(site_url('claim/read/$1'), '$2') . "  ", 'claim_id,claim_number');
    //         return $this->datatables->generate();
    //     } elseif ($this->session->userdata('id_user_level') == 18) {
    //         $store_code = $this->session->userdata('store_code');
    //         $this->datatables->select('form_claim.claim_id,
    //         form_claim.tgl_claim,
    //         form_claim.claim_number,
    //         form_claim.promotion_number,
    //         form_claim.dpp,
    //         form_claim.ppn,
    //         form_claim.pph,
    //         form_claim.total,
    //         form_claim.kode_distributor,
    //         form_claim.nama_distributor,
    //         form_claim.invoice_number,
    //         form_claim.invoice,
    //         form_claim.faktur_pajak_number,
    //         form_claim.faktur_pajak,
    //         form_claim.pkp,
    //         form_claim.npwp,
    //         form_claim.keterangan,
    //         form_claim.`status`,
    //         form_claim.payment_date,
    //         form_claim.approval_scheme,
    //         form_claim.total_rev,
    //         tbl_promotion_status.status_name,
    //         form_claim.receive_date,
    //         form_claim.receive_status,
    //         form_claim.top,
    //         form_claim.due_date,
    //         form_claim.payment_plan,
    //         form_claim.payment_date,
    //         form_claim.mekanisme_claim');
    //         $this->datatables->from('form_claim');
    //         $this->datatables->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
    //         $this->datatables->where('form_claim.kode_distributor', $store_code);
    //         $this->datatables->add_column('action', anchor(site_url('claim/update/$1'), '<i class="fa fa-edit" aria-hidden="true"></i>', array('class' => 'btn btn-block btn-warning btn-xs')) . "  ", 'claim_id');
    //         $this->datatables->add_column('claimNumber', anchor(site_url('claim/read/$1'), '$2') . "  ", 'claim_id,claim_number');
    //         return $this->datatables->generate();
    //     } else {
    //         $this->datatables->select('form_claim.claim_id,
    //         form_claim.tgl_claim,
    //         form_claim.claim_number,
    //         form_claim.promotion_number,
    //         form_claim.dpp,
    //         form_claim.ppn,
    //         form_claim.pph,
    //         form_claim.total,
    //         form_claim.kode_distributor,
    //         form_claim.nama_distributor,
    //         form_claim.invoice_number,
    //         form_claim.invoice,
    //         form_claim.faktur_pajak_number,
    //         form_claim.faktur_pajak,
    //         form_claim.pkp,
    //         form_claim.npwp,
    //         form_claim.keterangan,
    //         form_claim.`status`,
    //         form_claim.payment_date,
    //         form_claim.approval_scheme,
    //         form_claim.total_rev,
    //         tbl_promotion_status.status_name,
    //         form_claim.receive_date,
    //         form_claim.receive_status,
    //         form_claim.top,
    //         form_claim.due_date,
    //         form_claim.payment_plan,
    //         form_claim.payment_date');
    //         $this->datatables->from('form_claim');
    //         $this->datatables->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
    //         $this->datatables->add_column('action', anchor(site_url('claim/update/$1'), '<i class="fa fa-edit" aria-hidden="true"></i>', array('class' => 'btn btn-block btn-warning btn-xs')) . "  ", 'claim_id');
    //         $this->datatables->add_column('claimNumber', anchor(site_url('claim/read/$1'), '$2') . "  ", 'claim_id,claim_number');
    //         return $this->datatables->generate();
    //     }
    // }

    function get_claim()
    {
        if ($this->session->userdata('id_user_level') == 17) {
            $kode_distributor = $this->session->userdata('kode_distributor');
            $this->db->select('form_claim.claim_id,
            form_claim.tgl_claim,
            form_claim.claim_number,
            form_claim.promotion_number,
            form_claim.dpp,
            form_claim.ppn,
            form_claim.pph,
            form_claim.total,
            form_claim.kode_distributor,
            form_claim.nama_distributor,
            form_claim.invoice_number,
            form_claim.invoice,
            form_claim.faktur_pajak_number,
            form_claim.faktur_pajak,
            form_claim.pkp,
            form_claim.npwp,
            form_claim.keterangan,
            form_claim.`status`,
            form_claim.payment_date,
            form_claim.approval_scheme,
            form_claim.total_rev,
            tbl_promotion_status.status_name,
            form_claim.receive_date,
            form_claim.receive_status,
            form_claim.top,
            form_claim.due_date,
            form_claim.payment_plan,
            form_claim.payment_date,
            form_claim.mekanisme_claim');
            $this->db->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->where('form_claim.kode_distributor', $kode_distributor);
            $query = $this->db->get('form_claim');
            $data = $query->result_array();
            return $data;
        } elseif ($this->session->userdata('id_user_level') == 24) {
            $kode_distributor = $this->session->userdata('kode_distributor');
            $this->db->select('form_claim.claim_id,
            form_claim.tgl_claim,
            form_claim.claim_number,
            form_claim.promotion_number,
            form_claim.dpp,
            form_claim.ppn,
            form_claim.pph,
            form_claim.total,
            form_claim.kode_distributor,
            form_claim.nama_distributor,
            form_claim.invoice_number,
            form_claim.invoice,
            form_claim.faktur_pajak_number,
            form_claim.faktur_pajak,
            form_claim.pkp,
            form_claim.npwp,
            form_claim.keterangan,
            form_claim.`status`,
            form_claim.payment_date,
            form_claim.approval_scheme,
            form_claim.total_rev,
            tbl_promotion_status.status_name,
            form_claim.receive_date,
            form_claim.receive_status,
            form_claim.top,
            form_claim.due_date,
            form_claim.payment_plan,
            form_claim.payment_date,
            form_claim.mekanisme_claim');
            $this->db->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->where('form_claim.kode_distributor', $kode_distributor);
            $query = $this->db->get('form_claim');
            $data = $query->result_array();
            return $data;
        } elseif ($this->session->userdata('id_user_level') == 18) {
            $store_code = $this->session->userdata('store_code');
            $this->db->select('form_claim.claim_id,
            form_claim.tgl_claim,
            form_claim.claim_number,
            form_claim.promotion_number,
            form_claim.dpp,
            form_claim.ppn,
            form_claim.pph,
            form_claim.total,
            form_claim.kode_distributor,
            form_claim.nama_distributor,
            form_claim.invoice_number,
            form_claim.invoice,
            form_claim.faktur_pajak_number,
            form_claim.faktur_pajak,
            form_claim.pkp,
            form_claim.npwp,
            form_claim.keterangan,
            form_claim.`status`,
            form_claim.payment_date,
            form_claim.approval_scheme,
            form_claim.total_rev,
            tbl_promotion_status.status_name,
            form_claim.receive_date,
            form_claim.receive_status,
            form_claim.top,
            form_claim.due_date,
            form_claim.payment_plan,
            form_claim.payment_date,
            form_claim.mekanisme_claim');
            $this->db->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->where('form_claim.kode_distributor', $store_code);
            $query = $this->db->get('form_claim');
            $data = $query->result_array();
            return $data;
        } else {
            $status = array(0, 1);
            $this->db->select('form_claim.claim_id,
            form_claim.tgl_claim,
            form_claim.claim_number,
            form_claim.promotion_number,
            form_claim.dpp,
            form_claim.ppn,
            form_claim.pph,
            form_claim.total,
            form_claim.kode_distributor,
            form_claim.nama_distributor,
            form_claim.invoice_number,
            form_claim.invoice,
            form_claim.faktur_pajak_number,
            form_claim.faktur_pajak,
            form_claim.pkp,
            form_claim.npwp,
            form_claim.keterangan,
            form_claim.`status`,
            form_claim.payment_date,
            form_claim.approval_scheme,
            form_claim.total_rev,
            tbl_promotion_status.status_name,
            form_claim.receive_date,
            form_claim.receive_status,
            form_claim.top,
            form_claim.due_date,
            form_claim.payment_plan,
            form_claim.payment_date,
            wf_claim.id_users,
            tbl_user.full_name');
            $this->db->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->join('wf_claim', 'form_claim.claim_number = wf_claim.no_claim AND form_claim.approval_scheme = wf_claim.approval_scheme', 'left');
            $this->db->join('tbl_user', 'wf_claim.id_users = tbl_user.id_users', 'left');
            $this->db->where_in('form_claim.`status`', $status);
            $query = $this->db->get('form_claim');
            $data = $query->result_array();
            return $data;
        }
    }

    function get_claim_history()
    {
        $status = array(2, 4);
        $this->db->select('form_claim.claim_id,
            form_claim.tgl_claim,
            form_claim.claim_number,
            form_claim.promotion_number,
            form_claim.dpp,
            form_claim.ppn,
            form_claim.pph,
            form_claim.total,
            form_claim.kode_distributor,
            form_claim.nama_distributor,
            form_claim.invoice_number,
            form_claim.invoice,
            form_claim.faktur_pajak_number,
            form_claim.faktur_pajak,
            form_claim.pkp,
            form_claim.npwp,
            form_claim.keterangan,
            form_claim.`status`,
            form_claim.payment_date,
            form_claim.approval_scheme,
            form_claim.total_rev,
            tbl_promotion_status.status_name,
            form_claim.receive_date,
            form_claim.receive_status,
            form_claim.top,
            form_claim.due_date,
            form_claim.payment_plan,
            form_claim.payment_date');
        $this->db->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
        $this->db->where_in('form_claim.`status`', $status);
        $query = $this->db->get('form_claim');
        $data = $query->result_array();
        return $data;
    }

    // datatables
    function json_payment()
    {
        $this->datatables->select('claim_id,claim_number,payment_date,payment_plan,top,due_date,nama_distributor');
        $this->datatables->where('status', 4);
        $this->datatables->from('form_claim');
        //add this line for join
        //$this->datatables->join('table2', 'form_claim.field = table2.field');
        $this->datatables->add_column('action', '<button id="btn-payment" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-payment$1"><i class="fa fa-money" aria-hidden="true"></i> Payment</button>', 'claim_id');
        return $this->datatables->generate();
    }

    function json_bukti_potong()
    {
        $this->datatables->select('form_claim.claim_id,form_claim.claim_number,form_claim.nama_distributor,tbl_promotion_status.status_name,form_claim.bukti_potong');
        $this->datatables->where('form_claim.status', 4);
        $this->datatables->where('form_claim.bukti_potong IS NULL');
        $this->datatables->from('form_claim');
        //add this line for join
        //$this->datatables->join('table2', 'form_claim.field = table2.field');
        $this->datatables->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
        $this->datatables->add_column('action', '<button id="btn-bukti" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-bukti$1"><i class="fa fa-upload" aria-hidden="true"></i> Upload Bukti Potong</button>', 'claim_id');
        return $this->datatables->generate();
    }

    function json_history_bukti_potong()
    {
        $this->datatables->select('form_claim.claim_id,form_claim.claim_number,form_claim.nama_distributor,tbl_promotion_status.status_name,form_claim.bukti_potong,form_claim.no_bukti_potong');
        $this->datatables->where('form_claim.status', 4);
        $this->datatables->where('form_claim.bukti_potong IS NOT NULL');
        $this->datatables->from('form_claim');
        //add this line for join
        //$this->datatables->join('table2', 'form_claim.field = table2.field');
        $this->datatables->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
        $this->datatables->add_column('action', '<button id="btn-edit-bukti" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-bukti$1"><i class="fa fa-edit" aria-hidden="true"></i> Edit Bukti Potong</button>', 'claim_id');
        return $this->datatables->generate();
    }

    // get data by id
    function get_by_id_budget($id)
    {
        $this->db->select('*', FALSE);
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->db->where('id', $id);
        $query = $this->db->get('form_budget_program');
        $data = $query->row();

        return $data;
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result_array();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('
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
        form_claim.`status` as statusClaim,
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
        form_claim.no_bukti_potong,
        form_claim.bukti_potong,
        form_claim.payment_method,
        form_claim.SecLogDate,
        form_claim.SecLogUser,
        wf_claim.id,
        wf_claim.no_claim,
        wf_claim.approval_scheme,
        wf_claim.id_user_level,
        wf_claim.id_users,
        wf_claim.approve_by,
        wf_claim.approval_date,
        wf_claim.reject_by,
        wf_claim.reject_date,
        wf_claim.reject_reason,
        wf_claim.SecLogDate AS wfLogDate,
        wf_claim.SecLogUser,
        form_promotion.promotion_id,
        form_promotion.kode_perusahaan,
        form_promotion.date_create,
        form_promotion.periode_awal,
        form_promotion.periode_akhir,
        form_promotion.promotion_number,
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
        form_promotion.approval_scheme,
        form_promotion.upload_file,
        form_promotion.upload_activity,
        form_promotion.SecLogUser,
        form_promotion.SecLogDate,
        form_promotion_budget.promotion_number,
        form_promotion_budget.promotion_id,
        form_promotion_budget.promotion_total_cost,
        form_promotion_budget.promotion_total_usage,
        form_promotion_budget.promotion_total_saldo,
        form_promotion_budget.`status`,
        form_promotion_budget.SecLogDate,
        form_promotion_budget.SecLogUser,
        tbl_promotion_status.status_name');
        $this->db->join('wf_claim', 'form_claim.claim_number = wf_claim.no_claim AND form_claim.approval_scheme = wf_claim.approval_scheme', 'left');
        $this->db->join('form_promotion', 'form_claim.promotion_number = form_promotion.promotion_number', 'left');
        $this->db->join('form_promotion_budget', 'form_promotion.promotion_number = form_promotion_budget.promotion_number', 'left');
        $this->db->join('tbl_promotion_status', 'form_claim.status = tbl_promotion_status.status_code', 'left');
        $this->db->where('form_claim.claim_id', $id);
        return $this->db->get('form_claim')->row();
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('claim_id', $q);
        $this->db->or_like('kode_distributor', $q);
        $this->db->or_like('nama_distributor', $q);
        $this->db->or_like('tgl_klaim', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->or_like('claim_dpp', $q);
        $this->db->or_like('claim_ppn', $q);
        $this->db->or_like('claim_pph', $q);
        $this->db->or_like('total_claim', $q);
        $this->db->or_like('faktur_pajak', $q);
        $this->db->or_like('npwp', $q);
        $this->db->or_like('Pemohon', $q);
        $this->db->or_like('SecLogDate', $q);
        $this->db->or_like('SecLogUser', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('claim_id', $q);
        $this->db->or_like('kode_distributor', $q);
        $this->db->or_like('nama_distributor', $q);
        $this->db->or_like('tgl_klaim', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->or_like('claim_dpp', $q);
        $this->db->or_like('claim_ppn', $q);
        $this->db->or_like('claim_pph', $q);
        $this->db->or_like('total_claim', $q);
        $this->db->or_like('faktur_pajak', $q);
        $this->db->or_like('npwp', $q);
        $this->db->or_like('Pemohon', $q);
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

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_nama_level($id_user_level)
    {
        $this->db->select('*', FALSE);
        $this->db->where('id_user_level', $id_user_level);
        $this->db->order_by('nama_level', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_user_level');
        $data = $query->row();
        $NamaLevel = $data->nama_level;
        return $NamaLevel;
    }

    function get_promotion($store_code, $kode_distributor, $region_code)
    {
        // if ($kode_distributor != NULL && $this->session->userdata('category_id') == 3) {
        //     $sql = $this->db->query("SELECT * FROM
        //     form_promotion
        //     LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.kode_area AND form_promotion.region_code = arc_distributor.region_code
        //     WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'

        //     UNION

        //     SELECT * FROM
        //     form_promotion
        //     LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
        //     WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'

        //     UNION

        //     SELECT * FROM
        //     form_promotion
        //     LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
        //     WHERE form_promotion.`status` = 4 and form_promotion.kode_departemen = '0312'");
        // } elseif ($kode_distributor != NULL && $this->session->userdata('category_id') == 2) {
        //     $sql = $this->db->query("SELECT * FROM
        //     form_promotion
        //     LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.kode_area AND form_promotion.region_code = arc_distributor.region_code
        //     WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'

        //     UNION

        //     SELECT * FROM
        //     form_promotion
        //     LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
        //     WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'");
        // } else {
        //     $sql = $this->db->query("SELECT * FROM
        //     form_promotion
        //     WHERE form_promotion.`status` = 4 and store_code = '$store_code'");
        // }

        if ($kode_distributor != NULL && $this->session->userdata('category_id') == 3) {
            $sql = $this->db->query("SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.kode_area OR form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name
            FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'

            UNION

            SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name
            FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.region_code = 6 and form_promotion.kode_area = '$region_code' or form_promotion.kode_area = '' and form_promotion.`status` = 4 and form_promotion.kode_departemen = '0305' GROUP BY form_promotion.promotion_number
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name
            FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.kode_departemen = '0312'");
        } elseif ($kode_distributor != NULL && $this->session->userdata('category_id') == 2 && $region_code != '') {
            $sql = $this->db->query("SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.kode_area AND form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'

            UNION

            SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.region_code = 6 and form_promotion.kode_area = $region_code or form_promotion.kode_area = '' and form_promotion.`status` = 4 and form_promotion.kode_departemen = '0305' GROUP BY form_promotion.promotion_number
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name
            FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.kode_departemen = '0312'");
        } elseif ($kode_distributor != NULL && $this->session->userdata('category_id') == 2 && $region_code == '') {
            $sql = $this->db->query("SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.kode_area AND form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'

            UNION

            SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.region_code = 6 or form_promotion.kode_area = '' and form_promotion.`status` = 4 and form_promotion.kode_departemen = '0305' GROUP BY form_promotion.promotion_number
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name
            FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.kode_departemen = '0312'");
        } else {
            $sql = $this->db->query("SELECT form_promotion.promotion_id,
            form_promotion.promotion_number,
            form_promotion.promotion_name FROM
            form_promotion
            WHERE form_promotion.`status` = 4 and store_code = '$store_code'");
        }


        // $this->db->select('*', TRUE);
        // $this->db->from('form_promotion');
        // $this->db->join('arc_distributor', 'form_promotion.kode_area = arc_distributor.kode_area AND form_promotion.region_code = arc_distributor.region_code ', 'left');
        // $this->db->where('form_promotion.status', 4);
        // $this->db->where('form_promotion.store_code', $store_code);
        // $this->db->where('arc_distributor.kode_distributor', $kode_distributor);
        // $query = $this->db->get();
        $data = $sql->result_array();
        return $data;
    }

    function get_promotion_name($promotion_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->limit(1);
        $query = $this->db->get('form_promotion');
        return $query;
    }

    function get_channel_name($channel_code)
    {
        $this->db->select('*', FALSE);
        $this->db->where('channel_code', $channel_code);
        $this->db->limit(1);
        $query = $this->db->get('arc_channel');
        $data = $query->row();
        $alias_channel_name = $data->channel_name;
        return $alias_channel_name;
    }
    public function buat_kode()
    {
        $this->db->select('RIGHT(form_claim.claim_number,5) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('form_claim');
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT); // angka 3 menunjukkan jumlah digit angka 0
        return $kodemax;
    }

    function get_promotion_id($promotion_number)
    {
        // $this->db->select('*', FALSE);
        // $this->db->where('promotion_number', $promotion_number);
        // $query = $this->db->get('form_promotion');
        // $data = $query->row();
        // $promotion_id = $data->promotion_id;
        // return $promotion_id;

        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        // $this->db->limit(1);
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
    }

    /* DATA BUDGET PROGRAM */
    function get_budget_program($promotion_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        // $this->db->limit(1);
        $query = $this->db->get('form_promotion_budget');
        $data = $query->row();
        return $data;
    }

    // update budget usage
    function update_usage($promotion_number, $data)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->update('form_promotion_budget', $data);
    }

    /* GET APPROVAL SHCEME */
    // function get_approval($kode_distributor, $store_code, $total_on_top_promo)
    // {
    //     if ($store_code != NULL) {
    //         $this->db->select('approval_scheme, id_user_level, id_users', FALSE);
    //         $this->db->where('kode_departemen IS NULL');
    //         $this->db->or_where('store_code', $store_code);
    //         if ($total_on_top_promo != NULL || $total_on_top_promo != 0) {
    //             $this->db->or_where('id_user_level', '7');
    //         }
    //         $this->db->order_by('approval_scheme', 'ASC');
    //     } else {
    //         $this->db->select('approval_scheme, id_user_level, id_users', FALSE);
    //         $this->db->where('kode_departemen IS NULL');
    //         $this->db->or_where('id_user_level', '7');
    //         $this->db->order_by('approval_scheme', 'ASC');
    //     }
    //     $query = $this->db->get('approval_claim');
    //     $data = $query->result_array();
    //     return $data;
    // }

    function get_approval($kode_distributor)
    {

        $this->db->select('id_users', FALSE);
        $this->db->where('kode_distributor', $kode_distributor);
        $query = $this->db->get('arc_distributor');
        $data = $query->row();
        return $data;
    }

    // insert Workflow Claim
    function insert_wf_claim($insertArray)
    {
        $this->db->insert('wf_claim', $insertArray);
    }

    function get_onTopPromo($promotion_number)
    {
        $this->db->select('total_on_top_promo', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
    }

    function get_data($claim_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('claim_number', $claim_number);
        $query = $this->db->get('form_claim');
        $data = $query->row();
        return $data;
    }

    function get_email($claim_number, $data)
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
        $this->db->where('wf_claim.approval_scheme', $data['approval_scheme']);
        $query = $this->db->get('wf_claim');
        $data = $query->row();
        return $data;
    }

    function update_payment($data, $claim_id)
    {
        $this->db->where('claim_id', $claim_id);
        $this->db->update('form_claim', $data);
    }

    function wfClaim($claim_number)
    {
        $this->db->join('tbl_user', 'wf_claim.id_users = tbl_user.id_users', 'left');
        $this->db->where('no_claim', $claim_number);
        $query = $this->db->get('wf_claim');
        $data = $query->result_array();
        return $data;
    }

    function get_claim_excel($startDate, $endDate, $channel_code)
    {
        if ($channel_code == "") {
            $channel_code = array('001', '002', '003');
        }
        if ($this->session->userdata('kode_distributor') != NULL || $this->session->userdata('kode_distributor') != '') {
            $this->db->select('form_claim.claim_id,
            form_claim.tgl_claim,
            form_claim.claim_number,
            form_claim.promotion_number,
            form_claim.kode_distributor,
            form_claim.nama_distributor,
            form_claim.dpp,
            form_claim.dpp*(form_claim.ppn/100) AS ppn,
            form_claim.dpp*(form_claim.pph/100) AS pph,
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
            form_claim.dpp_rev*(form_claim.ppn_rev/100) AS ppn_rev,
            form_claim.dpp_rev*(form_claim.pph_rev/100) AS pph_rev,
            form_claim.total_rev,
            form_claim.mekanisme_claim,
            form_claim.no_bukti_potong,
            form_claim.bukti_potong,
            form_claim.payment_method,
            form_claim.SecLogDate,
            form_claim.SecLogUser,
            tbl_promotion_status.status_name,
            listing_activity.listing_activity_name,
            listing_cost.gl_account_code AS AccountCode_listing,
            account_listing.gl_coa_desc AS CoaDesc_listing,
            on_top_promo_activity.promo_activity_name,
            on_top_promo.gl_account_code AS AccountCode_promo,
            account_promo.gl_coa_desc AS CoaDesc_promo,
            trading_term_activity.trading_activity_name,
            trading_term.gl_account_code AS AccountCode_trading,
            account_trading.gl_coa_desc AS CoaDesc_trading,
            arc_channel.channel_name,
            arc_store.store_name,
            arc_region.nama_region', FALSE);
            $this->db->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->join('listing_cost', 'form_claim.promotion_number = listing_cost.promotion_number', 'left');
            $this->db->join('on_top_promo', 'form_claim.promotion_number = on_top_promo.promotion_number', 'left');
            $this->db->join('trading_term', 'form_claim.promotion_number = trading_term.promotion_number', 'left');
            $this->db->join('listing_activity', 'listing_cost.listing_activity = listing_activity.listing_activity_id', 'left');
            $this->db->join('on_top_promo_activity', 'on_top_promo.promo_activity_name = on_top_promo_activity.promo_activity_id', 'left');
            $this->db->join('trading_term_activity', 'trading_term.trading_activity_name = trading_term_activity.trading_activity_id', 'left');
            $this->db->join('gl_account AS account_listing', 'listing_cost.gl_account_code = account_listing.gl_coa', 'left');
            $this->db->join('gl_account AS account_promo', 'on_top_promo.gl_account_code = account_promo.gl_coa', 'left');
            $this->db->join('gl_account AS account_trading', 'trading_term.gl_account_code = account_trading.gl_coa', 'left');
            $this->db->join('form_promotion', 'form_claim.promotion_number = form_promotion.promotion_number', 'left');
            $this->db->join('(select * from arc_channel group by channel_code) AS arc_channel', 'form_promotion.channel_code = arc_channel.channel_code', 'left');
            $this->db->join('arc_store', 'form_promotion.store_code = arc_store.store_code', 'left');
            $this->db->join('(select * from arc_region group by region_code) AS arc_region', 'form_promotion.region_code = arc_region.region_code', 'left');
            $this->db->where_in('form_promotion.channel_code', $channel_code);
            $this->db->where("form_claim.tgl_claim between '$startDate' and '$endDate'");
            $this->db->where('form_claim.kode_distributor', $this->session->userdata('kode_distributor'));
            $this->db->group_by('form_claim.claim_number');
        } elseif ($this->session->userdata('store_code') != NULL || $this->session->userdata('store_code') != '') {
            $this->db->select('form_claim.claim_id,
            form_claim.tgl_claim,
            form_claim.claim_number,
            form_claim.promotion_number,
            form_claim.kode_distributor,
            form_claim.nama_distributor,
            form_claim.dpp,
            form_claim.dpp*(form_claim.ppn/100) AS ppn,
            form_claim.dpp*(form_claim.pph/100) AS pph,
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
            form_claim.dpp_rev*(form_claim.ppn_rev/100) AS ppn_rev,
            form_claim.dpp_rev*(form_claim.pph_rev/100) AS pph_rev,
            form_claim.total_rev,
            form_claim.mekanisme_claim,
            form_claim.no_bukti_potong,
            form_claim.bukti_potong,
            form_claim.payment_method,
            form_claim.SecLogDate,
            form_claim.SecLogUser,
            tbl_promotion_status.status_name,
            listing_activity.listing_activity_name,
            listing_cost.gl_account_code AS AccountCode_listing,
            account_listing.gl_coa_desc AS CoaDesc_listing,
            on_top_promo_activity.promo_activity_name,
            on_top_promo.gl_account_code AS AccountCode_promo,
            account_promo.gl_coa_desc AS CoaDesc_promo,
            trading_term_activity.trading_activity_name,
            trading_term.gl_account_code AS AccountCode_trading,
            account_trading.gl_coa_desc AS CoaDesc_trading,
            arc_channel.channel_name,
            arc_store.store_name,
            arc_region.nama_region', FALSE);
            $this->db->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->join('listing_cost', 'form_claim.promotion_number = listing_cost.promotion_number', 'left');
            $this->db->join('on_top_promo', 'form_claim.promotion_number = on_top_promo.promotion_number', 'left');
            $this->db->join('trading_term', 'form_claim.promotion_number = trading_term.promotion_number', 'left');
            $this->db->join('listing_activity', 'listing_cost.listing_activity = listing_activity.listing_activity_id', 'left');
            $this->db->join('on_top_promo_activity', 'on_top_promo.promo_activity_name = on_top_promo_activity.promo_activity_id', 'left');
            $this->db->join('trading_term_activity', 'trading_term.trading_activity_name = trading_term_activity.trading_activity_id', 'left');
            $this->db->join('gl_account AS account_listing', 'listing_cost.gl_account_code = account_listing.gl_coa', 'left');
            $this->db->join('gl_account AS account_promo', 'on_top_promo.gl_account_code = account_promo.gl_coa', 'left');
            $this->db->join('gl_account AS account_trading', 'trading_term.gl_account_code = account_trading.gl_coa', 'left');
            $this->db->join('form_promotion', 'form_claim.promotion_number = form_promotion.promotion_number', 'left');
            $this->db->join('(select * from arc_channel group by channel_code) AS arc_channel', 'form_promotion.channel_code = arc_channel.channel_code', 'left');
            $this->db->join('arc_store', 'form_promotion.store_code = arc_store.store_code', 'left');
            $this->db->join('(select * from arc_region group by region_code) AS arc_region', 'form_promotion.region_code = arc_region.region_code', 'left');
            $this->db->where_in('form_promotion.channel_code', $channel_code);
            $this->db->where("form_claim.tgl_claim between '$startDate' and '$endDate'");
            $this->db->where('form_claim.kode_distributor', $this->session->userdata('store_code'));
            $this->db->group_by('form_claim.claim_number');
        } else {
            $this->db->select('form_claim.claim_id,
            form_claim.tgl_claim,
            form_claim.claim_number,
            form_claim.promotion_number,
            form_claim.kode_distributor,
            form_claim.nama_distributor,
            form_claim.dpp,
            form_claim.dpp*(form_claim.ppn/100) AS ppn,
            form_claim.dpp*(form_claim.pph/100) AS pph,
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
            form_claim.dpp_rev*(form_claim.ppn_rev/100) AS ppn_rev,
            form_claim.dpp_rev*(form_claim.pph_rev/100) AS pph_rev,
            form_claim.total_rev,
            form_claim.mekanisme_claim,
            form_claim.no_bukti_potong,
            form_claim.bukti_potong,
            form_claim.payment_method,
            form_claim.SecLogDate,
            form_claim.SecLogUser,
            tbl_promotion_status.status_name,
            listing_activity.listing_activity_name,
            listing_cost.gl_account_code AS AccountCode_listing,
            account_listing.gl_coa_desc AS CoaDesc_listing,
            on_top_promo_activity.promo_activity_name,
            on_top_promo.gl_account_code AS AccountCode_promo,
            account_promo.gl_coa_desc AS CoaDesc_promo,
            trading_term_activity.trading_activity_name,
            trading_term.gl_account_code AS AccountCode_trading,
            account_trading.gl_coa_desc AS CoaDesc_trading,
            arc_channel.channel_name,
            arc_store.store_name,
            arc_region.nama_region', FALSE);
            $this->db->join('tbl_promotion_status', 'form_claim.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->join('listing_cost', 'form_claim.promotion_number = listing_cost.promotion_number', 'left');
            $this->db->join('on_top_promo', 'form_claim.promotion_number = on_top_promo.promotion_number', 'left');
            $this->db->join('trading_term', 'form_claim.promotion_number = trading_term.promotion_number', 'left');
            $this->db->join('listing_activity', 'listing_cost.listing_activity = listing_activity.listing_activity_id', 'left');
            $this->db->join('on_top_promo_activity', 'on_top_promo.promo_activity_name = on_top_promo_activity.promo_activity_id', 'left');
            $this->db->join('trading_term_activity', 'trading_term.trading_activity_name = trading_term_activity.trading_activity_id', 'left');
            $this->db->join('gl_account AS account_listing', 'listing_cost.gl_account_code = account_listing.gl_coa', 'left');
            $this->db->join('gl_account AS account_promo', 'on_top_promo.gl_account_code = account_promo.gl_coa', 'left');
            $this->db->join('gl_account AS account_trading', 'trading_term.gl_account_code = account_trading.gl_coa', 'left');
            $this->db->join('form_promotion', 'form_claim.promotion_number = form_promotion.promotion_number', 'left');
            $this->db->join('(select * from arc_channel group by channel_code) AS arc_channel', 'form_promotion.channel_code = arc_channel.channel_code', 'left');
            $this->db->join('arc_store', 'form_promotion.store_code = arc_store.store_code', 'left');
            $this->db->join('(select * from arc_region group by region_code) AS arc_region', 'form_promotion.region_code = arc_region.region_code', 'left');
            $this->db->where_in('form_promotion.channel_code', $channel_code);
            $this->db->where("form_claim.tgl_claim between '$startDate' and '$endDate'");
            $this->db->group_by('form_claim.claim_number');
        }
        $query = $this->db->get('form_claim');
        return $query->result_array();
    }

    // update data
    function update_buktiPotong($claim_id, $data)
    {
        $this->db->where($this->id, $claim_id);
        $this->db->update($this->table, $data);
    }

    function get_region($kode_distributor)
    {
        $this->db->select('region_code', FALSE);
        $this->db->where('kode_distributor', $kode_distributor);
        $query = $this->db->get('arc_distributor');
        return $query->row();
    }

    public function kode_import()
    {
        $this->db->select('RIGHT(form_claim.claim_number,5) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('form_claim');
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $kodemax = $kode;
        return $kodemax;
    }

    public function check_claim($claim_number)
    {
        $this->db->where_in('claim_number', $claim_number);
        $data = $this->db->get('form_claim');
        return $data->num_rows();
        // $this->db->where_in('claim_number', $claim);
        // $data = $this->db->get('form_claim');
        // return $data->num_rows();
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    public function insert_batch($data)
    {
        $this->db->insert_batch('form_claim', $data);

        return $this->db->affected_rows();
    }

    function get_claimDpp($resultData)
    {
        for ($x = 0; $x < count($resultData); $x++) {
            $claim_number[$x] = $resultData[$x]['claim_number'];
        }
        $this->db->select('promotion_number, SUM(dpp) AS dpp', FALSE);
        $this->db->where_in('claim_number', $claim_number);
        $this->db->group_by('promotion_number');
        $this->db->order_by('promotion_number', 'ASC');
        $query = $this->db->get('form_claim');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($resultData);
        // exit;
    }

    function get_budget_promotion($claim_promotionNumber)
    {
        $this->db->select('*', FALSE);
        $this->db->where_in('promotion_number', $claim_promotionNumber);
        $this->db->order_by('promotion_number');
        $query = $this->db->get('form_promotion_budget');
        $data = $query->result_array();
        return $data;
        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function update_budget_promotion($budgetArray)
    {
        $this->db->update_batch('form_promotion_budget', $budgetArray, 'promotion_number');

        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function get_budgetPromotion($promotion_number)
    {
        $sql = $this->db->query("SELECT
        'Listing Cost' AS Budget,
        listing_activity.listing_activity_name AS activity,
        listing_cost.gl_account_code
    FROM
        `listing_cost`
    LEFT JOIN listing_activity ON listing_activity.listing_activity_id = listing_cost.listing_activity
    WHERE listing_cost.promotion_number = '$promotion_number'
    UNION
    SELECT
        'On Top Promo' AS Budget,
        on_top_promo_activity.promo_activity_name AS activity,
        on_top_promo.gl_account_code
    FROM
        `on_top_promo`
    LEFT JOIN on_top_promo_activity ON on_top_promo_activity.promo_activity_id = on_top_promo.promo_activity_name
    WHERE on_top_promo.promotion_number = '$promotion_number'
    UNION
    SELECT
        'Trading Term' AS Budget,
        trading_term_activity.trading_activity_name AS activity,
        trading_term.gl_account_code
    FROM
        `trading_term`
    LEFT JOIN trading_term_activity ON trading_term_activity.trading_activity_id = trading_term.trading_activity_name
    WHERE trading_term.promotion_number = '$promotion_number'");
        $data = $sql->result_array();
        return $data;
    }
}
