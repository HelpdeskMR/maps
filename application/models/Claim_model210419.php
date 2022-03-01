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

    // Data Claim ALL
    function json()
    {
        $this->datatables->select('claim_id,kode_distributor,nama_distributor,no_claim,tgl_claim,promotion_number,promotion_id,deskripsi,claim_dpp,claim_ppn,claim_pph,total_claim,faktur_pajak,npwp,Pemohon,status,document_claim,SecLogDate,SecLogUser');
        $this->datatables->from('form_claim');
        //$this->datatables->join('table2', 'form_claim.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('claim_list/update/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')) . "  " , 'claim_id');
        return $this->datatables->generate();
    }

    // Data Claim DISTRIBUTOR
    function json_distributor()
    {
        $kode_distributor = $this->session->userdata('kode_distributor');
        $this->datatables->select('claim_id,kode_distributor,nama_distributor,no_claim,tgl_claim,promotion_number,promotion_id,deskripsi,claim_dpp,claim_ppn,claim_pph,total_claim,faktur_pajak,npwp,Pemohon,status,document_claim,SecLogDate,SecLogUser');
        $this->datatables->from('form_claim');
        $this->datatables->where('form_claim.kode_distributor', $kode_distributor);
        $this->datatables->add_column('action', anchor(site_url('claim_list/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')) . "  ", 'claim_id');
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
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
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

}
