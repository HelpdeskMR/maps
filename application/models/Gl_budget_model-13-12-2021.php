<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gl_budget_model extends CI_Model
{

    public $table = 'gl_budget';
    public $id = 'budget_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $year = array(Date('Y'), Date('Y', strtotime('+1 years')), Date('Y', strtotime('-1 years')));
        // $this->db->distinct();
        $this->datatables->select('
        gl_budget.budget_id,
        gl_budget.kode_departemen,
        arc_channel.channel_name,
        gl_budget.gl_coa,
        gl_budget.gl_coa_segment,
        gl_budget.YearPeriod,
        gl_budget.BudgetAmount,
        gl_budget.BudgetUsage,
        gl_budget.BudgetSaldo,
        gl_budget.is_aktif,
        arc_departemen.kode_departemen, 
        arc_departemen.nama_departemen,
        gl_account.gl_coa_desc,
        arc_store.store_name,
        arc_region.nama_region,
        business_unit.business_unit_name
        ');
        $this->datatables->from('gl_budget');
        $this->datatables->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->datatables->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->datatables->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->datatables->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->datatables->join('arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->datatables->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->datatables->where_in('gl_budget.YearPeriod', $year);
        $this->datatables->where_in('gl_budget.business_unit_id', 0);
        $this->datatables->group_by('gl_budget.budget_id');
        $this->datatables->add_column('action', anchor(site_url('gl_budget/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')) . " " . anchor(site_url('gl_budget/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) . " 
                " . anchor(site_url('gl_budget/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'budget_id');
                $this->datatables->add_column('is_aktif', '$1', 'rename_string_is_aktif(is_aktif)');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->select('gl_budget.budget_id,
        arc_company.nama_perusahaan,
        arc_departemen.nama_departemen,
        gl_budget.gl_coa,
        gl_account.gl_coa_desc,
        gl_budget.YearPeriod,
        gl_budget.BudgetAmount,
        gl_budget.BudgetUsage,
        gl_budget.BudgetSaldo,
        arc_channel.channel_name,
        arc_store.store_name,
        arc_region.nama_region,
        business_unit.business_unit_name', FALSE);
        $this->db->join('arc_company', 'gl_budget.kode_perusahaan = arc_company.kode_perusahaan', 'left');
        $this->db->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->db->join('arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->db->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->db->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->db->group_by('gl_budget.budget_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    // function get_by_id($id)
    // {
    //     $this->db->where($this->id, $id);
    //     return $this->db->get($this->table)->row();
    // }

    function get_by_id($id)
    {
        $this->db->select('gl_budget.budget_id,
        gl_budget.kode_perusahaan,
        gl_budget.business_unit_id,
        gl_budget.kode_departemen,
        gl_budget.channel_code,
        gl_budget.store_code,
        gl_budget.region_id,
        gl_budget.gl_coa,
        gl_budget.gl_coa_segment,
        gl_budget.YearPeriod,
        gl_budget.BudgetAmount,
        gl_budget.BudgetUsage,
        gl_budget.BudgetSaldo,
        gl_budget.is_aktif,
        gl_budget.SecLogUser,
        gl_budget.SecLogDate,
        arc_company.nama_perusahaan,
        business_unit.business_unit_name,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_store.store_name,
        arc_region.nama_region,
        gl_account.gl_coa_desc',FALSE);
        $this->db->join('arc_company', 'gl_budget.kode_perusahaan = arc_company.kode_perusahaan', 'left');
        $this->db->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->db->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->db->join('(SELECT * FROM arc_channel GROUP BY channel_code) AS arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->db->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');

        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
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
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
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

    function get_channel_name($channel_code)
    {
        $this->db->select('*', FALSE);
        $this->db->where('channel_code', $channel_code);
        $this->db->limit(1);
        $query = $this->db->get('arc_channel');
        $data = $query->row();
        return $data;
    }

    function get_store($channel_code)
    {
        $this->db->select('*', FALSE);
        $this->db->from('arc_store');
        $this->db->where('channel_code', $channel_code);
        $this->db->order_by('store_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    // function get_store_name($store_code)
    // {
    //     $this->db->select('*', FALSE);
    //     $this->db->where('store_code', $store_code);
    //     $this->db->limit(1);
    //     $query = $this->db->get('arc_store');
    //     $data = $query->row();
    //     return $data;
    // }

    function get_region($channel_code)
    {
        $this->db->select('*', FALSE);
        $this->db->from('arc_region');
        $this->db->where('channel_code', $channel_code);
        $this->db->order_by('nama_region', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function check_coa_segment($gl_coa_segment)
    {
        $this->db->where('gl_coa_segment', $gl_coa_segment);
        $data = $this->db->get('gl_budget');

        return $data->num_rows();
    }

    public function insert_batch($data)
    {
        $this->db->insert_batch('gl_budget', $data);

        return $this->db->affected_rows();
    }

    // Budget View
    function json_view()
    {
        $year = array(Date('Y'), Date('Y', strtotime('+1 years')), Date('Y', strtotime('-1 years')));
        if ($this->session->userdata('kode_departemen') == NULL) {
            $this->datatables->select('
                                    gl_budget.budget_id,
                                    gl_budget.kode_departemen,
                                    arc_channel.channel_name,
                                    gl_budget.gl_coa,
                                    gl_budget.gl_coa_segment,
                                    gl_budget.YearPeriod,
                                    gl_budget.BudgetAmount,
                                    gl_budget.BudgetUsage,
                                    gl_budget.BudgetSaldo,
                                    gl_budget.is_aktif,
                                    arc_departemen.kode_departemen, 
                                    arc_departemen.nama_departemen,
                                    gl_account.gl_coa_desc,
                                    arc_store.store_name,
                                    arc_region.nama_region,
                                    business_unit.business_unit_name
                                    ');
            $this->datatables->from('gl_budget');
            $this->datatables->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
            $this->datatables->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
            $this->datatables->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
            $this->datatables->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
            $this->datatables->join('arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
            $this->datatables->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
            $this->datatables->where_in('gl_budget.YearPeriod', $year);
            $this->datatables->where_in('gl_budget.business_unit_id', 0);
            $this->datatables->group_by('gl_budget.budget_id');
            $this->datatables->add_column('is_aktif', '$1', 'rename_string_is_aktif(is_aktif)');
        } else {
            $this->datatables->select('
                                        gl_budget.budget_id,
                                        gl_budget.kode_departemen,
                                        arc_channel.channel_name,
                                        gl_budget.gl_coa,
                                        gl_budget.gl_coa_segment,
                                        gl_budget.YearPeriod,
                                        gl_budget.BudgetAmount,
                                        gl_budget.BudgetUsage,
                                        gl_budget.BudgetSaldo,
                                        gl_budget.is_aktif,
                                        arc_departemen.kode_departemen, 
                                        arc_departemen.nama_departemen,
                                        gl_account.gl_coa_desc,
                                        arc_store.store_name,
                                        arc_region.nama_region,
                                        business_unit.business_unit_name
                                        ');
            $this->datatables->from('gl_budget');
            $this->datatables->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
            $this->datatables->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
            $this->datatables->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
            $this->datatables->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
            $this->datatables->join('arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
            $this->datatables->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
            $this->datatables->where_in('gl_budget.YearPeriod', $year);
            $this->datatables->where('gl_budget.kode_departemen', $this->session->userdata('kode_departemen'));
            $this->datatables->where_in('gl_budget.business_unit_id', 0);
            $this->datatables->group_by('gl_budget.budget_id');
            $this->datatables->add_column('is_aktif', '$1', 'rename_string_is_aktif(is_aktif)');
        }

        return $this->datatables->generate();
    }

    function insert_history($history)
    {
        $this->db->insert('gl_budget_history', $history);
    }

    function get_history($id)
    {
        $this->db->where('budget_id', $id);
        $data = $this->db->get('gl_budget_history')->result();
        return $data;
    }
}
