<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PsLowongan_model extends CI_Model
{

    public $table = 'eesemka_posisi_lowongan';
    public $tablef = 'eesemka_posisi';
    public $id = 'id';
    public $idlowongan = 'id_lowongan';
    public $idposisi = 'id_posisi';
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

     // get all posisi lowongan
     function get_allposisi($id)
     {
        $this->db->where($this->idlowongan, $id);
        $this->db->join($this->tablef,"$this->tablef.$this->id = $this->table.$this->idposisi");
        //  $this->db->order_by($this->id, $this->order);
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
	$this->db->or_like('id_perusahaan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('id_perusahaan', $q);
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
     function delete_lowongan($id)
     {
         $this->db->where($this->idlowongan, $id);
         $this->db->delete($this->table);
     }

}
