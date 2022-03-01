<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form_claim_model extends CI_Model
{

    public $table = 'form_claim';
    public $id = 'claim_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('claim_id,tgl_claim,claim_number,promotion_number,kode_distributor,nama_distributor,dpp,ppn,pph,total,invoice_number,invoice,faktur_pajak_number,faktur_pajak,pkp,npwp,keterangan,pemohon,status,payment_date,approval_scheme,SecLogDate,SecLogUser');
        $this->datatables->from('form_claim');
        //add this line for join
        //$this->datatables->join('table2', 'form_claim.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('form_claim/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
            ".anchor(site_url('form_claim/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm'))." 
                ".anchor(site_url('form_claim/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'claim_id');
        return $this->datatables->generate();
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
    function total_rows($q = NULL) {
        $this->db->like('claim_id', $q);
	$this->db->or_like('tgl_claim', $q);
	$this->db->or_like('claim_number', $q);
	$this->db->or_like('promotion_number', $q);
	$this->db->or_like('kode_distributor', $q);
	$this->db->or_like('nama_distributor', $q);
	$this->db->or_like('dpp', $q);
	$this->db->or_like('ppn', $q);
	$this->db->or_like('pph', $q);
	$this->db->or_like('total', $q);
	$this->db->or_like('invoice_number', $q);
	$this->db->or_like('invoice', $q);
	$this->db->or_like('faktur_pajak_number', $q);
	$this->db->or_like('faktur_pajak', $q);
	$this->db->or_like('pkp', $q);
	$this->db->or_like('npwp', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('pemohon', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('payment_date', $q);
	$this->db->or_like('approval_scheme', $q);
	$this->db->or_like('SecLogDate', $q);
	$this->db->or_like('SecLogUser', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('claim_id', $q);
	$this->db->or_like('tgl_claim', $q);
	$this->db->or_like('claim_number', $q);
	$this->db->or_like('promotion_number', $q);
	$this->db->or_like('kode_distributor', $q);
	$this->db->or_like('nama_distributor', $q);
	$this->db->or_like('dpp', $q);
	$this->db->or_like('ppn', $q);
	$this->db->or_like('pph', $q);
	$this->db->or_like('total', $q);
	$this->db->or_like('invoice_number', $q);
	$this->db->or_like('invoice', $q);
	$this->db->or_like('faktur_pajak_number', $q);
	$this->db->or_like('faktur_pajak', $q);
	$this->db->or_like('pkp', $q);
	$this->db->or_like('npwp', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('pemohon', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('payment_date', $q);
	$this->db->or_like('approval_scheme', $q);
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

}

