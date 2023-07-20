<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_model extends CI_Model
{

    public $table = 'eesemka_file';
    public $id = 'id';
    public $id_siswa = 'id_siswa';
    public $id_tipefile = 'id_tipefile';

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
     function get_allsertifikat($id=null,$tipe)
     {
         $this->db->where([
            $this->id_siswa => $id,
            $this->id_tipefile => $tipe,
        ]);
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
     function get_by_idsiswa($id,$tipe)
     {
        $this->db->where([
            $this->id_siswa => $id,
            $this->id_tipefile => $tipe,
        ]);
         return $this->db->get($this->table)->row();
     }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('file_name', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('file_name', $q);
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

    function delete_sertifikat($id,$tipe)
    {
        $this->db->where([
            $this->id_siswa => $id,
            $this->id_tipefile => $tipe,
    ]);
        $this->db->delete($this->table);
    }

}
