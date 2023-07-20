<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Swpengalaman_model extends CI_Model
{

    public $table = 'eesemka_siswa_pengalaman';
    public $id = 'id';
    public $id_siswa = 'id_siswa';
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

     // get allpengalaman
     function get_allpengalaman($id=null)
     {
         $this->db->where($this->id_siswa, $id);
         $this->db->order_by($this->id, $this->order);
         return $this->db->get($this->table)->result();
     }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('id_siswa', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('id_siswa', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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

     // delete data
     function delete_pengalaman($id)
     {
         $this->db->where($this->id_siswa, $id);
         $this->db->delete($this->table);
     }

}
