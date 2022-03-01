<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reminders_model extends CI_Model
{

    public $table = 'form_promotion';
    public $id = 'promotion_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_data_for_finance($id_user)
    {
        $this->db->select('form_promotion.promotion_id,
        form_promotion.date_create,
        form_promotion.periode_awal,
        form_promotion.periode_akhir,
        form_promotion.promotion_number,
        form_promotion.business_unit_id,
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
        wf_program.id_users,
        tbl_user.email,
        tbl_user.full_name', FALSE);
        $this->db->join('wf_program','form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme','left');
        $this->db->join('tbl_user','wf_program.id_users = tbl_user.id_users','left');
        $this->db->where_in('wf_program.id_users', $id_user);
        $this->db->where('wf_program.approve_by IS NULL AND wf_program.reject_by IS NULL');
        $query = $this->db->get('form_promotion');
        $data = $query->result_array();
        return $data;
    }

    function get_email($id_user)
    {
        $this->db->select('email,full_name', FALSE);
        $this->db->where('id_users', $id_user);
        $query = $this->db->get('tbl_user');
        $data = $query->row();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }
}