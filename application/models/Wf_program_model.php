<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wf_program_model extends CI_Model
{

    public $table = 'wf_program';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_scheme($id_user_level)
    {
        $this->db->select('*', FALSE);
        $this->db->where('id_user_level', $id_user_level);
        $this->db->order_by('approval_scheme', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get('approval_program');
        $data = $query->row();
        $alias = $data->approval_scheme;
        return $alias;
    }

    // datatables
    function json()
    {
        $id_user_level = $this->session->userdata('id_user_level');
        $id_user = $this->session->userdata('id_users');
        $status = array('0', '1');
        $this->datatables->select('
        wf_program.id, 
            wf_program.promotion_number, 
            wf_program.approval_scheme, 
            form_promotion.promotion_name,
            form_promotion.promotion_period,
            form_promotion.total_product_baseline,
            form_promotion.total_product_incremental,
            form_promotion.total_listing_cost,
            form_promotion.total_on_top_promo,
            form_promotion.promotion_id,
            form_promotion.date_create,
            wf_program.id_users
        ');
        $this->datatables->from('wf_program');
        $this->datatables->join('form_promotion', 'wf_program.promotion_number = form_promotion.promotion_number AND wf_program.approval_scheme = form_promotion.approval_scheme');
        $this->datatables->where('wf_program.id_user_level', $id_user_level);
        $this->datatables->where('wf_program.id_users', $id_user);
        $this->datatables->where('wf_program.reject_date', NULL);
        $this->datatables->where_in('form_promotion.status', $status);
        $this->datatables->add_column('action', anchor(site_url('wf_program/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i> Detail', array('class' => 'btn btn-success btn-sm')) , 'promotion_id');

        return $this->datatables->generate();
    }

    function json_edit()
    {
        $id_user_level = $this->session->userdata('id_user_level');
        $id_user = $this->session->userdata('id_users');
        $status = array('0', '1');
        $this->datatables->select('
            wf_edit_promotion.id,
            wf_edit_promotion.promotion_number,
            wf_edit_promotion.approval_scheme,
            form_promotion.promotion_name,
            form_promotion.promotion_id,
            additional_budget.SecLogDate,
            additional_budget.additional_amount,
            wf_edit_promotion.id_users
        ');
        $this->datatables->from('wf_edit_promotion');
        $this->datatables->join('additional_budget', 'wf_edit_promotion.promotion_number = additional_budget.promotion_number AND wf_edit_promotion.approval_scheme = additional_budget.approval_scheme');
        $this->datatables->join('form_promotion','additional_budget.promotion_number = form_promotion.promotion_number','left');
        $this->datatables->where('wf_edit_promotion.id_user_level', $id_user_level);
        $this->datatables->where('wf_edit_promotion.id_users', $id_user);
        $this->datatables->where('wf_edit_promotion.reject_date', NULL);
        $this->datatables->where_in('form_promotion.status', $status);
        $this->datatables->add_column('action', anchor(site_url('wf_edit_budget/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i> Detail', array('class' => 'btn btn-success btn-sm')) , 'promotion_id');

        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($promotion_id)
    {
        $this->db->select('form_promotion.promotion_id,
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
        form_promotion.approval_scheme,
        form_promotion.upload_file,
        form_promotion.upload_activity,
        form_promotion.SecLogUser,
        form_promotion.SecLogDate,
        arc_area.area_id,
        arc_area.kode_area,
        arc_area.nama_area,
        arc_area.region_id,
        arc_region.region_id,
        arc_region.nama_region,
        arc_region.region_code,
        arc_region.rsm_id', FALSE);
        // $this->db->join('form_promotion', 'wf_program.promotion_number = form_promotion.promotion_number');
        $this->db->join('arc_area', 'form_promotion.kode_area = arc_area.kode_area', 'left');
        $this->db->join('arc_region', 'form_promotion.region_code = arc_region.region_code', 'left');
        $this->db->where('form_promotion.promotion_id', $promotion_id);
        return $this->db->get('form_promotion')->row();
    }

    function get_wf_program($promotion_number)
    {
        $this->db->select('approve_by', FALSE);
        $this->db->join('form_promotion', 'wf_program.promotion_number = form_promotion.promotion_number');
        $this->db->where('form_promotion.promotion_number', $promotion_number);
        $this->db->where('(wf_program.approve_by is NULL)', NULL, FALSE);
        return $this->db->get('wf_program')->row();
        // $query = $this->db->get('wf_program');
        // $data = $query->row();
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('no_p3', $q);
        $this->db->or_like('approval_scheme', $q);
        $this->db->or_like('id_user_level', $q);
        $this->db->or_like('approve_by', $q);
        $this->db->or_like('approval_date', $q);
        $this->db->or_like('SecLogDate', $q);
        $this->db->or_like('SecLogUser', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('no_p3', $q);
        $this->db->or_like('approval_scheme', $q);
        $this->db->or_like('id_user_level', $q);
        $this->db->or_like('approve_by', $q);
        $this->db->or_like('approval_date', $q);
        $this->db->or_like('SecLogDate', $q);
        $this->db->or_like('SecLogUser', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // update data
    function update_wf_program($approval_scheme, $promotion_number, $data)
    {
        $this->db->where('approval_scheme', $approval_scheme);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->update('wf_program', $data);
    }

    function get_scheme_wf_program($no_p3)
    {
        $id_user_level = $this->session->userdata('id_user_level');
        $this->db->select_max('approval_scheme', 'max');
        $this->db->where('no_p3', $no_p3);
        $this->db->where('id_user_level', $id_user_level);
        $this->db->order_by('approval_scheme', 'ASC');
        $query = $this->db->get('wf_program');
        $data = $query->row()->max;
        return $data;
    }

    /*UPDATE STATUS PROMOTION*/
    function update_promotion($promotion_number, $data_program)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->update('form_promotion', $data_program);
    }

    /*UPDATE STATUS BUDGET CLAIM PROGRAM*/
    function update_claim($no_p3, $data_program)
    {
        $this->db->where('no_p3', $no_p3);
        $this->db->update('form_budget_program', $data_program);
    }

    // Get Listing
    function listing_coa_segment($promotion_number)
    {
        $this->db->select('promotion_number,gl_coa_segment, SUM(amount) AS amount', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->group_by('gl_coa_segment');
        $this->db->order_by('gl_coa_segment', 'ASC');
        $query = $this->db->get('listing_cost');
        $data = $query->result_array();
        return $data;
    }

    function listing_budget_amount($listingCoaSegment)
    {
        $this->db->select('*', FALSE);
        $this->db->where_in('gl_coa_segment', $listingCoaSegment);
        $this->db->order_by('gl_coa_segment');
        $query = $this->db->get('gl_budget');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function update_budget_listing($budgetListingArray, $fiscal_year)
    {
        // $Year = date('Y');
        $this->db->where('YearPeriod', $fiscal_year);
        $this->db->update_batch('gl_budget', $budgetListingArray, 'gl_coa_segment');
        // print_r($this->db->last_query());
        // echo "<pre>";
        // exit;
    }

    /* ON TOP PROMO */
    function get_ontopPromo($promotion_number)
    {
        $this->db->select('promotion_number,gl_coa_segment, SUM(amount) AS amount', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->group_by('gl_coa_segment');
        $this->db->order_by('gl_coa_segment', 'ASC');
        $query = $this->db->get('on_top_promo');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_ontopPromo_budget_amount($ontopPromo_coaSegment)
    {
        $this->db->select('*', FALSE);
        $this->db->where_in('gl_coa_segment', $ontopPromo_coaSegment);
        $this->db->order_by('gl_coa_segment');
        $query = $this->db->get('gl_budget');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    // function get_ontopPromo_budget($ontopPromo_coaSegment)
    // {
    //     $this->db->select('*', FALSE);
    //     $this->db->where_in('gl_coa_segment', $ontopPromo_coaSegment);
    //     $this->db->order_by('gl_coa_segment');
    //     $query = $this->db->get('gl_budget');
    //     $data = $query->result_array();
    //     return $data;
    //     // print_r($this->db->last_query());
    //     // echo "<pre>";
    //     // print_r($data);
    //     // exit;
    // }

    function update_budget_onTopPromo($budgetArray, $fiscal_year)
    {
        // $Year = date('Y');
        $this->db->where('YearPeriod', $fiscal_year);
        $this->db->update_batch('gl_budget', $budgetArray, 'gl_coa_segment');

        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    /* TRADING TERM */
    function get_tradingTerm($promotion_number)
    {
        $this->db->select('promotion_number,gl_coa_segment, SUM(amount) AS amount', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->group_by('gl_coa_segment');
        $this->db->order_by('gl_coa_segment', 'ASC');
        $query = $this->db->get('trading_term');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_tradingTerm_budget_amount($tradingTerm_coaSegment)
    {
        $this->db->select('*', FALSE);
        $this->db->where_in('gl_coa_segment', $tradingTerm_coaSegment);
        $this->db->order_by('gl_coa_segment');
        $query = $this->db->get('gl_budget');
        $data = $query->result_array();
        return $data;
        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function update_budget_tradingTerm($tradingTerm_budgetArray, $fiscal_year)
    {
        // $Year = date('Y');
        $this->db->where('YearPeriod', $fiscal_year);
        $this->db->update_batch('gl_budget', $tradingTerm_budgetArray, 'gl_coa_segment');

        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function get_data($promotion_number)
    {
        $this->db->select('form_promotion.promotion_id,
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
        form_promotion.approval_scheme,
        form_promotion.upload_file,
        form_promotion.upload_activity,
        form_promotion.SecLogUser,
        form_promotion.SecLogDate,
        arc_channel.channel_code,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_region.nama_region,
        arc_area.nama_area,
        arc_store.store_name,
        tbl_user.email', FALSE);
        $this->db->join('arc_channel', 'form_promotion.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
        $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
        $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
        $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
        $this->db->join('tbl_user', 'tbl_user.full_name = form_promotion.pemohon', 'left');
        $this->db->where('form_promotion.promotion_number', $promotion_number);
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_email($promotion_number, $data_program)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.channel_code,
        wf_program.store_code,
        wf_program.region_code,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.id_users,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user.email,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users', 'left');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', $data_program['approval_scheme']);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_cc($promotion_number, $data_program)
    {
        $user_level = array('4','5','7','16');
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.channel_code,
        wf_program.store_code,
        wf_program.region_code,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.id_users,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user.email,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users', 'left');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where_in('wf_program.id_user_level', $user_level);
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_email_distributor($promotion_number)
    {
        // $this->db->select('tbl_user.email', FALSE);
        // $this->db->join('tbl_user', 'form_promotion.region_code = tbl_user.region_code OR form_promotion.kode_area = tbl_user.region_code', 'left');
        // $this->db->where('form_promotion.promotion_number', $promotion_number);
        // $query = $this->db->get('form_promotion');
        $this->db->select('arc_distributor.email, arc_distributor.region_code', FALSE);
        $this->db->join('arc_distributor', 'form_promotion_distributor.kode_distributor = arc_distributor.kode_distributor', 'left');
        $this->db->where('form_promotion_distributor.promotion_number', $promotion_number);
        $this->db->where("arc_distributor.email <> ''");
        $this->db->group_by('arc_distributor.email');
        $query = $this->db->get('form_promotion_distributor');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_email_cc($promotion_number)
    {
        // if($region_code == 6 && $kode_area == '') {
        //     $sql = $this->db->query("SELECT arc_rsm.email FROM arc_region LEFT JOIN arc_rsm ON arc_region.rsm_id = arc_rsm.rsm_id WHERE arc_region.region_code NOT IN (6) GROUP BY arc_rsm.email
        //     UNION ALL 
        //     SELECT email FROM arc_am
        //     UNION ALL
		//     SELECT email FROM tbl_user WHERE full_name IN ('Nur Risa Afriani Abas','Agus Nirokim','Bondan Roemandi')");
        //     $data = $sql->result_array();
        //     return $data;
        // } elseif ($region_code == 6 && $kode_area != '') {
        //     $sql = $this->db->query("SELECT arc_rsm.email FROM form_promotion LEFT JOIN arc_region ON form_promotion.region_code = arc_region.region_code OR form_promotion.kode_area = arc_region.region_code LEFT JOIN arc_rsm ON arc_region.rsm_id = arc_rsm.rsm_id WHERE form_promotion.promotion_number = '$promotion_number' AND arc_region.region_code NOT IN (6) GROUP BY arc_rsm.email
        //     UNION ALL
        //     SELECT arc_am.email FROM form_promotion LEFT JOIN arc_am ON form_promotion.region_code = arc_am.region_code OR form_promotion.kode_area = arc_am.region_code WHERE form_promotion.promotion_number = '$promotion_number'
        //     UNION ALL
		//     SELECT email FROM tbl_user WHERE full_name IN ('Nur Risa Afriani Abas','Agus Nirokim','Bondan Roemandi')");
        //     $data = $sql->result_array();
        //     return $data;
        // } else {
        //     $sql = $this->db->query("SELECT arc_rsm.email FROM form_promotion LEFT JOIN arc_region ON form_promotion.region_code = arc_region.region_code LEFT JOIN arc_rsm ON arc_region.rsm_id = arc_rsm.rsm_id WHERE form_promotion.promotion_number = '$promotion_number' GROUP BY arc_rsm.email
        //     UNION ALL
        //     SELECT arc_am.email FROM form_promotion LEFT JOIN arc_am ON form_promotion.region_code = arc_am.region_code WHERE form_promotion.promotion_number = '$promotion_number'
        //     UNION ALL
		//     SELECT email FROM tbl_user WHERE full_name IN ('Nur Risa Afriani Abas','Agus Nirokim','Bondan Roemandi')");
        //     $data = $sql->result_array();
        //     return $data;
        // }
        
        $sql = $this->db->query("SELECT arc_am.email FROM form_promotion_distributor
        LEFT JOIN arc_distributor ON form_promotion_distributor.kode_distributor = arc_distributor.kode_distributor
        LEFT JOIN arc_am ON arc_distributor.region_code = arc_am.region_code
        WHERE promotion_number = '$promotion_number' AND arc_am.email IS NOT NULL
        GROUP BY arc_am.email
        UNION ALL
        SELECT arc_rsm.email FROM form_promotion_distributor
        LEFT JOIN arc_distributor ON form_promotion_distributor.kode_distributor = arc_distributor.kode_distributor
        LEFT JOIN arc_rsm ON arc_distributor.region_code = arc_rsm.region_code
        WHERE promotion_number = '$promotion_number' AND arc_rsm.email IS NOT NULL
        GROUP BY arc_rsm.email
        UNION ALL
        SELECT email FROM tbl_user WHERE full_name IN ('Nur Risa Afriani Abas','Agus Nirokim','Bondan Roemandi')");
        $data = $sql->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approval($promotion_number)
    {
        $this->db->select('wf_program.approval_scheme,wf_program.approve_by,wf_program.reject_by,wf_program.approval_date,wf_program.reject_date,tbl_user.full_name');
        $this->db->join('tbl_user','wf_program.id_users = tbl_user.id_users','left');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->group_by('wf_program.approval_scheme');
        $data = $this->db->get('wf_program')->result_array();
        return $data;
    }
}
