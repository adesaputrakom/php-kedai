<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Pengguna_model');
        $this->load->library(array('form_validation'));
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "Admin") {


            $d['pengguna'] = $this->Pengguna_model->tampil_data();
            $this->load->view('admin/profil', $d);
        } else {
            redirect('app/logout');
        }
    }
}