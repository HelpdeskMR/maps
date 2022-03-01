<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_name_model extends CI_Model
{

    public $table = 'product_list';
    public $id = 'product_name_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('product_list.product_name_id,product_list.product_code,product_list.product_name,category1.category_name AS category_1,category2.category_name AS category_2,business_unit.business_unit_name');
        $this->datatables->from('product_list');
        //add this line for join
        $this->datatables->join('product_category AS category1', 'product_list.category_1 = category1.category_id','left');
        $this->datatables->join('product_category AS category2', 'product_list.category_2 = category2.category_id','left');
        $this->datatables->join('business_unit', 'product_list.business_unit_id = business_unit.business_unit_id','left');
        $this->datatables->add_column('action', anchor(site_url('product_name/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm'))." 
                ".anchor(site_url('product_name/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'product_name_id');
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
        $this->db->like('product_name_id', $q);
	$this->db->or_like('product_code', $q);
	$this->db->or_like('product_name', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('product_name_id', $q);
	$this->db->or_like('product_code', $q);
	$this->db->or_like('product_name', $q);
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

