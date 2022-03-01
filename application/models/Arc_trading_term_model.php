<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_trading_term_model extends CI_Model
{

    public $table = 'arc_trading_term';
    public $id = 'trading_term_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('
        arc_trading_term.trading_term_id,
        arc_trading_term.kode_departemen,
        arc_trading_term.channel_code,
        arc_trading_term.store_code,
        arc_trading_term.trading_term,
        arc_trading_term.SecLogUser,
        arc_trading_term.SeclogDate,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_store.store_name,');
        $this->datatables->from('arc_trading_term');
        //add this line for join
        $this->datatables->join('arc_departemen', 'arc_trading_term.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->datatables->join('arc_channel', 'arc_trading_term.channel_code = arc_channel.channel_code', 'left');
        $this->datatables->join('arc_store', 'arc_trading_term.store_code = arc_store.store_code', 'left');
        $this->datatables->group_by('arc_trading_term.trading_term_id');
        $this->datatables->add_column('action', anchor(site_url('arc_trading_term/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm'))." 
                ".anchor(site_url('arc_trading_term/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'trading_term_id');
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
        $this->db->select('
        arc_trading_term.trading_term_id,
        arc_trading_term.kode_departemen,
        arc_trading_term.channel_code,
        arc_trading_term.store_code,
        arc_trading_term.trading_term,
        arc_trading_term.SecLogUser,
        arc_trading_term.SeclogDate,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_store.store_name', FALSE);
        $this->db->join('arc_departemen','arc_trading_term.kode_departemen = arc_departemen.kode_departemen','left');
        $this->db->join('arc_channel', 'arc_trading_term.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'arc_trading_term.store_code = arc_store.store_code', 'left');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('trading_term_id', $q);
	$this->db->or_like('kode_departemen', $q);
	$this->db->or_like('channel_code', $q);
	$this->db->or_like('store_code', $q);
	$this->db->or_like('gl_coa', $q);
	$this->db->or_like('trading_term', $q);
	$this->db->or_like('SecLogUser', $q);
	$this->db->or_like('SeclogDate', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('trading_term_id', $q);
	$this->db->or_like('kode_departemen', $q);
	$this->db->or_like('channel_code', $q);
	$this->db->or_like('store_code', $q);
	$this->db->or_like('gl_coa', $q);
	$this->db->or_like('trading_term', $q);
	$this->db->or_like('SecLogUser', $q);
	$this->db->or_like('SeclogDate', $q);
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
        $this->db->select('DISTINCT channel_code, channel_name', FALSE);
        $this->db->from('arc_channel');
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->where('channel_code', '001');
        $this->db->order_by('channel_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

}

