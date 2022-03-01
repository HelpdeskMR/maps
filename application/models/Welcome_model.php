<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_promotion($kode_departemen)
    {
        if ($kode_departemen == NULL) {
            $this->db->select('COUNT(promotion_number) AS jml_promotion', FALSE);
        } else {
            $this->db->select('COUNT(promotion_number) AS jml_promotion', FALSE);
            $this->db->where('kode_departemen', $kode_departemen);
        }
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
    }

    function get_promotion_waiting($id_users)
    {
        $status = array('1', '0');
        $this->db->select('COUNT(form_promotion.promotion_number) AS jml_promotion_waiting', FALSE);
        $this->db->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme', 'left');
        $this->db->where('wf_program.id_users', $id_users);
        $this->db->where_in('status', $status);
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
    }

    function get_promotion_approve($kode_departemen)
    {
        $status = array('4');
        if ($kode_departemen == NULL) {
            $this->db->select('COUNT(promotion_number) AS jml_promotion_approve', FALSE);
        } else {
            $this->db->select('COUNT(promotion_number) AS jml_promotion_approve', FALSE);
            $this->db->where('kode_departemen', $kode_departemen);
        }
        $this->db->where_in('status', $status);
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
    }

    function get_promotion_reject($kode_departemen)
    {
        if ($kode_departemen == NULL) {
            $this->db->select('COUNT(promotion_number) AS jml_promotion_reject', FALSE);
        } else {
            $this->db->select('COUNT(promotion_number) AS jml_promotion_reject', FALSE);
            $this->db->where('kode_departemen', $kode_departemen);
        }
        $this->db->where('status', '2');
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
    }

    // function get_promotion_delete($kode_departemen)
    // {
    //     if ($kode_departemen == NULL) {
    //         $this->db->select('COUNT(promotion_number) AS jml_promotion_delete', FALSE);
    //     } else {
    //         $this->db->select('COUNT(promotion_number) AS jml_promotion_delete', FALSE);
    //         $this->db->where('kode_departemen', $kode_departemen);
    //     }
    //     $this->db->where('status', '3');
    //     $query = $this->db->get('form_promotion');
    //     $data = $query->row();
    //     return $data;
    // }

    function get_form_promotion()
    {
        $this->db->select('form_promotion.promotion_id,
        form_promotion.date_create,
        form_promotion.promotion_number,
        form_promotion.kode_departemen,
        form_promotion.status,
        form_promotion.approval_scheme,
        wf_program.id_user_level,
        wf_program.approval_scheme AS scheme_promotion,
        wf_program.approval_date,
        wf_program.reject_date,
        tbl_user_level.nama_level', FALSE);
        $this->db->join('wf_program', 'wf_program.approval_scheme = form_promotion.approval_scheme', 'left');
        $this->db->join('tbl_user_level', 'tbl_user_level.id_user_level = wf_program.id_user_level', 'left');
        $this->db->where('form_promotion.kode_departemen', $this->session->userdata('kode_departemen'));
        $this->db->group_by('form_promotion.promotion_number');
        $query = $this->db->get('form_promotion');
        $data = $query->result_array();
        return $data;
    }

    // get data by id
    function get_all_data($kode_departemen)
    {
        $status = array('0', '1', '2', '4');
        if ($kode_departemen == NULL) {
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
            form_promotion.upload_file,
            form_promotion.upload_activity,
            form_promotion.SecLogUser,
            form_promotion.SecLogDate,
            arc_departemen.nama_departemen,
            arc_channel.channel_name,
            arc_region.nama_region,
            arc_area.nama_area,
            arc_store.store_name,
            wf_program.id_user_level, 
            tbl_user.full_name,
            tbl_promotion_status.status_name', FALSE);
            $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
            $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
            $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
            $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
            $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
            $this->db->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme', 'left');
            $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users', 'left');
            $this->db->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->where_in('form_promotion.status', $status);
            $this->db->group_by('form_promotion.promotion_number');
        } else {
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
            form_promotion.upload_file,
            form_promotion.upload_activity,
            form_promotion.SecLogUser,
            form_promotion.SecLogDate,
            arc_departemen.nama_departemen,
            arc_channel.channel_name,
            arc_region.nama_region,
            arc_area.nama_area,
            arc_store.store_name,
            wf_program.id_user_level, 
            tbl_user.full_name,
            tbl_promotion_status.status_name', FALSE);
            $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
            $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
            $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
            $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
            $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
            $this->db->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme', 'left');
            $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users', 'left');
            $this->db->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->where('form_promotion.kode_departemen', $kode_departemen);
            $this->db->where_in('form_promotion.status', $status);
            $this->db->group_by('form_promotion.promotion_number');
        }
        return $this->db->get('form_promotion')->result_array();
    }

    function get_waiting_data($id_users)
    {
        $status = array('0');
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
        form_promotion.upload_file,
        form_promotion.upload_activity,
        form_promotion.SecLogUser,
        form_promotion.SecLogDate,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_region.nama_region,
        arc_area.nama_area,
        arc_store.store_name,
        wf_program.id_user_level, 
        wf_program.id_users,
        tbl_user.full_name,
        tbl_promotion_status.status_name', FALSE);
        $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
        $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
        $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
        $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
        $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
        $this->db->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme', 'left');
        $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users', 'left');
        $this->db->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code', 'left');
        $this->db->where('wf_program.id_users', $id_users);
        $this->db->where_in('form_promotion.status', $status);
        $this->db->group_by('form_promotion.promotion_number');
        return $this->db->get('form_promotion')->result_array();
    }

    function get_approve_data($kode_departemen)
    {
        $status = array('4');
        if ($kode_departemen == NULL) {
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
            form_promotion.upload_file,
            form_promotion.upload_activity,
            form_promotion.SecLogUser,
            form_promotion.SecLogDate,
            arc_departemen.nama_departemen,
            arc_channel.channel_name,
            arc_region.nama_region,
            arc_area.nama_area,
            arc_store.store_name,
            wf_program.id_user_level, 
            tbl_user.full_name,
            tbl_promotion_status.status_name', FALSE);
            $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
            $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
            $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
            $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
            $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
            $this->db->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme', 'left');
            $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users', 'left');
            $this->db->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->where_in('form_promotion.status', $status);
            $this->db->group_by('form_promotion.promotion_number');
        } else {
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
            form_promotion.upload_file,
            form_promotion.upload_activity,
            form_promotion.SecLogUser,
            form_promotion.SecLogDate,
            arc_departemen.nama_departemen,
            arc_channel.channel_name,
            arc_region.nama_region,
            arc_area.nama_area,
            arc_store.store_name,
            wf_program.id_user_level, 
            tbl_user.full_name,
            tbl_promotion_status.status_name', FALSE);
            $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
            $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
            $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
            $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
            $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
            $this->db->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme', 'left');
            $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users', 'left');
            $this->db->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->where('form_promotion.kode_departemen', $kode_departemen);
            $this->db->where_in('form_promotion.status', $status);
            $this->db->group_by('form_promotion.promotion_number');
        }
        return $this->db->get('form_promotion')->result_array();
    }

    function get_reject_data($kode_departemen)
    {
        $status = array('2');
        if ($kode_departemen == NULL) {
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
            form_promotion.upload_file,
            form_promotion.upload_activity,
            form_promotion.SecLogUser,
            form_promotion.SecLogDate,
            arc_departemen.nama_departemen,
            arc_channel.channel_name,
            arc_region.nama_region,
            arc_area.nama_area,
            arc_store.store_name,
            wf_program.id_user_level, 
            tbl_user.full_name,
            tbl_promotion_status.status_name', FALSE);
            $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
            $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
            $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
            $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
            $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
            $this->db->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme', 'left');
            $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users', 'left');
            $this->db->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->where_in('form_promotion.status', $status);
            $this->db->group_by('form_promotion.promotion_number');
        } else {
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
            form_promotion.upload_file,
            form_promotion.upload_activity,
            form_promotion.SecLogUser,
            form_promotion.SecLogDate,
            arc_departemen.nama_departemen,
            arc_channel.channel_name,
            arc_region.nama_region,
            arc_area.nama_area,
            arc_store.store_name,
            wf_program.id_user_level, 
            tbl_user.full_name,
            tbl_promotion_status.status_name', FALSE);
            $this->db->join('arc_departemen', 'arc_departemen.kode_departemen = form_promotion.kode_departemen', 'left');
            $this->db->join('arc_channel', 'arc_channel.channel_code = form_promotion.channel_code', 'left');
            $this->db->join('arc_region', 'arc_region.region_code = form_promotion.region_code', 'left');
            $this->db->join('arc_area', 'arc_area.kode_area = form_promotion.kode_area', 'left');
            $this->db->join('arc_store', 'arc_store.store_code = form_promotion.store_code', 'left');
            $this->db->join('wf_program', 'form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme', 'left');
            $this->db->join('tbl_user', 'wf_program.id_users = tbl_user.id_users', 'left');
            $this->db->join('tbl_promotion_status', 'form_promotion.`status` = tbl_promotion_status.status_code', 'left');
            $this->db->where('form_promotion.kode_departemen', $kode_departemen);
            $this->db->where_in('form_promotion.status', $status);
            $this->db->group_by('form_promotion.promotion_number');
        }
        return $this->db->get('form_promotion')->result_array();
    }

    function get_claim()
    {
        $this->db->select('COUNT(claim_number) AS jml_claim', FALSE);
        $query = $this->db->get('form_claim');
        $data = $query->row();
        return $data;
    }

    function get_claim_waiting($id_users)
    {
        $status = array('1', '0');
        $this->db->select('COUNT(form_claim.claim_number) AS jml_claim_waiting', FALSE);
        $this->db->join('wf_claim', 'form_claim.claim_number = wf_claim.no_claim AND form_claim.approval_scheme = wf_claim.approval_scheme', 'left');
        $this->db->where('wf_claim.id_users', $id_users);
        $this->db->where_in('status', $status);
        $query = $this->db->get('form_claim');
        $data = $query->row();
        return $data;
    }

    function get_claim_approve()
    {
        $status = array('4');
        $this->db->select('COUNT(claim_number) AS jml_claim_approve', FALSE);
        $this->db->where_in('status', $status);
        $query = $this->db->get('form_claim');
        $data = $query->row();
        return $data;
    }

    function get_claim_reject()
    {
        $this->db->select('COUNT(claim_number) AS jml_claim_reject', FALSE);
        $this->db->where('status', '2');
        $query = $this->db->get('form_claim');
        $data = $query->row();
        return $data;
    }
}
