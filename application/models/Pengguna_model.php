<?php

class Pengguna_model extends CI_Model
{

    public $table = 'tb_user';
    public $id = 'id_user';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function tampil_data()
    {
        return $this->db->get($this->table);
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function delete($id)
    {
        
        $row=$this->db->where($this->id, $id)->get($this->table)->row();

        if ($row->foto != ""){
        unlink("./assets/file_user/$row->foto");
        unlink("./assets/file_user/thumb/$row->foto");
        unlink("./assets/file_user/medium/$row->foto");

        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        }else{

        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        }
    }

    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }


    function ubah($data, $id_poli)
    {
        $this->db->where('id_poli', $id_poli);
        $this->db->update('tbl_poli', $data);
        return TRUE;
    }

    //    hitung jumlah total data
    function total_record()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    //    tampilkan dengan limit
    function user_limit($limit, $start = 0)
    {
        $this->db->order_by($this->id, 'DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table);
    }
}
