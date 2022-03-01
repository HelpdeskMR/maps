<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gl_budget_model_user extends CI_Model
{

    public $table = 'gl_budget';
    public $id = 'budget_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('
        gl_budget.budget_id,
        gl_budget.kode_departemen,
        gl_budget.gl_coa,
        gl_budget.gl_coa_segment,
        gl_budget.YearPeriod,
        gl_budget.BudgetAmount,
        gl_budget.BudgetUsage,
        gl_budget.BudgetSaldo,
        arc_departemen.kode_departemen, 
        arc_departemen.nama_departemen,
        gl_account.gl_coa_desc
            ');
        $this->datatables->from('gl_budget');
        //add this line for join
        //$this->datatables->join('table2', 'gl_budget.field = table2.field');
        $this->datatables->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen');
        $this->datatables->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa');
		$this->datatables->where('gl_budget.YearPeriod', Date('Y'));
        $this->datatables->add_column('action', anchor(site_url('gl_budget_user/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ", 'budget_id');
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
        $this->db->like('budget_id', $q);
	$this->db->or_like('kode_perusahaan', $q);
	$this->db->or_like('kode_departemen', $q);
	$this->db->or_like('gl_coa', $q);
	$this->db->or_like('gl_coa_segment', $q);
	$this->db->or_like('YearPeriod', $q);
	$this->db->or_like('BudgetAmount', $q);
	$this->db->or_like('BudgetUsage', $q);
	$this->db->or_like('BudgetSaldo', $q);
	$this->db->or_like('SecLogUser', $q);
	$this->db->or_like('SecLogDate', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('budget_id', $q);
	$this->db->or_like('kode_perusahaan', $q);
	$this->db->or_like('kode_departemen', $q);
	$this->db->or_like('gl_coa', $q);
	$this->db->or_like('gl_coa_segment', $q);
	$this->db->or_like('YearPeriod', $q);
	$this->db->or_like('BudgetAmount', $q);
	$this->db->or_like('BudgetUsage', $q);
	$this->db->or_like('BudgetSaldo', $q);
	$this->db->or_like('SecLogUser', $q);
	$this->db->or_like('SecLogDate', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}