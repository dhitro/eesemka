<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

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
        $data = array(
            'title' => 'Sekolah Member Area'
        );
        $this->template->load('template', 'Sekolah/dashboard', $data);
	}

  public function siswa()
  {
    // $Siswa = $this->db->get('eesemka_Siswa')->result_array();
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = site_url('/sekolah/siswa');
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
    $Siswa  = array_filter($Siswa, function ($row) {
      return ($row->id_sekolah == $this->session->userdata('id_sekolah'));
  });
  

    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Admin Area - Data Siswa',
      'data' => $Siswa,
      'actionadd' => site_url('sekolah/siswa_create'),
      'actionfilter' => site_url('sekolah/siswa'),
    );
    $this->template->load('template', 'Sekolah/Siswa/siswa_list', $data);
  }

 

 
  public function siswa_read($id)
  {
    $row = $this->Siswa_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Member Area - Detail Siswa',
        'nik' => $row->nik,
        'id' => $row->id,
        'nama_siswa' => $row->nama_siswa,
        'jenis_kelamin' => $row->jenis_kelamin,
        'alamat' => $row->alamat,
        'status' => $row->status,
        'deskripsi' => $row->deskripsi,
        'id_user' => $row->id_user,
      );
      $this->template->load('template', 'Sekolah/Siswa/siswa_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('sekolah/siswa'));
    }
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
      $this->template->load('template', 'Sekolah/Siswa/siswa_profile', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('sekolah/siswa'));
    }
  }

  public function siswa_create()
  {
    $data = array(
      'button' => 'Create',
      'title' => 'Member Area - Form Siswa',
      'action' => site_url('sekolah/siswa_create_action'),
      'actionadd' => site_url('sekolah/sekolah_create'),
      'actionfilter' => site_url('sekolah/sekolah'),
      'id' => set_value('id'),
      'uuid' => set_value('uuid'),
      'id_sekolah' => set_value('id_sekolah'),
      'nik' => set_value('nik'),
      'nama_siswa' => set_value('nama_siswa'),
      'jenis_kelamin' => set_value('jenis_kelamin'),
      'alamat' => set_value('alamat'),
      'status' => set_value('status'),
      'deskripsi' => set_value('deskripsi'),
      'id_user' => set_value('id_user'),
    );
    $this->template->load('template', 'Sekolah/Siswa/siswa_form', $data);
  }

  public function siswa_create_action()
  {
    $this->siswa_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->siswa_create();
    } else {
      $uuid = $this->uuid->v4();
      $data = array(
        'nik' => $this->input->post('nik', TRUE),
        'nama_siswa' => $this->input->post('nama_siswa', TRUE),
        'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'id_sekolah' => $this->input->post('id_sekolah', TRUE),
        'status' => $this->input->post('status', TRUE),
        'deskripsi' => $this->input->post('deskripsi', TRUE),
        'id_user' => $this->input->post('id_user', TRUE),
        'uuid' => $uuid,
      );

      $idlast = $this->Siswa_model->insert($data);
      $pengalaman = $this->input->post('pengalaman');
      $tahun = $this->input->post('tahun');
      if (!empty($tahun)) :
        foreach ($tahun as $key => $th) :
          $datapengalaman = array(
            'id_siswa' =>  $idlast,
            'tahun' => $th,
            'pengalaman' => $pengalaman[$key],
          );
          $this->Swpengalaman_model->insert($datapengalaman);
        endforeach;
      endif;

      $fileuploaded = array();

      if (!empty($_FILES['sertifikat_ahli']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $uuid, $_FILES['sertifikat_ahli'], $idlast, 1, 'sertifikat_ahli[]');
      endif;
      if (!empty($_FILES['sertifikat_pendukung']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $uuid, $_FILES['sertifikat_pendukung'], $idlast, 2, 'sertifikat_pendukung[]');
      endif;
      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $uuid, $_FILES['foto'], $idlast, 3, 'foto[]');
      endif;

      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('sekolah/siswa'));
    }
  }

  public function siswa_update($id)
  {

    $row = $this->Siswa_model->get_by_id($id);

    if ($row) {
      $data = array(
        'title' => 'Member Area - Form Data Siswa',
        'button' => 'Update',
        'action' => site_url('sekolah/siswa_update_action'),
        'id' => set_value('id', $row->id),
        'uuid' => set_value('uuid', $row->uuid),
        'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
        'nik' => set_value('nik', $row->nik),
        'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
        'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
        'alamat' => set_value('alamat', $row->alamat),
        'status' => set_value('status', $row->status),
        'deskripsi' => set_value('deskripsi', $row->deskripsi),
        'id_user' => set_value('id_user', $row->id_user),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Sekolah/Siswa/siswa_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('sekolah/siswa'));
    }
  }

  public function siswa_update_action()
  {
    $this->siswa_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->siswa_update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'nik' => $this->input->post('nik', TRUE),
        'nama_siswa' => $this->input->post('nama_siswa', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
        'id_sekolah' => $this->input->post('id_sekolah', TRUE),
        'status' => $this->input->post('status', TRUE),
        'deskripsi' => $this->input->post('deskripsi', TRUE),
        'id_user' => $this->input->post('id_user', TRUE),
      );

      $this->Siswa_model->update($this->input->post('id', TRUE), $data);
      $this->Swpengalaman_model->delete_pengalaman($this->input->post('id', TRUE));
      $pengalaman = $this->input->post('pengalaman');
      $tahun = $this->input->post('tahun');
      if (!empty($tahun)) :
        foreach ($tahun as $key => $th) :
          $datapengalaman = array(
            'id_siswa' =>  $this->input->post('id', TRUE),
            'tahun' => $th,
            'pengalaman' => $pengalaman[$key],
          );
          $this->Swpengalaman_model->insert($datapengalaman);
        endforeach;
      endif;
      // $this->File_model->delete_sertifikat($this->input->post('id', TRUE),1);
      // $this->File_model->delete_sertifikat($this->input->post('id', TRUE),2);
      $fileuploaded = array();
      if (!empty($_FILES['sertifikat_ahli']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['sertifikat_ahli'], $this->input->post('id', TRUE), 1, 'sertifikat_ahli[]');
      endif;
      if (!empty($_FILES['sertifikat_pendukung']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['sertifikat_pendukung'], $this->input->post('id', TRUE), 2, 'sertifikat_pendukung[]');
      endif;
      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['foto'], $this->input->post('id', TRUE), 3, 'foto[]');
      endif;
      // var_dump($fileuploaded);
      // die();


      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('sekolah/siswa'));
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

  public function siswa_delete($id)
  {
    $row = $this->Siswa_model->get_by_id($id);

    if ($row) {
      $this->Siswa_model->delete($id);
      // $this->session->set_flashdata('message', 'Delete Record Success');
      // redirect(site_url('admin/Siswa'));
    } else {
      // $this->session->set_flashdata('message', 'Record Not Found');
      // redirect(site_url('admin/Siswa'));
    }
  }

  public function siswa_delete_file()
  {
    $id = $this->input->post('id');
    $row = $this->File_model->get_by_id($id);

    if ($row) {
      $this->File_model->delete($id);
      $path = "./upload/dokumen/" . $row->file;
      unlink($path);
      // $this->session->set_flashdata('message', 'Delete Record Success');
      // redirect(site_url('admin/Siswa'));
    } else {
      // $this->session->set_flashdata('message', 'Record Not Found');
      // redirect(site_url('admin/Siswa'));
    }
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

  public function lowongan()
  {
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = site_url('/sekolah/lowongan');
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


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Member Area - Data Lowongan',
      'data' => $lowongan,
      // 'actionadd' => site_url('sekolah/lowongan_create'),
      // 'actionfilter' => site_url('sekolah/lowongan'),
    );
    $this->template->load('template', 'Sekolah/lowongan', $data);
  }
  public function lowongandetail($id = null,$idposisi = null)
  {

    $row = $this->Lowongan_model->get_by_id($id);

    if ($row) {
      $data = array(
        'id_lowongan' => $id,
        'id_siswa' => $this->session->userdata('id_siswa'),
        'id_posisi' => $idposisi,

      );
      $total = $this->Lamaran_model->get_count_where($data);
      
      if ($total > 0) :
        $lamaran = $this->Lamaran_model->get_by_data($data);

        $this->session->set_flashdata('message', 'Lamaran Sudah Pernah Dikirim <br> Status : '.$lamaran->status);
        // redirect(site_url('sekolah/lowongandetail/' . $this->input->post('id_lowongan', TRUE).'/'.$this->input->post('id_posisi', TRUE)));

      endif;

      $lowongan = $this->Lowongan_model->get_all();
      
      $data = array(
        'title' => 'Siswa Area - Form Data Lowongan',
        'button' => 'Update',
        'data' => $lowongan,
        'action' => site_url('sekolah/lowongan_update_action'),
        'id' => set_value('id', $row->id),
        'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
        'id_posisi' => set_value('id_posisi', $idposisi),
        'nama_lowongan' => set_value('nama_lowongan', $row->nama_lowongan),
        'deskripsi' => set_value('deskripsi', $row->deskripsi),
        'persyaratan' => set_value('persyaratan', $row->persyaratan),
        'status' => set_value('status', $row->status),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Sekolah/lowongandetail', $data);
    } else {
      $this->template->load('template', 'Error/notfound');
    }
  }

  public function lamaran_create_action()
  {
    $this->lamaran_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('message', 'Lengkapi Data Anda!!');
      $this->lowongandetail($this->input->post('id_lowongan', TRUE));
    } else {

      $uuid = $this->uuid->v4();
      $data = array(
        'id_lowongan' => $this->input->post('id_lowongan', TRUE),
        'id_siswa' => $this->session->userdata('id_siswa'),
        'id_posisi' => $this->input->post('id_posisi', TRUE),

      );
      $total = $this->Lamaran_model->get_count_where($data);

      if ($total > 0) :

        $this->session->set_flashdata('message', 'Lamaran Sudah Pernah Dikirim');
        redirect(site_url('sekolah/lowongandetail/' . $this->input->post('id_lowongan', TRUE).'/'.$this->input->post('id_posisi', TRUE)));

      else :
        $data = array(
          'id_lowongan' => $this->input->post('id_lowongan', TRUE),
          'id_siswa' => $this->session->userdata('id_siswa'),
          'id_posisi' => $this->input->post('id_posisi', TRUE),
          'created_by' => $this->session->userdata('user_id'),
          'uuid' =>  $uuid,
        );


        $idlast =   $this->Lamaran_model->insert($data);

        $this->session->set_flashdata('message', 'Lamaran Sukses Dikirim');
        redirect(site_url('sekolah/lowongandetail/' . $this->input->post('id_lowongan', TRUE)));
      endif;
    }
  }

  public function lamaran_rules()
  {
    $this->form_validation->set_rules('id_lowongan', 'Nama Lowongan', 'trim|required');
    $this->form_validation->set_rules('id_posisi', 'Data Pribadi Anda Belum Lengkap', 'trim|required');

    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function profile()
  {

    $id = $this->session->userdata('id_sekolah');
    $user = $this->session->userdata('user_id');
    $row = $this->Sekolah_model->get_by_id($id);
    $rowbasic = $this->User_model->get_by_id($user);
    if ($row) {
      $data = array(
        'title' => 'Member Area - Form Data Sekolah',
        'button' => 'Update',
        'action' => site_url('sekolah/sekolah_update_action'),
        'id' => set_value('id', $row->id),
        'nama_sekolah' => set_value('nama_sekolah', $row->nama_sekolah),
        'alamat' => set_value('alamat', $row->alamat),
        'deskripsi' => set_value('deskripsi', $row->deskripsi),
        'id_user' => set_value('id_user', $row->id_user),
        'uuid' => set_value('uuid', $row->uuid),

        'action2' => site_url('sekolah/user_update_action'),
        'iduser' => set_value('iduser', $rowbasic->id),
        'firstname' => set_value('firstname', $rowbasic->firstname),
        'lastname' => set_value('lastname', $rowbasic->lastname),
        'username' => set_value('username', $rowbasic->username),
        'email' => set_value('email', $rowbasic->email),
        'phone' => set_value('phone', $rowbasic->phone),
        'facebook' => set_value('facebook', $rowbasic->facebook),
        'instagram' => set_value('instagram', $rowbasic->instagram),
     
      );
      $this->template->load('template', 'Sekolah/profile', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('sekolah/profile'));
    }
  }

  public function sekolah_update_action()
  {
    $this->sekolah_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->profile();
    } else {
      $data = array(
        'nama_sekolah' => $this->input->post('nama_sekolah', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'deskripsi' => $this->input->post('deskripsi', TRUE),
      
      );

      $this->Sekolah_model->update($this->input->post('id', TRUE), $data);
      $fileuploaded = array();
      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['foto'], $this->input->post('id', TRUE), 5, 'foto[]');
      endif;
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('sekolah/profile'));
    }
  }

  public function sekolah_delete($id)
  {
    $row = $this->Sekolah_model->get_by_id($id);
    if ($row) {
      $this->Sekolah_model->delete($id);
    } else {  
    }
  }

  public function sekolah_rules()
  {
    $this->form_validation->set_rules('nama_sekolah', 'nama_sekolah', 'trim|required');
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function user_update_action()
  {
    $this->user_rules();

    if ($this->form_validation->run() == FALSE) {
      redirect(site_url('sekolah/profile'));
    } else {
      $data = array(
        'firstname' => $this->input->post('firstname', TRUE),
        'lastname' => $this->input->post('lastname', TRUE),
        'username' => $this->input->post('username', TRUE),
        'email' => $this->input->post('email', TRUE),
        'phone' => $this->input->post('phone', TRUE),
        'facebook' => $this->input->post('facebook', TRUE),
        'instagram' => $this->input->post('instagram', TRUE),
     
      );
      if(!empty($this->input->post('password', TRUE)))  $data['password'] = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);

      $this->User_model->update($this->input->post('id', TRUE), $data);
      $fileuploaded = array();
      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['foto'], $this->input->post('id', TRUE), 5, 'foto[]');
      endif;
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('sekolah/profile'));
    }
  }

  public function user_rules()
   {
     $this->form_validation->set_rules('firstname', 'Nama User', 'trim|required');
 
     $this->form_validation->set_rules('id', 'id', 'trim');
     $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

 // Module Permintaan
 public function permintaan()
 {
   $per_hal = $this->input->post('per_hal');
   if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
   $ses_hal = $this->session->userdata('perhal');
   $config['base_url'] = site_url('/sekolah/permintaan');
   $config['page_query_string'] = TRUE;
   $config['total_rows'] = $this->Permintaan_model->get_count();
   $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
   $config['full_tag_open'] = '<div class="pagination__numbers">';
   $config['full_tag_close'] = '</div>';

   $this->pagination->initialize($config);
   $limit = $config['per_page'];
   $offset = html_escape($this->input->get('per_page'));
   $cari = html_escape($this->input->get('s'));

   $sekolah = $this->Permintaan_model->get_limit_data_sekolah($limit, $offset, $cari, $this->session->userdata('id_sekolah'));
   $this->pagination->initialize($config);
   $data = array(
     'title' => 'Member Area - Data permintaan',
     'data' => $sekolah,
     'actionadd' => site_url('sekolah/permintaan_create'),
     'actionfilter' => site_url('sekolah/permintaan'),
   );
   $this->template->load('template', 'sekolah/Permintaan/permintaan_list', $data);
 }


}
