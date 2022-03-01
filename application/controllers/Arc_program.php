<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_program extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_program_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','arc_program/arc_program_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Arc_program_model->json();
    }

    public function read($id) 
    {
        $row = $this->Arc_program_model->get_by_id($id);
        if ($row) {
            $data = array(
		'program_id' => $row->program_id,
		'nama_program' => $row->nama_program,
		'secloguser' => $row->secloguser,
		'seclogdate' => $row->seclogdate,
	    );
            $this->template->load('template','arc_program/arc_program_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_program'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_program/create_action'),
	    'program_id' => set_value('program_id'),
	    'nama_program' => set_value('nama_program'),
	    'secloguser' => set_value('secloguser'),
	    'seclogdate' => set_value('seclogdate'),
	);
        $this->template->load('template','arc_program/arc_program_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_program' => $this->input->post('nama_program',TRUE),
		'secloguser' => $this->input->post('secloguser',TRUE),
		'seclogdate' => $this->input->post('seclogdate',TRUE),
	    );

            $this->Arc_program_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_program'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_program_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_program/update_action'),
		'program_id' => set_value('program_id', $row->program_id),
		'nama_program' => set_value('nama_program', $row->nama_program),
		'secloguser' => set_value('secloguser', $row->secloguser),
		'seclogdate' => set_value('seclogdate', $row->seclogdate),
	    );
            $this->template->load('template','arc_program/arc_program_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_program'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('program_id', TRUE));
        } else {
            $data = array(
		'nama_program' => $this->input->post('nama_program',TRUE),
		'secloguser' => $this->input->post('secloguser',TRUE),
		'seclogdate' => $this->input->post('seclogdate',TRUE),
	    );

            $this->Arc_program_model->update($this->input->post('program_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_program'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_program_model->get_by_id($id);

        if ($row) {
            $this->Arc_program_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_program'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_program'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_program', 'nama program', 'trim|required');
	$this->form_validation->set_rules('secloguser', 'secloguser', 'trim|required');
	$this->form_validation->set_rules('seclogdate', 'seclogdate', 'trim|required');

	$this->form_validation->set_rules('program_id', 'program_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "arc_program.xls";
        $judul = "arc_program";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Program");
	xlsWriteLabel($tablehead, $kolomhead++, "Secloguser");
	xlsWriteLabel($tablehead, $kolomhead++, "Seclogdate");

	foreach ($this->Arc_program_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_program);
	    xlsWriteLabel($tablebody, $kolombody++, $data->secloguser);
	    xlsWriteLabel($tablebody, $kolombody++, $data->seclogdate);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Arc_program.php */
/* Location: ./application/controllers/Arc_program.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-20 12:04:42 */
/* http://harviacode.com */