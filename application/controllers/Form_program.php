<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Form_program extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Form_program_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->library('session');
	}

	public function index()
	{
		$this->template->load('template', 'form_program/form_program_list');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Form_program_model->json();
	}

	public function read($id)
	{
		$row = $this->Form_program_model->get_by_id($id);
		if ($row) {
			$data = array(
				'form_id' => $row->form_id,
				'jenis_form' => $row->jenis_form,
				'kode_perusahaan' => $row->kode_perusahaan,
				'kode_departemen' => $row->kode_departemen,
				'gl_coa' => $row->gl_coa,
				'gl_coa_desc' => $row->gl_coa_desc,
				'gl_coa_segment' => $row->gl_coa_segment,
				'tgl_pengajuan' => $row->tgl_pengajuan,
				'no_p3' => $row->no_p3,
				'kode_area' => $row->kode_area,
				'nama_area' => $row->nama_area,
				'region_id' => $row->region_id,
				'nama_region' => $row->nama_region,
				'program_id' => $row->program_id,
				'nama_program' => $row->nama_program,
				'brand' => $row->brand,
				'latar_belakang_promo' => $row->latar_belakang_promo,
				'tujuan_promo' => $row->tujuan_promo,
				'jumlah_outlet' => $row->jumlah_outlet,
				'tipe_outlet' => $row->tipe_outlet,
				'periode_awal' => $row->periode_awal,
				'periode_akhir' => $row->periode_akhir,
				'mekanisme_promo' => $row->mekanisme_promo,
				'sku_avg_sales_unit' => $row->sku_avg_sales_unit,
				'sku_avg_sales_amount' => $row->sku_avg_sales_amount,
				'sku_target_sales_unit' => $row->sku_target_sales_unit,
				'sku_target_sales_amount' => $row->sku_target_sales_amount,
				'sku_growth' => $row->sku_growth,
				'sku_total_cost' => $row->sku_total_cost,
				'sku_cost_ratio' => $row->sku_cost_ratio,
				'estimasi_biaya' => $row->estimasi_biaya,
				'charging_cost' => $row->charging_cost,
				'pemohon' => $row->pemohon,
				'SecLogUser' => $row->SecLogUser,
				'SecLogDate' => $row->SecLogDate,
			);
			$this->template->load('template', 'form_program/form_program_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_program'));
		}
	}

	public function create()
	{
		// $dataregion = $this->Form_program_model->get_region()->result();
		$data = array(
			'button' => 'Create',
			'action' => site_url('form_program/create_action'),
			'form_id' => set_value('form_id'),
			'kode_departemen' => set_value('kode_departemen'),
			'gl_coa' => set_value('gl_coa'),
			'tgl_pengajuan' => set_value('tgl_pengajuan'),
			'region_id' => set_value('region_id'),
			'kode_area' => set_value('kode_area'),
			'program_id' => set_value('program_id'),
			'brand' => set_value('brand'),
			'latar_belakang_promo' => set_value('latar_belakang_promo'),
			'tujuan_promo' => set_value('tujuan_promo'),
			'jumlah_outlet' => set_value('jumlah_outlet'),
			'tipe_outlet' => set_value('tipe_outlet'),
			'periode_awal' => set_value('periode_awal'),
			'periode_akhir' => set_value('periode_akhir'),
			'mekanisme_promo' => set_value('mekanisme_promo'),
			'sku_avg_sales_unit' => set_value('sku_avg_sales_unit'),
			'sku_avg_sales_amount' => set_value('sku_avg_sales_amount'),
			'sku_target_sales_unit' => set_value('sku_target_sales_unit'),
			'sku_target_sales_amount' => set_value('sku_target_sales_amount'),
			'sku_growth' => set_value('sku_growth'),
			'sku_total_cost' => set_value('sku_total_cost'),
			'sku_cost_ratio' => set_value('sku_cost_ratio'),
			'estimasi_biaya' => set_value('estimasi_biaya'),
			'charging_cost' => set_value('charging_cost'),
		);
		$this->template->load('template', 'form_program/form_program_form', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$InputKodePerusahaan = '01';
			$kode_departemen = $this->input->post('kode_departemen', TRUE);
			$InputGlCoa = $this->input->post('gl_coa', TRUE);
			$gl_coa_segment = $InputKodePerusahaan . "-" . $kode_departemen . "-" . $InputGlCoa;
			$kode_area = $this->input->post('kode_area', TRUE);
			$kode = $this->Form_program_model->buat_kode();
			$alias_dept = $this->Form_program_model->get_dept($kode_departemen);
			$bulan = date("m");
			$tahun = date("Y");
			$no_fp3 = $kode . "/" . $alias_dept . "/" . $kode_area . "/" . $bulan . "/" . $tahun;

			$data = array(
				'jenis_form' => 'PROGRAM',
				'kode_perusahaan' => $InputKodePerusahaan,
				'kode_departemen' => $kode_departemen,
				'gl_coa' => $InputGlCoa,
				'gl_coa_segment' => $gl_coa_segment,
				'tgl_pengajuan' => $this->input->post('tgl_pengajuan', TRUE),
				'no_p3' => $no_fp3,
				'kode_area' => $this->input->post('kode_area', TRUE),
				'region_id' => $this->input->post('region_id', TRUE),
				'program_id' => $this->input->post('program_id', TRUE),
				'brand' => $this->input->post('brand', TRUE),
				'latar_belakang_promo' => $this->input->post('latar_belakang_promo', TRUE),
				'tujuan_promo' => $this->input->post('tujuan_promo', TRUE),
				'jumlah_outlet' => $this->input->post('jumlah_outlet', TRUE),
				'tipe_outlet' => $this->input->post('tipe_outlet', TRUE),
				'periode_awal' => $this->input->post('periode_awal', TRUE),
				'periode_akhir' => $this->input->post('periode_akhir', TRUE),
				'mekanisme_promo' => $this->input->post('mekanisme_promo', TRUE),
				'sku_avg_sales_unit' => $this->input->post('sku_avg_sales_unit', TRUE),
				'sku_avg_sales_amount' => $this->input->post('sku_avg_sales_amount', TRUE),
				'sku_target_sales_unit' => $this->input->post('sku_target_sales_unit', TRUE),
				'sku_target_sales_amount' => $this->input->post('sku_target_sales_amount', TRUE),
				'sku_growth' => $this->input->post('sku_growth', TRUE),
				'sku_total_cost' => $this->input->post('sku_total_cost', TRUE),
				'sku_cost_ratio' => $this->input->post('sku_cost_ratio', TRUE),
				'estimasi_biaya' => $this->input->post('estimasi_biaya', TRUE),
				'charging_cost' => $this->input->post('charging_cost', TRUE),
				'pemohon' => $this->session->userdata('full_name'),
				'SecLogUser' => $this->session->userdata('full_name'),
				'SecLogDate' => date('Y-m-d H:i:s'),
			);
			$row = $this->Form_program_model->get_budget_amount($gl_coa_segment);
			$BudgetSaldo = $row->BudgetSaldo;

			if ($this->input->post('sku_total_cost') > $BudgetSaldo) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Over Budget Total Cost <b>Rp. ' . $this->input->post('sku_total_cost') . '</b>, Sisa Budget yang tersedia <b> Rp. ' . $BudgetSaldo . ' </b> <a href=' . site_url('form_program/create') . ' class="btn btn-info"> OK </a></div>');

				redirect('form_program/create');
			} else {

				$this->Form_program_model->insert($data);

				$row = $this->Form_program_model->get_budget_amount($gl_coa_segment);

				/* BUDGET USAGE */
				$BudgetUsage = $row->BudgetUsage;
				$TotalSku = $this->input->post('sku_total_cost');
				$TotalBudgetUsage = $BudgetUsage + $TotalSku;

				/* BUDGET SALDO */
				$BudgetSaldo = $row->BudgetSaldo;
				$TotalBudgetSaldo = $BudgetSaldo - $TotalSku;

				/* UPDATE MASTER BUDGET */
				$BudgetUsage = array(
					'BudgetUsage' => $TotalBudgetUsage,
					'BudgetSaldo' => $TotalBudgetSaldo,
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name'),
				);

				$this->Form_program_model->update_usage($gl_coa_segment, $BudgetUsage);

				/* CREATE BUDGET CLAIM */
				$BudgetProgram = array(
					'no_p3' => $no_fp3,
					'program_id' => $this->input->post('program_id', TRUE),
					'gl_coa' => $this->input->post('gl_coa', TRUE),
					'gl_coa_segment' => $gl_coa_segment,
					'sku_total_cost' => $this->input->post('sku_total_cost', TRUE),
					'sku_total_usage' => 0.00,
					'sku_total_saldo' => $this->input->post('sku_total_cost', TRUE),
					'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name'),
				);
				$this->Form_program_model->insert_budget($BudgetProgram);

				/* CREATE APPROVAL PROGRAM */

				$row = $this->Form_program_model->get_approval($kode_departemen);
				$SecLogDate = date('Y-m-d H:i:s');
				$SecLogUser = $this->session->userdata('full_name');
				$insertArray = array();

				foreach ($row as $data_program) {
					$new_add = array(
						'no_p3' => $no_fp3,
						'approval_scheme' => $data_program['approval_scheme'],
						'id_user_level' => $data_program['id_user_level'],
						'approve_by' => NULL,
						'approval_date' => NULL,
						'SecLogDate' => $SecLogDate,
						'SecLogUser' => $SecLogUser
					);

					array_push($insertArray, $new_add);
				}

				$this->Form_program_model->insert_wf_program($insertArray);

				$this->session->set_flashdata('message', 'Create Record Success 2');
				redirect(site_url('form_program'));
			}
		}
	}

	public function update($id)
	{
		$row = $this->Form_program_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('form_program/update_action'),
				'form_id' => set_value('form_id', $row->form_id),
				'kode_departemen' => set_value('kode_departemen', $row->kode_departemen),
				'gl_coa' => set_value('gl_coa', $row->gl_coa),
				'tgl_pengajuan' => set_value('tgl_pengajuan', $row->tgl_pengajuan),
				'no_p3' => set_value('no_p3', $row->no_p3),
				'kode_area' => set_value('kode_area', $row->kode_area),
				'region_id' => set_value('region_id', $row->region_id),
				'program_id' => set_value('program_id', $row->program_id),
				'brand' => set_value('brand', $row->brand),
				'latar_belakang_promo' => set_value('latar_belakang_promo', $row->latar_belakang_promo),
				'tujuan_promo' => set_value('tujuan_promo', $row->tujuan_promo),
				'jumlah_outlet' => set_value('jumlah_outlet', $row->jumlah_outlet),
				'tipe_outlet' => set_value('tipe_outlet', $row->tipe_outlet),
				'periode_awal' => set_value('periode_awal', $row->periode_awal),
				'periode_akhir' => set_value('periode_akhir', $row->periode_akhir),
				'mekanisme_promo' => set_value('mekanisme_promo', $row->mekanisme_promo),
				'sku_avg_sales_unit' => set_value('sku_avg_sales_unit', $row->sku_avg_sales_unit),
				'sku_avg_sales_amount' => set_value('sku_avg_sales_amount', $row->sku_avg_sales_amount),
				'sku_target_sales_unit' => set_value('sku_target_sales_unit', $row->sku_target_sales_unit),
				'sku_target_sales_amount' => set_value('sku_target_sales_amount', $row->sku_target_sales_amount),
				'sku_growth' => set_value('sku_growth', $row->sku_growth),
				'sku_total_cost' => set_value('sku_total_cost', $row->sku_total_cost),
				'sku_cost_ratio' => set_value('sku_cost_ratio', $row->sku_cost_ratio),
				'estimasi_biaya' => set_value('estimasi_biaya', $row->estimasi_biaya),
				'charging_cost' => set_value('charging_cost', $row->charging_cost),

			);
			$this->template->load('template', 'form_program/form_program_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_program'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('form_id', TRUE));
		} else {
			$data = array(
				'jenis_form' => $this->input->post('jenis_form', TRUE),
				'kode_perusahaan' => $this->input->post('kode_perusahaan', TRUE),
				'kode_departemen' => $this->input->post('kode_departemen', TRUE),
				'gl_coa' => $this->input->post('gl_coa', TRUE),
				'gl_coa_segment' => $this->input->post('gl_coa_segment', TRUE),
				'tgl_pengajuan' => $this->input->post('tgl_pengajuan', TRUE),
				'no_p3' => $this->input->post('no_p3', TRUE),
				'kode_area' => $this->input->post('kode_area', TRUE),
				'region_id' => $this->input->post('region_id', TRUE),
				'program_id' => $this->input->post('program_id', TRUE),
				'brand' => $this->input->post('brand', TRUE),
				'latar_belakang_promo' => $this->input->post('latar_belakang_promo', TRUE),
				'tujuan_promo' => $this->input->post('tujuan_promo', TRUE),
				'jumlah_outlet' => $this->input->post('jumlah_outlet', TRUE),
				'tipe_outlet' => $this->input->post('tipe_outlet', TRUE),
				'periode_awal' => $this->input->post('periode_awal', TRUE),
				'periode_akhir' => $this->input->post('periode_akhir', TRUE),
				'mekanisme_promo' => $this->input->post('mekanisme_promo', TRUE),
				'sku_avg_sales_unit' => $this->input->post('sku_avg_sales_unit', TRUE),
				'sku_avg_sales_amount' => $this->input->post('sku_avg_sales_amount', TRUE),
				'sku_target_sales_unit' => $this->input->post('sku_target_sales_unit', TRUE),
				'sku_target_sales_amount' => $this->input->post('sku_target_sales_amount', TRUE),
				'sku_growth' => $this->input->post('sku_growth', TRUE),
				'sku_total_cost' => $this->input->post('sku_total_cost', TRUE),
				'sku_cost_ratio' => $this->input->post('sku_cost_ratio', TRUE),
				'estimasi_biaya' => $this->input->post('estimasi_biaya', TRUE),
				'charging_cost' => $this->input->post('charging_cost', TRUE),
				'pemohon' => $this->session->userdata('full_name'),
				'SecLogUser' => $this->session->userdata('full_name'),
				'SecLogDate' => date('Y-m-d H:i:s'),
			);

			$this->Form_program_model->update($this->input->post('form_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('form_program'));
		}
	}

	public function delete($id)
	{
		$row = $this->Form_program_model->get_by_id($id);

		if ($row) {
			$this->Form_program_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('form_program'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_program'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('kode_departemen', 'kode departemen', 'trim|required');
		$this->form_validation->set_rules('gl_coa', 'gl coa', 'trim|required');
		$this->form_validation->set_rules('tgl_pengajuan', 'tgl pengajuan', 'trim|required');
		$this->form_validation->set_rules('kode_area', 'kode area', 'trim|required');
		$this->form_validation->set_rules('region_id', 'region id', 'trim|required');
		$this->form_validation->set_rules('program_id', 'program id', 'trim|required');
		$this->form_validation->set_rules('brand', 'brand', 'trim|required');
		$this->form_validation->set_rules('latar_belakang_promo', 'latar belakang promo', 'trim|required');
		$this->form_validation->set_rules('tujuan_promo', 'tujuan promo', 'trim|required');
		$this->form_validation->set_rules('jumlah_outlet', 'jumlah outlet', 'trim|required');
		$this->form_validation->set_rules('tipe_outlet', 'tipe outlet', 'trim|required');
		$this->form_validation->set_rules('periode_awal', 'periode awal', 'trim|required');
		$this->form_validation->set_rules('periode_akhir', 'periode akhir', 'trim|required');
		$this->form_validation->set_rules('mekanisme_promo', 'mekanisme promo', 'trim|required');
		$this->form_validation->set_rules('sku_avg_sales_unit', 'sku avg sales unit', 'trim|required');
		$this->form_validation->set_rules('sku_avg_sales_amount', 'sku avg sales amount', 'trim|required|numeric');
		$this->form_validation->set_rules('sku_target_sales_unit', 'sku target sales unit', 'trim|required');
		$this->form_validation->set_rules('sku_target_sales_amount', 'sku target sales amount', 'trim|required|numeric');
		$this->form_validation->set_rules('sku_growth', 'sku growth', 'trim|required|numeric');
		$this->form_validation->set_rules('sku_total_cost', 'sku total cost', 'trim|required|numeric');
		// $this->form_validation->set_rules('sku_cost_ratio', 'sku cost ratio', 'trim|required|numeric');
		// $this->form_validation->set_rules('estimasi_biaya', 'estimasi biaya', 'trim|required|numeric');
		// $this->form_validation->set_rules('charging_cost', 'charging cost', 'trim|required|numeric');

		$this->form_validation->set_rules('form_id', 'form_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "form_program.xls";
		$judul = "form_program";
		$tablehead = 0;
		$tablebody = 1;
		$nourut = 1;
		//penulisan header
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=" . $namaFile . "");
		header("Content-Transfer-Encoding: binary ");

		xlsBOF();

		$kolomhead = 0;
		xlsWriteLabel($tablehead, $kolomhead++, "No");
		xlsWriteLabel($tablehead, $kolomhead++, "Jenis Form");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Perusahaan");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Departemen");
		xlsWriteLabel($tablehead, $kolomhead++, "Gl Coa");
		xlsWriteLabel($tablehead, $kolomhead++, "Gl Coa Segment");
		xlsWriteLabel($tablehead, $kolomhead++, "Tgl Pengajuan");
		xlsWriteLabel($tablehead, $kolomhead++, "No P3");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Area");
		xlsWriteLabel($tablehead, $kolomhead++, "Region Id");
		xlsWriteLabel($tablehead, $kolomhead++, "Program Id");
		xlsWriteLabel($tablehead, $kolomhead++, "Brand");
		xlsWriteLabel($tablehead, $kolomhead++, "Latar Belakang Promo");
		xlsWriteLabel($tablehead, $kolomhead++, "Tujuan Promo");
		xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Outlet");
		xlsWriteLabel($tablehead, $kolomhead++, "Tipe Outlet");
		xlsWriteLabel($tablehead, $kolomhead++, "Periode Awal");
		xlsWriteLabel($tablehead, $kolomhead++, "Periode Akhir");
		xlsWriteLabel($tablehead, $kolomhead++, "Mekanisme Promo");
		xlsWriteLabel($tablehead, $kolomhead++, "Sku Avg Sales Unit");
		xlsWriteLabel($tablehead, $kolomhead++, "Sku Avg Sales Amount");
		xlsWriteLabel($tablehead, $kolomhead++, "Sku Target Sales Unit");
		xlsWriteLabel($tablehead, $kolomhead++, "Sku Target Sales Amount");
		xlsWriteLabel($tablehead, $kolomhead++, "Sku Growth");
		xlsWriteLabel($tablehead, $kolomhead++, "Sku Total Cost");
		xlsWriteLabel($tablehead, $kolomhead++, "Sku Cost Ratio");
		xlsWriteLabel($tablehead, $kolomhead++, "Estimasi Biaya");
		xlsWriteLabel($tablehead, $kolomhead++, "Charging Cost");
		xlsWriteLabel($tablehead, $kolomhead++, "Pemohon");
		xlsWriteLabel($tablehead, $kolomhead++, "SecLogUser");
		xlsWriteLabel($tablehead, $kolomhead++, "SecLogDate");

		foreach ($this->Form_program_model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->jenis_form);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_perusahaan);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_departemen);
			xlsWriteLabel($tablebody, $kolombody++, $data->gl_coa);
			xlsWriteLabel($tablebody, $kolombody++, $data->gl_coa_segment);
			xlsWriteLabel($tablebody, $kolombody++, $data->tgl_pengajuan);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_p3);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_area);
			xlsWriteNumber($tablebody, $kolombody++, $data->region_id);
			xlsWriteNumber($tablebody, $kolombody++, $data->program_id);
			xlsWriteLabel($tablebody, $kolombody++, $data->brand);
			xlsWriteLabel($tablebody, $kolombody++, $data->latar_belakang_promo);
			xlsWriteLabel($tablebody, $kolombody++, $data->tujuan_promo);
			xlsWriteLabel($tablebody, $kolombody++, $data->jumlah_outlet);
			xlsWriteLabel($tablebody, $kolombody++, $data->tipe_outlet);
			xlsWriteLabel($tablebody, $kolombody++, $data->periode_awal);
			xlsWriteLabel($tablebody, $kolombody++, $data->periode_akhir);
			xlsWriteLabel($tablebody, $kolombody++, $data->mekanisme_promo);
			xlsWriteNumber($tablebody, $kolombody++, $data->sku_avg_sales_unit);
			xlsWriteNumber($tablebody, $kolombody++, $data->sku_avg_sales_amount);
			xlsWriteNumber($tablebody, $kolombody++, $data->sku_target_sales_unit);
			xlsWriteNumber($tablebody, $kolombody++, $data->sku_target_sales_amount);
			xlsWriteNumber($tablebody, $kolombody++, $data->sku_growth);
			xlsWriteNumber($tablebody, $kolombody++, $data->sku_total_cost);
			xlsWriteNumber($tablebody, $kolombody++, $data->sku_cost_ratio);
			xlsWriteLabel($tablebody, $kolombody++, $data->estimasi_biaya);
			xlsWriteNumber($tablebody, $kolombody++, $data->charging_cost);
			xlsWriteLabel($tablebody, $kolombody++, $data->pemohon);
			xlsWriteLabel($tablebody, $kolombody++, $data->SecLogUser);
			xlsWriteLabel($tablebody, $kolombody++, $data->SecLogDate);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

	function get_area()
	{
		$region_id = $this->input->post('id', TRUE);
		$data = $this->Form_program_model->get_area($region_id)->result();
		echo json_encode($data);
	}

	function get_coa()
	{
		$kode_departemen = $this->input->post('id', TRUE);
		$data = $this->Form_program_model->get_coa($kode_departemen)->result();
		echo json_encode($data);
	}

	public function print($id)
	{
		$row = $this->Form_program_model->get_by_id($id);
		if ($row) {
			$data = array(
				'title' => 'Program Pengajuan Promosi',
				'form_id' => $row->form_id,
				'jenis_form' => $row->jenis_form,
				'kode_perusahaan' => $row->kode_perusahaan,
				'kode_departemen' => $row->kode_departemen,
				'gl_coa' => $row->gl_coa,
				'gl_coa_desc' => $row->gl_coa_desc,
				'gl_coa_segment' => $row->gl_coa_segment,
				'tgl_pengajuan' => $row->tgl_pengajuan,
				'no_p3' => $row->no_p3,
				'kode_area' => $row->kode_area,
				'nama_area' => $row->nama_area,
				'region_id' => $row->region_id,
				'nama_region' => $row->nama_region,
				'program_id' => $row->program_id,
				'nama_program' => $row->nama_program,
				'brand' => $row->brand,
				'latar_belakang_promo' => $row->latar_belakang_promo,
				'tujuan_promo' => $row->tujuan_promo,
				'jumlah_outlet' => $row->jumlah_outlet,
				'tipe_outlet' => $row->tipe_outlet,
				'periode_awal' => $row->periode_awal,
				'periode_akhir' => $row->periode_akhir,
				'mekanisme_promo' => $row->mekanisme_promo,
				'sku_avg_sales_unit' => $row->sku_avg_sales_unit,
				'sku_avg_sales_amount' => $row->sku_avg_sales_amount,
				'sku_target_sales_unit' => $row->sku_target_sales_unit,
				'sku_target_sales_amount' => $row->sku_target_sales_amount,
				'sku_growth' => $row->sku_growth,
				'sku_total_cost' => $row->sku_total_cost,
				'sku_cost_ratio' => $row->sku_cost_ratio,
				'estimasi_biaya' => $row->estimasi_biaya,
				'charging_cost' => $row->charging_cost,
				'SecLogUser' => $row->SecLogUser,
				'SecLogDate' => $row->SecLogDate,
			);
			// $this->template->load('form_program/form_program_print', $data);
			$this->load->view('form_program/form_program_print', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('form_program'));
		}
	}
}
