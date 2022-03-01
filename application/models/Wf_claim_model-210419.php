<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wf_claim_model extends CI_Model
{

    public $table = 'wf_claim';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $id_user_level = $this->session->userdata('id_user_level');
        $id_users = $this->session->userdata('id_users');
        $status = array('0','1');
        $this->datatables->select('
            wf_claim.id,
            wf_claim.no_claim,
            wf_claim.approval_scheme,
            wf_claim.id_user_level,
            wf_claim.approve_by,
            wf_claim.approval_date,
            wf_claim.reject_by,
            wf_claim.reject_date,
            wf_claim.reject_reason,
            form_claim.no_claim,
            form_claim.nama_distributor,
            form_claim.tgl_claim,
            form_claim.total_claim
        ');
        $this->datatables->from('wf_claim');
        $this->datatables->join('form_claim', 'wf_claim.no_claim = form_claim.no_claim');
        $this->datatables->where('wf_claim.id_user_level', $id_user_level);
        $this->datatables->where('wf_claim.approval_date', NULL);
        $this->datatables->where('wf_claim.reject_date', NULL);
        $this->datatables->add_column('action', anchor(site_url('wf_claim/update/$1'),
            '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Approve', array('class' =>
            'btn btn-success btn-sm')) . " 
            "  . anchor(site_url('wf_claim/reject_action/$1'),
            '<i class="fa fa-trash-o" aria-hidden="true"></i> Reject',
            'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'),
            'id');
        return $this->datatables->generate();
    }

    function json_scheme()
    {
        $id_user_level = $this->session->userdata('id_user_level');
        $this->db->select('*', false);
        $this->db->where('id_user_level', $id_user_level);
        $this->db->order_by('approval_scheme', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get('approval_claim');
        $data = $query->row();
        $alias = $data->approval_scheme;

        $this->datatables->select('
            wf_claim.id,
            wf_claim.no_klaim,
            wf_claim.approval_scheme,
            wf_claim.id_user_level,
            wf_claim.approve_by,
            wf_claim.approval_date,
            wf_claim.reject_by,
            wf_claim.reject_date,
            form_claim.no_klaim,
            form_claim.nama_distributor,
            form_claim.tgl_klaim,
            form_claim.total_claim
        ');
        $this->datatables->from('wf_claim');
        $this->datatables->join('form_claim', 'wf_claim.no_klaim = form_claim.no_klaim');
        $this->datatables->where('wf_claim.approval_date', null, true);
        $this->datatables->where('wf_claim.reject_date', null);
        $this->datatables->where('wf_claim.approval_scheme', $alias, true);
        $this->datatables->where('wf_claim.id_user_level', $id_user_level, true);
        $this->datatables->where('form_claim.status', 1, true);
        $this->datatables->add_column('action', anchor(site_url('wf_claim/update/$1'),
            '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Approve', array('class' =>
            'btn btn-success btn-sm')) . " 
            "  . anchor(site_url('wf_claim/reject_action/$1'),
            '<i class="fa fa-trash-o" aria-hidden="true"></i> Reject',
            'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'),
            'id');
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
        $this->db->join('form_claim', 'wf_claim.no_klaim = form_claim.no_klaim');
        $this->db->join('arc_program', 'form_claim.program_id = arc_program.program_id', 'left');
        $this->db->join('form_program', 'form_claim.no_p3 = form_program.no_p3','left');
        $this->db->join('gl_account', 'form_program.gl_coa = gl_account.gl_coa', 'left');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = null)
    {
        $this->db->like('id', $q);
        $this->db->or_like('no_klaim', $q);
        $this->db->or_like('approval_scheme', $q);
        $this->db->or_like('id_user_level', $q);
        $this->db->or_like('approve_by', $q);
        $this->db->or_like('approval_date', $q);
        $this->db->or_like('reject_by', $q);
        $this->db->or_like('reject_date', $q);
        $this->db->or_like('SecLogDate', $q);
        $this->db->or_like('SecLogUser', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('no_klaim', $q);
        $this->db->or_like('approval_scheme', $q);
        $this->db->or_like('id_user_level', $q);
        $this->db->or_like('approve_by', $q);
        $this->db->or_like('approval_date', $q);
        $this->db->or_like('reject_by', $q);
        $this->db->or_like('reject_date', $q);
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

    // update Form Claim
    function update_claim($claim_id, $data)
    {
        $this->db->where('claim_id', $claim_id);
        $this->db->update('form_claim', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_scheme($id_user_level)
    {
        $this->db->select('*', false);
        $this->db->where('id_user_level', $id_user_level);
        $this->db->order_by('approval_scheme', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get('approval_claim');
        $data = $query->row();
        $alias = $data->approval_scheme;
        return $alias;
    }

    // Get budget
    function get_budget_amount($no_p3)
    {
        $this->db->select('*', FALSE);
        $this->db->where('no_p3', $no_p3);
        $this->db->limit(1);
        $query = $this->db->get('form_budget_program');
        $data = $query->row();
        return $data;
    }

    // update budget claim
    function update_usage($no_p3, $BudgetUsage)
    {
        $this->db->where('no_p3', $no_p3);
        $this->db->update('form_budget_program', $BudgetUsage);
    }
}
