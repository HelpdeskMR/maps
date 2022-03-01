<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_area extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_area_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','arc_area/arc_area_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Arc_area_model->json();
    }

    public function read($id) 
    {
        $row = $this->Arc_area_model->get_by_id($id);
        if ($row) {
            $data = array(
		'area_id' => $row->area_id,
		'kode_area' => $row->kode_area,
		'nama_area' => $row->nama_area,
		'region_id' => $row->region_id,
	    );
            $this->template->load('template','arc_area/arc_area_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_area'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_area/create_action'),
	    'area_id' => set_value('area_id'),
	    'kode_area' => set_value('kode_area'),
	    'nama_area' => set_value('nama_area'),
	    'region_id' => set_value('region_id'),
	);
        $this->template->load('template','arc_area/arc_area_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_area' => $this->input->post('kode_area',TRUE),
		'nama_area' => $this->input->post('nama_area',TRUE),
		'region_id' => $this->input->post('region_id',TRUE),
	    );

            $this->Arc_area_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_area'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_area_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_area/update_action'),
		'area_id' => set_value('area_id', $row->area_id),
		'kode_area' => set_value('kode_area', $row->kode_area),
		'nama_area' => set_value('nama_area', $row->nama_area),
		'region_id' => set_value('region_id', $row->region_id),
	    );
            $this->template->load('template','arc_area/arc_area_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_area'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('area_id', TRUE));
        } else {
            $data = array(
		'kode_area' => $this->input->post('kode_area',TRUE),
		'nama_area' => $this->input->post('nama_area',TRUE),
		'region_id' => $this->input->post('region_id',TRUE),
	    );

            $this->Arc_area_model->update($this->input->post('area_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_area'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_area_model->get_by_id($id);

        if ($row) {
            $this->Arc_area_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_area'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_area'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_area', 'kode area', 'trim|required');
	$this->form_validation->set_rules('nama_area', 'nama area', 'trim|required');
	$this->form_validation->set_rules('region_id', 'region id', 'trim|required');

	$this->form_validation->set_rules('area_id', 'area_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "arc_area.xls";
        $judul = "arc_area";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Area");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Area");
	xlsWriteLabel($tablehead, $kolomhead++, "Region Id");

	foreach ($this->Arc_area_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_area);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_area);
	    xlsWriteNumber($tablebody, $kolombody++, $data->region_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Arc_area.php */
/* Location: ./application/controllers/Arc_area.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-20 15:58:07 */
/* http://harviacode.com */