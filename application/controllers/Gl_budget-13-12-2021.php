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
            if ($this->input->post('business_unit_id', TRUE) == NULL || $this->input->post('business_unit_id', TRUE) == '') {
                $data = array(
                    'kode_perusahaan' => $this->input->post('kode_perusahaan', TRUE),
                    'kode_departemen' => $this->input->post('kode_departemen', TRUE),
                    'channel_code' => $this->input->post('channel_code', TRUE),
                    'store_code' => $this->input->post('store_code', TRUE),
                    'region_id' => $this->input->post('region_id', TRUE),
                    'gl_coa' => $this->input->post('gl_coa', TRUE),
                    'gl_coa_segment' => $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('store_code', TRUE) . $this->input->post('region_id', TRUE) . "-" . $this->input->post('gl_coa', TRUE),
                    'YearPeriod' => $this->input->post('YearPeriod', TRUE),
                    'BudgetAmount' => $BudgetAmount,
                    'BudgetUsage' => 0.00,
                    'BudgetSaldo' => $BudgetAmount,
                    'is_aktif' => $this->input->post('is_aktif', TRUE),
                    'SecLogUser' => $this->session->userdata('full_name'),
                    'SecLogDate' => date('Y-m-d H:i:s'),
                );
            } else {
                $data = array(
                    'kode_perusahaan' => $this->input->post('kode_perusahaan', TRUE),
                    'business_unit_id' => $this->input->post('business_unit_id', TRUE),
                    'kode_departemen' => $this->input->post('kode_departemen', TRUE),
                    'channel_code' => $this->input->post('channel_code', TRUE),
                    'store_code' => $this->input->post('store_code', TRUE),
                    'region_id' => $this->input->post('region_id', TRUE),
                    'gl_coa' => $this->input->post('gl_coa', TRUE),
                    'gl_coa_segment' => $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $this->input->post('store_code', TRUE) . $this->input->post('region_id', TRUE) . "-" . $this->input->post('gl_coa', TRUE),
                    'YearPeriod' => $this->input->post('YearPeriod', TRUE),
                    'BudgetAmount' => $BudgetAmount,
                    'BudgetUsage' => 0.00,
                    'BudgetSaldo' => $BudgetAmount,
                    'is_aktif' => $this->input->post('is_aktif', TRUE),
                    'SecLogUser' => $this->session->userdata('full_name'),
                    'SecLogDate' => date('Y-m-d H:i:s'),
                );
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
        $store_code = $this->input->post('store_code', TRUE);
        $region_code = $this->input->post('region_id', TRUE);
        if($store_code == 0){
            $store_code = '';
        }
        if($region_code == 0){
            $region_code = '';
        }

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('budget_id', TRUE));
        } else {
            if ($this->input->post('business_unit_id', TRUE) == NULL || $this->input->post('business_unit_id', TRUE) == '') {
                if ($this->input->post('keterangan', TRUE) == NULL || $this->input->post('keterangan', TRUE) == '') {
                    $data = array(
                        'kode_perusahaan' => $this->input->post('kode_perusahaan', TRUE),
                        'kode_departemen' => $this->input->post('kode_departemen', TRUE),
                        'channel_code' => $this->input->post('channel_code', TRUE),
                        'store_code' => $this->input->post('store_code', TRUE),
                        'region_id' => $this->input->post('region_id', TRUE),
                        'gl_coa' => $this->input->post('gl_coa', TRUE),
                        'gl_coa_segment' => $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $store_code . $region_code . "-" . $this->input->post('gl_coa', TRUE),
                        'YearPeriod' => $this->input->post('YearPeriod', TRUE),
                        'BudgetAmount' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)),
                        'BudgetUsage' => $this->input->post('BudgetUsage', TRUE),
                        'BudgetSaldo' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)) - $this->input->post('BudgetUsage', TRUE),
                        'is_aktif' => $this->input->post('is_aktif', TRUE),
                        'SecLogUser' => $this->session->userdata('full_name'),
                        'SecLogDate' => date('Y-m-d H:i:s'),
                    );
                } else {
                    $data = array(
                        'kode_perusahaan' => $this->input->post('kode_perusahaan', TRUE),
                        'kode_departemen' => $this->input->post('kode_departemen', TRUE),
                        'channel_code' => $this->input->post('channel_code', TRUE),
                        'store_code' => $this->input->post('store_code', TRUE),
                        'region_id' => $this->input->post('region_id', TRUE),
                        'gl_coa' => $this->input->post('gl_coa', TRUE),
                        'gl_coa_segment' => $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $store_code . $region_code . "-" . $this->input->post('gl_coa', TRUE),
                        'YearPeriod' => $this->input->post('YearPeriod', TRUE),
                        'BudgetAmount' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)),
                        'BudgetUsage' => $this->input->post('BudgetUsage', TRUE),
                        'BudgetSaldo' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)) - $this->input->post('BudgetUsage', TRUE),
                        'is_aktif' => $this->input->post('is_aktif', TRUE),
                        'SecLogUser' => $this->session->userdata('full_name'),
                        'SecLogDate' => date('Y-m-d H:i:s'),
                    );

                    $row = $this->Gl_budget_model->get_by_id($this->input->post('budget_id', TRUE));
                    $history = array(
                        'keterangan' => $this->input->post('keterangan', TRUE),
                        'budget_id' => $this->input->post('budget_id', TRUE),
                        'gl_coa_segment' => $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $store_code . $region_code . "-" . $this->input->post('gl_coa', TRUE),
                        'previous_amount' => $row->BudgetAmount,
                        'lastest_amount' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)),
                        'SecLogUser' => $this->session->userdata('full_name'),
                        'SecLogDate' => date('Y-m-d H:i:s'),
                    );
                }
            } else {
                if ($this->input->post('keterangan', TRUE) == NULL || $this->input->post('keterangan', TRUE) == '') {
                    $data = array(
                        'kode_perusahaan' => $this->input->post('kode_perusahaan', TRUE),
                        'business_unit_id' => $this->input->post('business_unit_id', TRUE),
                        'kode_departemen' => $this->input->post('kode_departemen', TRUE),
                        'channel_code' => $this->input->post('channel_code', TRUE),
                        'store_code' => $this->input->post('store_code', TRUE),
                        'region_id' => $this->input->post('region_id', TRUE),
                        'gl_coa' => $this->input->post('gl_coa', TRUE),
                        'gl_coa_segment' => $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $store_code . $region_code . "-" . $this->input->post('gl_coa', TRUE),
                        'YearPeriod' => $this->input->post('YearPeriod', TRUE),
                        'BudgetAmount' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)),
                        'BudgetUsage' => $this->input->post('BudgetUsage', TRUE),
                        'BudgetSaldo' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)) - $this->input->post('BudgetUsage', TRUE),
                        'is_aktif' => $this->input->post('is_aktif', TRUE),
                        'SecLogUser' => $this->session->userdata('full_name'),
                        'SecLogDate' => date('Y-m-d H:i:s'),
                    );
                } else {
                    $data = array(
                        'kode_perusahaan' => $this->input->post('kode_perusahaan', TRUE),
                        'business_unit_id' => $this->input->post('business_unit_id', TRUE),
                        'kode_departemen' => $this->input->post('kode_departemen', TRUE),
                        'channel_code' => $this->input->post('channel_code', TRUE),
                        'store_code' => $this->input->post('store_code', TRUE),
                        'region_id' => $this->input->post('region_id', TRUE),
                        'gl_coa' => $this->input->post('gl_coa', TRUE),
                        'gl_coa_segment' => $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $store_code . $region_code . "-" . $this->input->post('gl_coa', TRUE),
                        'YearPeriod' => $this->input->post('YearPeriod', TRUE),
                        'BudgetAmount' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)),
                        'BudgetUsage' => $this->input->post('BudgetUsage', TRUE),
                        'BudgetSaldo' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)) - $this->input->post('BudgetUsage', TRUE),
                        'is_aktif' => $this->input->post('is_aktif', TRUE),
                        'SecLogUser' => $this->session->userdata('full_name'),
                        'SecLogDate' => date('Y-m-d H:i:s'),
                    );

                    $row = $this->Gl_budget_model->get_by_id($this->input->post('budget_id', TRUE));
                    $history = array(
                        'keterangan' => $this->input->post('keterangan', TRUE),
                        'budget_id' => $this->input->post('budget_id', TRUE),
                        'gl_coa_segment' => $this->input->post('kode_perusahaan', TRUE) . "-" . $this->input->post('business_unit_id', TRUE) . "-" . $this->input->post('kode_departemen', TRUE) . "-" . $this->input->post('channel_code', TRUE) . "-" . $store_code . $region_code . "-" . $this->input->post('gl_coa', TRUE),
                        'previous_amount' => $row->BudgetAmount,
                        'lastest_amount' => str_replace(".", "", $this->input->post('BudgetAmount', TRUE)),
                        'SecLogUser' => $this->session->userdata('full_name'),
                        'SecLogDate' => date('Y-m-d H:i:s'),
                    );
                }
            }
            $this->Gl_budget_model->update($this->input->post('budget_id', TRUE), $data);
            if ($this->input->post('keterangan', TRUE) != NULL || $this->input->post('keterangan', TRUE) != '') {
                $this->Gl_budget_model->insert_history($history);
            }
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
        $sheet->setCellValue('H1', "GL Coa");
        $sheet->setCellValue('I1', "GL Coa Name");
        $sheet->setCellValue('J1', "Year Period");
        $sheet->setCellValue('K1', "Budget Amount");
        $sheet->setCellValue('L1', "Budget Usage");
        $sheet->setCellValue('M1', "Budget Saldo");

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
            $sheet->setCellValue('H' . $numrow, $data->gl_coa);
            $sheet->setCellValue('I' . $numrow, $data->gl_coa_desc);
            $sheet->setCellValue('J' . $numrow, $data->YearPeriod);
            $sheet->setCellValue('K' . $numrow, $data->BudgetAmount);
            $sheet->setCellValue('L' . $numrow, $data->BudgetUsage);
            $sheet->setCellValue('M' . $numrow, $data->BudgetSaldo);

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

    function get_region()
    {
        $channel_code = $this->input->post('id', TRUE);
        $data = $this->Gl_budget_model->get_region($channel_code)->result();
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
                    $gl_coa = $sheetData[$i]['6'];
                    if ($store_code == 0) {
                        $gl_coa_segment = $sheetData[$i]['0'] . "-" . $sheetData[$i]['1'] . "-" . $sheetData[$i]['2'] . "-" . $sheetData[$i]['3'] . "-" . $sheetData[$i]['5'] . "-" . $sheetData[$i]['6'];
                    } else {
                        $gl_coa_segment = $sheetData[$i]['0'] . "-" . $sheetData[$i]['1'] . "-" . $sheetData[$i]['2'] . "-" . $sheetData[$i]['3'] . "-" . $sheetData[$i]['4'] . "-" . $sheetData[$i]['6'];
                    }
                    $YearPeriod = $sheetData[$i]['7'];
                    $BudgetAmount = $sheetData[$i]['8'];
                    $BudgetUsage = $sheetData[$i]['9'];
                    $BudgetSaldo = $sheetData[$i]['10'];
                    $SecLogUser = $this->session->userdata('full_name');
                    $SecLogDate = date('Y-m-d H:i:s');
                    $is_aktif = 'y';

                    $check = $this->Gl_budget_model->check_coa_segment($gl_coa_segment);
                    if ($check != 1) {
                        $resultData[] = array(
                            'kode_perusahaan' => $kode_perusahaan,
                            'business_unit_id' => $business_unit_id,
                            'kode_departemen' => $kode_departemen,
                            'channel_code' => $channel_code,
                            'store_code' => $store_code,
                            'region_id' => $region_id,
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
                    }
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
}
