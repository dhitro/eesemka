<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongankerja extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->library('uuid');
    $this->load->library('pagination');
    $this->load->model([
      
      'Lowongan_model'
    ]);
  }

	
	public function index()
	{
		$lowongan = $this->Lowongan_model->get_limit_data($limit, $offset, $cari);
		$data = array(
			'title' => 'E-Esemka - Lowongan Kerja',
			'data' => $lowongan,
		  );
        $this->template->load('template_front', 'frontend/lowongankerja', $data);

	}

	public function details($id=null)
	{
		$data = array(
            'title' => 'Lowongan Kerja | SMK Siap Kerja'
        );
        $this->template->load('template_front', 'frontend/singleloker', $data);
		
	}

	public function detail($id)
	{
		$row = $this->Lowongan_model->get_by_id($id);
		if ($row) {
		$data = array(
			'title' => 'E-Esemka - '.$row->nama_lowongan,
			'id' => $row->id,
			'nama_lowongan' => $row->nama_lowongan,
			'deskripsi' => $row->deskripsi,
			'persyaratan' => $row->persyaratan,
			'status' => $row->status,
		);
		$this->template->load('template_front', 'frontend/singleloker', $data);
		} else {
		$this->session->set_flashdata('message', 'Record Not Found');
		redirect(site_url('admin/lowongan'));
		}
	}
	
}
