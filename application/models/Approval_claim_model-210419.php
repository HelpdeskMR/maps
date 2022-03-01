<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approval_claim_model extends CI_Model
{

    public $table = 'approval_claim';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,approval_scheme,id_user_level,region_id,SecLogDate,SecLogUser');
        $this->datatables->from('approval_claim');
        //add this line for join
        //$this->datatables->join('table2', 'approval_claim.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('approval_claim/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('approval_claim/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
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
	$this->db->or_like('approval_scheme', $q);
	$this->db->or_like('id_user_level', $q);
	$this->db->or_like('region_id', $q);
	$this->db->or_like('SecLogDate', $q);
	$this->db->or_like('SecLogUser', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('approval_scheme', $q);
	$this->db->or_like('id_user_level', $q);
	$this->db->or_like('region_id', $q);
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