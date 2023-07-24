<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->library('upload');
      $this->load->library('uuid');
      $this->load->model([
        'Sekolah_model',
        'Siswa_model',
        'Perusahaan_model',
        'Bdperusahaan_model',
        'Lowongan_model',
        'Posisi_model',
        'PsLowongan_model',
        'Swpengalaman_model',
        'File_model',
        'Lamaran_model',
        'Permintaan_model',
        'User_model'
      ]);
      is_logged_in();
    }
    
	public function index()
	{
        $data = array(
            'title' => 'Perusahaan Member Area'
        );
        $this->template->load('template', 'Perusahaan/dashboard', $data);
	}

  public function profile()
  {

    $uper = $this->session->userdata('user_id');
    
    $row = $this->Perusahaan_model->get_by_id($uper);

    $data = array(
      'title' => 'Admin Area - Detail Perusahaan',
      'id' => $row->id,
      'uper' => $uper,
      'nama_perusahaan' => $row->nama_perusahaan,
      'alamat' => $row->alamat,
      'jumlah_karyawan' => $row->jumlah_karyawan,
      'deskripsi' => $row->deskripsi,
      'id_user' => $row->id_user,
    );
    $this->template->load('template', 'Perusahaan/profile', $data);
    
  }

  public function profile_update()
  {

    $uper = $this->session->userdata('user_id');
    
    $row = $this->Perusahaan_model->get_by_id($uper);

    $data = array(
      'title' => 'Admin Area - Form Data Perusahaan',
      'button' => 'Update',
      'action' => site_url('perusahaan/perusahaan_update_action'),
      'id' => set_value('id', $row->id),
      'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
      'alamat' => set_value('alamat', $row->alamat),
      'jumlah_karyawan' => set_value('jumlah_karyawan', $row->jumlah_karyawan),
      'deskripsi' => set_value('deskripsi', $row->deskripsi),
      'id_user' => set_value('id_user', $row->id_user),
      'uuid' => set_value('uuid', $row->uuid),
    );
    $this->template->load('template', 'Perusahaan/profile_update', $data);
    
  }

  public function perusahaan_update_action()
  {
    $this->perusahaan_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->profile_update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'nama_perusahaan' => $this->input->post('nama_perusahaan', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'jumlah_karyawan' => $this->input->post('jumlah_karyawan', TRUE),
        'deskripsi' => $this->input->post('deskripsi', TRUE),
        'id_user' => $this->input->post('id_user', TRUE),
      );

      $this->Perusahaan_model->update($this->input->post('id', TRUE), $data);
      $fileuploaded = array();
      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['foto'], $this->input->post('id', TRUE), 6, 'foto[]');
      endif;

      $bidang_list = $this->input->post('bidang_list');
      $this->Bdperusahaan_model->delete_perusahaan($this->input->post('id', TRUE));
      if (!empty($bidang_list)) :
        foreach ($bidang_list as $bidang) :
          $datab = array(
            'id_perusahaan' => $this->input->post('id', TRUE),
            'id_bidang' => $bidang,
          );
          $this->Bdperusahaan_model->insert($datab);
        endforeach;
      endif;

      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('perusahaan/profile'));
    }
  }

  public function perusahaan_rules()
  {
    $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
    $this->form_validation->set_rules('jumlah_karyawan', 'Jumlah Karyawan', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }
}
