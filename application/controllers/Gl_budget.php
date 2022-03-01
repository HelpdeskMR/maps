<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Gl_budget extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Gl_budget_model');
        $this->load->model('Promotion_header_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'gl_budget/gl_budget_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Gl_budget_model->json();
    }

    public function read($id)
    {
        $row = $this->Gl_budget_model->get_by_id($id);
        $history = $this->Gl_budget_model->get_history($id);
        $history_allocation = $this->Gl_budget_model->get_history_allocation($id);
        if ($row) {
            $data = array(
                'budget_id' => $row->budget_id,
                'kode_perusahaan' => $row->kode_perusahaan,
                'nama_perusahaan' => $row->nama_perusahaan,
                'business_unit_id' => $row->business_unit_id,
                'business_unit_name' => $row->business_unit_name,
                'kode_departemen' => $row->kode_departemen,
                'nama_departemen' => $row->nama_departemen,
                'channel_code' => $row->channel_code,
                'channel_name' => $row->channel_name,
                'store_code' => $row->store_code,
                'store_name' => $row->store_name,
                'region_id' => $row->region_id,
                'nama_region' => $row->nama_region,
                'brand_code' => $row->brand_code,
                'brand_name' => $row->brand_name,
                'series_code' => $row->series_code,
                'series_name' => $row->series_name,
                'gl_coa' => $row->gl_coa,
                'gl_coa_desc' => $row->gl_coa_desc,
                'gl_coa_segment' => $row->gl_coa_segment,
                'YearPeriod' => $row->YearPeriod,
                'BudgetAmount' => $row->BudgetAmount,
                'BudgetUsage' => $row->BudgetUsage,
                'BudgetSaldo' => $row->BudgetSaldo,
                'is_aktif' => $row->is_aktif,
                'SecLogUser' => $row->SecLogUser,
                'SecLogDate' => $row->SecLogDate,
                'history' => $history,
                'history_allocation' => $history_allocation,
            );
            $this->template->load('template', 'gl_budget/gl_budget_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gl_budget'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('gl_budget/create_action'),
            'budget_id' => set_value('budget_id'),
            'kode_perusahaan' => set_value('kode_perusahaan'),
            'business_unit_id' => set_value('business_unit_id'),
            'kode_departemen' => set_value('kode_departemen'),
            'channel_code' => set_value('channel_code'),
            'channel_name' => set_value(''),
            'store_name' => set_value(''),
            'store_code' => set_value('store_code'),
            'region_id' => set_value('region_id'),
            'region_name' => set_value(''),
            'brand_code' => set_value('brand_code'),
            'series_code' => set_value('series_code'),
            'brand_name' => set_value('brand_name'),
            'series_name' => set_value('series_name'),
            'gl_coa' => set_value('gl_coa'),
            'gl_coa_segment' => set_value('gl_coa_segment'),
            'YearPeriod' => set_value('YearPeriod'),
            'BudgetAmount' => set_value('BudgetAmount'),
            'BudgetUsage' => set_value('BudgetUsage'),
            'BudgetSaldo' => set_value('BudgetSaldo'),
            'is_aktif' => set_value('is_aktif'),
            'SecLogUser' => set_value('SecLogUser'),
            'SecLogDate' => set_value('SecLogDate'),
        );
        $this->template->load('template', 'gl_budget/gl_budget_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $BudgetAmount = str_replace(".", "", $this->input->post('BudgetAmount', TRUE));
            $data['kode_perusahaan'] = $this->input->post('kode_perusahaan', TRUE);
            $data['kode_departemen'] = $this->input->post('kode_departemen', TRUE);
            $data['channel_code'] = $this->input->post('channel_code', TRUE);
            $data['store_code'] = $this->input->post('store_code', TRUE);
            $data['region_id'] = $this->input->post('region_id', TRUE);
            $data['brand_code'] = $this->input->post('brand_code', TRUE);
            $data['series_code'] = $this->input->post('series_code', TRUE);
            $data['gl_coa'] = $this->input->post('gl_coa', TRUE);
            $data['YearPeriod'] = $this->input->post('YearPeriod', TRUE);
            $data['BudgetAmount'] = $BudgetAmount;
            $data['BudgetUsage'] = 0.00;
            $data['BudgetSaldo'] = $BudgetAmount;
            $data['is_aktif'] = $this->input->post('is_aktif', TRUE);
            $data['SecLogUser'] = $this->session->userdata('full_name');
            $data['SecLogDate'] = date('Y-m-d H:i:s');
            if ($this->input->post('business_unit_id', TRUE) == NULL || $this->input->post('business_unit_id', TRUE) == '') {
                if ($this->input->post('kode_departemen', TRUE) == '0306') {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('brand_code', TRUE) . "-" . $this->input->post('series_code', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                } elseif ($this->input->post('kode_departemen', TRUE) == '0306401' || $this->input->post('kode_departemen', TRUE) == '0308' || $this->input->post('kode_departemen', TRUE) == '0307' || $this->input->post('kode_departemen', TRUE) == '0303') {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                } else {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('store_code', TRUE) . $this->input->post('region_id', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                }
            } else {
                $data['business_unit_id'] = $this->input->post('business_unit_id', TRUE);
                if ($this->input->post('kode_departemen', TRUE) == '0306') {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('brand_code', TRUE) . "-" . $this->input->post('series_code', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                } elseif ($this->input->post('kode_departemen', TRUE) == '0306401' || $this->input->post('kode_departemen', TRUE) == '0308' || $this->input->post('kode_departemen', TRUE) == '0307' || $this->input->post('kode_departemen', TRUE) == '0303') {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                } else {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('store_code', TRUE) . $this->input->post('region_id', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                }
            }
            $this->Gl_budget_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('gl_budget'));
        }
    }

    public function update($id)
    {
        $row = $this->Gl_budget_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gl_budget/update_action'),
                'budget_id' => set_value('budget_id', $row->budget_id),
                'kode_perusahaan' => set_value('kode_perusahaan', $row->kode_perusahaan),
                'business_unit_id' => set_value('business_unit_id', $row->business_unit_id),
                'kode_departemen' => set_value('kode_departemen', $row->kode_departemen),
                'channel_code' => set_value('channel_code', $row->channel_code),
                'store_code' => set_value('store_code', $row->store_code),
                'region_id' => set_value('region_id', $row->region_id),
                'channel_name' => set_value('channel_name', $row->channel_name),
                'store_name' => set_value('store_name', $row->store_name),
                'region_name' => set_value('region_name', $row->nama_region),
                'brand_code' => set_value('brand_code', $row->brand_code),
                'series_code' => set_value('series_code', $row->series_code),
                'brand_name' => set_value('brand_name', $row->brand_name),
                'series_name' => set_value('series_name', $row->series_name),
                'gl_coa' => set_value('gl_coa', $row->gl_coa),
                'gl_coa_segment' => set_value('gl_coa_segment', $row->gl_coa_segment),
                'YearPeriod' => set_value('YearPeriod', $row->YearPeriod),
                'BudgetAmount' => set_value('BudgetAmount', str_replace(',', '.', number_format($row->BudgetAmount))),
                'BudgetUsage' => set_value('BudgetUsage', $row->BudgetUsage),
                'BudgetSaldo' => set_value('BudgetSaldo', $row->BudgetSaldo),
                'SecLogUser' => set_value('SecLogUser', $row->SecLogUser),
                'SecLogDate' => set_value('SecLogDate', $row->SecLogDate),
                'is_aktif' => set_value('is_aktif', $row->is_aktif),
            );
            $this->template->load('template', 'gl_budget/gl_budget_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gl_budget'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('budget_id', TRUE));
        } else {
            $data['kode_perusahaan'] = $this->input->post('kode_perusahaan', TRUE);
            $data['kode_departemen'] = $this->input->post('kode_departemen', TRUE);
            if($this->input->post('channel_code', TRUE) == 0) {
                $data['channel_code'] = '';
            } else {
                $data['channel_code'] = $this->input->post('channel_code', TRUE);
            }
            if($this->input->post('store_code', TRUE) == 0) {
                $data['store_code'] = '';
            } else {
                $data['store_code'] = $this->input->post('store_code', TRUE);
            }
            if($this->input->post('region_id', TRUE) == 0) {
                $data['region_id'] = '';
            } else {
                $data['region_id'] = $this->input->post('region_id', TRUE);
            }
            if($this->input->post('brand_code', TRUE) == 0) {
                $data['brand_code'] = '';
            } else {
                $data['brand_code'] = $this->input->post('brand_code', TRUE);
            }
            if($this->input->post('series_code', TRUE) == 0) {
                $data['series_code'] = '';
            } else {
                $data['series_code'] = $this->input->post('series_code', TRUE);
            }
            if($this->input->post('gl_coa', TRUE) == 0) {
                $data['gl_coa'] = '';
            } else {
                $data['gl_coa'] = $this->input->post('gl_coa', TRUE);
            }
            $data['YearPeriod'] = $this->input->post('YearPeriod', TRUE);
            $data['BudgetAmount'] = str_replace(".", "", $this->input->post('BudgetAmount', TRUE));
            $data['BudgetUsage'] = $this->input->post('BudgetUsage', TRUE);
            $data['BudgetSaldo'] = str_replace(".", "", $this->input->post('BudgetAmount', TRUE)) - $this->input->post('BudgetUsage', TRUE);
            $data['is_aktif'] = $this->input->post('is_aktif', TRUE);
            $data['SecLogUser'] = $this->session->userdata('full_name');
            $data['SecLogDate'] = date('Y-m-d H:i:s');

            if ($this->input->post('business_unit_id', TRUE) == NULL || $this->input->post('business_unit_id', TRUE) == '') {
                if ($this->input->post('kode_departemen', TRUE) == '0306') {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('brand_code', TRUE) . "-" . $this->input->post('series_code', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                } elseif ($this->input->post('kode_departemen', TRUE) == '0306401' || $this->input->post('kode_departemen', TRUE) == '0308' || $this->input->post('kode_departemen', TRUE) == '0307' || $this->input->post('kode_departemen', TRUE) == '0303') {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                } else {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('store_code', TRUE) . $this->input->post('region_id', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                }
            } else {
                $data['business_unit_id'] = $this->input->post('business_unit_id', TRUE);
                if ($this->input->post('kode_departemen', TRUE) == '0306') {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('brand_code', TRUE) . "-" . $this->input->post('series_code', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                } elseif ($this->input->post('kode_departemen', TRUE) == '0306401' || $this->input->post('kode_departemen', TRUE) == '0308' || $this->input->post('kode_departemen', TRUE) == '0307' || $this->input->post('kode_departemen', TRUE) == '0303') {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                } else {
                    $data['gl_coa_segment'] = $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('store_code', TRUE) . $this->input->post('region_id', TRUE) . "-" . $this->input->post('gl_coa', TRUE);
                }
            }

            if ($this->input->post('keterangan', TRUE) != NULL || $this->input->post('keterangan', TRUE) != '') {
                $row = $this->Gl_budget_model->get_by_id($this->input->post('budget_id', TRUE));
                $history = array(
                    'keterangan' => $this->input->post('keterangan', TRUE),
                    'budget_id' => $this->input->post('budget_id', TRUE),
                    'gl_coa_segment' => $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('brand_code', TRUE) . "-" . $this->input->post('series_code', TRUE) . "-" . $this->input->post('gl_coa', TRUE),
                    'previous_amount' => $row->BudgetAmount,
                    'lastest_amount' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)),
                    'SecLogUser' => $this->session->userdata('full_name'),
                    'SecLogDate' => date('Y-m-d H:i:s'),
                );
                $this->Gl_budget_model->insert_history($history);
            }

            $this->Gl_budget_model->update($this->input->post('budget_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('gl_budget'));
        }
    }

    public function delete($id)
    {
        $row = $this->Gl_budget_model->get_by_id($id);

        if ($row) {
            $this->Gl_budget_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('gl_budget'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gl_budget'));
        }
    }

    function switching_budget()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('gl_budget/action_switching_budget'),
            'kode_perusahaan' => set_value('kode_perusahaan'),
            'business_unit_id' => set_value('business_unit_id'),
            'kode_departemen' => set_value('kode_departemen'),
            'channel_code' => set_value('channel_code'),
            'channel_name' => set_value(''),
            'store_name' => set_value(''),
            'store_code' => set_value('store_code'),
            'region_id' => set_value('region_id'),
            'region_name' => set_value(''),
            'brand_code' => set_value('brand_code'),
            'series_code' => set_value('series_code'),
            'brand_name' => set_value(''),
            'series_name' => set_value(''),
            'gl_coa' => set_value('gl_coa'),
            'BudgetSaldo' => set_value('BudgetSaldo'),
            'amount' => set_value('amount'),
        );

        $this->template->load('template', 'gl_budget/switching_form', $data);
    }

    function action_switching_budget()
    {
        $code = $this->Gl_budget_model->get_code();
        $gl_coa_segment_from = $this->input->post('gl_coa_segment', TRUE);
        $gl_coa_segment_to = $this->input->post('gl_coa_segment_to', TRUE);
        $amount_allocation = str_replace(".", "", $this->input->post('amount_allocation', TRUE));

        $data = array(
            'date_create' => date('Y-m-d'),
            'allocation_code' => $code,
            'gl_coa_segment_from' => $gl_coa_segment_from,
            'gl_coa_segment_to' => $gl_coa_segment_to,
            'amount_allocation' => $amount_allocation,
            'status' => 0,
            'SecLogUser' => $this->session->userdata('full_name'),
            'SecLogDate' => date('Y-m-d H:i:s'),
        );

        $this->Gl_budget_model->insert_budgetAllocation($data);

        $data_wf = array(
            'allocation_code' => $code,
            'id_users' => 13,
            'id_user_level' => 9,
            'SecLogUser' => $this->session->userdata('full_name'),
            'SecLogDate' => date('Y-m-d H:i:s'),
        );

        $this->Gl_budget_model->insert_wfAllocation($data_wf);
        $this->send($data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('gl_budget'));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode_perusahaan', 'kode perusahaan', 'trim|required');
        $this->form_validation->set_rules('kode_departemen', 'kode departemen', 'trim|required');
        // $this->form_validation->set_rules('account_code', 'account code', 'trim|required');
        $this->form_validation->set_rules('gl_coa', 'gl coa', 'trim|required');
        // $this->form_validation->set_rules('gl_coa_segment', 'gl coa segment', 'trim|required');
        $this->form_validation->set_rules('YearPeriod', 'yearperiod', 'trim|required');
        $this->form_validation->set_rules('BudgetAmount', 'budgetamount', 'trim|required');
        // $this->form_validation->set_rules('BudgetUsage', 'budgetusage', 'trim|required|numeric');
        // $this->form_validation->set_rules('BudgetSaldo', 'budgetsaldo', 'trim|required|numeric');
        // $this->form_validation->set_rules('SecLogUser', 'secloguser', 'trim|required');
        // $this->form_validation->set_rules('SecLogDate', 'seclogdate', 'trim|required');

        $this->form_validation->set_rules('budget_id', 'budget_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("GL Budget");

        $styleArray = [
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
            ],
        ];

        $sheet->setCellValue('A1', "No");
        $sheet->setCellValue('B1', "Company Name");
        $sheet->setCellValue('C1', "Business Unit");
        $sheet->setCellValue('D1', "Department Name");
        $sheet->setCellValue('E1', "Channel Name");
        $sheet->setCellValue('F1', "Store Name");
        $sheet->setCellValue('G1', "Ragion Name");
        $sheet->setCellValue('H1', "Brand Name");
        $sheet->setCellValue('I1', "Series Name");
        $sheet->setCellValue('J1', "GL Coa");
        $sheet->setCellValue('K1', "GL Coa Name");
        $sheet->setCellValue('L1', "Year Period");
        $sheet->setCellValue('M1', "Budget Amount");
        $sheet->setCellValue('N1', "Budget Usage");
        $sheet->setCellValue('O1', "Budget Saldo");

        $sheet->getStyle('A1')->applyFromArray($styleArray);
        $sheet->getStyle('B1')->applyFromArray($styleArray);
        $sheet->getStyle('C1')->applyFromArray($styleArray);
        $sheet->getStyle('D1')->applyFromArray($styleArray);
        $sheet->getStyle('E1')->applyFromArray($styleArray);
        $sheet->getStyle('F1')->applyFromArray($styleArray);
        $sheet->getStyle('G1')->applyFromArray($styleArray);
        $sheet->getStyle('H1')->applyFromArray($styleArray);
        $sheet->getStyle('I1')->applyFromArray($styleArray);
        $sheet->getStyle('J1')->applyFromArray($styleArray);
        $sheet->getStyle('K1')->applyFromArray($styleArray);
        $sheet->getStyle('L1')->applyFromArray($styleArray);
        $sheet->getStyle('M1')->applyFromArray($styleArray);
        $sheet->getStyle('N1')->applyFromArray($styleArray);
        $sheet->getStyle('O1')->applyFromArray($styleArray);

        $promotion = $this->Gl_budget_model->get_all();

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($promotion as $data) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->nama_perusahaan);
            $sheet->setCellValue('C' . $numrow, $data->business_unit_name);
            $sheet->setCellValue('D' . $numrow, $data->nama_departemen);
            $sheet->setCellValue('E' . $numrow, $data->channel_name);
            $sheet->setCellValue('F' . $numrow, $data->store_name);
            $sheet->setCellValue('G' . $numrow, $data->nama_region);
            $sheet->setCellValue('H' . $numrow, $data->brand_name);
            $sheet->setCellValue('I' . $numrow, $data->series_name);
            $sheet->setCellValue('J' . $numrow, $data->gl_coa);
            $sheet->setCellValue('K' . $numrow, $data->gl_coa_desc);
            $sheet->setCellValue('L' . $numrow, $data->YearPeriod);
            $sheet->setCellValue('M' . $numrow, $data->BudgetAmount);
            $sheet->setCellValue('N' . $numrow, $data->BudgetUsage);
            $sheet->setCellValue('O' . $numrow, $data->BudgetSaldo);

            $sheet->getStyle('A' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('B' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('C' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('D' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('E' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('F' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('G' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('H' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('I' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('J' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('K' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('L' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('M' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('N' . $numrow)->applyFromArray($styleArray);
            $sheet->getStyle('O' . $numrow)->applyFromArray($styleArray);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);
        $sheet->getColumnDimension('L')->setWidth(20);
        $sheet->getColumnDimension('M')->setWidth(20);
        $sheet->getColumnDimension('N')->setWidth(20);
        $sheet->getColumnDimension('O')->setWidth(20);

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="GL Budget.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    function get_channel()
    {
        $kode_departemen = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_channel($kode_departemen)->result();
        echo json_encode($data);
    }

    function get_store()
    {
        $channel_code = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_store($channel_code)->result();
        echo json_encode($data);
    }

    function get_store_switching()
    {
        $channel_code = $this->input->post('id', TRUE);
		$kode_departemen = $this->input->post('kode_departemen', TRUE);
		$business_unit_id = $this->input->post('business_unit_id', TRUE);
        $data = $this->Gl_budget_model->get_store_switching($channel_code, $kode_departemen, $business_unit_id)->result();
        echo json_encode($data);
    }

    function get_region()
    {
        $channel_code = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_region($channel_code)->result();
        echo json_encode($data);
    }

    function get_region_switching()
    {
        $channel_code = $this->input->post('id', TRUE);
		$kode_departemen = $this->input->post('kode_departemen', TRUE);
		$business_unit_id = $this->input->post('business_unit_id', TRUE);
        $data = $this->Gl_budget_model->get_region_switching($channel_code, $kode_departemen, $business_unit_id)->result();
        echo json_encode($data);
    }

    function get_brand()
    {
        $kode_departemen = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_brand($kode_departemen)->result();
        echo json_encode($data);
    }

    function get_brand_switching()
    {
        $kode_departemen = $this->input->post('id', TRUE);
		$business_unit_id = $this->input->post('business_unit_id', TRUE);
        $data = $this->Gl_budget_model->get_brand_switching($kode_departemen, $business_unit_id)->result();
        echo json_encode($data);
    }

    function get_series()
    {
        $brand_code = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_series($brand_code)->result();
        echo json_encode($data);
    }

    function get_series_switching()
    {
        $brand_code = $this->input->post('id', TRUE);
		$business_unit_id = $this->input->post('business_unit_id', TRUE);
        $kode_departemen = $this->input->post('kode_departemen', TRUE);
        $data = $this->Gl_budget_model->get_series_switching($brand_code, $business_unit_id, $kode_departemen)->result();
        echo json_encode($data);
    }

    function get_coa_store_switching()
    {
        $gl_coa_segment = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_coa_store_switching($gl_coa_segment)->result();
        echo json_encode($data);
    }

    function get_coa_region_switching()
    {
        $gl_coa_segment = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_coa_region_switching($gl_coa_segment)->result();
        echo json_encode($data);
    }

    function get_coa_series_switching()
    {
        $gl_coa_segment = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_coa_series_switching($gl_coa_segment)->result();
        echo json_encode($data);
    }

    function get_balance()
    {
        $gl_coa_segment = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_balance($gl_coa_segment)->result();
        echo json_encode($data);
    }

    public function import()
    {
        $this->form_validation->set_rules('excel', 'File', 'trim|required');

        if ($_FILES['excel']['name'] == '') {
            $this->session->set_flashdata('message', 'File harus diisi');
        } else {
            $config['upload_path'] = './assets/excel/';
            $config['allowed_types'] = 'xls|xlsx';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('excel')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', $error);
            } else {
                $data = $this->upload->data();

                error_reporting(E_ALL);
                date_default_timezone_set('Asia/Jakarta');

                $inputFileName = './assets/excel/' . $data['file_name'];
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $objPHPExcel = $reader->load($inputFileName);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray();
                for ($i = 1; $i < count($sheetData); $i++) {
                    $kode_perusahaan = $sheetData[$i]['0'];
                    $business_unit_id = $sheetData[$i]['1'];
                    $kode_departemen = $sheetData[$i]['2'];
                    $channel_code = $sheetData[$i]['3'];
                    $store_code = $sheetData[$i]['4'];
                    $region_id = $sheetData[$i]['5'];
                    $brand_code = $sheetData[$i]['6'];
                    $series_code = $sheetData[$i]['7'];
                    $gl_coa = $sheetData[$i]['8'];
                    if ($kode_departemen == '0305') {
                        $gl_coa_segment = $sheetData[$i]['0'] . "-" . $sheetData[$i]['1'] . "-" . $sheetData[$i]['2'] . "-" . $sheetData[$i]['3'] . "-" . $sheetData[$i]['5'] . "-" . $sheetData[$i]['8'];
                    } elseif ($kode_departemen == '0312') {
                        $gl_coa_segment = $sheetData[$i]['0'] . "-" . $sheetData[$i]['1'] . "-" . $sheetData[$i]['2'] . "-" . $sheetData[$i]['3'] . "-" . $sheetData[$i]['4'] . "-" . $sheetData[$i]['8'];
                    } elseif ($kode_departemen == '0306') {
                        $gl_coa_segment = $sheetData[$i]['0'] . "-" . $sheetData[$i]['1'] . "-" . $sheetData[$i]['2'] . "-" . $sheetData[$i]['3'] . "-" . $sheetData[$i]['6'] . "-" . $sheetData[$i]['7'] . "-" . $sheetData[$i]['8'];
                    } elseif ($kode_departemen == '0306401' || $kode_departemen == '0308' || $kode_departemen == '0307' || $kode_departemen == '0303') {
                        $gl_coa_segment = $sheetData[$i]['0'] . "-" . $sheetData[$i]['1'] . "-" . $sheetData[$i]['2'] . "-" . $sheetData[$i]['3'] . "-" . $sheetData[$i]['8'];
                    }
                    $YearPeriod = $sheetData[$i]['9'];
                    $BudgetAmount = $sheetData[$i]['10'];
                    $BudgetUsage = $sheetData[$i]['11'];
                    $BudgetSaldo = $sheetData[$i]['12'];
                    $SecLogUser = $this->session->userdata('full_name');
                    $SecLogDate = date('Y-m-d H:i:s');
                    $is_aktif = 'y';

                    // $check = $this->Gl_budget_model->check_coa_segment($gl_coa_segment);
                    // if ($check != 1) {
                        $resultData[] = array(
                            'kode_perusahaan' => $kode_perusahaan,
                            'business_unit_id' => $business_unit_id,
                            'kode_departemen' => $kode_departemen,
                            'channel_code' => $channel_code,
                            'store_code' => $store_code,
                            'region_id' => $region_id,
                            'brand_code' => $brand_code,
                            'series_code' => $series_code,
                            'gl_coa' => $gl_coa,
                            'gl_coa_segment' => $gl_coa_segment,
                            'YearPeriod' => $YearPeriod,
                            'BudgetAmount' => $BudgetAmount,
                            'BudgetUsage' => $BudgetUsage,
                            'BudgetSaldo' => $BudgetSaldo,
                            'is_aktif' => $is_aktif,
                            'SecLogUser' => $SecLogUser,
                            'SecLogDate' => $SecLogDate,
                        );
                    // }
                }

                unlink('./assets/excel/' . $data['file_name']);

                if (count($resultData) != 0) {
                    $result = $this->Gl_budget_model->insert_batch($resultData);
                    if ($result > 0) {
                        $this->session->set_flashdata('message', 'Data Budget Berhasil di Import ke database');
                        redirect(site_url('gl_budget'));
                    }
                } else {
                    $this->session->set_flashdata('message', 'Data Budget Gagal di Import ke database (Data Sudah terupdate)');
                    redirect(site_url('gl_budget'));
                }
            }
        }
    }

    public function send($data)
	{
		//Load data
        $budgetAllocationFrom = $this->Gl_budget_model->get_dataAllocationFrom($data['allocation_code']);
        $budgetAllocationTo = $this->Gl_budget_model->get_dataAllocationTo($data['allocation_code']);
        $wfAllocation = $this->Gl_budget_model->get_wfAllocation($data['allocation_code']);
        $row_password = $this->Promotion_header_model->get_password_email();
		$password = $row_password->password;
		
        
        $message = '<div>
        <p>Yth. Bapak/Ibu Nur Risa Afriani Abas,<br/><br/>A request by Wulan Ambar has been submitted that requires your approval.</p>
      </div>
		<div>
        <p>The request detail : <a href="' . site_url() . 'wf_allocation/read/' . $wfAllocation->id . '">' . site_url() . 'wf_allocation/read/' . $wfAllocation->id . '</a>.</p>
	  </div>
	  <table border="1" bordercolor="#333333">
		<thead>
        <tr>
          <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">BUDGET ALLOCATION</font></b></td>
		</tr>
		</thead>
		<tbody>
        <tr>
          <td colspan="2" align="left" bgcolor="#3C8DBC" style="padding-left:20px; padding-right:20px;"><b><font color="#FFFFFF">FROM</font></b></td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Business Unit</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationFrom->business_unit_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Departemen</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationFrom->nama_departemen .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Channel</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationFrom->channel_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Store</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationFrom->store_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Region</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationFrom->nama_region .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Brand</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationFrom->brand_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Series</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationFrom->series_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Coa</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationFrom->gl_coa_desc .'</td>
        </tr>
        <tr>
          <td colspan="2" align="left" bgcolor="#3C8DBC" style="padding-left:20px; padding-right:20px;"><b><font color="#FFFFFF">TO</font></b></td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Business Unit</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationTo->business_unit_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Departemen</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationTo->nama_departemen .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Channel</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationTo->channel_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Store</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationTo->store_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Region</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationTo->nama_region .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Brand</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationTo->brand_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Series</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationTo->series_name .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Coa</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationTo->gl_coa_desc .'</td>
        </tr>
        <tr>
          <td style="padding-left:20px; padding-right:20px;">Amount Allocation</td>
		  <td style="padding-left:20px; padding-right:20px;">'. $budgetAllocationTo->amount_allocation .'</td>
        </tr>
		</tbody>
	  </table>';

		//Send Email
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'mustikaratu.mailer@gmail.com';
		$config['smtp_pass'] = $password;
		$config['mailtype'] = 'html';

		$this->load->library('email', $config);

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
		$this->email->from('mustikaratu.mailer@gmail.com', 'MAPS');
		// $this->email->to('risa.afriani@mustika-ratu.co.id');
		$this->email->bcc('development@mustika-ratu.co.id');
		$this->email->subject('Budget Allocation');
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		} else {
			$this->session->set_flashdata("email_sent", "Error in sending Email.");
			// show_error($this->email->print_debugger());
		}
	}
}
