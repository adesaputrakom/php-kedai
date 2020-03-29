<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();

        $this->load->helper('kedai_helper');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "Admin") {

        	$d['barang'] = $this->db->query("select * from tb_barang order by id DESC LIMIT 10");
            $this->load->view('admin/home',$d);
        } else {
            redirect('app/logout');
        }
    }
}
