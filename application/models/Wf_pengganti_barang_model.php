<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wf_pengganti_barang_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_data()
    {
        $id_user_level = $this->session->userdata('id_user_level');
        $id_user = $this->session->userdata('id_users');
        $this->db->select('wf_pengganti_barang.id,
        wf_pengganti_barang.code_pengganti_barang,
        wf_pengganti_barang.approval_scheme,
        form_pengganti_barang.date_create,
        form_pengganti_barang.claim_number', FALSE);
        $this->db->join('form_pengganti_barang','wf_pengganti_barang.code_pengganti_barang = form_pengganti_barang.code_pengganti_barang AND wf_pengganti_barang.approval_scheme = form_pengganti_barang.approval_scheme','left');
        $this->db->where('wf_pengganti_barang.id_user_level', $id_user_level);
        $this->db->where('wf_pengganti_barang.id_users', $id_user);
        $this->db->where('wf_pengganti_barang.reject_date', NULL);
        $this->db->where('form_pengganti_barang.status', 1);
        $data = $this->db->get('wf_pengganti_barang')->result();
        return $data;
    }

    function get_data($code)
    {
        $this->db->select('id, date_create, claim_number, code_pengganti_barang, status, approval_scheme', FALSE);
        $this->db->where('code_pengganti_barang', $code);
        $data = $this->db->get('form_pengganti_barang')->row();
        return $data;
    }

    function check_approval($code)
    {
        $this->db->select('approve_by', FALSE);
        $this->db->where('wf_pengganti_barang.code_pengganti_barang', $code);
        $this->db->where('(wf_pengganti_barang.approve_by is NULL)', NULL, FALSE);
        return $this->db->get('wf_pengganti_barang')->row();
    }

    function update_approval($wf_pengganti_barang, $code, $approval_scheme)
    {
        $this->db->where('approval_scheme', $approval_scheme);
        $this->db->where('code_pengganti_barang', $code);
        $this->db->update('wf_pengganti_barang', $wf_pengganti_barang);
    }

    function update_pengganti_barang($update_pengganti_barang, $code)
    {
        $this->db->where('code_pengganti_barang', $code);
        $this->db->update('form_pengganti_barang', $update_pengganti_barang);
    }

    function get_approval_send($code)
    {
        $this->db->select('tbl_user.full_name, tbl_user.email, wf_pengganti_barang.reject_reason, wf_pengganti_barang.reject_by, wf_pengganti_barang.reject_date', FALSE);
        $this->db->join('wf_pengganti_barang','form_pengganti_barang.code_pengganti_barang = wf_pengganti_barang.code_pengganti_barang AND form_pengganti_barang.approval_scheme = wf_pengganti_barang.approval_scheme','left');
        $this->db->join('tbl_user','wf_pengganti_barang.id_users = tbl_user.id_users','left');
        $this->db->where('form_pengganti_barang.code_pengganti_barang', $code);
        $data = $this->db->get('form_pengganti_barang')->row();
        return $data;
    }
}
