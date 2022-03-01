<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_distributor_margin_model extends CI_Model
{

    public $table = 'arc_distributor_margin';
    public $id = 'distributor_margin_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('
        arc_distributor_margin.distributor_margin_id,
        arc_distributor_margin.kode_departemen,
        arc_distributor_margin.channel_code,
        arc_distributor_margin.store_code,
        arc_distributor_margin.region_code,
        arc_distributor_margin.margin,
        arc_distributor_margin.SecLogUser,
        arc_distributor_margin.SeclogDate,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_store.store_name,
        arc_region.nama_region');
        $this->datatables->from('arc_distributor_margin');
        //add this line for join
        $this->datatables->join('arc_departemen', 'arc_distributor_margin.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->datatables->join('arc_channel', 'arc_distributor_margin.channel_code = arc_channel.channel_code', 'left');
        $this->datatables->join('arc_store', 'arc_distributor_margin.store_code = arc_store.store_code', 'left');
        $this->datatables->join('arc_region', 'arc_distributor_margin.region_code = arc_region.region_code', 'left');
        $this->datatables->group_by('arc_distributor_margin.distributor_margin_id');
        $this->datatables->add_column('action', anchor(site_url('arc_distributor_margin/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm'))." 
                ".anchor(site_url('arc_distributor_margin/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'distributor_margin_id');
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
        arc_distributor_margin.distributor_margin_id,
        arc_distributor_margin.kode_departemen,
        arc_distributor_margin.channel_code,
        arc_distributor_margin.store_code,
        arc_distributor_margin.region_code,
        arc_distributor_margin.margin,
        arc_distributor_margin.SecLogUser,
        arc_distributor_margin.SeclogDate,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_store.store_name,
        arc_region.nama_region', FALSE);
        $this->db->where($this->id, $id);
        $this->db->join('arc_departemen', 'arc_distributor_margin.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->db->join('arc_channel', 'arc_distributor_margin.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'arc_distributor_margin.store_code = arc_store.store_code', 'left');
        $this->db->join('arc_region', 'arc_distributor_margin.region_code = arc_region.region_code', 'left');
        $this->db->group_by('arc_distributor_margin.distributor_margin_id');
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('distributor_margin_id', $q);
	$this->db->or_like('kode_departemen', $q);
	$this->db->or_like('channel_code', $q);
	$this->db->or_like('store_code', $q);
	$this->db->or_like('region_code', $q);
	$this->db->or_like('margin', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('distributor_margin_id', $q);
	$this->db->or_like('kode_departemen', $q);
	$this->db->or_like('channel_code', $q);
	$this->db->or_like('store_code', $q);
	$this->db->or_like('region_code', $q);
	$this->db->or_like('margin', $q);
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
        $this->db->select('*', FALSE);
        $this->db->from('arc_channel');
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->order_by('channel_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_store($channel_code)
    {
        $this->db->select('store_code, store_name', FALSE);
        $this->db->from('arc_store');
        $this->db->where('channel_code', $channel_code);
        $query = $this->db->get();
        return $query;
    }

    function get_region($channel_code)
    {
        $this->db->select('DISTINCT arc_region.region_code, arc_region.nama_region', FALSE);
        $this->db->from('arc_region');
        $this->db->where('channel_code', $channel_code);
        $query = $this->db->get();
        return $query;
    }

}

