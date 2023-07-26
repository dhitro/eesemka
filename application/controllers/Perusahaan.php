<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->library('upload');
      $this->load->library('uuid');
      $this->load->library('pagination');
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
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = base_url('/perusahaan/lowongan');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Lowongan_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    $q = array(
      'id_perusahaan' => $this->session->userdata('id_perusahaan'),
    
    );

    $uid = $this->session->userdata('user_id');

    $lamaran = $this->Lowongan_model->get_limit_data_done($limit, $offset, $q);

    $this->pagination->initialize($config);
    $data = array(
        'title' => 'Perusahaan Member Area',
        'data' => $lamaran,
        'ui' => $uid
    );
    $this->template->load('template', 'Perusahaan/dashboard', $data);
	}

  public function profile()
  {

    $uper = $this->session->userdata('user_id');
    
    $row = $this->Perusahaan_model->get_by_id($uper);

    $data = array(
      'title' => 'Perusahaan Area - Detail Perusahaan',
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
      'title' => 'Perusahaan Area - Form Data Perusahaan',
      'button' => 'Update',
      'action' => base_url('perusahaan/perusahaan_update_action'),
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
      redirect(base_url('perusahaan/profile'));
    }
  }

  public function perusahaan_rules()
  {
    $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
    $this->form_validation->set_rules('jumlah_karyawan', 'Jumlah Karyawan', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  // Module Permintaan
  public function permintaan()
  {
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = base_url('/perusahaan/permintaan');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Permintaan_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    
    $ss = $this->session->userdata('user_id');
    $sekolah = $this->Permintaan_model->get_limit_data_user($limit, $offset, $cari, $ss);


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Perusahaan Area - Data permintaan',
      'data' => $sekolah,
      'ini' => $ss,
      'actionadd' => base_url('perusahaan/permintaan_create'),
      'actionfilter' => base_url('perusahaan/permintaan'),
    );
    $this->template->load('template', 'Perusahaan/Permintaan/permintaan_list', $data);
  }

  public function permintaan_read($id)
  {
    $row = $this->Permintaan_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Perusahaan Area - Detail permintaan',
        'id' => $row->id,
        'id_lowongan' => $row->id_lowongan,
        'id_siswa' => $row->id_siswa,
        'keterangan' => $row->keterangan,
       
      );
      $this->template->load('template', 'Perusahaan/Permintaan/permintaan_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(base_url('perusahaan/permintaan'));
    }
  }

  public function permintaan_create($idsis = null)
  {

    $ss = $this->session->userdata('user_id');
    $row = $this->Permintaan_model->get_by_id($idsis);
    $mow = $this->Siswa_model->get_by_id($idsis);

    $data = array(
      'title' => 'Perusahaan Area - Tambah permintaan',
      'button' => 'Rekrut',
      'idsiswa' => $idsis,
      'idper' => $ss,
      'namasiswa' => $mow->nama_siswa,
      'action' => base_url('perusahaan/permintaan_create_action'),
      'id' => set_value('id'),
      'uuid' => set_value('uuid'),
      'id_perusahaan' => set_value('id_perusahaan'),
      'id_siswa' => set_value('id_siswa'),
      'keterangan' => set_value('keterangan'),
     
    );
    $this->template->load('template', 'Perusahaan/Permintaan/permintaan_form', $data);
  }

  public function permintaan_create_action()
  {
    $this->permintaan_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->permintaan_create();
    } else {
      $uuid = $this->uuid->v4();
      $data = array(
        'id_perusahaan' => $this->input->post('id_perusahaan', TRUE),
        'id_siswa' => $this->input->post('id_siswa', TRUE),
        'keterangan' => $this->input->post('keterangan', TRUE),
        'created_by' => $this->session->userdata('user_id'),
        'uuid' =>  $uuid,
      );

      $idlast =   $this->Permintaan_model->insert($data);

     $this->session->set_flashdata('message', 'Create Record Success');
      redirect(base_url('perusahaan/permintaan'));
    }
  }

  public function permintaan_update($id)
  {

    $row = $this->Permintaan_model->get_by_id($id);

    if ($row) {
      $data = array(
        'title' => 'Perusahaan Area - Form Data permintaan',
        'button' => 'Update',
        'action' => base_url('perusahaan/permintaan_update_action'),
        'id' => set_value('id', $row->id),
        'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
        'id_siswa' => set_value('id_siswa', $row->id_siswa),
        'keterangan' => set_value('keterangan', $row->keterangan),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Perusahaan/Permintaan/permintaan_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(base_url('perusahaan/permintaan'));
    }
  }

  public function permintaan_update_action()
  {
    $this->permintaan_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->permintaan_update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'id_perusahaan' => $this->input->post('id_perusahaan', TRUE),
        'id_siswa' => $this->input->post('id_siswa', TRUE),
        'keterangan' => $this->input->post('keterangan', TRUE),
      
      );

      $this->Permintaan_model->update($this->input->post('id', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(base_url('perusahaan/permintaan'));
    }
  }

  public function permintaan_approve()
  {
    $id = $this->input->post('id', TRUE);
    $val = $this->input->post('val', TRUE);
    $data = array(
      'status' => $val,
    );
    $this->Permintaan_model->update($id, $data);
  }


  public function permintaan_delete($id)
  {
    $row = $this->Permintaan_model->get_by_id($id);

    if ($row) {
      $this->Permintaan_model->delete($id);
      // $this->session->set_flashdata('message', 'Delete Record Success');
      // redirect(base_url('perusahaan/sekolah'));
    } else {
      // $this->session->set_flashdata('message', 'Record Not Found');
      // redirect(base_url('perusahaan/sekolah'));
    }
  }

  public function permintaan_rules()
  {
    $this->form_validation->set_rules('id_perusahaan', 'Nama Perusahaan', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  // Module Lamaran
  public function pelamar()
  {
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = base_url('/perusahaan/lamaran');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Lamaran_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    $uper = $this->session->userdata('user_id');

    $sekolah = $this->Lamaran_model->get_limit_data_user($limit, $offset, $cari, $uper);


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Perusahaan Area - Data Lamaran',
      'up' => $uper,
      'data' => $sekolah,
      'actionadd' => base_url('perusahaan/lamaran_create'),
      'actionfilter' => base_url('perusahaan/lamaran'),
    );
    $this->template->load('template', 'Perusahaan/Lamaran/lamaran_list', $data);
  }

  public function lamaran_read($id)
  {
    $row = $this->Siswa_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Admin Area - Detail Siswa',
        'nik' => $row->nik,
        'id' => $row->id,
        'nama_siswa' => $row->nama_siswa,
        'jenis_kelamin' => $row->jenis_kelamin,
        'alamat' => $row->alamat,
        'status' => $row->status,
        'deskripsi' => $row->deskripsi,
        'id_user' => $row->id_user,
      );
      $this->template->load('template', 'Perusahaan/Lamaran/lamaran_list', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(base_url('admin/siswa'));
    }
  }

  public function lamaran_approve()
  {
    $id = $this->input->post('id', TRUE);
    $val = $this->input->post('val', TRUE);
    $data = array(
      'status' => $val,
    );
    $this->Lamaran_model->update($id, $data);
  }

  public function lamaran_rules()
  {
    $this->form_validation->set_rules('id_lowongan', 'Nama Lowongan', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  // Module lowongan
  public function lowongan()
  {
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = base_url('/perusahaan/lowongan');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Lowongan_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    $uper = $this->session->userdata('user_id');

    $lowongan = $this->Lowongan_model->get_limit_data_user($limit, $offset, $cari, $uper);
    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Perusahaan Area - Data Lowongan',
      'data' => $lowongan,
      'uper' => $uper,
      'actionadd' => base_url('perusahaan/lowongan_create'),
      'actionfilter' => base_url('perusahaan/lowongan'),
    );
    $this->template->load('template', 'Perusahaan/Lowongan/lowongan_list', $data);
  }

  public function lowongan_read($id)
  {
    $row = $this->Lowongan_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Perusahaan Area - Detail Lowongan',
        'id' => $row->id,
        'nama_lowongan' => $row->nama_lowongan,
        'deskripsi' => $row->deskripsi,
        'persyaratan' => $row->persyaratan,
        'status' => $row->status,
      );
      $this->template->load('template', 'Perusahaan/Lowongan/lowongan_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(base_url('perusahaan/lowongan'));
    }
  }

  public function lowongan_create()
  {


    $uper = $this->session->userdata('user_id');

    $data = array(
      'title' => 'Perusahaan Area - Tambah Lowongan',
      'userper' => $uper,
      'button' => 'Create',
      'action' => base_url('perusahaan/lowongan_create_action'),
      'id' => set_value('id'),
      'id_perusahaan' => set_value('id_perusahaan'),
      'uuid' => set_value('uuid'),
      'nama_lowongan' => set_value('nama_lowongan'),
      'deskripsi' => set_value('deskripsi'),
      'persyaratan' => set_value('persyaratan'),
      'status' => set_value('status'),
    );
    $this->template->load('template', 'Perusahaan/Lowongan/lowongan_form', $data);
  }

  public function lowongan_create_action()
  {
    $this->lowongan_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->lowongan_create();
    } else {
      $uuid = $this->uuid->v4();
      $data = array(
        'id_perusahaan' => $this->input->post('id_perusahaan', TRUE),
        'nama_lowongan' => $this->input->post('nama_lowongan', TRUE),
        'deskripsi' => $this->input->post('deskripsi', TRUE),
        'persyaratan' => $this->input->post('persyaratan', TRUE),
        'status' => $this->input->post('status', TRUE),
        'uuid' => $uuid,
        'created_by' => $this->session->userdata('user_id'),
      );

      $idlast =  $this->Lowongan_model->insert($data);

      $fileuploaded = array();

      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $uuid, $_FILES['foto'], $idlast, 4, 'foto[]');
      endif;


      $posisi_list = $this->input->post('posisi_list');
      if (!empty($posisi_list)) :
        foreach ($posisi_list as $posisi) :
          $datab = array(
            'id_lowongan' =>  $idlast,
            'id_posisi' => $posisi,
          );
          $this->PsLowongan_model->insert($datab);
        endforeach;
      endif;


      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(base_url('perusahaan/lowongan'));
    }
  }

  public function lowongan_update($id)
  {

    $uper = $this->session->userdata('user_id');
    $row = $this->Lowongan_model->get_by_id($id);

    if ($row) {
      $data = array(
        'title' => 'Perusahaan Area - Form Data Lowongan',
        'button' => 'Update',
        'userper' => $uper,
        'action' => base_url('perusahaan/lowongan_update_action'),
        'id' => set_value('id', $row->id),
        'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
        'nama_lowongan' => set_value('nama_lowongan', $row->nama_lowongan),
        'deskripsi' => set_value('deskripsi', $row->deskripsi),
        'persyaratan' => set_value('persyaratan', $row->persyaratan),
        'status' => set_value('status', $row->status),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Perusahaan/Lowongan/lowongan_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(base_url('perusahaan/lowongan'));
    }
  }

  public function lowongan_update_action()
  {
    $this->lowongan_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->lowongan_update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'id_perusahaan' => $this->input->post('id_perusahaan', TRUE),
        'nama_lowongan' => $this->input->post('nama_lowongan', TRUE),
        'deskripsi' => $this->input->post('deskripsi', TRUE),
        'persyaratan' => $this->input->post('persyaratan', TRUE),
        'status' => $this->input->post('status', TRUE),

      );

      $update =  $this->Lowongan_model->update($this->input->post('id', TRUE), $data);
      $fileuploaded = array();
      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['foto'], $this->input->post('id', TRUE), 4, 'foto[]');
      endif;
      $posisi_list = $this->input->post('posisi_list');
      $this->PsLowongan_model->delete_lowongan($this->input->post('id', TRUE));
      $posisi_list = $this->input->post('posisi_list');
      if (!empty($posisi_list)) :
        foreach ($posisi_list as $posisi) :
          $datab = array(
            'id_lowongan' => $this->input->post('id', TRUE),
            'id_posisi' => $posisi,
          );
          $this->PsLowongan_model->insert($datab);
        endforeach;
      endif;
      if ($update) :
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(base_url('perusahaan/lowongan'));
      else :
        $this->session->set_flashdata('message', 'Error Record' . var_dump($this->db->error()));
        redirect(base_url('perusahaan/lowongan'));
      endif;
    }
  }

  public function lowongan_posisi(){
    $id=  $this->input->post('id', TRUE);
    $data =  $this->PsLowongan_model->get_allposisi($id);
    $this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
    
   }

  public function lowongan_approve()
  {
    $id = $this->input->post('id', TRUE);
    $val = $this->input->post('val', TRUE);
    $data = array(
      'status' => $val,
    );
    $this->Lowongan_model->update($id, $data);
  }


  public function lowongan_delete($id)
  {
    $row = $this->Lowongan_model->get_by_id($id);
    if ($row) {
      $this->Lowongan_model->delete($id);
    } else {
    }
  }

  public function lowongan_rules()
  {
    $this->form_validation->set_rules('nama_lowongan', 'Nama Lowongan', 'trim|required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }


  // Module Siswa
  public function siswa()
  {
    // $Siswa = $this->db->get('eesemka_Siswa')->result_array();
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = base_url('/perusahaan/siswa');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Siswa_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    $Siswa = $this->Siswa_model->get_limit_data($limit, $offset, $cari);


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Perusahaan Area - Data Siswa',
      'data' => $Siswa,
      'actionadd' => base_url('perusahaan/siswa_create'),
      'actionfilter' => base_url('perusahaan/siswa'),
    );
    $this->template->load('template', 'Perusahaan/siswa', $data);
  }

  public function siswa_profile($id)
  {
    $row = $this->Siswa_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Admin Area - Detail Siswa',
        'nik' => $row->nik,
        'id' => $row->id,
        'nama_siswa' => $row->nama_siswa,
        'jenis_kelamin' => $row->jenis_kelamin,
        'alamat' => $row->alamat,
        'status' => $row->status,
        'deskripsi' => $row->deskripsi,
        'id_user' => $row->id_user,
      );
      $this->template->load('template', 'Perusahaan/siswa_profile', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(base_url('admin/siswa'));
    }
  }

  public function siswa_approve()
  {
    $id = $this->input->post('id', TRUE);
    $val = $this->input->post('val', TRUE);
    $data = array(
      'is_valid' => $val,
    );
    $this->Siswa_model->update($id, $data);
  }

  

  public function siswa_rules()
  {
    $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'trim|required');
    $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
    $this->form_validation->set_rules('id_sekolah', 'Sekolah', 'trim|required');
    $this->form_validation->set_rules('status', 'Status Siswa', 'trim|required');
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  

}


