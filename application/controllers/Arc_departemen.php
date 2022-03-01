<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_departemen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_departemen_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','arc_departemen/arc_departemen_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Arc_departemen_model->json();
    }

    public function read($id) 
    {
        $row = $this->Arc_departemen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'dept_id' => $row->dept_id,
		'kode_departemen' => $row->kode_departemen,
		'nama_departemen' => $row->nama_departemen,
	    );
            $this->template->load('template','arc_departemen/arc_departemen_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_departemen'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_departemen/create_action'),
	    'dept_id' => set_value('dept_id'),
	    'kode_departemen' => set_value('kode_departemen'),
	    'nama_departemen' => set_value('nama_departemen'),
	);
        $this->template->load('template','arc_departemen/arc_departemen_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_departemen' => $this->input->post('kode_departemen',TRUE),
		'nama_departemen' => $this->input->post('nama_departemen',TRUE),
	    );

            $this->Arc_departemen_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_departemen'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_departemen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_departemen/update_action'),
		'dept_id' => set_value('dept_id', $row->dept_id),
		'kode_departemen' => set_value('kode_departemen', $row->kode_departemen),
		'nama_departemen' => set_value('nama_departemen', $row->nama_departemen),
	    );
            $this->template->load('template','arc_departemen/arc_departemen_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_departemen'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('dept_id', TRUE));
        } else {
            $data = array(
		'kode_departemen' => $this->input->post('kode_departemen',TRUE),
		'nama_departemen' => $this->input->post('nama_departemen',TRUE),
	    );

            $this->Arc_departemen_model->update($this->input->post('dept_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_departemen'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_departemen_model->get_by_id($id);

        if ($row) {
            $this->Arc_departemen_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_departemen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_departemen'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_departemen', 'kode departemen', 'trim|required');
	$this->form_validation->set_rules('nama_departemen', 'nama depertemen', 'trim|required');

	$this->form_validation->set_rules('dept_id', 'dept_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "arc_departemen.xls";
        $judul = "arc_departemen";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Departemen");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Depertemen");

	foreach ($this->Arc_departemen_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_departemen);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_departemen);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Arc_departemen.php */
/* Location: ./application/controllers/Arc_departemen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-20 05:38:53 */
/* http://harviacode.com */