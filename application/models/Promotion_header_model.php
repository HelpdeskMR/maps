<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promotion_header_model extends CI_Model
{

    public $table = 'form_promotion';
    public $id = 'promotion_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $status = array('0', '1');
        $brand_code = array($this->session->userdata('brand_code'));
        if ($this->session->userdata('kode_departemen') == NULL) {
            $this->datatables->select('
                    form_promotion.promotion_id,
                    form_promotion.kode_perusahaan,
                    form_promotion.date_create,
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
                    form_promotion.approval_scheme,
                    form_promotion.pemohon,
                    form_promotion.total_product_baseline,
                    form_promotion.total_product_incremental,
                    form_promotion.total_listing_cost,
                    form_promotion.total_on_top_promo,
                    form_promotion.SecLogUser,
                    form_promotion.SecLogDate,
                    arc_departemen.nama_departemen,
                    wf_program.id_user_level, 
                    tbl_user.full_name,
                    tbl_promotion_status.status_name,
                    wf_program.reject_reason
            ');
            $this->datatables->from('form_promotion');
            $this->datatables->join('arc_departemen', 'form_promotion.kode_departemen = arc_departemen.kode_departemen');
            $this->datatables->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme');
            $this->datatables->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
            $this->datatables->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code');
            $this->datatables->where_in('status', $status);
            $this->datatables->group_by('form_promotion.promotion_number');
        } else {
            $this->datatables->select('
            form_promotion.promotion_id,
            form_promotion.kode_perusahaan,
            form_promotion.date_create,
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
            form_promotion.approval_scheme,
            form_promotion.pemohon,
            form_promotion.total_product_baseline,
            form_promotion.total_product_incremental,
            form_promotion.total_listing_cost,
            form_promotion.total_on_top_promo,
            form_promotion.SecLogUser,
            form_promotion.SecLogDate,
            arc_departemen.nama_departemen, 
            wf_program.id_user_level, 
            tbl_user.full_name,
            tbl_promotion_status.status_name,
            wf_program.reject_reason
            ');
            $this->datatables->from('form_promotion');
            $this->datatables->join('arc_departemen', 'form_promotion.kode_departemen = arc_departemen.kode_departemen');
            $this->datatables->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme');
            $this->datatables->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
            $this->datatables->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code');
            if($this->session->userdata('kode_departemen') == "0306401") {
                $dept = array('0306401','0308','0307');
                $this->datatables->where_in('form_promotion.kode_departemen', $dept);
            } else {
                $this->datatables->where('form_promotion.kode_departemen', $this->session->userdata('kode_departemen'));
            }
            if($this->session->userdata('kode_departemen') == "0306") {
                $this->datatables->where_in('form_promotion.brand_code', $brand_code);
            }
            $this->datatables->where_in('status', $status);
        }
        // $this->datatables->add_column('action', anchor(site_url('promotion_form/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')) . " 
        //     " . anchor(site_url('promotion_form/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) . " 
        //         " . anchor(site_url('promotion_form/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'promotion_id');
        $this->datatables->add_column('action', anchor(site_url('promotion_form/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')) . " " . anchor(site_url('promotion_form/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) . " " . '<button id="btn-delete" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete$1"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'promotion_id');
        $this->datatables->add_column('tooltip', '<a href="#" data-toggle="tooltip" data-placement="top" title="$2" style="color: #333333;">$1</a>', 'status_name, reject_reason, promotion_id');
        // $this->datatables->add_column('action', anchor(site_url('promotion_form/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')), 'promotion_id');
        return $this->datatables->generate();
    }

    function jsonHistory()
    {
        $status = array('2', '4');
        $brand_code = array($this->session->userdata('brand_code'));
        if ($this->session->userdata('kode_departemen') == NULL) {
            $this->datatables->select('
                    form_promotion.promotion_id,
                    form_promotion.kode_perusahaan,
                    form_promotion.date_create,
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
                    form_promotion.approval_scheme,
                    form_promotion.pemohon,
                    form_promotion.total_product_baseline,
                    form_promotion.total_product_incremental,
                    form_promotion.total_listing_cost,
                    form_promotion.total_on_top_promo,
                    form_promotion.SecLogUser,
                    form_promotion.SecLogDate,
                    arc_departemen.nama_departemen,
                    wf_program.id_user_level, 
                    tbl_user.full_name,
                    tbl_promotion_status.status_name,
                    wf_program.reject_reason
            ');
            $this->datatables->from('form_promotion');
            $this->datatables->join('arc_departemen', 'form_promotion.kode_departemen = arc_departemen.kode_departemen');
            $this->datatables->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme');
            $this->datatables->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
            $this->datatables->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code');
            $this->datatables->where_in('status', $status);
            $this->datatables->group_by('form_promotion.promotion_number');
        } else {
            $this->datatables->select('
            form_promotion.promotion_id,
            form_promotion.kode_perusahaan,
            form_promotion.date_create,
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
            form_promotion.approval_scheme,
            form_promotion.pemohon,
            form_promotion.total_product_baseline,
            form_promotion.total_product_incremental,
            form_promotion.total_listing_cost,
            form_promotion.total_on_top_promo,
            form_promotion.SecLogUser,
            form_promotion.SecLogDate,
            arc_departemen.nama_departemen, 
            wf_program.id_user_level, 
            tbl_user.full_name,
            tbl_promotion_status.status_name,
            wf_program.reject_reason
            ');
            $this->datatables->from('form_promotion');
            $this->datatables->join('arc_departemen', 'form_promotion.kode_departemen = arc_departemen.kode_departemen');
            $this->datatables->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme');
            $this->datatables->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
            $this->datatables->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code');
            if($this->session->userdata('kode_departemen') == "0306401") {
                $dept = array('0306401','0308','0307');
                $this->datatables->where_in('form_promotion.kode_departemen', $dept);
            } else {
                $this->datatables->where('form_promotion.kode_departemen', $this->session->userdata('kode_departemen'));
            }
            // if($this->session->userdata('kode_departemen') == "0306") {
            //     $this->datatables->where_in('form_promotion.brand_code', $brand_code);
            // }
            $this->datatables->where_in('status', $status);
        }
        /* $this->datatables->add_column('action', anchor(site_url('promotion_form/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')) . " " . '<button id="btn-delete" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete$1"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'promotion_id');*/
        $this->datatables->add_column('tooltip', '<a href="#" data-toggle="tooltip" data-placement="top" title="$2" style="color: #333333;">$1</a>', 'status_name, reject_reason, promotion_id');
        $this->datatables->add_column('action', anchor(site_url('promotion_form/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')) . " " . anchor(site_url('promotion_form/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'promotion_id');
        return $this->datatables->generate();
    }

    function jsonCancel()
    {
        $status = array('0', '1', '2', '4');
        if ($this->session->userdata('kode_departemen') == NULL) {
            $this->datatables->select('
                    form_promotion.promotion_id,
                    form_promotion.kode_perusahaan,
                    form_promotion.date_create,
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
                    form_promotion.approval_scheme,
                    form_promotion.pemohon,
                    form_promotion.total_product_baseline,
                    form_promotion.total_product_incremental,
                    form_promotion.total_listing_cost,
                    form_promotion.total_on_top_promo,
                    form_promotion.SecLogUser,
                    form_promotion.SecLogDate,
                    arc_departemen.nama_departemen,
                    wf_program.id_user_level, 
                    tbl_user.full_name,
                    tbl_promotion_status.status_name,
                    wf_program.reject_reason
            ');
            $this->datatables->from('form_promotion');
            $this->datatables->join('arc_departemen', 'form_promotion.kode_departemen = arc_departemen.kode_departemen');
            $this->datatables->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme');
            $this->datatables->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
            $this->datatables->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code');
            $this->datatables->where_in('status', $status);
            $this->datatables->group_by('form_promotion.promotion_number');
        } else {
            $this->datatables->select('
            form_promotion.promotion_id,
            form_promotion.kode_perusahaan,
            form_promotion.date_create,
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
            form_promotion.approval_scheme,
            form_promotion.pemohon,
            form_promotion.total_product_baseline,
            form_promotion.total_product_incremental,
            form_promotion.total_listing_cost,
            form_promotion.total_on_top_promo,
            form_promotion.SecLogUser,
            form_promotion.SecLogDate,
            arc_departemen.nama_departemen, 
            wf_program.id_user_level, 
            tbl_user.full_name,
            tbl_promotion_status.status_name,
            wf_program.reject_reason
            ');
            $this->datatables->from('form_promotion');
            $this->datatables->join('arc_departemen', 'form_promotion.kode_departemen = arc_departemen.kode_departemen');
            $this->datatables->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme');
            $this->datatables->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
            $this->datatables->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code');
            $this->datatables->where('form_promotion.kode_departemen', $this->session->userdata('kode_departemen'));
            $this->datatables->where_in('status', $status);
        }
        $this->datatables->add_column('tooltip', '<a href="#" data-toggle="tooltip" data-placement="top" title="$2" style="color: #333333;">$1</a>', 'status_name, reject_reason, promotion_id');

        $this->datatables->add_column('action', '<button id="btn-delete" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-cancel$1"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancel</button>', 'promotion_id');

        return $this->datatables->generate();
    }

    function json_additionalBudget()
    {
        $this->datatables->select('additional_budget.id_additional_budget,
        additional_budget.promotion_number,
        form_promotion.promotion_id,
        form_promotion.promotion_name,
        additional_budget.date_create,
        additional_budget.budget,
        additional_budget.gl_coa_segment,
        additional_budget.additional_amount,
        additional_budget.`status`,
        additional_budget.approval_scheme,
        tbl_user.full_name');
        $this->datatables->from('additional_budget');
        $this->datatables->join('form_promotion', 'additional_budget.promotion_number = form_promotion.promotion_number','left');
        $this->datatables->join('wf_edit_budget', 'additional_budget.promotion_number = wf_edit_budget.promotion_number AND additional_budget.approval_scheme = wf_edit_budget.approval_scheme','left');
        $this->datatables->join('tbl_user', 'wf_edit_budget.id_users = tbl_user.id_users','left');
        $this->datatables->add_column('action', anchor(site_url('promotion_form/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')), 'promotion_id');

        return $this->datatables->generate();
    }

    function promotion_view()
    {
        $kode_distributor = $this->session->userdata('kode_distributor');
        $store_code = $this->session->userdata('store_code');
        $region_code = $this->session->userdata('region_code');
        if ($kode_distributor != NULL && $this->session->userdata('category_id') == 3) {
            $sql = $this->db->query("SELECT form_promotion.promotion_id,
            form_promotion.periode_awal,
            form_promotion.periode_akhir,
            form_promotion.promotion_number,
            form_promotion.promotion_name,
            form_promotion.fiscal_year,
            form_promotion.region_code,
            form_promotion.kode_area FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.kode_area AND form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.periode_awal,
            form_promotion.periode_akhir,
            form_promotion.promotion_number,
            form_promotion.promotion_name,
            form_promotion.fiscal_year,
            form_promotion.region_code,
            form_promotion.kode_area
            FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'

            UNION

            SELECT form_promotion.promotion_id,
            form_promotion.periode_awal,
            form_promotion.periode_akhir,
            form_promotion.promotion_number,
            form_promotion.promotion_name,
            form_promotion.fiscal_year,
            form_promotion.region_code,
            form_promotion.kode_area
            FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.region_code = 6 and form_promotion.kode_area = '$region_code' or form_promotion.kode_area = '' and form_promotion.kode_departemen = '0305' GROUP BY form_promotion.promotion_number
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.periode_awal,
            form_promotion.periode_akhir,
            form_promotion.promotion_number,
            form_promotion.promotion_name,
            form_promotion.fiscal_year,
            form_promotion.region_code,
            form_promotion.kode_area
            FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.kode_departemen = '0312'");
        } elseif ($kode_distributor != NULL && $this->session->userdata('category_id') == 2) {
            $sql = $this->db->query("SELECT form_promotion.promotion_id,
            form_promotion.periode_awal,
            form_promotion.periode_akhir,
            form_promotion.promotion_number,
            form_promotion.promotion_name,
            form_promotion.fiscal_year,
            form_promotion.region_code,
            form_promotion.kode_area FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.kode_area AND form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'

            UNION

            SELECT form_promotion.promotion_id,
            form_promotion.periode_awal,
            form_promotion.periode_akhir,
            form_promotion.promotion_number,
            form_promotion.promotion_name,
            form_promotion.fiscal_year,
            form_promotion.region_code,
            form_promotion.kode_area FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.region_code = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.region_code = 6 and form_promotion.kode_area = '$region_code' or form_promotion.kode_area = '' and form_promotion.kode_departemen = '0305' GROUP BY form_promotion.promotion_number
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.periode_awal,
            form_promotion.periode_akhir,
            form_promotion.promotion_number,
            form_promotion.promotion_name,
            form_promotion.fiscal_year,
            form_promotion.region_code,
            form_promotion.kode_area FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and arc_distributor.kode_distributor = '$kode_distributor'
            
            UNION
            
            SELECT form_promotion.promotion_id,
            form_promotion.periode_awal,
            form_promotion.periode_akhir,
            form_promotion.promotion_number,
            form_promotion.promotion_name,
            form_promotion.fiscal_year,
            form_promotion.region_code,
            form_promotion.kode_area
            FROM
            form_promotion
            LEFT JOIN arc_distributor ON form_promotion.kode_area = arc_distributor.region_code
            WHERE form_promotion.`status` = 4 and form_promotion.kode_departemen = '0312'");
        } else {
            $sql = $this->db->query("SELECT form_promotion.promotion_id,
            form_promotion.periode_awal,
            form_promotion.periode_akhir,
            form_promotion.promotion_number,
            form_promotion.promotion_name,
            form_promotion.fiscal_year,
            form_promotion.region_code,
            form_promotion.kode_area FROM
            form_promotion
            WHERE form_promotion.`status` = 4 and store_code = '$store_code'");
        }
        $data = $sql->result_array();
        return $data;
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get all data
    function get_all_data()
    {
        $this->db->order_by($this->id);
        return $this->db->get($this->table)->result_array();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('DISTINCT form_promotion.promotion_id,
        form_promotion.kode_perusahaan,
        form_promotion.date_create,
        form_promotion.business_unit_id,
        form_promotion.promotion_number,
        form_promotion.kode_departemen,
        form_promotion.promotion_name,
        form_promotion.periode_awal,
        form_promotion.periode_akhir,
        form_promotion.fiscal_year,
        form_promotion.channel_code,
        form_promotion.region_code,
        form_promotion.kode_area,
        form_promotion.store_code,
        form_promotion.brand_code,
        form_promotion.series_code,
        form_promotion.sales_background,
        form_promotion.sales_strategy,
        form_promotion.sales_objective,
        form_promotion.sales_mechanism,
        form_promotion.status,
        form_promotion.pemohon,
        form_promotion.total_product_baseline,
        form_promotion.total_product_incremental,
        form_promotion.total_listing_cost,
        form_promotion.total_on_top_promo,
        form_promotion.total_trading_term,
        form_promotion.approval_scheme,
        form_promotion.upload_file,
        form_promotion.upload_activity,
        form_promotion.type,
        form_promotion.SecLogUser,
        form_promotion.SecLogDate,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_region.nama_region,
        arc_area.nama_area,
        arc_store.store_name,
        tbl_promotion_status.status_name,
        business_unit.business_unit_name,
        brand.brand_name,
        series.series_name', FALSE);
        $this->db->where($this->id, $id);
        $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
        $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
        $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
        $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
        $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
        $this->db->join('tbl_promotion_status', 'tbl_promotion_status.status_code = form_promotion.status', 'left');
        $this->db->join('business_unit', 'form_promotion.business_unit_id = business_unit.business_unit_id', 'left');
        $this->db->join('brand', 'form_promotion.brand_code = brand.brand_code', 'left');
        $this->db->join('series', 'form_promotion.series_code = series.series_code', 'left');
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('promotion_id', $q);
        $this->db->or_like('kode_perusahaan', $q);
        $this->db->or_like('date_create', $q);
        $this->db->or_like('promotion_number', $q);
        $this->db->or_like('kode_departemen', $q);
        $this->db->or_like('promotion_name', $q);
        $this->db->or_like('promotion_period', $q);
        $this->db->or_like('fiscal_year', $q);
        $this->db->or_like('channel_code', $q);
        $this->db->or_like('region_code', $q);
        $this->db->or_like('kode_area', $q);
        $this->db->or_like('store_code', $q);
        $this->db->or_like('sales_background', $q);
        $this->db->or_like('sales_strategy', $q);
        $this->db->or_like('sales_objective', $q);
        $this->db->or_like('sales_mechanism', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('pemohon', $q);
        $this->db->or_like('SecLogUser', $q);
        $this->db->or_like('SecLogDate', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('promotion_id', $q);
        $this->db->or_like('kode_perusahaan', $q);
        $this->db->or_like('date_create', $q);
        $this->db->or_like('promotion_number', $q);
        $this->db->or_like('kode_departemen', $q);
        $this->db->or_like('promotion_name', $q);
        $this->db->or_like('promotion_period', $q);
        $this->db->or_like('fiscal_year', $q);
        $this->db->or_like('channel_code', $q);
        $this->db->or_like('region_code', $q);
        $this->db->or_like('kode_area', $q);
        $this->db->or_like('store_code', $q);
        $this->db->or_like('sales_background', $q);
        $this->db->or_like('sales_strategy', $q);
        $this->db->or_like('sales_objective', $q);
        $this->db->or_like('sales_mechanism', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('pemohon', $q);
        $this->db->or_like('SecLogUser', $q);
        $this->db->or_like('SecLogDate', $q);
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

    function get_channel($kode_departemen)
    {
        if ($kode_departemen == '0306401') {
            $kode = array('0306401','0308','0307');
            $this->db->select('*', FALSE);
            $this->db->from('arc_channel');
            $this->db->where_in('kode_departemen', $kode);
        } else {
            $this->db->select('*', FALSE);
            $this->db->from('arc_channel');
            $this->db->where('kode_departemen', $kode_departemen);
        }
        $this->db->order_by('channel_name', 'ASC');
        $query = $this->db->get();
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

    function get_alias_channel($channel_code)
    {
        $this->db->select('*', FALSE);
        $this->db->where('channel_code', $channel_code);
        $this->db->limit(1);
        $query = $this->db->get('arc_channel');
        $data = $query->row();
        $alias_channel_name = $data->alias_channel;
        return $alias_channel_name;
    }

    function get_alias_series($series_code)
    {
        $this->db->select('*', FALSE);
        $this->db->where('series_code', $series_code);
        $this->db->limit(1);
        $query = $this->db->get('series');
        $data = $query->row();
        $alias_series_name = $data->series_alias;
        return $alias_series_name;
    }

    function get_store($channel_code, $kode_departemen, $business_unit_id)
    {
        $this->db->select('DISTINCT gl_budget.store_code, arc_store.store_name', FALSE);
        $this->db->from('gl_budget');
        $this->db->where('gl_budget.business_unit_id', $business_unit_id);
        $this->db->where('gl_budget.channel_code', $channel_code);
        $this->db->where('gl_budget.kode_departemen', $kode_departemen);
        $this->db->join('arc_store', 'arc_store.store_code = gl_budget.store_code');
        $this->db->order_by('arc_store.store_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_region($channel_code, $kode_departemen, $business_unit_id)
    {
        $this->db->select('DISTINCT gl_budget.region_id, arc_region.nama_region, arc_region.region_code', FALSE);
        $this->db->from('gl_budget');
        $this->db->where('gl_budget.business_unit_id', $business_unit_id);
        $this->db->where('gl_budget.channel_code', $channel_code);
        $this->db->where('gl_budget.kode_departemen', $kode_departemen);
        $this->db->join('arc_region', 'arc_region.region_code = gl_budget.region_id');
        $this->db->order_by('arc_region.nama_region', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_area($region_code)
    {
        $this->db->order_by('nama_area', 'ASC');
        $query = $this->db->get_where('arc_area', array('region_id' => $region_code));
        return $query;
    }

    function get_distributor($region_code)
    {
        if ($region_code != 6) {
            $this->db->order_by('nama_distributor', 'ASC');
            $query = $this->db->get_where('arc_distributor', array('region_code' => $region_code));
        } else {
            $this->db->order_by('nama_distributor', 'ASC');
            $query = $this->db->get('arc_distributor');
        }
        return $query;
    }

    function get_brand($kode_departemen)
    {
        $this->db->select('gl_budget.brand_code, brand.brand_name', FALSE);
        $this->db->where('gl_budget.kode_departemen', $kode_departemen);
        $this->db->join('brand','gl_budget.brand_code = brand.brand_code', 'left');
        $this->db->group_by('brand.brand_code');
        $this->db->order_by('brand.brand_name', 'ASC');
        $query = $this->db->get('gl_budget');
        return $query;
    }

    function get_series($brand_code, $kode_departemen)
    {
        $this->db->select('gl_budget.series_code, series.series_name', FALSE);
        $this->db->where('gl_budget.kode_departemen', $kode_departemen);
        $this->db->where('gl_budget.brand_code', $brand_code);
        $this->db->join('series','gl_budget.series_code = series.series_code', 'left');
        $this->db->group_by('series.series_code');
        $this->db->order_by('series.series_name', 'ASC');
        $query = $this->db->get('gl_budget');
        return $query;
    }

    function financial_desc()
    {
        $this->db->select('DISTINCT financial_name', FALSE);
        $query = $this->db->get('financial_desc');
        $data = $query->result_array();
        return $data;
    }

    public function buat_kode($kode_departemen)
    {
        $this->db->select('RIGHT(form_promotion.promotion_number,3) as kode', FALSE);
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('form_promotion');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        return $kodemax;
    }

    function get_dept($kode_departemen)
    {
        $this->db->select('*', FALSE);
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->order_by('kode_departemen', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('arc_departemen');
        $data = $query->row();
        $alias = $data->alias_departemen;
        return $alias;
    }

    // insert Financial KPI
    function insert_financial_kpi($insertArray)
    {
        $this->db->insert_batch('financial_kpi', $insertArray);
    }

    // INSERT PRODUCT
    function insert_product($productArray)
    {
        $this->db->insert_batch('product', $productArray);
    }

    // INSERT PRODUCT GRATIS
    function insert_product_gratis($productGratisArray)
    {
        $this->db->insert_batch('product_gratis', $productGratisArray);
    }

    // INSERT DISTRIBUTOR
    function insert_distributor($distributorArray)
    {
        $this->db->insert_batch('form_promotion_distributor', $distributorArray);
    }

    // INSERT LISTING COST
    function insert_listing($listingArray)
    {
        $this->db->insert_batch('listing_cost', $listingArray);
    }

    // INSERT ON TOP PROMO
    function insert_promo($promoArray)
    {
        $this->db->insert_batch('on_top_promo', $promoArray);
    }

    // INSERT TRADING TERM
    function insert_trading($tradingArray)
    {
        $this->db->insert_batch('trading_term', $tradingArray);
    }

    /* GET APPROVAL */
    function get_approval_tm_old($kode_departemen, $channel_code, $region_code, $store_code, $total_budget)
    {
        //Get approval list TM (GT/MTI) & (MTKA)
        $where_regionCode = "(region_code = '$region_code' OR region_code is NULL)";
        $where_storeCode = "(store_code = '$store_code' OR store_code is NULL)";
        $bod = array('10', '11');
        $this->db->SELECT('id_users, id_user_level', FALSE);
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->where('channel_code', $channel_code);
        if ($total_budget < 25000000) {
            $this->db->where_not_in('id_user_level', $bod);
        }
        if ($channel_code == '001') {
            $this->db->where($where_storeCode);
            $this->db->or_where('id_user_level', '7');
            $this->db->group_by('id_user_level');
            $this->db->order_by('id_user_level');
        } else {
            $this->db->where($where_regionCode);
            $this->db->group_by('id_user_level');
            $this->db->order_by('approval_scheme');
        }
        $query = $this->db->get('approval_program-old');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approval_ka_old($kode_departemen, $channel_code, $store_code, $total_on_top_promo, $total_budget)
    {
        //Get approval list KA & KA (on top promo)
        $where_storeCode = "(store_code = '$store_code' OR store_code is NULL)";
        $bod = array('10', '11');
        $this->db->SELECT('id_users, id_user_level', FALSE);
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->where('channel_code', $channel_code);
        if ($total_budget < 25000000) {
            $this->db->where_not_in('id_user_level', $bod);
        }
        if ($total_on_top_promo == 0) {
            $this->db->where($where_storeCode);
            $this->db->group_by('id_user_level');
            $this->db->order_by('approval_scheme');
        } else {
            $this->db->where($where_storeCode);
            $this->db->or_where('id_user_level', '7');
            $this->db->group_by('id_user_level');
            $this->db->order_by('id_user_level');
        }
        $query = $this->db->get('approval_program-old');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approval_ec_old($kode_departemen, $channel_code, $total_budget)
    {
        //Get approval list Ecommerce
        $bod = array('29', '11');
        $this->db->SELECT('id_users, id_user_level', FALSE);
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->where('channel_code', $channel_code);
        if ($total_budget < 25000000) {
            $this->db->where_not_in('id_user_level', $bod);
        }
        $this->db->group_by('id_user_level');
        $this->db->order_by('approval_scheme');
        $query = $this->db->get('approval_program-old');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    /* GET APPROVAL */
    function get_approval_tm($kode_departemen, $channel_code, $region_code, $store_code, $total_budget, $business_unit_id)
    {
        //Get approval list TM (GT/MTI) & (MTKA)
        $where_regionCode = "(region_code = '$region_code' OR region_code is NULL)";
        $where_storeCode = "(store_code = '$store_code' OR store_code is NULL)";
        $bod = array('10', '11');
        $this->db->SELECT('id_users, id_user_level', FALSE);
        $this->db->where('business_unit_id', $business_unit_id);
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->where('channel_code', $channel_code);
        if ($channel_code == '001') {
            $this->db->where($where_storeCode);
            if ($total_budget < 25000000) {
                $this->db->where_not_in('id_user_level', $bod);
            }
            // $this->db->or_where('id_user_level', '7');
            if ($business_unit_id == 1) {
                $this->db->or_where('id_user_level', '7');
                $this->db->where('id_users', '7');
            } else {
                $this->db->or_where('id_user_level', '7');
            }
        } else {
            $this->db->where($where_regionCode);
            if ($total_budget < 25000000) {
                $this->db->where_not_in('id_user_level', $bod);
            }
            if ($business_unit_id == 1) {
                $this->db->or_where('id_user_level', '7');
                $this->db->where('id_users', '7');
            } else {
                $this->db->or_where('id_user_level', '7');
            }
        }
        $this->db->group_by('id_user_level');
        $this->db->order_by('approval_scheme');
        $query = $this->db->get('approval_program');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approval_ka($kode_departemen, $channel_code, $store_code, $total_on_top_promo, $total_budget, $business_unit_id)
    {
        //Get approval list KA & KA (on top promo)
        $where_storeCode = "(store_code = '$store_code' OR store_code is NULL)";
        $bod = array('10', '11');
        $this->db->SELECT('id_users, id_user_level', FALSE);
        $this->db->where('business_unit_id', $business_unit_id);
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->where('channel_code', $channel_code);
        $this->db->where($where_storeCode);
        if ($total_budget < 25000000) {
            $this->db->where_not_in('id_user_level', $bod);
        }
        if ($total_on_top_promo != 0) {
            if ($business_unit_id == 1) {
                $this->db->or_where('id_user_level', '7');
                $this->db->where('id_users', '7');
            } else {
                $this->db->or_where('id_user_level', '7');
            }
        } else {
            $this->db->where_not_in('id_user_level', '7');
        }
        $this->db->group_by('id_user_level');
        $this->db->order_by('approval_scheme');
        $query = $this->db->get('approval_program');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approval_ec($kode_departemen, $channel_code, $store_code, $total_on_top_promo, $total_budget, $business_unit_id)
    {
        //Get approval list Ecommerce
        $bod = array('29', '11');
        $this->db->SELECT('id_users, id_user_level', FALSE);
        $this->db->where('business_unit_id', $business_unit_id);
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->where('channel_code', $channel_code);
        if ($total_budget < 25000000) {
            $this->db->where_not_in('id_user_level', $bod);
        }
        $this->db->group_by('id_user_level');
        $this->db->order_by('approval_scheme');
        $query = $this->db->get('approval_program');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approval_mkt($kode_departemen, $brand_code, $series_code, $total_budget, $business_unit_id)
    {
        //Get approval list Marketing
        $bod = array('11','29');
        $this->db->SELECT('id_users, id_user_level', FALSE);
        $this->db->where('business_unit_id', $business_unit_id);
        $this->db->where('brand_code IS NULL');
        if ($total_budget < 25000000) {
            $this->db->where_not_in('id_user_level', $bod);
        }
        $this->db->or_where('kode_departemen', $kode_departemen);
        $this->db->where('brand_code', $brand_code);
        $this->db->where('series_code', $series_code);
        $this->db->order_by('approval_scheme');
        $query = $this->db->get('approval_program');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approval_mktp($kode_departemen, $total_budget, $business_unit_id)
    {
        //Get approval list Marketing
        $bod = array('11','29');
        $this->db->SELECT('id_users, id_user_level', FALSE);
        $this->db->where('business_unit_id', $business_unit_id);
        if ($total_budget < 25000000) {
            $this->db->where_not_in('id_user_level', $bod);
        }
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->order_by('approval_scheme');
        $query = $this->db->get('approval_program');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approval_pr($kode_departemen, $total_budget, $business_unit_id)
    {
        //Get approval list Marketing
        $bod = array('11','29');
        $this->db->SELECT('id_users, id_user_level', FALSE);
        $this->db->where('business_unit_id', $business_unit_id);
        if ($total_budget < 25000000) {
            $this->db->where_not_in('id_user_level', $bod);
        }
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->order_by('approval_scheme');
        $query = $this->db->get('approval_program');
        $data = $query->result_array();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    /* GET APPROVAL */
    function get_scheme($promotion_number)
    {
        $this->db->SELECT('approval_scheme', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->order_by('approval_scheme', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    // insert Workflow PROGRAM
    function insert_wf_program($insertArray)
    {
        $this->db->insert_batch('wf_program', $insertArray);
    }

    // insert APPROVAL
    function insert_approval($insertApproval)
    {
        $this->db->insert_batch('wf_program', $insertApproval);
    }

    // // insert APPROVAL PROMO
    // function insert_approval_promo($insertApproval_promo)
    // {
    //     $this->db->insert_batch('wf_program', $insertApproval_promo);
    // }

    // update Sales - HET (Financial KPI)
    function update_salesHet($promotion_number, $data_salesHet)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('description', 'Sales - HET');
        $this->db->update('financial_kpi', $data_salesHet);
    }

    // update Distributor/Store Margin (Financial KPI)
    function update_margin($promotion_number, $data_margin)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('description', 'Distributor/Store Margin');
        $this->db->update('financial_kpi', $data_margin);
    }

    // update Net Amount (Financial KPI)
    function update_netAmount($promotion_number, $data_netAmount)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('description', 'Net Amount');
        $this->db->update('financial_kpi', $data_netAmount);
    }

    // update Trading Term (Financial KPI)
    function update_tradingTerm($promotion_number, $data_tradingTerm)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('description', 'Trading Term');
        $this->db->update('financial_kpi', $data_tradingTerm);
    }

    // update Listing (Financial KPI)
    function update_listing($promotion_number, $data_listing)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('description', 'Listing');
        $this->db->update('financial_kpi', $data_listing);
    }

    // update On Top Promo (Financial KPI)
    function update_onTopPromo($promotion_number, $data_promo)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('description', 'On Top Promo');
        $this->db->update('financial_kpi', $data_promo);
    }

    // update Cost (Financial KPI)
    function update_cost($promotion_number, $data_cost)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('description', 'Cost');
        $this->db->update('financial_kpi', $data_cost);
    }

    // update Net Sales (Financial KPI)
    function update_netSales($promotion_number, $data_netSales)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('description', 'Net Sales');
        $this->db->update('financial_kpi', $data_netSales);
    }

    function get_listing_fee_data($promotion_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('listing_activity', '1');
        $query = $this->db->get('listing_cost');
        $data = $query->row();
        return $data;
    }

    function get_listing_support_data($promotion_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('listing_activity', '2');
        $query = $this->db->get('listing_cost');
        $data = $query->row();
        return $data;
    }

    function get_listingFee_budget_amount($listingFee_coaSegment)
    {
        $this->db->select('*', FALSE);
        $this->db->where('gl_coa_segment', $listingFee_coaSegment);
        $query = $this->db->get('gl_budget');
        $data = $query->row();
        return $data;
        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function get_listingSupport_budget_amount($listingSupport_coaSegment)
    {
        $this->db->select('*', FALSE);
        $this->db->where('gl_coa_segment', $listingSupport_coaSegment);
        $query = $this->db->get('gl_budget');
        $data = $query->row();
        return $data;
    }

    // update budget usage
    function update_listingFee($listingFee_coaSegment, $data_listingFee, $fiscal_year)
    {
        // $Year = date('Y');
        $this->db->where('gl_coa_segment', $listingFee_coaSegment);
        $this->db->where('YearPeriod', $fiscal_year);
        $this->db->update('gl_budget', $data_listingFee);
    }

    function update_listingSupport($listingSupport_coaSegment, $listingSupport, $fiscal_year)
    {
        // $Year = date('Y');
        $this->db->where('gl_coa_segment', $listingSupport_coaSegment);
        $this->db->where('YearPeriod', $fiscal_year);
        $this->db->update('gl_budget', $listingSupport);
    }

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
        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function update_budget_onTopPromo($budgetArray, $fiscal_year)
    {
        // $Year = date('Y');
        $this->db->where('YearPeriod', $fiscal_year);
        $this->db->update_batch('gl_budget', $budgetArray, 'gl_coa_segment');

        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

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

    function update_budget_tradingTerm($budget_tradingArray, $fiscal_year)
    {
        // $Year = date('Y');
        $this->db->where('YearPeriod', $fiscal_year);
        $this->db->update_batch('gl_budget', $budget_tradingArray, 'gl_coa_segment');

        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
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

    function update_total($promotion_number, $total)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->update('form_promotion', $total);
    }

    function get_coaSegment($coa_segment)
    {
        $this->db->select('DISTINCT gl_budget.gl_coa, gl_account.gl_coa_desc, gl_budget.is_aktif', false);
        $this->db->like('gl_coa_segment', $coa_segment, 'after');
        $this->db->join('gl_account', 'gl_account.gl_coa = gl_budget.gl_coa', 'left');
        // $this->db->order_by('gl_coa_segment', 'ASC');
        // $this->db->where('gl_coa_segment', $coa_segment);
        $query = $this->db->get('gl_budget');
        return $query;
        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function get_listing_cost($promotion_number)
    {
        $this->db->select('listing_cost.listing_activity,
        listing_cost.gl_coa_segment,
        listing_cost.gl_account_code,
        listing_cost.amount,
        listing_cost.incremental_sales,
        listing_cost.source_fund,
        listing_cost.remark,
        gl_account.gl_coa_desc,
        listing_activity.listing_activity_name', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->join('listing_activity', 'listing_activity.listing_activity_id = listing_cost.listing_activity', 'left');
        $this->db->join('gl_account', 'gl_account.gl_coa = listing_cost.gl_account_code', 'left');
        $query = $this->db->get('listing_cost');
        return $query->result();
    }

    function get_financial_kpi($promotion_number, $kode_departemen)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        if ($kode_departemen == '0306' || $kode_departemen == '0306401' || $kode_departemen == '0308' || $kode_departemen == '0307' || $kode_departemen == '0303'){
            $description = array('Trading Term','Listing');
            $this->db->where_not_in('description', $description);
        }
        $query = $this->db->get('financial_kpi');
        return $query->result();
    }

    function get_product($promotion_number)
    {
        $this->db->select("product.product_code,
        product.baseline_sales,
        product.incremental_sales,
        product_list.product_name,
        product.business_unit_id,
        product.category_1,
        product.category_2,
        category1.category_name as cotegory_name_1,
        category2.category_name as cotegory_name_2,
        business_unit.business_unit_name", FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->join('product_list', 'product_list.product_code = product.product_code', 'left');
        $this->db->join('product_category as category1', 'category1.category_id = product.category_1', 'left');
        $this->db->join('product_category as category2', 'category2.category_id = product.category_2', 'left');
        $this->db->join('business_unit', 'business_unit.business_unit_id = product.business_unit_id', 'left');
        $this->db->group_by('product.product_code');
        $query = $this->db->get('product');
        return $query->result();
    }

    function get_product_gratis($promotion_number)
    {
        $this->db->select("product_gratis.product_code,
        product_gratis.qty,
        product_list.product_name,", FALSE);
        $this->db->join('product_list', 'product_gratis.product_code = product_list.product_code', 'left');
        $this->db->where('product_gratis.promotion_number', $promotion_number);
        $this->db->group_by('product_gratis.product_code');
        $query = $this->db->get('product_gratis');
        return $query->result();
    }

    function get_on_top_promo($promotion_number, $kode_departemen)
    {
        if ($kode_departemen == '0306' || $kode_departemen == '0306401' || $kode_departemen == '0308' || $kode_departemen == '0307' || $kode_departemen == '0303'){
            $this->db->select('on_top_promo.gl_coa_segment,
            on_top_promo.gl_account_code,
            on_top_promo.amount,
            on_top_promo.incremental_sales,
            on_top_promo.source_fund,
            on_top_promo.remark,
            on_top_promo.promo_activity_name AS activity_id,
            on_top_promo.promo_activity_name,
            gl_account.gl_coa_desc', FALSE);
            $this->db->where('promotion_number', $promotion_number);
            $this->db->join('gl_account', 'gl_account.gl_coa = on_top_promo.gl_account_code', 'left');
        } else {
            $this->db->select('on_top_promo.gl_coa_segment,
            on_top_promo.gl_account_code,
            on_top_promo.amount,
            on_top_promo.incremental_sales,
            on_top_promo.source_fund,
            on_top_promo.remark,
            on_top_promo.promo_activity_name AS activity_id,
            on_top_promo_activity.promo_activity_name,
            gl_account.gl_coa_desc', FALSE);
            $this->db->where('promotion_number', $promotion_number);
            $this->db->join('on_top_promo_activity', 'on_top_promo_activity.promo_activity_id = on_top_promo.promo_activity_name', 'left');
            $this->db->join('gl_account', 'gl_account.gl_coa = on_top_promo.gl_account_code', 'left');
        }
        $query = $this->db->get('on_top_promo');
        return $query->result();
    }

    function get_trading($promotion_number)
    {
        $this->db->select('
        trading_term.gl_account_code,
        trading_term.amount,
        trading_term.incremental_sales,
        trading_term.gl_coa_segment,
        trading_term.trading_activity_name as activity_id,
        trading_term_activity.trading_activity_name,
        gl_account.gl_coa_desc', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->join('trading_term_activity', 'trading_term_activity.trading_activity_id = trading_term.trading_activity_name', 'left');
        $this->db->join('gl_account', 'gl_account.gl_coa = trading_term.gl_account_code', 'left');
        $query = $this->db->get('trading_term');
        $data = $query->result_array();
        return $data;
    }

    function get_total_trading($promotion_number)
    {
        $this->db->select('
        SUM(amount)AS total_amount,
	    SUM(incremental_sales)AS total_incremental_sales', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $query = $this->db->get('trading_term');
        $data = $query->row();
        return $data;
    }

    function get_approve_scheme1($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
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
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '1');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme2($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
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
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '2');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme3($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
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
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '3');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme4($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
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
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '4');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme5($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
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
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '5');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme6($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
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
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '6');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme7($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
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
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '7');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_id($promotion_number)
    {
        $this->db->select('promotion_id', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
    }

    // INSERT ON TOP PROMO
    function insert_total_promotion($total_promotion)
    {
        $this->db->insert('form_promotion_budget', $total_promotion);
    }

    /* DELETE (Update Listing Cost Budget) */
    function get_listingCost($promotion_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->order_by('gl_coa_segment');
        $query = $this->db->get('listing_cost');
        $data = $query->result_array();
        return $data;
    }

    function get_listingCost_budget_amount($listingCost_coaSegment)
    {
        $this->db->select('*', FALSE);
        $this->db->where_in('gl_coa_segment', $listingCost_coaSegment);
        $this->db->order_by('gl_coa_segment');
        $query = $this->db->get('gl_budget');
        $data = $query->result_array();
        return $data;
        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function update_budget_listingCost($listing_budgetArray, $fiscal_year)
    {
        // $Year = date('Y');
        $this->db->where('YearPeriod', $fiscal_year);
        $this->db->update_batch('gl_budget', $listing_budgetArray, 'gl_coa_segment');

        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    /* DELETE (Update On Top Promo Budget) */
    function get_ontopPromo_data($promotion_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->order_by('gl_coa_segment');
        $query = $this->db->get('on_top_promo');
        $data = $query->result_array();
        return $data;
    }

    function get_ontopPromo_budget($ontopPromo_coaSegment)
    {
        $this->db->select('*', FALSE);
        $this->db->where_in('gl_coa_segment', $ontopPromo_coaSegment);
        $this->db->order_by('gl_coa_segment');
        $query = $this->db->get('gl_budget');
        $data = $query->result_array();
        return $data;
        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function updateBudget_onTopPromo($ontopPromo_budgetArray, $fiscal_year)
    {
        // $Year = date('Y');
        $this->db->where('YearPeriod', $fiscal_year);
        $this->db->update_batch('gl_budget', $ontopPromo_budgetArray, 'gl_coa_segment');

        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
    }

    function update_promotion($promotion_number, $data)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->update('form_promotion', $data);
    }

    // // Delete Product
    // function delete_product($promotion_number)
    // {
    //     $this->db->where('promotion_number', $promotion_number);
    //     $this->db->delete('product');
    // }

    // // Delete Listing Cost
    // function delete_listing_cost($promotion_number)
    // {
    //     $this->db->where('promotion_number', $promotion_number);
    //     $this->db->delete('listing_cost');
    // }

    // // Delete On Top Promo
    // function delete_on_top_promo($promotion_number)
    // {
    //     $this->db->where('promotion_number', $promotion_number);
    //     $this->db->delete('on_top_promo');
    // }

    // // Delete Trading Term
    // function delete_trading_term($promotion_number)
    // {
    //     $this->db->where('promotion_number', $promotion_number);
    //     $this->db->delete('trading_term');
    // }

    // // Delete On Top Promo
    // function delete_financial_kpi($promotion_number)
    // {
    //     $this->db->where('promotion_number', $promotion_number);
    //     $this->db->delete('financial_kpi');
    // }

    // // Delete On Top Promo
    // function delete_wf_program($promotion_number)
    // {
    //     $this->db->where('promotion_number', $promotion_number);
    //     $this->db->delete('wf_program');
    // }

    // // Delete On Top Promo
    // function delete_form_promotion_budget($promotion_number)
    // {
    //     $this->db->where('promotion_number', $promotion_number);
    //     $this->db->delete('form_promotion_budget');
    // }

    function get_product_category_1($business_unit_id)
    {
        $this->db->select('category_id,category_name', false);
        if($business_unit_id != 4) {
            $this->db->where('business_unit_id', $business_unit_id);
        }
        $query = $this->db->get('product_category');
        return $query;
    }

    function get_product_category_2($business_unit_id)
    {
        $this->db->select('category_id,category_name', false);
        if($business_unit_id != 4) {
            $this->db->where('business_unit_id', $business_unit_id);
        }
        $query = $this->db->get('product_category');
        return $query;
    }

    function get_margin($kode_departemen, $store_code, $channel_code, $region_code)
    {
        if ($kode_departemen == 0312) {
            $this->db->select('*', FALSE);
            $this->db->where('kode_departemen', $kode_departemen);
            $this->db->where('channel_code', $channel_code);
            $this->db->where('store_code', $store_code);
        } else {
            $this->db->select('*', FALSE);
            $this->db->where('kode_departemen', $kode_departemen);
            $this->db->where('channel_code', $channel_code);
            if ($channel_code == '001') {
                $this->db->where('store_code', $store_code);
            } else {
                $this->db->where('region_code', $region_code);
            }
        }
        $query = $this->db->get('arc_distributor_margin');
        return $query->row();
    }

    function get_trading_term($kode_departemen, $store_code, $channel_code)
    {
        $this->db->select('trading_term', FALSE);
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->where('channel_code', $channel_code);
        $this->db->where('store_code', $store_code);
        $query = $this->db->get('arc_trading_term');
        return $query->row();
    }

    function promotion_export($id)
    {
        $this->db->select('DISTINCT form_promotion.promotion_id,
        form_promotion.kode_perusahaan,
        form_promotion.date_create,
        form_promotion.promotion_number,
        form_promotion.kode_departemen,
        form_promotion.promotion_name,
        form_promotion.periode_awal,
        form_promotion.periode_akhir,
        form_promotion.fiscal_year,
        form_promotion.channel_code,
        form_promotion.region_code,
        form_promotion.kode_area,
        form_promotion.store_code,
        form_promotion.sales_background,
        form_promotion.sales_strategy,
        form_promotion.sales_objective,
        form_promotion.sales_mechanism,
        form_promotion.status,
        form_promotion.pemohon,
        form_promotion.total_product_baseline,
        form_promotion.total_product_incremental,
        form_promotion.total_listing_cost,
        form_promotion.total_on_top_promo,
        form_promotion.approval_scheme,
        form_promotion.SecLogUser,
        form_promotion.SecLogDate,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_region.nama_region,
        arc_area.nama_area,
        arc_store.store_name', FALSE);
        $this->db->where($this->id, $id);
        $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
        $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
        $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
        $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
        $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
        return $this->db->get($this->table)->row();
    }

    function get_financial_kpi_export($promotion_number, $kode_departemen)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        if ($kode_departemen == '0306'){
            $description = array('Trading Term','Listing');
            $this->db->where_not_in('description', $description);
        }
        $query = $this->db->get('financial_kpi');
        return $query->result();
    }

    function get_product_export($promotion_number)
    {
        $this->db->select("product.product_code,
        product.baseline_sales,
        product.incremental_sales,
        product_list.product_name,
        category1.category_name as cotegory_name_1,
        category2.category_name as cotegory_name_2,
        business_unit.business_unit_name", FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->join('product_list', 'product_list.product_code = product.product_code', 'left');
        $this->db->join('product_category as category1', 'category1.category_id = product.category_1', 'left');
        $this->db->join('product_category as category2', 'category2.category_id = product.category_2', 'left');
        $this->db->join('business_unit', 'business_unit.business_unit_id = product.business_unit_id', 'left');
        $this->db->group_by('product.product_code');
        $query = $this->db->get('product');
        return $query->result();
    }

    function get_listing_cost_export($promotion_number)
    {
        $this->db->select('listing_cost.listing_activity,
        listing_cost.gl_coa_segment,
        listing_cost.gl_account_code,
        listing_cost.amount,
        listing_cost.incremental_sales,
        listing_cost.source_fund,
        listing_cost.remark,
        gl_account.gl_coa_desc,
        listing_activity.listing_activity_name', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->join('listing_activity', 'listing_activity.listing_activity_id = listing_cost.listing_activity', 'left');
        $this->db->join('gl_account', 'gl_account.gl_coa = listing_cost.gl_account_code', 'left');
        $query = $this->db->get('listing_cost');
        return $query->result();
    }

    function get_on_top_promo_export($promotion_number, $kode_departemen)
    {
        if ($kode_departemen == '0306'){
            $this->db->select('on_top_promo.gl_coa_segment,
            on_top_promo.gl_account_code,
            on_top_promo.amount,
            on_top_promo.incremental_sales,
            on_top_promo.source_fund,
            on_top_promo.remark,
            on_top_promo.promo_activity_name,
            gl_account.gl_coa_desc', FALSE);
            $this->db->where('promotion_number', $promotion_number);
            $this->db->join('gl_account', 'gl_account.gl_coa = on_top_promo.gl_account_code', 'left');
        } else {
            $this->db->select('on_top_promo.gl_coa_segment,
            on_top_promo.gl_account_code,
            on_top_promo.amount,
            on_top_promo.incremental_sales,
            on_top_promo.source_fund,
            on_top_promo.remark,
            on_top_promo.promo_activity_name AS activity_id,
            on_top_promo_activity.promo_activity_name,
            gl_account.gl_coa_desc', FALSE);
            $this->db->where('promotion_number', $promotion_number);
            $this->db->join('on_top_promo_activity', 'on_top_promo_activity.promo_activity_id = on_top_promo.promo_activity_name', 'left');
            $this->db->join('gl_account', 'gl_account.gl_coa = on_top_promo.gl_account_code', 'left');
        }
        $query = $this->db->get('on_top_promo');
        return $query->result();
    }

    function get_trading_export($promotion_number)
    {
        $this->db->select('
        trading_term.gl_account_code,
        trading_term.amount,
        trading_term.incremental_sales,
        trading_term_activity.trading_activity_name,
        gl_account.gl_coa_desc', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->join('trading_term_activity', 'trading_term_activity.trading_activity_id = trading_term.trading_activity_name', 'left');
        $this->db->join('gl_account', 'gl_account.gl_coa = trading_term.gl_account_code', 'left');
        $query = $this->db->get('trading_term');
        $data = $query->result_array();
        return $data;
    }

    function get_total_trading_export($promotion_number)
    {
        $this->db->select('
        SUM(amount)AS total_amount,
	    SUM(incremental_sales)AS total_incremental_sales', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $query = $this->db->get('trading_term');
        $data = $query->row();
        return $data;
    }

    function get_approve_export($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user_level.nama_level', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('(wf_program.approval_date is NOT NULL)', NULL, FALSE);
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_reject_export($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user_level.nama_level', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('(wf_program.reject_date is NOT NULL)', NULL, FALSE);
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
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
        arc_store.store_name', FALSE);
        $this->db->join('arc_channel', 'form_promotion.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
        $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
        $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
        $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
        $this->db->where('form_promotion.promotion_number', $promotion_number);
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_email($approval_scheme, $promotion_number)
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
        $this->db->where('wf_program.approval_scheme', $approval_scheme);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_approve_scheme1_export($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '1');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme2_export($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '2');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme3_export($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '3');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme4_export($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '4');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme5_export($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '5');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme6_export($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
        wf_program.approval_scheme,
        wf_program.id_user_level,
        wf_program.approve_by,
        wf_program.approval_date,
        wf_program.reject_by,
        wf_program.reject_date,
        wf_program.reject_reason,
        wf_program.SecLogDate,
        wf_program.SecLogUser,
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '6');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_approve_scheme7_export($promotion_number)
    {
        $this->db->select('wf_program.id,
        wf_program.promotion_number,
        wf_program.kode_departemen,
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
        tbl_user_level.nama_level,
        tbl_user.full_name', FALSE);
        $this->db->join('tbl_user_level', 'wf_program.id_user_level = tbl_user_level.id_user_level');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users');
        $this->db->where('wf_program.promotion_number', $promotion_number);
        $this->db->where('wf_program.approval_scheme', '7');
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    function get_departemen($kode_departemen)
    {
        if ($kode_departemen == NULL) {
            $this->db->select('*', FALSE);
            $query = $this->db->get('arc_departemen');
            $data = $query->result_array();
        } elseif ($kode_departemen == '0306401') {
            $kode = array('0306401','0308','0307');
            $this->db->select('*', FALSE);
            $this->db->where_in('kode_departemen', $kode);
            $query = $this->db->get('arc_departemen');
            $data = $query->result_array();
        } else {
            $this->db->select('*', FALSE);
            $this->db->where('kode_departemen', $kode_departemen);
            $query = $this->db->get('arc_departemen');
            $data = $query->result_array();
        }
        return $data;
    }

    function get_business_unit($kode_departemen)
    {
        if ($kode_departemen == NULL) {
            $this->db->select('*', FALSE);
            $query = $this->db->get('business_unit');
            $data = $query->result_array();
        } else {
            if ($kode_departemen == '0312' || $kode_departemen == '0305') {
                $business_unit_id = array(1,2);
            } elseif ($kode_departemen == '0323') {
                $business_unit_id = array(3);
            } elseif ($kode_departemen == '0306') {
                $business_unit_id = array(4);
            } elseif ($kode_departemen == '0306401' || $kode_departemen == '0308' || $kode_departemen == '0307') {
                $business_unit_id = array(5);
            } elseif ($kode_departemen == '0303') {
                $business_unit_id = array(6);
            }
            $this->db->select('*', FALSE);
            $this->db->where_in('business_unit_id', $business_unit_id);
            $query = $this->db->get('business_unit');
            $data = $query->result_array();
        }
        return $data;
    }

    function get_wf_program_max($promotion_number)
    {
        $level = array('10', '11');
        $this->db->select('MAX(approval_scheme) as max_wf_program', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where_not_in('id_user_level', $level);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_approval_program_max()
    {
        $this->db->select('MAX(approval_scheme) as max_approval_program', FALSE);
        $query = $this->db->get('approval_program');
        $data = $query->row();
        return $data;
    }

    function get_wf_program_max_export($promotion_number)
    {
        $this->db->select('MAX(approval_scheme) as max_wf_program', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_approval_program_max_export()
    {
        $this->db->select('MAX(approval_scheme) as max_approval_program', FALSE);
        $query = $this->db->get('approval_program');
        $data = $query->row();
        return $data;
    }

    function get_review($promotion_number)
    {
        $level = array('4', '5', '7');
        $this->db->select('MAX(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where_in('id_user_level', $level);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_review_mkt($promotion_number)
    {
        $array = array('29','35','36','37','43');
        $this->db->select('count(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where_in('id_user_level', $array);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_review_mktp($promotion_number)
    {
        $array = array('29','35','42');
        $this->db->select('count(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where_in('id_user_level', $array);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_brandMgr($promotion_number)
    {
        $this->db->select('count(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('id_user_level', 36);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_mktMgr($promotion_number)
    {
        $this->db->select('count(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('id_user_level', 43);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_snrMktMgr($promotion_number)
    {
        $this->db->select('count(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('id_user_level', 37);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_salesDirector($promotion_number)
    {
        $this->db->select('count(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('id_user_level', 10);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_financeDirector($promotion_number)
    {
        $this->db->select('count(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('id_user_level', 11);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_marketingDirector($promotion_number)
    {
        $this->db->select('count(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('id_user_level', 29);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_review_export($promotion_number)
    {
        $level = array('4', '5', '7');
        $this->db->select('MAX(approval_scheme) as max_review', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where_in('id_user_level', $level);
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    public function check_promotion_number($promotion_number)
    {
        $this->db->where('promotion_number', $promotion_number);
        $data = $this->db->get('product');

        return $data->num_rows();
    }

    public function insert_file_product($resultData)
    {
        $data = $this->db->insert_batch('product', $resultData);

        return $this->db->affected_rows();

        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_budgetSaldo_promo($coa_segment, $promoAmount, $year)
    {
        $this->db->select('BudgetAmount, BudgetUsage, BudgetSaldo', FALSE);
        $this->db->where('gl_coa_segment', $coa_segment);
        $this->db->where('YearPeriod', $year);
        $query = $this->db->get('gl_budget');
        $data = $query->row();
        $budgetSaldo = $data->BudgetSaldo;
        if ($promoAmount > $budgetSaldo) {
            $error = "<font color='#a94442'>Over Budget, Budget : " . str_replace(",", ".", number_format($budgetSaldo)) . "</font>";
        } else {
            $error = null;
        }
        return $error;
    }

    function get_budgetSaldo_listing($coa_segment, $listingAmount, $year)
    {
        $this->db->select('BudgetAmount, BudgetUsage, BudgetSaldo', FALSE);
        $this->db->where('gl_coa_segment', $coa_segment);
        $this->db->where('YearPeriod', $year);
        $query = $this->db->get('gl_budget');
        $data = $query->row();
        $budgetSaldo = $data->BudgetSaldo;
        if ($listingAmount > $budgetSaldo) {
            $error = "<font color='#a94442'>Over Budget, Budget : " . $budgetSaldo . "</font>";
        } else {
            $error = null;
        }
        return $error;
    }

    function get_budgetSaldo_trading($coa_segment, $tradingAmount, $year)
    {
        $this->db->select('BudgetAmount, BudgetUsage, BudgetSaldo', FALSE);
        $this->db->where('gl_coa_segment', $coa_segment);
        $this->db->where('YearPeriod', $year);
        $query = $this->db->get('gl_budget');
        $data = $query->row();
        $budgetSaldo = $data->BudgetSaldo;
        if ($tradingAmount > $budgetSaldo) {
            $error = "<font color='#a94442'>Over Budget, Budget : " . str_replace(",", ".", number_format($budgetSaldo)) . "</font>";
        } else {
            $error = null;
        }
        return $error;
    }

    function get_reject_reason($promotion_number)
    {
        $this->db->select('reject_reason', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('reject_by IS NOT NULL');
        $query = $this->db->get('wf_program');
        $data = $query->row();
        return $data;
    }

    function get_promotion_excel($status, $yearPeriode, $department, $month)
    {
        if ($status == 0) {
            $arrayStatus = "'$status', '1'";
        } elseif ($status == 5) {
            $arrayStatus = "'0','1','2','4','5'";
        } else {
            $arrayStatus = $status;
        }
        if ($department == '') {
            $department = "'0312','0305'";
        }
        if ($month == '') {
            $month = "'1','2','3','4','5','6','7','8','9','10','11','12'";
        }

        $query = $this->db->query('SELECT DISTINCT arc_channel.channel_name,
        form_promotion.promotion_id,
        form_promotion.date_create,
        arc_departemen.nama_departemen,
        form_promotion.promotion_number,
        form_promotion.promotion_name,
        form_promotion.periode_awal,
        form_promotion.periode_akhir,
        form_promotion.fiscal_year,
        arc_region.nama_region,
        arc_area.nama_area,
        arc_store.store_name,
        form_promotion.total_product_baseline,
        form_promotion.total_product_incremental,
        (form_promotion.total_product_baseline + form_promotion.total_product_incremental) AS amount_sales,
        tbl_promotion_status.status_name,
        on_top_promo.gl_account_code,
        on_top_promo.amount AS amount_promo,
        NULL AS amount_listing,
        NULL AS amount_trading,
        on_top_promo.amount AS all_cost,
        business_unit.business_unit_name
        FROM
            `form_promotion`
        LEFT JOIN arc_departemen ON arc_departemen.kode_departemen = form_promotion.kode_departemen
        LEFT JOIN arc_channel ON arc_channel.channel_code = form_promotion.channel_code
        LEFT JOIN arc_region ON arc_region.region_code = form_promotion.region_code
        LEFT JOIN arc_area ON arc_area.kode_area = form_promotion.kode_area
        LEFT JOIN arc_store ON arc_store.store_code = form_promotion.store_code
        LEFT JOIN tbl_promotion_status ON tbl_promotion_status.status_code = form_promotion.`status`
        LEFT JOIN form_promotion_budget ON form_promotion_budget.promotion_number = form_promotion.promotion_number
        LEFT JOIN on_top_promo ON on_top_promo.promotion_number = form_promotion.promotion_number
        LEFT JOIN business_unit ON business_unit.business_unit_id = form_promotion.business_unit_id
        WHERE
        form_promotion.`status` IN (' . $arrayStatus . ') AND
        form_promotion.kode_departemen IN (' . $department . ') AND
        form_promotion.fiscal_year = ' . $yearPeriode . ' AND
        MONTH(form_promotion.date_create) IN (' . $month . ') AND
        on_top_promo.gl_account_code IS NOT NULL
        
        UNION
        
        SELECT DISTINCT arc_channel.channel_name,
        form_promotion.promotion_id,
        form_promotion.date_create,
        arc_departemen.nama_departemen,
        form_promotion.promotion_number,
        form_promotion.promotion_name,
        form_promotion.periode_awal,
        form_promotion.periode_akhir,
        form_promotion.fiscal_year,
        arc_region.nama_region,
        arc_area.nama_area,
        arc_store.store_name,
        form_promotion.total_product_baseline,
        form_promotion.total_product_incremental,
        (form_promotion.total_product_baseline + form_promotion.total_product_incremental) AS amount_sales,
        tbl_promotion_status.status_name,
        listing_cost.gl_account_code,
        NULL AS amount_promo,
        listing_cost.amount AS amount_listing,
        NULL AS amount_trading,
        listing_cost.amount AS all_cost,
        business_unit.business_unit_name
        FROM
            `form_promotion`
        LEFT JOIN arc_departemen ON arc_departemen.kode_departemen = form_promotion.kode_departemen
        LEFT JOIN arc_channel ON arc_channel.channel_code = form_promotion.channel_code
        LEFT JOIN arc_region ON arc_region.region_code = form_promotion.region_code
        LEFT JOIN arc_area ON arc_area.kode_area = form_promotion.kode_area
        LEFT JOIN arc_store ON arc_store.store_code = form_promotion.store_code
        LEFT JOIN tbl_promotion_status ON tbl_promotion_status.status_code = form_promotion.`status`
        LEFT JOIN form_promotion_budget ON form_promotion_budget.promotion_number = form_promotion.promotion_number
        LEFT JOIN listing_cost ON listing_cost.promotion_number = form_promotion.promotion_number
        LEFT JOIN business_unit ON business_unit.business_unit_id = form_promotion.business_unit_id
        WHERE
        form_promotion.`status` IN (' . $arrayStatus . ') AND
        form_promotion.kode_departemen IN (' . $department . ') AND
        form_promotion.fiscal_year = ' . $yearPeriode . ' AND
        MONTH(form_promotion.date_create) IN (' . $month . ') AND
        listing_cost.gl_account_code IS NOT NULL
        
        UNION
        
        SELECT DISTINCT arc_channel.channel_name,
        form_promotion.promotion_id,
        form_promotion.date_create,
        arc_departemen.nama_departemen,
        form_promotion.promotion_number,
        form_promotion.promotion_name,
        form_promotion.periode_awal,
        form_promotion.periode_akhir,
        form_promotion.fiscal_year,
        arc_region.nama_region,
        arc_area.nama_area,
        arc_store.store_name,
        form_promotion.total_product_baseline,
        form_promotion.total_product_incremental,
        (form_promotion.total_product_baseline + form_promotion.total_product_incremental) AS amount_sales,
        tbl_promotion_status.status_name,
        trading_term.gl_account_code,
        NULL AS amount_promo,
        NULL AS amount_listing,
        trading_term.amount AS amount_trading,
        trading_term.amount AS all_cost,
        business_unit.business_unit_name
        FROM
            `form_promotion`
        LEFT JOIN arc_departemen ON arc_departemen.kode_departemen = form_promotion.kode_departemen
        LEFT JOIN arc_channel ON arc_channel.channel_code = form_promotion.channel_code
        LEFT JOIN arc_region ON arc_region.region_code = form_promotion.region_code
        LEFT JOIN arc_area ON arc_area.kode_area = form_promotion.kode_area
        LEFT JOIN arc_store ON arc_store.store_code = form_promotion.store_code
        LEFT JOIN tbl_promotion_status ON tbl_promotion_status.status_code = form_promotion.`status`
        LEFT JOIN form_promotion_budget ON form_promotion_budget.promotion_number = form_promotion.promotion_number
        LEFT JOIN trading_term ON trading_term.promotion_number = form_promotion.promotion_number
        LEFT JOIN business_unit ON business_unit.business_unit_id = form_promotion.business_unit_id
        WHERE
        form_promotion.`status` IN (' . $arrayStatus . ') AND
        form_promotion.kode_departemen IN (' . $department . ') AND
        form_promotion.fiscal_year = ' . $yearPeriode . ' AND
        MONTH(form_promotion.date_create) IN (' . $month . ') AND
        trading_term.gl_account_code IS NOT NULL
        ORDER BY promotion_id');

        return $query->result();

        // $this->db->select('form_promotion.promotion_id,
        // form_promotion.date_create,
        // arc_departemen.nama_departemen,
        // form_promotion.promotion_number,
        // form_promotion.promotion_name,
        // form_promotion.periode_awal,
        // form_promotion.periode_akhir,
        // form_promotion.fiscal_year,
        // arc_channel.channel_name,
        // arc_region.nama_region,
        // arc_area.nama_area,
        // arc_store.store_name,
        // form_promotion.total_product_baseline,
        // form_promotion.total_product_incremental,
        // tbl_promotion_status.status_name,
        // form_promotion_budget.promotion_total_cost AS all_cost,
        // (form_promotion.total_product_baseline + form_promotion.total_product_incremental) AS amount_sales,
        // SUM(trading_term.amount) AS trading_term,
        // SUM(listing_cost.amount) AS listing_cost,
        // SUM(on_top_promo.amount) AS on_top_promo,
        // trading_term.gl_account_code AS coa_trading,
        // listing_cost.gl_account_code AS coa_listing,
        // on_top_promo.gl_account_code AS coa_promo', FALSE);
        // $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
        // $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
        // $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
        // $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
        // $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
        // $this->db->join('tbl_promotion_status', 'tbl_promotion_status.status_code = form_promotion.status', 'left');
        // $this->db->join('form_promotion_budget', 'form_promotion_budget.promotion_number = form_promotion.promotion_number', 'left');
        // $this->db->join('trading_term', 'trading_term.promotion_number = form_promotion.promotion_number', 'left');
        // $this->db->join('listing_cost', 'listing_cost.promotion_number = form_promotion.promotion_number', 'left');
        // $this->db->join('on_top_promo', 'on_top_promo.promotion_number = form_promotion.promotion_number', 'left');
        // $this->db->where_in('form_promotion.status', $arrayStatus);
        // $this->db->where('form_promotion.fiscal_year', $yearPeriode);
        // $this->db->where_in('form_promotion.kode_departemen', $department);
        // $this->db->group_by('form_promotion.promotion_id, coa_trading, coa_listing, coa_promo');
        // $this->db->order_by('form_promotion.promotion_id');
        // return $this->db->get($this->table)->result();
        // $data = $this->db->get($this->table)->result();
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function get_product_excel($status, $yearPeriode, $department, $month)
    {
        if ($status == 0) {
            $arrayStatus = "'$status', '1'";
        } elseif ($status == 5) {
            $arrayStatus = "'0','1','2','4','5'";
        } else {
            $arrayStatus = $status;
        }
        if ($department == '') {
            $department = "'0312','0305'";
        }
        if ($month == '') {
            $month = "'1','2','3','4','5','6','7','8','9','10','11','12'";
        }

        $query = $this->db->query('SELECT 
                    form_promotion.date_create,
                    arc_departemen.nama_departemen,
                    product.promotion_number,
                    form_promotion.promotion_name,
                    category1.category_name as category_name1,
                    category2.category_name as category_name2,
                    product_list.product_code,
                    product_list.product_name,
                    product.baseline_sales,
                    product.incremental_sales,
                    business_unit.business_unit_name
                FROM  product
                LEFT JOIN product_list ON product.product_code = product_list.product_code
                LEFT JOIN product_category AS category1 ON product.category_1 = category1.category_id
                LEFT JOIN product_category AS category2 ON product.category_1 = category2.category_id
                LEFT JOIN form_promotion ON product.promotion_number = form_promotion.promotion_number
                LEFT JOIN arc_departemen ON form_promotion.kode_departemen = arc_departemen.kode_departemen
                LEFT JOIN business_unit ON product.business_unit_id = business_unit.business_unit_id
                WHERE form_promotion.`status` IN (' . $arrayStatus . ') AND
                        form_promotion.kode_departemen IN (' . $department . ') AND
                        form_promotion.fiscal_year = ' . $yearPeriode . ' AND
                        MONTH(form_promotion.date_create) IN (' . $month . ')
                GROUP BY 
                        form_promotion.date_create,
                        arc_departemen.nama_departemen,
                        product.promotion_number,
                        form_promotion.promotion_name,
                        category1.category_name,
                        product_list.product_code,
                        product_list.product_name,
                        product.baseline_sales,
                        product.incremental_sales,
                        business_unit.business_unit_name
                ORDER BY product.promotion_number
        ');

        return $query->result();
    }

    function get_by_number($promotion_number)
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
        $this->db->where('form_promotion.promotion_number', $promotion_number);
        return $this->db->get('form_promotion')->row();
    }

    function get_product_name($business_unit_id)
    {
        $this->db->select("product_list.product_name_id,
        product_list.product_code,
        product_list.product_name,
        product_list.category_1,
        product_list.category_2,
        product_list.business_unit_id", FALSE);
        if($business_unit_id != 4 && $business_unit_id != 3 && $business_unit_id != '' && $business_unit_id != 5){
            $this->db->where('product_list.business_unit_id', $business_unit_id);
        }
        $this->db->group_by('product_list.product_name');
        $query = $this->db->get('product_list');
        return $query;
    }

    function get_business_id($business_unit_id)
    {
        $this->db->select("business_unit_id,business_unit_name", FALSE);
        $this->db->where('business_unit_id', $business_unit_id);
        $query = $this->db->get('business_unit');
        return $query;
    }

    function promotion_update($data_promotion, $promotion_id)
    {
        $this->db->where('promotion_id', $promotion_id);
        $this->db->update('form_promotion', $data_promotion);
    }

    function get_list_distributor($promotion_number)
    {
        $this->db->select('form_promotion_distributor.kode_distributor,
        arc_distributor.nama_distributor', FALSE);
        $this->db->join('arc_distributor', 'form_promotion_distributor.kode_distributor = arc_distributor.kode_distributor', 'left');
        $this->db->where('form_promotion_distributor.promotion_number', $promotion_number);
        $query = $this->db->get('form_promotion_distributor');
        $data = $query->result_array();
        return $data;
    }

    function delete_listDistributor($promotion_number)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->delete('form_promotion_distributor');
    }

    function delete_listProduct($promotion_number)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->delete('product');
    }

    function get_listProduct()
    {
        $this->db->select('product_code, product_name', FALSE);
        $query = $this->db->get('product_list');
        $data = $query->result_array();
        return $data;
    }

    function get_listCategory($business_unit_id)
    {
        $this->db->select('category_id, category_name', FALSE);
        $this->db->where('business_unit_id', $business_unit_id);
        $query = $this->db->get('product_category');
        $data = $query->result_array();
        return $data;
    }

    function get_listBudget($gl_coa_segment)
    {
        $this->db->select('DISTINCT gl_budget.gl_coa, gl_account.gl_coa_desc, gl_budget.is_aktif', false);
        $this->db->like('gl_coa_segment', $gl_coa_segment, 'after');
        $this->db->join('gl_account', 'gl_account.gl_coa = gl_budget.gl_coa', 'left');
        $query = $this->db->get('gl_budget');
        $data = $query->result_array();
        return $data;
    }

    function get_promotionBudget($promotion_number)
    {
        $this->db->select('promotion_total_cost, promotion_total_usage, promotion_total_saldo', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $query = $this->db->get('form_promotion_budget');
        $data = $query->row();
        return $data;
    }

    function update_total_promotion($promotion_number, $total_promotion)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->update('form_promotion_budget', $total_promotion);
    }

    function get_additionalBudget($promotion_number, $budget)
    {
        $this->db->select('promotion_number,gl_coa_segment, SUM(additional_amount) AS additional_amount', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->where('budget', $budget);
        $this->db->where('status', 0);
        $this->db->group_by('gl_coa_segment');
        $this->db->order_by('gl_coa_segment', 'ASC');
        $query = $this->db->get('additional_budget');
        if ($query->result_array() == null) {
            $data = NULL;
            return $data;
        } else {
            $data = $query->result_array();
            return $data;
        }
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    // INSERT ADDITIONAL TRADING TERM
    function insert_additionalTrading($additionalTrading)
    {
        $this->db->insert_batch('additional_budget', $additionalTrading);
    }

    // INSERT ADDITIONAL LISTING COST
    function insert_additionalListing($additionalListing)
    {
        $this->db->insert_batch('additional_budget', $additionalListing);
    }

    // INSERT ADDITIONAL ON TOP PROMO
    function insert_additionalPromo($additionalPromo)
    {
        $this->db->insert_batch('additional_budget', $additionalPromo);
    }

    function get_listingTotal($promotion_number)
    {
        $this->db->select('SUM(amount) AS amount', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->group_by('promotion_number');
        $query = $this->db->get('listing_cost');
        $data = $query->row();
        return $data;
    }

    function get_promoTotal($promotion_number)
    {
        $this->db->select('SUM(amount) AS amount', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->group_by('promotion_number');
        $query = $this->db->get('on_top_promo');
        $data = $query->row();
        return $data;
    }

    function update_additionalTrading($update_additionalTrading)
    {
        $this->db->update_batch('additional_budget', $update_additionalTrading, 'promotion_number');
    }

    function update_additionalListing($update_additionalListing)
    {
        $this->db->update_batch('additional_budget', $update_additionalListing, 'promotion_number');
    }

    function update_additionalPromo($update_additionalPromo)
    {
        $this->db->update_batch('additional_budget', $update_additionalPromo, 'promotion_number');
    }

    function get_approval_editPromotion($promotion_number)
    {
        $this->db->select('id_user_level, id_users', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $query = $this->db->get('wf_program');
        $data = $query->result_array();
        return $data;
    }

    // insert Workflow PROGRAM
    function insert_wf_edit($insertArray)
    {
        $this->db->insert_batch('wf_edit_budget', $insertArray);
    }

    function get_totalProduct($promotion_number)
    {
        $this->db->select('SUM(baseline_sales) AS baseline_sales, SUM(incremental_sales) AS incremental_sales', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        $this->db->group_by('promotion_number');
        $query = $this->db->get('product');
        $data = $query->row();
        return $data;
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }

    function update_product($promotion_number)
    {
        $sql = $this->db->query("UPDATE product
        LEFT JOIN product_list ON product.product_code = product_list.product_code
        SET product.business_unit_id = product_list.business_unit_id, product.category_1 = product_list.category_1, product.category_2 = product_list.category_2 WHERE product.promotion_number = '$promotion_number'");
    }

    function get_password_email()
    {
        $this->db->select('password', FALSE);
        $this->db->where('type', 'email');
        $data = $this->db->get('password')->row();
        return $data;
    }
}
