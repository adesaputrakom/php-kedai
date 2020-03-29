<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Barang_model');
        $this->load->helper('kedai_helper');
        $this->load->library(array('form_validation'));
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "User") {


            $d['barang'] = $this->Barang_model->tampil_data();
            $this->load->view('user/home', $d);
        } else {
            redirect('app/logout');
        }
    }
}