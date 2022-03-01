<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Form_program_model extends CI_Model
{

	public $table = 'form_program';
	public $id = 'form_id';
	public $order = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	// datatables
	function json()
	{
		$this->datatables->select('
		form_program.form_id,
		form_program.jenis_form,
		form_program.kode_perusahaan,
		form_program.kode_departemen,
		form_program.gl_coa,
		form_program.gl_coa_segment,
		form_program.tgl_pengajuan,
		form_program.no_p3,
		form_program.kode_area,
		form_program.region_id,
		form_program.program_id,
		form_program.brand,
		form_program.latar_belakang_promo,
		form_program.tujuan_promo,
		form_program.jumlah_outlet,
		form_program.tipe_outlet,
		form_program.periode_awal,
		form_program.periode_akhir,
		form_program.mekanisme_promo,
		form_program.sku_avg_sales_unit,
		form_program.sku_avg_sales_amount,
		form_program.sku_target_sales_unit,
		form_program.sku_target_sales_amount,
		form_program.sku_growth,
		form_program.sku_total_cost,
		form_program.sku_cost_ratio,
		form_program.estimasi_biaya,
		form_program.charging_cost,
		form_program.status,
		form_program.pemohon,
		form_program.SecLogUser,
		form_program.SecLogDate,
		arc_program.nama_program,
		gl_account.gl_coa_desc
		');
		$this->datatables->from('form_program');
		//add this line for join
		$this->datatables->join('arc_program', 'form_program.program_id = arc_program.program_id');
		$this->datatables->join('gl_account', 'form_program.gl_coa = gl_account.gl_coa');
		// $this->datatables->add_column('action', anchor(site_url('form_program/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
		//     ".anchor(site_url('form_program/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm'))." 
		//         ".anchor(site_url('form_program/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'form_id');

		// $this->datatables->add_column('action', anchor(site_url('form_program/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
		// 	 ".anchor(site_url('form_program/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm'))." ".anchor(site_url('form_program/print/$1'),'<i class="fa fa-print" aria-hidden="true"></i>', array('class' => 'btn btn-default', 'target' => '_blank'))." ", 'form_id');

		$this->datatables->add_column('action', anchor(site_url('form_program/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm')) . " 
			 " . anchor(site_url('form_program/print/$1'), '<i class="fa fa-print" aria-hidden="true"></i>', array('class' => 'btn btn-default', 'target' => '_blank')) . " ", 'form_id');

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
		$this->db->join('arc_area', 'form_program.kode_area = arc_area.kode_area', 'left');
		$this->db->join('arc_region', 'form_program.region_id = arc_region.region_id', 'left');
		$this->db->join('arc_program', 'form_program.program_id = arc_program.program_id', 'left');
		$this->db->join('gl_account', 'form_program.gl_coa = gl_account.gl_coa', 'left');

		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	// get total rows
	function total_rows($q = NULL)
	{
		$this->db->like('form_id', $q);
		$this->db->or_like('jenis_form', $q);
		$this->db->or_like('kode_perusahaan', $q);
		$this->db->or_like('kode_departemen', $q);
		$this->db->or_like('gl_coa', $q);
		$this->db->or_like('gl_coa_segment', $q);
		$this->db->or_like('tgl_pengajuan', $q);
		$this->db->or_like('no_p3', $q);
		$this->db->or_like('kode_area', $q);
		$this->db->or_like('region_id', $q);
		$this->db->or_like('program_id', $q);
		$this->db->or_like('brand', $q);
		$this->db->or_like('latar_belakang_promo', $q);
		$this->db->or_like('tujuan_promo', $q);
		$this->db->or_like('jumlah_outlet', $q);
		$this->db->or_like('tipe_outlet', $q);
		$this->db->or_like('periode_awal', $q);
		$this->db->or_like('periode_akhir', $q);
		$this->db->or_like('mekanisme_promo', $q);
		$this->db->or_like('sku_avg_sales_unit', $q);
		$this->db->or_like('sku_avg_sales_amount', $q);
		$this->db->or_like('sku_target_sales_unit', $q);
		$this->db->or_like('sku_target_sales_amount', $q);
		$this->db->or_like('sku_growth', $q);
		$this->db->or_like('sku_total_cost', $q);
		$this->db->or_like('sku_cost_ratio', $q);
		$this->db->or_like('estimasi_biaya', $q);
		$this->db->or_like('charging_cost', $q);
		$this->db->or_like('pemohon', $q);
		$this->db->or_like('SecLogUser', $q);
		$this->db->or_like('SecLogDate', $q);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	// get data with limit and search
	function get_limit_data($limit, $start = 0, $q = NULL)
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->like('form_id', $q);
		$this->db->or_like('jenis_form', $q);
		$this->db->or_like('kode_perusahaan', $q);
		$this->db->or_like('kode_departemen', $q);
		$this->db->or_like('gl_coa', $q);
		$this->db->or_like('gl_coa_segment', $q);
		$this->db->or_like('tgl_pengajuan', $q);
		$this->db->or_like('no_p3', $q);
		$this->db->or_like('kode_area', $q);
		$this->db->or_like('region_id', $q);
		$this->db->or_like('program_id', $q);
		$this->db->or_like('brand', $q);
		$this->db->or_like('latar_belakang_promo', $q);
		$this->db->or_like('tujuan_promo', $q);
		$this->db->or_like('jumlah_outlet', $q);
		$this->db->or_like('tipe_outlet', $q);
		$this->db->or_like('periode_awal', $q);
		$this->db->or_like('periode_akhir', $q);
		$this->db->or_like('mekanisme_promo', $q);
		$this->db->or_like('sku_avg_sales_unit', $q);
		$this->db->or_like('sku_avg_sales_amount', $q);
		$this->db->or_like('sku_target_sales_unit', $q);
		$this->db->or_like('sku_target_sales_amount', $q);
		$this->db->or_like('sku_growth', $q);
		$this->db->or_like('sku_total_cost', $q);
		$this->db->or_like('sku_cost_ratio', $q);
		$this->db->or_like('estimasi_biaya', $q);
		$this->db->or_like('charging_cost', $q);
		$this->db->or_like('pemohon', $q);
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

	// get data departemen

	function get_dept($kode_departemen)
	{
		$this->db->select('*', FALSE);
		$this->db->where('kode_departemen', $kode_departemen);
		$this->db->order_by('kode_departemen', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('arc_departemen');
		$data = $query->row();
		$alias = $data->alias_departemen;
		return $alias;
	}

	public function buat_kode()
	{
		$this->db->select('LEFT(form_program.no_p3,3) as kode', FALSE);
		$this->db->order_by('no_p3', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('form_program');      //cek dulu apakah ada sudah ada kode di tabel.    
		if ($query->num_rows() <> 0) {
			//jika kode ternyata sudah ada.      
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			//jika kode belum ada      
			$kode = 1;
		}

		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 3 menunjukkan jumlah digit angka 0
		return $kodemax;
	}

	// insert Budget Program from Form Program
	function insert_budget($BudgetProgram)
	{
		$this->db->insert('form_budget_program', $BudgetProgram);
	}

	function get_region()
	{
		$this->db->select('*', TRUE);
		$this->db->order_by('nama_region', 'ASC');
		$query = $this->db->get('arc_region');
		return $query;
	}

	function get_area($region_id)
	{
		$this->db->order_by('nama_area', 'ASC');
		$query = $this->db->get_where('arc_area', array('region_id' => $region_id));
		return $query;
	}

	function get_dept_budget()
	{
		$this->db->select('*', TRUE);
		$this->db->order_by('nama_departemen', 'ASC');
		$query = $this->db->get('arc_departemen');
		return $query;
	}

	function get_coa($kode_departemen)
	{
		$this->db->select('gl_budget.kode_departemen,
							gl_budget.gl_coa,
							gl_budget.budgetamount,
							gl_account.gl_coa,
							gl_account.gl_coa_desc');
		$this->db->from('gl_budget');
		$this->db->join('gl_account', 'gl_budget.gl_coa = gl_account.gl_coa', 'left');
		$this->db->where('gl_budget.kode_departemen', $kode_departemen);
		$query = $this->db->get();
		return $query;
	}

	function get_budget_amount($gl_coa_segment)
	{
		$Year = date('Y');
		$this->db->select('*', FALSE);
		$this->db->where('gl_coa_segment', $gl_coa_segment);
		$this->db->where('YearPeriod', $Year);
		$this->db->limit(1);
		$query = $this->db->get('gl_budget');
		$data = $query->row();
		return $data;
	}

	// update budget usage
	function update_usage($gl_coa_segment, $data)
	{
		$Year = date('Y');
		$this->db->where('gl_coa_segment', $gl_coa_segment);
		$this->db->where('YearPeriod', $Year);
		$this->db->update('gl_budget', $data);
	}

	/* GET APPROVAL SHCEME */
	function get_approval($kode_departemen)
	{
		$this->db->select('DISTINCT approval_scheme, id_user_level', FALSE);
		$kode_dept = array($kode_departemen, '');
		$this->db->where_in('kode_departemen', $kode_dept);
		$query = $this->db->get('approval_program');
		$data = $query->result_array();
		return $data;
	}

	// insert Workflow PROGRAM
	function insert_wf_program($insertArray)
	{
		$this->db->insert_batch('wf_program', $insertArray);
	}
}
