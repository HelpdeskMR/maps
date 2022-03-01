<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_region extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_region_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','arc_region/arc_region_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Arc_region_model->json();
    }

    public function read($id) 
    {
        $row = $this->Arc_region_model->get_by_id($id);
        if ($row) {
            $data = array(
		'region_id' => $row->region_id,
		'nama_region' => $row->nama_region,
		'nama_rsm' => $row->nama_rsm,
		'secloguser' => $row->secloguser,
		'seclogdate' => $row->seclogdate,
	    );
            $this->template->load('template','arc_region/arc_region_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_region'));
        }
    }

    public function create() 
    {
        $secloguser = $this->session->userdata('full_name'); 
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_region/create_action'),
            'region_id' => set_value('region_id'),
            'nama_region' => set_value('nama_region'),
            'rsm_id' => set_value('rsm_id'),
            'secloguser' => set_value('secloguser'),
            'seclogdate' => set_value('seclogdate'),
	);
        $this->template->load('template','arc_region/arc_region_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_region' => $this->input->post('nama_region',TRUE),
		'rsm_id' => $this->input->post('rsm_id',TRUE),
		'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name'),
	    );

            $this->Arc_region_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_region'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_region_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_region/update_action'),
		'region_id' => set_value('region_id', $row->region_id),
		'nama_region' => set_value('nama_region', $row->nama_region),
		'rsm_id' => set_value('rsm_id', $row->rsm_id),
		'secloguser' => set_value('secloguser', $row->secloguser),
		'seclogdate' => set_value('seclogdate', $row->seclogdate),
	    );
            $this->template->load('template','arc_region/arc_region_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_region'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('region_id', TRUE));
        } else {
            $data = array(
		'nama_region' => $this->input->post('nama_region',TRUE),
		'rsm_id' => $this->input->post('rsm_id',TRUE),
		'SecLogDate' => date('Y-m-d H:i:s'),
					'SecLogUser' => $this->session->userdata('full_name'),
	    );

            $this->Arc_region_model->update($this->input->post('region_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_region'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_region_model->get_by_id($id);

        if ($row) {
            $this->Arc_region_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_region'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_region'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_region', 'nama region', 'trim|required');
	$this->form_validation->set_rules('rsm_id', 'rsm id', 'trim|required');
	
	$this->form_validation->set_rules('region_id', 'region_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "arc_region.xls";
        $judul = "arc_region";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Region");
	xlsWriteLabel($tablehead, $kolomhead++, "Rsm Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Secloguser");
	xlsWriteLabel($tablehead, $kolomhead++, "Seclogdate");

	foreach ($this->Arc_region_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_region);
	    xlsWriteNumber($tablebody, $kolombody++, $data->rsm_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->secloguser);
	    xlsWriteLabel($tablebody, $kolombody++, $data->seclogdate);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Arc_region.php */
/* Location: ./application/controllers/Arc_region.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-20 15:29:21 */
/* http://harviacode.com */