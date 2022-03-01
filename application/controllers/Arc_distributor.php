<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arc_distributor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Arc_distributor_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','arc_distributor/arc_distributor_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Arc_distributor_model->json();
    }

    public function read($id) 
    {
        $row = $this->Arc_distributor_model->get_by_id($id);
        if ($row) {
            $data = array(
		'distributor_id' => $row->distributor_id,
		'kode_distributor' => $row->kode_distributor,
		'nama_distributor' => $row->nama_distributor,
		'email' => $row->email,
		'kode_area' => $row->kode_area,
		'secloguser' => $row->secloguser,
		'seclogdate' => $row->seclogdate,
	    );
            $this->template->load('template','arc_distributor/arc_distributor_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_distributor'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arc_distributor/create_action'),
            'distributor_id' => set_value('distributor_id'),
            'kode_distributor' => set_value('kode_distributor'),
            'nama_distributor' => set_value('nama_distributor'),
            'email' => set_value('email'),
            'kode_area' => set_value('kode_area'),
            'secloguser' => set_value('secloguser'),
            'seclogdate' => set_value('seclogdate'),
	);
        $this->template->load('template','arc_distributor/arc_distributor_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_distributor' => $this->input->post('kode_distributor',TRUE),
		'nama_distributor' => $this->input->post('nama_distributor',TRUE),
		'email' => $this->input->post('email',TRUE),
		'kode_area' => $this->input->post('kode_area',TRUE),
		'SecLogUser' => $this->session->userdata('full_name'),
		'SecLogDate' => date('Y-m-d H:i:s'),
	    );

            $this->Arc_distributor_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arc_distributor'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arc_distributor_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arc_distributor/update_action'),
		'distributor_id' => set_value('distributor_id', $row->distributor_id),
		'kode_distributor' => set_value('kode_distributor', $row->kode_distributor),
		'nama_distributor' => set_value('nama_distributor', $row->nama_distributor),
		'email' => set_value('email', $row->email),
		'kode_area' => set_value('kode_area', $row->kode_area),
		'secloguser' => set_value('secloguser', $row->secloguser),
		'seclogdate' => set_value('seclogdate', $row->seclogdate),
	    );
            $this->template->load('template','arc_distributor/arc_distributor_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_distributor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('distributor_id', TRUE));
        } else {
            $data = array(
		'kode_distributor' => $this->input->post('kode_distributor',TRUE),
		'nama_distributor' => $this->input->post('nama_distributor',TRUE),
		'email' => $this->input->post('email',TRUE),
		'kode_area' => $this->input->post('kode_area',TRUE),
		'SecLogUser' => $this->session->userdata('full_name'),
		'SecLogDate' => date('Y-m-d H:i:s'),
	    );

            $this->Arc_distributor_model->update($this->input->post('distributor_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arc_distributor'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arc_distributor_model->get_by_id($id);

        if ($row) {
            $this->Arc_distributor_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arc_distributor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arc_distributor'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_distributor', 'kode distributor', 'trim|required');
	$this->form_validation->set_rules('nama_distributor', 'nama distributor', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('kode_area', 'kode area', 'trim|required');
	$this->form_validation->set_rules('secloguser', 'secloguser', 'trim|required');
	$this->form_validation->set_rules('seclogdate', 'seclogdate', 'trim|required');

	$this->form_validation->set_rules('distributor_id', 'distributor_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "arc_distributor.xls";
        $judul = "arc_distributor";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Distributor");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Distributor");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Area");
	xlsWriteLabel($tablehead, $kolomhead++, "Secloguser");
	xlsWriteLabel($tablehead, $kolomhead++, "Seclogdate");

	foreach ($this->Arc_distributor_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_distributor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_distributor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_area);
	    xlsWriteLabel($tablebody, $kolombody++, $data->secloguser);
	    xlsWriteLabel($tablebody, $kolombody++, $data->seclogdate);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Arc_distributor.php */
/* Location: ./application/controllers/Arc_distributor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-20 10:54:21 */
/* http://harviacode.com */