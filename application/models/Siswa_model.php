<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa_model extends CI_Model
{

    public $table = 'eesemka_siswa';
    public $id = 'id';
    public $id_sekolah = 'id_sekolah';
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

    // get allsekolah
    function get_allsekolah($id=null)
    {
        $this->db->where($this->id_sekolah, $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
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
        $this->db->or_like('nama_siswa', $q);
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
        $this->db->or_like('nama_siswa', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    function get_limit_data_user($limit, $start = 0, $q = NULL, $idsekolah = NULL) {
       $this->db->where($this->id_sekolah,$idsekolah);
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('nama_siswa', $q);
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
