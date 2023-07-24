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
		$per_hal = $this->input->post('per_hal');
		if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
		$ses_hal = $this->session->userdata('perhal');
		$config['base_url'] = site_url('/admin/lowongan');
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->Lowongan_model->get_count();
		$config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
		$config['full_tag_open'] = '<div class="pagination__numbers">';
		$config['full_tag_close'] = '</div>';
	
		$this->pagination->initialize($config);
		$limit = $config['per_page'];
		$offset = html_escape($this->input->get('per_page'));
		$cari = html_escape($this->input->get('s'));
		
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
