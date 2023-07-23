<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{

    public $table = 'eesemka_perusahaan';
    public $tablef = 'eesemka_bidang_perusahaan';
    public $tablef2 = 'eesemka_bidang';
    public $id = 'id';
    public $id_user = 'id_user';
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
    // get all
    function get_allbidang($id)
    {
        $this->db->where("$this->table.$this->id", $id);
        // $this->db->order_by($this->id, $this->order);
        return $this->db
        ->join($this->tablef,"$this->tablef.id_perusahaan = $this->table.id")
        ->join($this->tablef2,"$this->tablef.id_bidang = $this->tablef2.id")
        ->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function get_by_iduser($id)
    {
        $this->db->where($this->id_user, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
        $this->db->or_like('nama_perusahaan', $q);
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
        $this->db->or_like('nama_perusahaan', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('deskripsi', $q);
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
