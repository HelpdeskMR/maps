<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approval_program_model extends CI_Model
{

    public $table = 'approval_program';
    public $id = 'approval_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('approval_program.approval_id,approval_program.id_users,approval_program.id_user_level,approval_program.kode_departemen,arc_departemen.kode_departemen,arc_departemen.nama_departemen,tbl_user.full_name,tbl_user_level.*');
        $this->datatables->from('approval_program');
        //add this line for join
        $this->datatables->join('arc_departemen', 'approval_program.kode_departemen = arc_departemen.kode_departemen','left');
        $this->datatables->join('tbl_user_level', 'approval_program.id_user_level = tbl_user_level.id_user_level','left');
        $this->datatables->join('tbl_user', 'approval_program.id_users = tbl_user.id_users','left');
        $this->datatables->add_column('action', anchor(site_url('approval_program/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('approval_program/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('approval_program/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'approval_id');
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
	$this->db->or_like('kode_departemen', $q);
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
	$this->db->or_like('kode_departemen', $q);
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

/* End of file Approval_program_model.php */
/* Location: ./application/models/Approval_program_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-30 11:14:19 */
/* http://harviacode.com */