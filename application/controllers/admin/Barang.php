<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Barang_model');
        $this->load->library(array('form_validation'));
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "Admin") {


            $d['barang'] = $this->Barang_model->tampil_data();
            $this->load->view('admin/barang/data_barang', $d);
        } else {
            redirect('app/logout');
        }
    }

    public function tambah()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "Admin") {
            $d['id_param'] = "";
            $d['barang'] = "";
            $d['harga'] = "";
            $d['satuan'] = "";

            $d['st'] = "tambah";

            $this->load->view('admin/barang/tambah', $d);
        } else {
            redirect('admin/barang');
        }
    }

    public function hapus($id)
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $this->Barang_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger background-danger" role="alert"> 
            Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="mdi mdi-close-circle"></i></button></div>');

            redirect(site_url('admin/barang'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger background-danger" role="alert"> 
                Data tidak ditemukan <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="mdi mdi-close-circle"></i></button></div>');

            redirect(site_url('admin/barang'));
        }
    }

    public function simpan()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "Admin") {

            $this->form_validation->set_rules('barang', 'Barang', 'trim|required');

            $id['id'] = $this->input->post("id_param");
            $st_frame = $this->input->post("frame");

            if ($this->form_validation->run() == FALSE) {
                $st = $this->input->post('st');

                if ($st == "tambah") {
                    $d['id_param'] = "";
                    $d['barang'] = "";
                    $d['harga'] = "";
                    $d['satuan'] = "";

                    $d['st'] = "tambah";

                    $this->db->get('tb_barang');

                    $this->load->view('admin/barang/tambah', $d);
                }
            } else {
                $st = $this->input->post('st');
                if ($st == "tambah") {
                    $in['barang'] = $this->input->post('barang');
                    $in['harga'] = $this->input->post('harga');
                    $in['satuan'] = $this->input->post('satuan');

                    $this->db->insert("tb_barang", $in);

                    $this->session->set_flashdata('message', '<div class="alert alert-success background-success" role="alert"> 
                    Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="mdi mdi-close-circle"></i></button></div>');

                    redirect('admin/barang');
                }
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success background-success" role="alert"> 
            Data Gagal ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="mdi mdi-close-circle"></i></button></div>');

            redirect('admin/barang');
        }
    }

    public function edit()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "Admin") {
            $id['id'] = $this->uri->segment(4);
            $q = $this->db->get_where("tb_barang", $id);
            $d = array();
            foreach ($q->result() as $dt) {

                $d['id_param'] = $dt->id;
                $d['barang'] = $dt->barang;
                $d['harga'] = $dt->harga;
                $d['satuan'] = $dt->satuan;

            }

            $d['st'] = "edit";

            $this->load->view('admin/barang/edit', $d);
        } else {
            redirect('admin/barang');
        }
    }

    public function simpan_ubah()

    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "Admin") {

            $id['id'] = $this->input->post("id_param");

            $st = $this->input->post('st');
            if ($st == "edit") {
                $upd['barang'] = $this->input->post('barang');
                $upd['harga'] = $this->input->post('harga');
                $upd['satuan'] = $this->input->post('satuan');

                $this->db->update("tb_barang", $upd, $id);

                $this->session->set_flashdata('message', '<div class="alert alert-success background-success" role="alert"> 
                Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="mdi mdi-close-circle"></i></button></div>');

                redirect('admin/barang');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger background-danger" role="alert"> 
                Data Gagal diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="mdi mdi-close-circle"></i></button></div>');

            redirect('admin/barang');
        }
    }
}
