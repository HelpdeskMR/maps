<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengganti_barang_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->select('form_pengganti_barang.id, form_pengganti_barang.date_create, form_pengganti_barang.claim_number, form_pengganti_barang.code_pengganti_barang, form_pengganti_barang.status, tbl_promotion_status.status_name, tbl_user.full_name', FALSE);
        $this->db->join('tbl_promotion_status','form_pengganti_barang.status = tbl_promotion_status.status_code','left');
        $this->db->join('wf_pengganti_barang','form_pengganti_barang.code_pengganti_barang = wf_pengganti_barang.code_pengganti_barang AND form_pengganti_barang.approval_scheme = wf_pengganti_barang.approval_scheme','left');
        $this->db->join('tbl_user','wf_pengganti_barang.id_users = tbl_user.id_users','left');
        $this->db->where('status', 1);
        $data = $this->db->get('form_pengganti_barang')->result();
        return $data;
    }

    function get_all_history()
    {
        $status = array(2,4);
        $this->db->select('form_pengganti_barang.id, form_pengganti_barang.date_create, form_pengganti_barang.claim_number, form_pengganti_barang.code_pengganti_barang, form_pengganti_barang.status, tbl_promotion_status.status_name, tbl_user.full_name', FALSE);
        $this->db->join('tbl_promotion_status','form_pengganti_barang.status = tbl_promotion_status.status_code','left');
        $this->db->join('wf_pengganti_barang','form_pengganti_barang.code_pengganti_barang = wf_pengganti_barang.code_pengganti_barang AND form_pengganti_barang.approval_scheme = wf_pengganti_barang.approval_scheme','left');
        $this->db->join('tbl_user','wf_pengganti_barang.id_users = tbl_user.id_users','left');
        $this->db->where_in('status', $status);
        $data = $this->db->get('form_pengganti_barang')->result();
        return $data;
    }

    function get_claim_barang()
    {
        $this->db->select('claim_number', FALSE);
        $this->db->where('mekanisme_claim', 'Barang');
        $this->db->where('status', 4);
        $data = $this->db->get('form_claim')->result();
        return $data;
    }

    function check_kode()
    {
        $this->db->select("CAST(SUBSTR(code_pengganti_barang,4) as INT) as code", FALSE);
        $this->db->order_by("code", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('form_pengganti_barang');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $code = intval($data->code) + 1;
        } else {
            $code = 1;
        }
        return $code;
    }

    function insert_pengganti_barang($pengganti_barang)
    {
        $this->db->insert('form_pengganti_barang', $pengganti_barang);
    }

    function insert_product($productArray)
    {
        $this->db->insert_batch('product_pengganti', $productArray);
    }

    function insert_approval($approvalArray)
    {
        $this->db->insert_batch('wf_pengganti_barang', $approvalArray);
    }

    function get_by_code($code)
    {
        $this->db->select('form_pengganti_barang.id,
        form_pengganti_barang.date_create,
        form_pengganti_barang.claim_number,
        form_pengganti_barang.code_pengganti_barang,
        form_pengganti_barang.status,
        form_pengganti_barang.approval_scheme,
        form_pengganti_barang.SecLogDate,
        form_pengganti_barang.SecLogUser', FALSE);
        $this->db->where('code_pengganti_barang', $code);
        $data = $this->db->get('form_pengganti_barang')->row();
        return $data;
    }

    // get data by id
    function get_by_number($id)
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
        tbl_promotion_status.status_name');
        $this->db->join('form_promotion', 'form_claim.promotion_number = form_promotion.promotion_number', 'left');
        $this->db->join('tbl_promotion_status', 'form_claim.status = tbl_promotion_status.status_code', 'left');
        $this->db->where('form_claim.claim_number', $id);
        return $this->db->get('form_claim')->row();
    }

    function get_list_approval()
    {
        $this->db->select('id_users, id_user_level', FALSE);
        $data = $this->db->get('approval_pengganti_barang')->result();
        return $data;
    }

    function get_approval($code)
    {
        $this->db->select('wf_pengganti_barang.id,
        wf_pengganti_barang.code_pengganti_barang,
        wf_pengganti_barang.approval_scheme,
        wf_pengganti_barang.id_user_level,
        wf_pengganti_barang.id_users,
        wf_pengganti_barang.approve_by,
        wf_pengganti_barang.approval_date,
        wf_pengganti_barang.reject_by,
        wf_pengganti_barang.reject_date,
        wf_pengganti_barang.reject_reason,
        wf_pengganti_barang.SecLogDate,
        wf_pengganti_barang.SecLogUser,
        tbl_user.full_name,
        tbl_user_level.nama_level', FALSE);
        $this->db->join('tbl_user','wf_pengganti_barang.id_users = tbl_user.id_users','left');
        $this->db->join('tbl_user_level','wf_pengganti_barang.id_user_level = tbl_user_level.id_user_level','left');
        $this->db->where('wf_pengganti_barang.code_pengganti_barang', $code);
        $data = $this->db->get('wf_pengganti_barang')->result_array();
        return $data;
    }

    function get_product($code)
    {
        $this->db->select('product_pengganti.code_pengganti_barang,
        product_pengganti.product_code,
        product_pengganti.qty,
        product_list.product_name', FALSE);
        $this->db->join('product_list','product_pengganti.product_code = product_list.product_code','left');
        $this->db->where('product_pengganti.code_pengganti_barang', $code);
        $data = $this->db->get('product_pengganti')->result_array();
        return $data;
    }

    function delete_by_code($code_pengganti_barang)
    {
        $this->db->where('code_pengganti_barang', $code_pengganti_barang);
        $this->db->delete('product_pengganti');
    }

    function update_pengganti_barang($pengganti_barang, $code_pengganti_barang)
    {
        $this->db->where('code_pengganti_barang', $code_pengganti_barang);
        $this->db->update('form_pengganti_barang', $pengganti_barang);
    }

    function get_approval_send($code_pengganti_barang)
    {
        $this->db->select('wf_pengganti_barang.id_users, tbl_user.full_name, tbl_user.email', FALSE);
        $this->db->join('tbl_user','wf_pengganti_barang.id_users = tbl_user.id_users','left');
        $this->db->where('wf_pengganti_barang.code_pengganti_barang', $code_pengganti_barang);
        $this->db->where('wf_pengganti_barang.approval_scheme', 1);
        $data = $this->db->get('wf_pengganti_barang')->row();
        return $data;
    }

    function update_wf_pengganti_barang($wf_pengganti_barang, $code_pengganti_barang)
    {
        $this->db->where('code_pengganti_barang', $code_pengganti_barang);
        $this->db->update('wf_pengganti_barang', $wf_pengganti_barang);
    }
}
