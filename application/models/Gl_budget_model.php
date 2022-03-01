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
        gl_budget.brand_code,
        gl_budget.series_code,
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
        business_unit.business_unit_name,
        brand.brand_name,
        series.series_name
        ');
        $this->datatables->from('gl_budget');
        $this->datatables->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->datatables->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->datatables->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->datatables->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->datatables->join('arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->datatables->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->datatables->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
        $this->datatables->join('series', 'gl_budget.series_code = series.series_code', 'left');
        $this->datatables->where_in('gl_budget.YearPeriod', $year);
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
        business_unit.business_unit_name,
        brand.brand_name,
        series.series_name', FALSE);
        $this->db->join('arc_company', 'gl_budget.kode_perusahaan = arc_company.kode_perusahaan', 'left');
        $this->db->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->db->join('arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->db->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->db->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->db->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
        $this->db->join('series', 'gl_budget.series_code = series.series_code', 'left');
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
        gl_budget.brand_code,
        gl_budget.series_code,
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
        gl_account.gl_coa_desc,
        brand.brand_name,
        series.series_name',FALSE);
        $this->db->join('arc_company', 'gl_budget.kode_perusahaan = arc_company.kode_perusahaan', 'left');
        $this->db->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->db->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->db->join('(SELECT * FROM arc_channel GROUP BY channel_code) AS arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->db->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->db->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
        $this->db->join('series', 'gl_budget.series_code = series.series_code', 'left');
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

    function get_store_switching($channel_code, $kode_departemen, $business_unit_id)
    {
        $this->db->select('DISTINCT gl_budget.store_code, arc_store.store_name', FALSE);
        $this->db->from('gl_budget');
        $this->db->where('gl_budget.business_unit_id', $business_unit_id);
        $this->db->where('gl_budget.channel_code', $channel_code);
        $this->db->where('gl_budget.kode_departemen', $kode_departemen);
        $this->db->join('arc_store', 'arc_store.store_code = gl_budget.store_code');
        $this->db->order_by('arc_store.store_name', 'ASC');
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

    function get_region_switching($channel_code, $kode_departemen, $business_unit_id)
    {
        $this->db->select('DISTINCT gl_budget.region_id, arc_region.nama_region, arc_region.region_code', FALSE);
        $this->db->from('gl_budget');
        $this->db->where('gl_budget.business_unit_id', $business_unit_id);
        $this->db->where('gl_budget.channel_code', $channel_code);
        $this->db->where('gl_budget.kode_departemen', $kode_departemen);
        $this->db->join('arc_region', 'arc_region.region_code = gl_budget.region_id');
        $this->db->order_by('arc_region.nama_region', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_brand($kode_departemen)
    {
        $this->db->select('*', FALSE);
        $this->db->from('brand');
        $this->db->where('kode_departemen', $kode_departemen);
        $this->db->order_by('brand_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_brand_switching($kode_departemen, $business_unit_id)
    {
        $this->db->select('DISTINCT gl_budget.brand_code, brand.brand_name', FALSE);
        $this->db->from('gl_budget');
        $this->db->where('gl_budget.business_unit_id', $business_unit_id);
        $this->db->where('gl_budget.kode_departemen', $kode_departemen);
        $this->db->join('brand', 'gl_budget.brand_code = brand.brand_code');
        $this->db->order_by('brand.brand_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_series($brand_code)
    {
        $this->db->select('*', FALSE);
        $this->db->from('series');
        $this->db->where('brand_code', $brand_code);
        $this->db->order_by('series_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_series_switching($brand_code, $business_unit_id, $kode_departemen)
    {
        $this->db->select('DISTINCT gl_budget.series_code, series.series_name', FALSE);
        $this->db->from('gl_budget');
        $this->db->where('gl_budget.business_unit_id', $business_unit_id);
        $this->db->where('gl_budget.kode_departemen', $kode_departemen);
        $this->db->where('gl_budget.brand_code', $brand_code);
        $this->db->join('series', 'gl_budget.series_code = series.series_code');
        $this->db->order_by('series.series_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_coa_store_switching($gl_coa_segment)
    {
        $this->db->select('DISTINCT gl_budget.gl_coa, gl_account.gl_coa_desc', FALSE);
        $this->db->from('gl_budget');
        $this->db->like('gl_coa_segment', $gl_coa_segment, 'after');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa');
        $this->db->order_by('gl_account.gl_coa_desc', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_coa_region_switching($gl_coa_segment)
    {
        $this->db->select('DISTINCT gl_budget.gl_coa, gl_account.gl_coa_desc', FALSE);
        $this->db->from('gl_budget');
        $this->db->like('gl_coa_segment', $gl_coa_segment, 'after');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa');
        $this->db->order_by('gl_account.gl_coa_desc', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_coa_series_switching($gl_coa_segment)
    {
        $this->db->select('DISTINCT gl_budget.gl_coa, gl_account.gl_coa_desc', FALSE);
        $this->db->from('gl_budget');
        $this->db->like('gl_coa_segment', $gl_coa_segment, 'after');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa');
        $this->db->order_by('gl_account.gl_coa_desc', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_balance($gl_coa_segment)
    {
        $this->db->select('FORMAT(BudgetAmount,0) AS BudgetAmount, FORMAT(BudgetUsage,0) AS BudgetUsage, FORMAT(BudgetSaldo,0) AS BudgetSaldo', FALSE);
        $this->db->from('gl_budget');
        $this->db->where('gl_coa_segment', $gl_coa_segment);
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
                                    business_unit.business_unit_name,
                                    brand.brand_name,
                                    series.series_name
                                    ');
            $this->datatables->from('gl_budget');
            $this->datatables->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
            $this->datatables->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
            $this->datatables->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
            $this->datatables->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
            $this->datatables->join('arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
            $this->datatables->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
            $this->datatables->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
            $this->datatables->join('series', 'gl_budget.series_code = series.series_code', 'left');
            $this->datatables->where_in('gl_budget.YearPeriod', $year);
            $this->datatables->group_by('gl_budget.budget_id');
            $this->datatables->add_column('is_aktif', '$1', 'rename_string_is_aktif(is_aktif)');
        } elseif ($this->session->userdata('kode_departemen') == '0306401' || $this->session->userdata('kode_departemen') == '0307' || $this->session->userdata('kode_departemen') == '0308') {
            $kode = array('0306401','0307','0308');
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
                                        business_unit.business_unit_name,
                                        brand.brand_name,
                                        series.series_name
                                        ');
            $this->datatables->from('gl_budget');
            $this->datatables->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
            $this->datatables->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
            $this->datatables->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
            $this->datatables->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
            $this->datatables->join('arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
            $this->datatables->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
            $this->datatables->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
            $this->datatables->join('series', 'gl_budget.series_code = series.series_code', 'left');
            $this->datatables->where_in('gl_budget.YearPeriod', $year);
            $this->datatables->where_in('gl_budget.kode_departemen', $kode);
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
                                        business_unit.business_unit_name,
                                        brand.brand_name,
                                        series.series_name
                                        ');
            $this->datatables->from('gl_budget');
            $this->datatables->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
            $this->datatables->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
            $this->datatables->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
            $this->datatables->join('arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
            $this->datatables->join('arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
            $this->datatables->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
            $this->datatables->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
            $this->datatables->join('series', 'gl_budget.series_code = series.series_code', 'left');
            $this->datatables->where_in('gl_budget.YearPeriod', $year);
            $this->datatables->where('gl_budget.kode_departemen', $this->session->userdata('kode_departemen'));
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

    function get_budgetFrom($gl_coa_segment_from)
    {
        $this->db->select('BudgetAmount, BudgetUsage, BudgetSaldo', FALSE);
        $this->db->where('gl_coa_segment', $gl_coa_segment_from);
        $data = $this->db->get('gl_budget')->row();
        return $data;
    }

    function get_budgetTo($gl_coa_segment_to)
    {
        $this->db->select('BudgetAmount, BudgetUsage, BudgetSaldo', FALSE);
        $this->db->where('gl_coa_segment', $gl_coa_segment_to);
        $data = $this->db->get('gl_budget')->row();
        return $data;
    }

    function update_budgetAllocation($gl_coa_segment, $data)
    {
        $this->db->where('gl_coa_segment', $gl_coa_segment);
        $this->db->update('gl_budget', $data);
    }

    function get_code()
    {
        $this->db->select('MAX(id_budget_allocation) as code', FALSE);
        $query = $this->db->get('budget_allocation');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $code = intval($data->code) + 1;
        } else {
            $code = 1;
        }
        return $code;
    }

    function insert_budgetAllocation($data)
    {
        $this->db->insert('budget_allocation', $data);
    }

    function insert_wfAllocation($data_wf)
    {
        $this->db->insert('wf_allocation', $data_wf);
    }

    function json_allocation()
    {
        $this->datatables->select('wf_allocation.id, wf_allocation.allocation_code, budget_allocation.date_create, budget_allocation.gl_coa_segment_from, budget_allocation.gl_coa_segment_to, budget_allocation.amount_allocation, budget_allocation.status');
        $this->datatables->from('wf_allocation');
        $this->datatables->join('budget_allocation', 'wf_allocation.allocation_code = budget_allocation.allocation_code', 'left');
        // $this->datatables->where('wf_allocation.id_user_level', $this->session->userdata('id_user_level'));
        $this->datatables->where('budget_allocation.status', 0);
        $this->datatables->group_by('wf_allocation.id');
        $this->datatables->add_column('action', anchor(site_url('wf_allocation/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')), 'id');
        return $this->datatables->generate();
    }

    function get_budgetAllocationFrom($id)
    {
        $this->db->select('budget_allocation.id_budget_allocation,
        budget_allocation.date_create,
        budget_allocation.allocation_code,
        budget_allocation.gl_coa_segment_from,
        budget_allocation.gl_coa_segment_to,
        budget_allocation.amount_allocation,
        budget_allocation.`status`,
        budget_allocation.SecLogDate,
        budget_allocation.SecLogUser,
        arc_company.nama_perusahaan,
        business_unit.business_unit_name,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_store.store_name,
        arc_region.nama_region,
        brand.brand_name,
        series.series_name,
        gl_account.gl_coa_desc,
        gl_budget.BudgetSaldo', FALSE);
        $this->db->join('gl_budget', 'budget_allocation.gl_coa_segment_from = gl_budget.gl_coa_segment', 'left');
        $this->db->join('arc_company', 'gl_budget.kode_perusahaan = arc_company.kode_perusahaan', 'left');
        $this->db->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->db->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->db->join('(SELECT * FROM arc_channel GROUP BY channel_code) AS arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->db->join('(SELECT * FROM arc_region GROUP BY region_code) AS arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->db->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
        $this->db->join('series', 'gl_budget.series_code = series.series_code', 'left');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->db->where('budget_allocation.id_budget_allocation', $id);
        $data = $this->db->get('budget_allocation')->row();
        return $data;
    }

    function get_budgetAllocationTo($id)
    {
        $this->db->select('budget_allocation.id_budget_allocation,
        budget_allocation.date_create,
        budget_allocation.allocation_code,
        budget_allocation.gl_coa_segment_from,
        budget_allocation.gl_coa_segment_to,
        budget_allocation.amount_allocation,
        budget_allocation.`status`,
        budget_allocation.SecLogDate,
        budget_allocation.SecLogUser,
        arc_company.nama_perusahaan,
        business_unit.business_unit_name,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_store.store_name,
        arc_region.nama_region,
        brand.brand_name,
        series.series_name,
        gl_account.gl_coa_desc,
        gl_budget.BudgetSaldo', FALSE);
        $this->db->join('gl_budget', 'budget_allocation.gl_coa_segment_to = gl_budget.gl_coa_segment', 'left');
        $this->db->join('arc_company', 'gl_budget.kode_perusahaan = arc_company.kode_perusahaan', 'left');
        $this->db->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->db->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->db->join('(SELECT * FROM arc_channel GROUP BY channel_code) AS arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->db->join('(SELECT * FROM arc_region GROUP BY region_code) AS arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->db->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
        $this->db->join('series', 'gl_budget.series_code = series.series_code', 'left');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->db->where('budget_allocation.id_budget_allocation', $id);
        $data = $this->db->get('budget_allocation')->row();
        return $data;
    }

    function get_budget_allocation($id)
    {
        $this->db->where('id_budget_allocation', $id);
        $data = $this->db->get('budget_allocation')->row();
        return $data;
    }

    function update_dataAllocation($id, $data)
    {
        $this->db->where('id_budget_allocation', $id);
        $this->db->update('budget_allocation', $data);
    }

    function update_wfAllocation($allocation_code, $data)
    {
        $this->db->where('allocation_code', $allocation_code);
        $this->db->update('wf_allocation', $data);
    }

    function get_dataAllocationFrom($allocation_code)
    {
        $this->db->select('budget_allocation.id_budget_allocation,
        budget_allocation.date_create,
        budget_allocation.allocation_code,
        budget_allocation.gl_coa_segment_from,
        budget_allocation.gl_coa_segment_to,
        budget_allocation.amount_allocation,
        budget_allocation.`status`,
        budget_allocation.SecLogDate,
        budget_allocation.SecLogUser,
        arc_company.nama_perusahaan,
        business_unit.business_unit_name,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_store.store_name,
        arc_region.nama_region,
        brand.brand_name,
        series.series_name,
        gl_account.gl_coa_desc,
        gl_budget.BudgetSaldo', FALSE);
        $this->db->join('gl_budget', 'budget_allocation.gl_coa_segment_from = gl_budget.gl_coa_segment', 'left');
        $this->db->join('arc_company', 'gl_budget.kode_perusahaan = arc_company.kode_perusahaan', 'left');
        $this->db->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->db->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->db->join('(SELECT * FROM arc_channel GROUP BY channel_code) AS arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->db->join('(SELECT * FROM arc_region GROUP BY region_code) AS arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->db->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
        $this->db->join('series', 'gl_budget.series_code = series.series_code', 'left');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->db->where('budget_allocation.allocation_code', $allocation_code);
        $data = $this->db->get('budget_allocation')->row();
        return $data;
    }

    function get_dataAllocationTo($allocation_code)
    {
        $this->db->select('budget_allocation.id_budget_allocation,
        budget_allocation.date_create,
        budget_allocation.allocation_code,
        budget_allocation.gl_coa_segment_from,
        budget_allocation.gl_coa_segment_to,
        budget_allocation.amount_allocation,
        budget_allocation.`status`,
        budget_allocation.SecLogDate,
        budget_allocation.SecLogUser,
        arc_company.nama_perusahaan,
        business_unit.business_unit_name,
        arc_departemen.nama_departemen,
        arc_channel.channel_name,
        arc_store.store_name,
        arc_region.nama_region,
        brand.brand_name,
        series.series_name,
        gl_account.gl_coa_desc,
        gl_budget.BudgetSaldo', FALSE);
        $this->db->join('gl_budget', 'budget_allocation.gl_coa_segment_to = gl_budget.gl_coa_segment', 'left');
        $this->db->join('arc_company', 'gl_budget.kode_perusahaan = arc_company.kode_perusahaan', 'left');
        $this->db->join('business_unit', 'gl_budget.business_unit_id = business_unit.business_unit_id', 'left');
        $this->db->join('arc_departemen', 'gl_budget.kode_departemen = arc_departemen.kode_departemen', 'left');
        $this->db->join('(SELECT * FROM arc_channel GROUP BY channel_code) AS arc_channel', 'gl_budget.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_store', 'gl_budget.store_code = arc_store.store_code', 'left');
        $this->db->join('(SELECT * FROM arc_region GROUP BY region_code) AS arc_region', 'gl_budget.region_id = arc_region.region_code', 'left');
        $this->db->join('brand', 'gl_budget.brand_code = brand.brand_code', 'left');
        $this->db->join('series', 'gl_budget.series_code = series.series_code', 'left');
        $this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
        $this->db->where('budget_allocation.allocation_code', $allocation_code);
        $data = $this->db->get('budget_allocation')->row();
        return $data;
    }

    function get_wfAllocation($allocation_code)
    {
        $this->db->where('allocation_code', $allocation_code);
        $data = $this->db->get('wf_allocation')->row();
        return $data;
    }

    function get_history_allocation($id)
    {
        $query = $this->db->query("SELECT
            gl_budget.*,
            budget_allocation.*
        FROM
            `gl_budget`
        LEFT JOIN (SELECT
            budget_allocation.*,
            budget_from.nama_perusahaan AS nama_perusahaan_from,
            budget_from.business_unit_name AS business_unit_name_from,
            budget_from.nama_departemen AS nama_departemen_from,
            budget_from.channel_name AS channel_name_from,
            budget_from.store_name AS store_name_from,
            budget_from.nama_region AS nama_region_from,
            budget_from.brand_name AS brand_name_from,
            budget_from.series_name AS series_name_from,
            budget_from.gl_coa_desc AS gl_coa_desc_from,
            budget_to.nama_perusahaan AS nama_perusahaan_to,
            budget_to.business_unit_name AS business_unit_name_to,
            budget_to.nama_departemen AS nama_departemen_to,
            budget_to.channel_name AS channel_name_to,
            budget_to.store_name AS store_name_to,
            budget_to.nama_region AS nama_region_to,
            budget_to.brand_name AS brand_name_to,
            budget_to.series_name AS series_name_to,
            budget_to.gl_coa_desc AS gl_coa_desc_to
        FROM
            `budget_allocation`
        LEFT JOIN(
            SELECT
                gl_budget.*, arc_company.nama_perusahaan,
                business_unit.business_unit_name,
                arc_departemen.nama_departemen,
                arc_channel.channel_name,
                arc_store.store_name,
                arc_region.nama_region,
                brand.brand_name,
                series.series_name,
                gl_account.gl_coa_desc
            FROM
                gl_budget
            LEFT JOIN arc_company ON gl_budget.kode_perusahaan = arc_company.kode_perusahaan
            LEFT JOIN business_unit ON gl_budget.business_unit_id = business_unit.business_unit_id
            LEFT JOIN arc_departemen ON gl_budget.kode_departemen = arc_departemen.kode_departemen
            LEFT JOIN(
                SELECT
                    *
                FROM
                    arc_channel
                GROUP BY
                    channel_code
            )AS arc_channel ON gl_budget.channel_code = arc_channel.channel_code
            LEFT JOIN arc_store ON gl_budget.store_code = arc_store.store_code
            LEFT JOIN(
                SELECT
                    *
                FROM
                    arc_region
                GROUP BY
                    region_code
            )AS arc_region ON gl_budget.region_id = arc_region.region_code
            LEFT JOIN brand ON gl_budget.brand_code = brand.brand_code
            LEFT JOIN series ON gl_budget.series_code = series.series_code
            LEFT JOIN gl_account ON gl_budget.gl_coa = gl_account.gl_coa
            ORDER BY
                gl_budget.budget_id
        )AS budget_from ON budget_allocation.gl_coa_segment_from = budget_from.gl_coa_segment
        LEFT JOIN(
            SELECT
                gl_budget.*, arc_company.nama_perusahaan,
                business_unit.business_unit_name,
                arc_departemen.nama_departemen,
                arc_channel.channel_name,
                arc_store.store_name,
                arc_region.nama_region,
                brand.brand_name,
                series.series_name,
                gl_account.gl_coa_desc
            FROM
                gl_budget
            LEFT JOIN arc_company ON gl_budget.kode_perusahaan = arc_company.kode_perusahaan
            LEFT JOIN business_unit ON gl_budget.business_unit_id = business_unit.business_unit_id
            LEFT JOIN arc_departemen ON gl_budget.kode_departemen = arc_departemen.kode_departemen
            LEFT JOIN(
                SELECT
                    *
                FROM
                    arc_channel
                GROUP BY
                    channel_code
            )AS arc_channel ON gl_budget.channel_code = arc_channel.channel_code
            LEFT JOIN arc_store ON gl_budget.store_code = arc_store.store_code
            LEFT JOIN(
                SELECT
                    *
                FROM
                    arc_region
                GROUP BY
                    region_code
            )AS arc_region ON gl_budget.region_id = arc_region.region_code
            LEFT JOIN brand ON gl_budget.brand_code = brand.brand_code
            LEFT JOIN series ON gl_budget.series_code = series.series_code
            LEFT JOIN gl_account ON gl_budget.gl_coa = gl_account.gl_coa
            ORDER BY
                gl_budget.budget_id
        )AS budget_to ON budget_allocation.gl_coa_segment_to = budget_to.gl_coa_segment) AS budget_allocation ON gl_budget.gl_coa_segment = budget_allocation.gl_coa_segment_from OR gl_budget.gl_coa_segment = budget_allocation.gl_coa_segment_to
        WHERE gl_budget.budget_id = '$id' AND budget_allocation.status = 4
        ORDER BY gl_budget.budget_id");
        return $query->result();
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($data);
        // exit;
    }
}
