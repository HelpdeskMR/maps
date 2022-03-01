<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model
{

    public $table = 'product';
    public $id = 'product_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('product_id,product_name,product_code,category_1,category_2,baseline_sales,incremental_sales,SecLogUser,SecLogDate');
        $this->datatables->from('product');
        //add this line for join
        //$this->datatables->join('table2', 'product.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('product/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
            ".anchor(site_url('product/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm'))." 
                ".anchor(site_url('product/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'product_id');
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
        $this->db->like('product_id', $q);
	$this->db->or_like('product_name', $q);
	$this->db->or_like('product_code', $q);
	$this->db->or_like('category_1', $q);
	$this->db->or_like('category_2', $q);
	$this->db->or_like('baseline_sales', $q);
	$this->db->or_like('incremental_sales', $q);
	$this->db->or_like('SecLogUser', $q);
	$this->db->or_like('SecLogDate', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('product_id', $q);
	$this->db->or_like('product_name', $q);
	$this->db->or_like('product_code', $q);
	$this->db->or_like('category_1', $q);
	$this->db->or_like('category_2', $q);
	$this->db->or_like('baseline_sales', $q);
	$this->db->or_like('incremental_sales', $q);
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

}

