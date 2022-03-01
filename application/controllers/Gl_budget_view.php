<?php
date_default_timezone_set('Asia/Jakarta');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gl_budget_view extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Gl_budget_model');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'gl_budget/gl_budget_view');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Gl_budget_model->json_view();
    }
}
