<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

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
    $config['base_url'] = site_url('/siswa/lowongan');
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
      'id_siswa' => $this->session->userdata('id_siswa'),
    
    );

    $lamaran = $this->Lamaran_model->get_limit_data_done($limit, $offset, $q);


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Siswa Membner Area',
      'data' => $lamaran,
      // 'actionadd' => site_url('siswa/lowongan_create'),
      // 'actionfilter' => site_url('siswa/lowongan'),
    );
    $this->template->load('template', 'Siswa/dashboard', $data);
  }

  public function lowongan()
  {
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = site_url('/siswa/lowongan');
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
      'title' => 'Siswa Area - Data Lowongan',
      'data' => $lowongan,
      // 'actionadd' => site_url('siswa/lowongan_create'),
      // 'actionfilter' => site_url('siswa/lowongan'),
    );
    $this->template->load('template', 'Siswa/lowongan', $data);
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
        // redirect(site_url('siswa/lowongandetail/' . $this->input->post('id_lowongan', TRUE).'/'.$this->input->post('id_posisi', TRUE)));

      endif;

      $lowongan = $this->Lowongan_model->get_all();
      
      $data = array(
        'title' => 'Siswa Area - Form Data Lowongan',
        'button' => 'Update',
        'data' => $lowongan,
        'action' => site_url('admin/lowongan_update_action'),
        'id' => set_value('id', $row->id),
        'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
        'id_posisi' => set_value('id_posisi', $idposisi),
        'nama_lowongan' => set_value('nama_lowongan', $row->nama_lowongan),
        'deskripsi' => set_value('deskripsi', $row->deskripsi),
        'persyaratan' => set_value('persyaratan', $row->persyaratan),
        'status' => set_value('status', $row->status),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Siswa/lowongandetail', $data);
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
        redirect(site_url('siswa/lowongandetail/' . $this->input->post('id_lowongan', TRUE).'/'.$this->input->post('id_posisi', TRUE)));

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
        redirect(site_url('siswa/lowongandetail/' . $this->input->post('id_lowongan', TRUE)));
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
    $row = $this->Siswa_model->get_by_id($this->session->userdata('id_siswa'));
    
    $data = array(
      'title' => 'Admin Area - Form Data Siswa',
      'button' => 'Update',
      'action' => site_url('siswa/siswa_update_action'),
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
      $this->template->load('template', 'Siswa/profile', $data);
    
  }

  public function siswa_update_action()
  {
    $this->siswa_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->profile();
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
      redirect(site_url('siswa/profile'));
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


  // Module Permintaan
  public function permintaan()
  {
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = site_url('/siswa/permintaan');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Permintaan_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    $sekolah = $this->Permintaan_model->get_limit_data_user($limit, $offset, $cari, $this->session->userdata('id_siswa'));
    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Admin Area - Data permintaan',
      'data' => $sekolah,
      'actionadd' => site_url('admin/permintaan_create'),
      'actionfilter' => site_url('admin/permintaan'),
    );
    $this->template->load('template', 'siswa/Permintaan/permintaan_list', $data);
  }
}
