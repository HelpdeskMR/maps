<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form_budget_program_model extends CI_Model
{

    public $table = 'form_budget_program';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,no_p3,program_id,gl_coa,gl_coa_segment,sku_total_cost,sku_total_usage,sku_total_saldo,SecLogDate,SecLogUser');
        $this->datatables->from('form_budget_program');
        //add this line for join
        //$this->datatables->join('table2', 'form_budget_program.field = table2.field');
        $this->datatables->where('status', '1');
        $this->datatables->add_column('action', anchor(site_url('form_budget_program/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('form_budget_program/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('form_budget_program/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
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
        $this->db->like('id', $q);
	$this->db->or_like('no_p3', $q);
	$this->db->or_like('program_id', $q);
	$this->db->or_like('gl_coa', $q);
	$this->db->or_like('gl_coa_segment', $q);
	$this->db->or_like('sku_total_cost', $q);
	$this->db->or_like('sku_total_usage', $q);
	$this->db->or_like('sku_total_saldo', $q);
	$this->db->or_like('SecLogDate', $q);
	$this->db->or_like('SecLogUser', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('no_p3', $q);
	$this->db->or_like('program_id', $q);
	$this->db->or_like('gl_coa', $q);
	$this->db->or_like('gl_coa_segment', $q);
	$this->db->or_like('sku_total_cost', $q);
	$this->db->or_like('sku_total_usage', $q);
	$this->db->or_like('sku_total_saldo', $q);
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

/* End of file Form_budget_program_model.php */
/* Location: ./application/models/Form_budget_program_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-23 03:48:32 */
/* http://harviacode.com */