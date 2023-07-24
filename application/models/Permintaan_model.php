<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permintaan_model extends CI_Model
{

    public $table = 'eesemka_permintaan';
    public $id = 'id';
    public $idperusahaan = 'id_perusahaan';
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

    function get_allsiswa($id = null)
    {
        $this->db->where($this->idperusahaan,$id);
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
	// $this->db->or_like('nama', $q);
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
	// $this->db->or_like('nama', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

     // get data with limit and search
     function get_limit_data_user($limit, $start = 0, $q = NULL, $id=null) {
        $this->db->where('id_siswa',$id);
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
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

}
