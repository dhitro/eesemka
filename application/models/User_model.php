<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{

    public $table = 'eesemka_user';
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

    // get all
    function get_all_by_level($id=null,$id2=null)
    {
        $this->db->where('id_level',$id);
        $this->db->or_where('id_level',$id2);
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
        $this->db->or_like('username', $q);
        $this->db->or_like('firstname', $q);
        $this->db->or_like('lastname', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('phone', $q);
        $this->db->or_like('facebook', $q);
        $this->db->or_like('instagram', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('username', $q);
        $this->db->or_like('firstname', $q);
        $this->db->or_like('lastname', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('phone', $q);
        $this->db->or_like('facebook', $q);
        $this->db->or_like('instagram', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    public function get_count()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
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
