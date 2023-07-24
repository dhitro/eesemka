<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lowongan_model extends CI_Model
{

    public $table = 'eesemka_lowongan';
    public $tablef = 'eesemka_posisi_lowongan';
    public $tablef2 = 'eesemka_posisi';
    public $tablef3 = 'eesemka_lamaran';
    public $tablef4 = 'eesemka_perusahaan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    // get all posisi
    function get_allposisi($id)
    {
        $this->db->where("$this->table.$this->id", $id);
        // $this->db->order_by($this->id, $this->order);
        return $this->db
        ->join($this->tablef,"$this->tablef.id_lowongan = $this->table.id")
        ->join($this->tablef2,"$this->tablef.id_posisi = $this->tablef2.id")
        ->get($this->table)->result();
    }

    // get all lamaran
    function get_alllamaran($id)
    {
        $this->db->where("$this->table.$this->id", $id);
        // $this->db->order_by($this->id, $this->order);
        return $this->db
        ->join($this->tablef,"$this->tablef3.id_lowongan = $this->table.id")
        ->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }


    // get data by id
    function get_perusahaan_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->join($this->tablef4,"$this->table.id_perusahaan = $this->tablef4.id");
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
        $this->db->or_like('nama_lowongan', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_count()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('nama_lowongan', $q);
        // $this->db->or_like('persyaratan', $q);
        // $this->db->or_like('deskripsi', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

     // get data with limit and search
     function get_limit_data_user($limit, $start = 0, $q = NULL, $id=null) {
        $this->db->where('id_perusahaan',$id);
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();
        return $last_id; 
       
    }
    function lastid()
    {
        $this->db->insert_id;
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
