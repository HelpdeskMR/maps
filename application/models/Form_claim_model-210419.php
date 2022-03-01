<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form_claim_model extends CI_Model
{

    public $table = 'form_claim';
    public $id = 'claim_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('claim_id,kode_distributor,nama_distributor,tgl_klaim,no_p3,program_id,deskripsi,claim_dpp,claim_ppn,claim_pph,total_claim,faktur_pajak,npwp,Pemohon,SecLogDate,SecLogUser');
        $this->datatables->from('form_claim');
        //add this line for join
        //$this->datatables->join('table2', 'form_claim.field = table2.field');

        $this->datatables->add_column('action', anchor(site_url('form_claim/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . " 
            " . anchor(site_url('form_claim/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . " 
                " . anchor(site_url('form_claim/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'claim_id');
        return $this->datatables->generate();
    }

    // datatables
    // function json_program1()
    // {
    //     $kode_distributor = $this->session->userdata('email');
    //     $this->datatables->select('
    //     form_program.form_id,
    //     form_program.no_p3,
    //     form_program.program_id,
    //     form_program.gl_coa,
    //     form_program.gl_coa_segment,
    //     form_program.kode_area,
    //     form_program.sku_total_cost,
    //     arc_program.program_id,
    //     arc_program.nama_program,
    //     gl_account.gl_coa,
    //     gl_account.gl_coa_desc,
    //     arc_area.kode_area,
    //     arc_area.nama_area,
    //     form_budget_program.gl_coa_segment,
    //     form_budget_program.sku_total_saldo,
    //     arc_distributor.kode_area,
    //     arc_distributor.kode_distributor
    //     ');
    //     $this->datatables->from('form_program');
    //     $this->datatables->join('arc_program', 'form_program.program_id = arc_program.program_id');
    //     $this->datatables->join('gl_account', 'form_program.gl_coa = gl_account.gl_coa');
    //     $this->datatables->join('arc_area', 'form_program.kode_area = arc_area.kode_area');
    //     $this->datatables->join('form_budget_program', 'form_program.no_p3 = form_budget_program.no_p3');
    //     $this->datatables->join('arc_distributor', 'form_program.kode_area = arc_distributor.kode_area', 'left');
    //     $this->datatables->where('arc_distributor.kode_distributor', $kode_distributor);
    //     $this->datatables->where('form_program.status =', 1);
    //     $this->datatables->add_column('action', anchor(site_url('form_claim/create/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"> Klaim</i>', array('class' => 'btn btn-warning btn-sm')) . " 
    //             ", 'form_id');
    //     return $this->datatables->generate();
    // }

    // datatables
    function json_program()
    {
        $kode_distributor = $this->session->userdata('kode_distributor');
        $this->datatables->select('
        form_promotion.promotion_id,
        form_promotion.promotion_number,
        form_promotion.promotion_name,
        arc_channel.channel_name,
        arc_region.nama_region,
        arc_area.nama_area,
        arc_store.store_name,
        form_promotion.total_listing_cost,
        form_promotion.total_on_top_promo,
        form_promotion.total_trading_term,
        form_promotion_budget.promotion_total_cost,
        form_promotion_budget.promotion_total_usage,
        form_promotion_budget.promotion_total_saldo,
        arc_distributor.kode_distributor,
        arc_distributor.nama_distributor
        ');
        $this->datatables->from('form_promotion');
        $this->datatables->join('form_promotion_budget', 'form_promotion.promotion_number = form_promotion_budget.promotion_number', 'left');
        $this->datatables->join('arc_channel', 'form_promotion.channel_code = arc_channel.channel_code', 'left');
        $this->datatables->join('arc_region', 'form_promotion.region_code = arc_region.region_code', 'left');
        $this->datatables->join('arc_area', 'form_promotion.kode_area = arc_area.kode_area', 'left');
        $this->datatables->join('arc_store', 'form_promotion.store_code = arc_store.store_code', 'left');
        $this->datatables->join('arc_distributor', 'form_promotion.kode_area = arc_distributor.kode_area', 'left'); 
        $this->datatables->where('form_promotion.`status` =', 4);
        $this->datatables->where('arc_distributor.kode_distributor', $kode_distributor);
        $this->datatables->group_by('form_promotion.promotion_number');
        $this->datatables->add_column('action', anchor(site_url('form_claim/create/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"> Klaim</i>', array('class' => 'btn btn-warning btn-sm')) . " 
                ", 'promotion_id');
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
    function total_rows($q = NULL)
    {
        $this->db->like('claim_id', $q);
        $this->db->or_like('kode_distributor', $q);
        $this->db->or_like('nama_distributor', $q);
        $this->db->or_like('tgl_klaim', $q);
        $this->db->or_like('no_p3', $q);
        $this->db->or_like('program_id', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->or_like('claim_dpp', $q);
        $this->db->or_like('claim_ppn', $q);
        $this->db->or_like('claim_pph', $q);
        $this->db->or_like('total_claim', $q);
        $this->db->or_like('faktur_pajak', $q);
        $this->db->or_like('npwp', $q);
        $this->db->or_like('Pemohon', $q);
        $this->db->or_like('SecLogDate', $q);
        $this->db->or_like('SecLogUser', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('claim_id', $q);
        $this->db->or_like('kode_distributor', $q);
        $this->db->or_like('nama_distributor', $q);
        $this->db->or_like('tgl_klaim', $q);
        $this->db->or_like('no_p3', $q);
        $this->db->or_like('program_id', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->or_like('claim_dpp', $q);
        $this->db->or_like('claim_ppn', $q);
        $this->db->or_like('claim_pph', $q);
        $this->db->or_like('total_claim', $q);
        $this->db->or_like('faktur_pajak', $q);
        $this->db->or_like('npwp', $q);
        $this->db->or_like('Pemohon', $q);
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

    function get_p3()
    {

        $kode_distributor = $this->session->userdata('email');
        $this->db->select('form_program.no_p3,
                            form_program.kode_area,
                            form_program.region_id,
							arc_distributor.kode_distributor,
							arc_distributor.kode_area');
        $this->db->from('form_program');
        $this->db->join('arc_distributor', 'form_program.kode_area = arc_distributor.kode_area', 'left');
        $this->db->where('arc_distributor.kode_distributor', $kode_distributor);
        $query = $this->db->get();
        return $query;
    }

    function get_program($id)
    {
        $this->db->select('form_promotion.promotion_id,
        form_promotion.promotion_number,
        form_promotion.promotion_name,
        arc_channel.channel_name,
        arc_region.nama_region,
        arc_area.nama_area,
        arc_store.store_name,
        form_promotion.total_listing_cost,
        form_promotion.total_on_top_promo,
        form_promotion.total_trading_term,
        form_promotion_budget.promotion_total_cost,
        form_promotion_budget.promotion_total_usage,
        form_promotion_budget.promotion_total_saldo,
        form_promotion.kode_perusahaan,
        form_promotion.date_create,
        form_promotion.periode_awal,
        form_promotion.periode_akhir,
        form_promotion.kode_departemen,
        form_promotion.promotion_period,
        form_promotion.fiscal_year,
        form_promotion.channel_code,
        form_promotion.region_code,
        form_promotion.kode_area,
        form_promotion.store_code,
        form_promotion.sales_background,
        form_promotion.sales_strategy,
        form_promotion.sales_objective,
        form_promotion.sales_mechanism,
        form_promotion.`status`,
        form_promotion.pemohon,
        form_promotion.total_product_baseline,
        form_promotion.total_product_incremental,
        form_promotion.approval_scheme,
        form_promotion.upload_file,
        form_promotion.upload_activity,
        form_promotion.SecLogUser,
        form_promotion.SecLogDate,
        arc_distributor.kode_distributor,
        arc_distributor.nama_distributor,
        arc_distributor.npwp', FALSE);
        $this->db->join('form_promotion_budget', 'form_promotion.promotion_number = form_promotion_budget.promotion_number', 'left');
        $this->db->join('arc_channel', 'form_promotion.channel_code = arc_channel.channel_code', 'left');
        $this->db->join('arc_region', 'form_promotion.region_code = arc_region.region_code', 'left');
        $this->db->join('arc_area', 'form_promotion.kode_area = arc_area.kode_area', 'left');
        $this->db->join('arc_store', 'form_promotion.store_code = arc_store.store_code', 'left');
        $this->datatables->join('arc_distributor', 'form_promotion.kode_area = arc_distributor.kode_area', 'left'); 
        $this->db->where('form_promotion.promotion_id', $id);
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
    }

    /* BUAT NOMOR URUT */
    public function buat_kode()
    {
        $this->db->select('LEFT(form_claim.no_claim,3) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('form_claim');
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

    /* DATA BUDGET PROGRAM */
    function get_budget_program($promotion_number)
    {
        $this->db->select('*', FALSE);
        $this->db->where('promotion_number', $promotion_number);
        // $this->db->limit(1);
        $query = $this->db->get('form_promotion_budget');
        $data = $query->row();
        return $data;
    }

    // update budget usage
    function update_usage($promotion_number, $data)
    {
        $this->db->where('promotion_number', $promotion_number);
        $this->db->update('form_promotion_budget', $data);
    }

    /* GET APPROVAL SHCEME */
	// function get_approval($region_code)
	// {
	// 	$this->db->select('DISTINCT approval_scheme, id_user_level, id_users', FALSE);
	// 	$region_id = array($region_code, 0);
	// 	$this->db->where_in('region_id', $region_id);
	// 	$query = $this->db->get('approval_claim');
	// 	$data = $query->result_array();
	// 	return $data;
    // }

    /* GET APPROVAL SHCEME */
	function get_approval($kode_distributor)
	{
        $id_user_level = array('7','8','9','10','11');
		$this->db->select('DISTINCT approval_scheme, id_user_level, id_users', FALSE);
        $this->db->where('kode_distributor', $kode_distributor);
        $this->db->or_where_in('id_user_level', $id_user_level);
        $this->db->order_by('approval_scheme', 'ASC');
		$query = $this->db->get('approval_claim');
		$data = $query->result_array();
		return $data;
    }
    
    /* Get Region ID */
    function get_region($promotion_number)
    {
        $this->db->select('*', TRUE);
        $this->db->where('promotion_number', $promotion_number);
        $query = $this->db->get('form_promotion');
        $data = $query->row();
        return $data;
    }

    // insert Workflow Claim
	function insert_wf_claim($insertArray)
	{
		$this->db->insert_batch('wf_claim', $insertArray);
	}
}
