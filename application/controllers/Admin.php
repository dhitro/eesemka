<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
    $data = array(
      'title' => 'Admin Area'
    );
    $this->template->load('template', 'Admin/dashboard', $data);
  }
  // Module sekolah
  public function sekolah()
  {
    // $sekolah = $this->db->get('eesemka_sekolah')->result_array();
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = site_url('/admin/sekolah');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Sekolah_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    $sekolah = $this->Sekolah_model->get_limit_data($limit, $offset, $cari);


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Admin Area - Data Sekolah',
      'data' => $sekolah,
      'actionadd' => site_url('admin/sekolah_create'),
      'actionfilter' => site_url('admin/sekolah'),
    );
    $this->template->load('template', 'Admin/Sekolah/sekolah_list', $data);
  }

  public function sekolah_read($id)
  {
    $row = $this->Sekolah_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Admin Area - Detail Sekolah',
        'id' => $row->id,
        'nama_sekolah' => $row->nama_sekolah,
        'alamat' => $row->alamat,
        'deskripsi' => $row->deskripsi,
        'id_user' => $row->id_user,
      );
      $this->template->load('template', 'Admin/Sekolah/sekolah_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/sekolah'));
    }
  }

  public function sekolah_create()
  {
    $data = array(
      'title' => 'Admin Area - Tambah Sekolah',
      'button' => 'Create',
      'action' => site_url('admin/sekolah_create_action'),
      'id' => set_value('id'),
      'uuid' => set_value('uuid'),
      'nama_sekolah' => set_value('nama_sekolah'),
      'alamat' => set_value('alamat'),
      'deskripsi' => set_value('deskripsi'),
      'id_user' => set_value('id_user'),
    );
    $this->template->load('template', 'Admin/Sekolah/sekolah_form', $data);
  }

  public function sekolah_create_action()
  {
    $this->sekolah_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->sekolah_create();
    } else {
      $uuid = $this->uuid->v4();
      $data = array(
        'nama_sekolah' => $this->input->post('nama_sekolah', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'deskripsi' => $this->input->post('deskripsi', TRUE),
        'id_user' => $this->input->post('id_user', TRUE),
        'uuid' =>  $uuid,
      );

      $idlast =   $this->Sekolah_model->insert($data);

      $fileuploaded = array();

      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $uuid, $_FILES['foto'], $idlast, 5, 'foto[]');
      endif;

      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('admin/sekolah'));
    }
  }

  public function sekolah_update($id)
  {

    $row = $this->Sekolah_model->get_by_id($id);

    if ($row) {
      $data = array(
        'title' => 'Admin Area - Form Data Sekolah',
        'button' => 'Update',
        'action' => site_url('admin/sekolah_update_action'),
        'id' => set_value('id', $row->id),
        'nama_sekolah' => set_value('nama_sekolah', $row->nama_sekolah),
        'alamat' => set_value('alamat', $row->alamat),
        'deskripsi' => set_value('deskripsi', $row->deskripsi),
        'id_user' => set_value('id_user', $row->id_user),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Admin/Sekolah/sekolah_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/sekolah'));
    }
  }

  public function sekolah_update_action()
  {
    $this->sekolah_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->sekolah_update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'nama_sekolah' => $this->input->post('nama_sekolah', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'deskripsi' => $this->input->post('deskripsi', TRUE),
        'id_user' => $this->input->post('id_user', TRUE),
      );

      $this->Sekolah_model->update($this->input->post('id', TRUE), $data);
      $fileuploaded = array();
      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['foto'], $this->input->post('id', TRUE), 5, 'foto[]');
      endif;
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('admin/sekolah'));
    }
  }

  public function sekolah_delete($id)
  {
    $row = $this->Sekolah_model->get_by_id($id);

    if ($row) {
      $this->Sekolah_model->delete($id);
      // $this->session->set_flashdata('message', 'Delete Record Success');
      // redirect(site_url('admin/sekolah'));
    } else {
      // $this->session->set_flashdata('message', 'Record Not Found');
      // redirect(site_url('admin/sekolah'));
    }
  }

  public function sekolah_rules()
  {
    $this->form_validation->set_rules('nama_sekolah', 'nama_sekolah', 'trim|required');

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
    $config['base_url'] = site_url('/admin/siswa');
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
      'title' => 'Admin Area - Data Siswa',
      'data' => $Siswa,
      'actionadd' => site_url('admin/siswa_create'),
      'actionfilter' => site_url('admin/siswa'),
    );
    $this->template->load('template', 'Admin/Siswa/siswa_list', $data);
  }

  public function siswa_read($id)
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
      $this->template->load('template', 'Admin/Siswa/siswa_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/siswa'));
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
      $this->template->load('template', 'Admin/Siswa/siswa_profile', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/siswa'));
    }
  }

  public function siswa_create()
  {
    $data = array(
      'button' => 'Create',
      'title' => 'Admin Area - Form Siswa',
      'action' => site_url('admin/siswa_create_action'),
      'actionadd' => site_url('admin/sekolah_create'),
      'actionfilter' => site_url('admin/sekolah'),
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
    $this->template->load('template', 'Admin/Siswa/siswa_form', $data);
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
      redirect(site_url('admin/siswa'));
    }
  }

  public function siswa_update($id)
  {

    $row = $this->Siswa_model->get_by_id($id);

    if ($row) {
      $data = array(
        'title' => 'Admin Area - Form Data Siswa',
        'button' => 'Update',
        'action' => site_url('admin/siswa_update_action'),
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
      $this->template->load('template', 'Admin/Siswa/siswa_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/siswa'));
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
      redirect(site_url('admin/siswa'));
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

  // Module perusahaan
  public function perusahaan()
  {
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = site_url('/admin/perusahaan');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Perusahaan_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    $Perusahaan = $this->Perusahaan_model->get_limit_data($limit, $offset, $cari);


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Admin Area - Data Perusahaan',
      'data' => $Perusahaan,
      'actionadd' => site_url('admin/perusahaan_create'),
      'actionfilter' => site_url('admin/perusahaan'),
    );
    $this->template->load('template', 'Admin/Perusahaan/perusahaan_list', $data);
  }

  public function perusahaan_read($id)
  {
    $row = $this->Perusahaan_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Admin Area - Detail Perusahaan',
        'id' => $row->id,
        'nama_perusahaan' => $row->nama_perusahaan,
        'alamat' => $row->alamat,
        'jumlah_karyawan' => $row->jumlah_karyawan,
        'deskripsi' => $row->deskripsi,
        'id_user' => $row->id_user,
      );
      $this->template->load('template', 'Admin/Perusahaan/perusahaan_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/Perusahaan'));
    }
  }

  public function perusahaan_create()
  {
    $data = array(
      'title' => 'Admin Area - Tambah Sekolah',
      'button' => 'Create',
      'action' => site_url('admin/perusahaan_create_action'),
      'id' => set_value('id'),
      'nama_perusahaan' => set_value('nama_perusahaan'),
      'alamat' => set_value('alamat'),
      'jumlah_karyawan' => set_value('jumlah_karyawan'),
      'deskripsi' => set_value('deskripsi'),
      'id_user' => set_value('id_user'),
    );
    $this->template->load('template', 'Admin/Perusahaan/perusahaan_form', $data);
  }

  public function perusahaan_create_action()
  {
    $this->perusahaan_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->perusahaan_create();
    } else {
      $uuid = $this->uuid->v4();
      $data = array(
        'nama_perusahaan' => $this->input->post('nama_perusahaan', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'deskripsi' => $this->input->post('deskripsi', TRUE),
        'id_user' => $this->input->post('id_user', TRUE),
        'jumlah_karyawan' => $this->input->post('jumlah_karyawan', TRUE),
        'uuid' => $uuid,
      );

      $idlast =  $this->Perusahaan_model->insert($data);

      $fileuploaded = array();

      if (!empty($_FILES['foto']['name'])) :
        $fileuploaded =  upload_files('upload/dokumen', $uuid, $_FILES['foto'], $idlast, 6, 'foto[]');
      endif;

      $bidang_list = $this->input->post('bidang_list');
      if (!empty($bidang_list)) :
        foreach ($bidang_list as $bidang) :
          $datab = array(
            'id_perusahaan' =>  $idlast,
            'id_bidang' => $bidang,
          );
          $this->Bdperusahaan_model->insert($datab);
        endforeach;
      endif;


      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('admin/perusahaan'));
    }
  }

  public function perusahaan_update($id)
  {

    $row = $this->Perusahaan_model->get_by_id($id);

    if ($row) {
      $data = array(
        'title' => 'Admin Area - Form Data Perusahaan',
        'button' => 'Update',
        'action' => site_url('admin/perusahaan_update_action'),
        'id' => set_value('id', $row->id),
        'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
        'alamat' => set_value('alamat', $row->alamat),
        'jumlah_karyawan' => set_value('jumlah_karyawan', $row->jumlah_karyawan),
        'deskripsi' => set_value('deskripsi', $row->deskripsi),
        'id_user' => set_value('id_user', $row->id_user),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Admin/Perusahaan/perusahaan_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/perusahaan'));
    }
  }

  public function perusahaan_update_action()
  {
    $this->perusahaan_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->perusahaan_update($this->input->post('id', TRUE));
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
      redirect(site_url('admin/perusahaan'));
    }
  }

  public function perusahaan_delete($id)
  {
    $row = $this->Perusahaan_model->get_by_id($id);

    if ($row) {
      $this->Perusahaan_model->delete($id);
    } else {
    }
  }

  public function perusahaan_rules()
  {
    $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
    $this->form_validation->set_rules('jumlah_karyawan', 'Jumlah Karyawan', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  // Module lowongan
  public function lowongan()
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


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Admin Area - Data Lowongan',
      'data' => $lowongan,
      'actionadd' => site_url('admin/lowongan_create'),
      'actionfilter' => site_url('admin/lowongan'),
    );
    $this->template->load('template', 'Admin/Lowongan/lowongan_list', $data);
  }

  public function lowongan_read($id)
  {
    $row = $this->Lowongan_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Admin Area - Detail Lowongan',
        'id' => $row->id,
        'nama_lowongan' => $row->nama_lowongan,
        'deskripsi' => $row->deskripsi,
        'persyaratan' => $row->persyaratan,
        'status' => $row->status,
      );
      $this->template->load('template', 'Admin/Lowongan/lowongan_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/lowongan'));
    }
  }

  public function lowongan_create()
  {
    $data = array(
      'title' => 'Admin Area - Tambah Lowongan',
      'button' => 'Create',
      'action' => site_url('admin/lowongan_create_action'),
      'id' => set_value('id'),
      'id_perusahaan' => set_value('id_perusahaan'),
      'uuid' => set_value('uuid'),
      'nama_lowongan' => set_value('nama_lowongan'),
      'deskripsi' => set_value('deskripsi'),
      'persyaratan' => set_value('persyaratan'),
      'status' => set_value('status'),
    );
    $this->template->load('template', 'Admin/Lowongan/lowongan_form', $data);
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
      redirect(site_url('admin/lowongan'));
    }
  }

  public function lowongan_update($id)
  {

    $row = $this->Lowongan_model->get_by_id($id);

    if ($row) {
      $data = array(
        'title' => 'Admin Area - Form Data Lowongan',
        'button' => 'Update',
        'action' => site_url('admin/lowongan_update_action'),
        'id' => set_value('id', $row->id),
        'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
        'nama_lowongan' => set_value('nama_lowongan', $row->nama_lowongan),
        'deskripsi' => set_value('deskripsi', $row->deskripsi),
        'persyaratan' => set_value('persyaratan', $row->persyaratan),
        'status' => set_value('status', $row->status),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Admin/Lowongan/lowongan_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/lowongan'));
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
        redirect(site_url('admin/lowongan'));
      else :
        $this->session->set_flashdata('message', 'Error Record' . var_dump($this->db->error()));
        redirect(site_url('admin/lowongan'));
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


  // Module Lamaran
  public function lamaran()
  {
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = site_url('/admin/lamaran');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Lamaran_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    $sekolah = $this->Lamaran_model->get_limit_data($limit, $offset, $cari);


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Admin Area - Data Lamaran',
      'data' => $sekolah,
      'actionadd' => site_url('admin/lamaran_create'),
      'actionfilter' => site_url('admin/lamaran'),
    );
    $this->template->load('template', 'Admin/Lamaran/lamaran_list', $data);
  }

  public function lamaran_read($id)
  {
    $row = $this->Lamaran_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Admin Area - Detail Lamaran',
        'id' => $row->id,
        'id_lowongan' => $row->id_lowongan,
        'id_siswa' => $row->id_siswa,
       
      );
      $this->template->load('template', 'Admin/Lamaran/lamaran_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/lamaran'));
    }
  }

  public function lamaran_create()
  {
    $data = array(
      'title' => 'Admin Area - Tambah Lamaran',
      'button' => 'Create',
      'action' => site_url('admin/lamaran_create_action'),
      'id' => set_value('id'),
      'uuid' => set_value('uuid'),
      'id_lowongan' => set_value('id_lowongan'),
      'id_posisi' => set_value('id_posisi'),
      'id_siswa' => set_value('id_siswa'),
     
    );
    $this->template->load('template', 'Admin/Lamaran/lamaran_form', $data);
  }

  public function lamaran_create_action()
  {
    $this->lamaran_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->lamaran_create();
    } else {
      $uuid = $this->uuid->v4();
      $data = array(
        'id_lowongan' => $this->input->post('id_lowongan', TRUE),
        'id_siswa' => $this->input->post('id_siswa', TRUE),
        'id_posisi' => $this->input->post('id_posisi', TRUE),
        'created_by' => $this->session->userdata('user_id'),
        'uuid' =>  $uuid,
      );

      $idlast =   $this->Lamaran_model->insert($data);

     $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('admin/lamaran'));
    }
  }

  public function lamaran_update($id)
  {

    $row = $this->Lamaran_model->get_by_id($id);

    if ($row) {
      $data = array(
        'title' => 'Admin Area - Form Data Lamaran',
        'button' => 'Update',
        'action' => site_url('admin/lamaran_update_action'),
        'id' => set_value('id', $row->id),
        'id_lowongan' => set_value('id_lowongan', $row->id_lowongan),
        'id_siswa' => set_value('id_siswa', $row->id_siswa),
        'id_posisi' => set_value('id_posisi', $row->id_posisi),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Admin/Lamaran/lamaran_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/lamaran'));
    }
  }

  public function lamaran_update_action()
  {
    $this->lamaran_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->lamaran_update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'id_lowongan' => $this->input->post('id_lowongan', TRUE),
        'id_posisi' => $this->input->post('id_posisi', TRUE),
        'id_siswa' => $this->input->post('id_siswa', TRUE),
      
      );

      $this->Lamaran_model->update($this->input->post('id', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('admin/lamaran'));
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


  public function lamaran_delete($id)
  {
    $row = $this->Lamaran_model->get_by_id($id);

    if ($row) {
      $this->Lamaran_model->delete($id);
      // $this->session->set_flashdata('message', 'Delete Record Success');
      // redirect(site_url('admin/sekolah'));
    } else {
      // $this->session->set_flashdata('message', 'Record Not Found');
      // redirect(site_url('admin/sekolah'));
    }
  }

  public function lamaran_rules()
  {
    $this->form_validation->set_rules('id_lowongan', 'Nama Lowongan', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  // Module Permintaan
  public function permintaan()
  {
    $per_hal = $this->input->post('per_hal');
    if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
    $ses_hal = $this->session->userdata('perhal');
    $config['base_url'] = site_url('/admin/permintaan');
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Permintaan_model->get_count();
    $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
    $config['full_tag_open'] = '<div class="pagination__numbers">';
    $config['full_tag_close'] = '</div>';

    $this->pagination->initialize($config);
    $limit = $config['per_page'];
    $offset = html_escape($this->input->get('per_page'));
    $cari = html_escape($this->input->get('s'));

    $sekolah = $this->Permintaan_model->get_limit_data($limit, $offset, $cari);


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Admin Area - Data permintaan',
      'data' => $sekolah,
      'actionadd' => site_url('admin/permintaan_create'),
      'actionfilter' => site_url('admin/permintaan'),
    );
    $this->template->load('template', 'Admin/Permintaan/permintaan_list', $data);
  }

  public function permintaan_read($id)
  {
    $row = $this->Permintaan_model->get_by_id($id);
    if ($row) {
      $data = array(
        'title' => 'Admin Area - Detail permintaan',
        'id' => $row->id,
        'id_lowongan' => $row->id_lowongan,
        'id_siswa' => $row->id_siswa,
        'keterangan' => $row->keterangan,
       
      );
      $this->template->load('template', 'Admin/Permintaan/permintaan_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/permintaan'));
    }
  }

  public function permintaan_create()
  {
    $data = array(
      'title' => 'Admin Area - Tambah permintaan',
      'button' => 'Create',
      'action' => site_url('admin/permintaan_create_action'),
      'id' => set_value('id'),
      'uuid' => set_value('uuid'),
      'id_perusahaan' => set_value('id_perusahaan'),
      'id_siswa' => set_value('id_siswa'),
      'keterangan' => set_value('keterangan'),
     
    );
    $this->template->load('template', 'Admin/Permintaan/permintaan_form', $data);
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
      redirect(site_url('admin/permintaan'));
    }
  }

  public function permintaan_update($id)
  {

    $row = $this->Permintaan_model->get_by_id($id);

    if ($row) {
      $data = array(
        'title' => 'Admin Area - Form Data permintaan',
        'button' => 'Update',
        'action' => site_url('admin/permintaan_update_action'),
        'id' => set_value('id', $row->id),
        'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
        'id_siswa' => set_value('id_siswa', $row->id_siswa),
        'keterangan' => set_value('keterangan', $row->keterangan),
        'uuid' => set_value('uuid', $row->uuid),
      );
      $this->template->load('template', 'Admin/Permintaan/permintaan_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('admin/permintaan'));
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
      redirect(site_url('admin/permintaan'));
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
      // redirect(site_url('admin/sekolah'));
    } else {
      // $this->session->set_flashdata('message', 'Record Not Found');
      // redirect(site_url('admin/sekolah'));
    }
  }

  public function permintaan_rules()
  {
    $this->form_validation->set_rules('id_perusahaan', 'Nama Perusahaan', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }


   // Module User
   public function user()
   {
     // $user = $this->db->get('eesemka_user')->result_array();
     $per_hal = $this->input->post('per_hal');
     if (!empty($per_hal))  $this->session->set_userdata(['perhal' => $per_hal]);
     $ses_hal = $this->session->userdata('perhal');
     $config['base_url'] = site_url('/admin/user');
     $config['page_query_string'] = TRUE;
     $config['total_rows'] = $this->User_model->get_count();
     $config['per_page'] = ($ses_hal == null || $ses_hal == '') ? 10 : $ses_hal;
     $config['full_tag_open'] = '<div class="pagination__numbers">';
     $config['full_tag_close'] = '</div>';
 
     $this->pagination->initialize($config);
     $limit = $config['per_page'];
     $offset = html_escape($this->input->get('per_page'));
     $cari = html_escape($this->input->get('s'));
 
     $user = $this->User_model->get_limit_data($limit, $offset, $cari);
 
 
     $this->pagination->initialize($config);
     $data = array(
       'title' => 'Admin Area - Data User',
       'data' => $user,
       'actionadd' => site_url('admin/user_create'),
       'actionfilter' => site_url('admin/user'),
     );
     $this->template->load('template', 'Admin/User/user_list', $data);
   }
 
   public function user_read($id)
   {
     $row = $this->User_model->get_by_id($id);
     if ($row) {
       $data = array(
         'title' => 'Admin Area - Detail User',
         'id' => $row->id,
         'firstname' => $row->firstname,
         'lastname' => $row->lastname,
         'username' => $row->username,
         'email' => $row->email,
         'phone' => $row->phone,
         'instagram' => $row->instagram,
         'facebook' => $row->facebook,
         'is_active' => $row->is_active,
         'id_level' => $row->id_level,
       );
       $this->template->load('template', 'Admin/User/user_read', $data);
     } else {
       $this->session->set_flashdata('message', 'Record Not Found');
       redirect(site_url('admin/user'));
     }
   }
 
   public function user_create()
   {
     $data = array(
       'title' => 'Admin Area - Tambah user',
       'button' => 'Create',
       'action' => site_url('admin/user_create_action'),
       'id' => set_value('id'),
       'uuid' => set_value('uuid'),
       'firstname' => set_value('firstname'),
       'lastname' => set_value('lastname'),
       'username' => set_value('username'),
       'password' => set_value('password'),
       'email' => set_value('email'),
       'phone' => set_value('phone'),
       'facebook' => set_value('facebook'),
       'instagram' => set_value('instagram'),
       'is_active' => set_value('is_active'),
       'id_level' => set_value('id_level'),
     );
     $this->template->load('template', 'Admin/User/user_form', $data);
   }
 
   public function user_create_action()
   {
     $this->user_rules();
 
     if ($this->form_validation->run() == FALSE) {
       $this->user_create();
     } else {
       $uuid = $this->uuid->v4();
       $data = array(
         'firstname' => $this->input->post('firstname', TRUE),
         'lastname' => $this->input->post('lastname', TRUE),
         'username' => $this->input->post('username', TRUE),
         'email' => $this->input->post('email', TRUE),
         'phone' => $this->input->post('phone', TRUE),
         'facebook' => $this->input->post('facebook', TRUE),
         'instagram' => $this->input->post('instagram', TRUE),
         'is_active' => $this->input->post('is_active', TRUE),
         'id_level' => $this->input->post('id_level', TRUE),
         'uuid' =>  $uuid,
       );
 
       if(!empty($this->input->post('password', TRUE)))  $data['password'] = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
       $idlast =   $this->User_model->insert($data);
       $fileuploaded = array();
 
       if (!empty($_FILES['foto']['name'])) :
         $fileuploaded =  upload_files('upload/dokumen', $uuid, $_FILES['foto'], $idlast, 5, 'foto[]');
       endif;
 
       $this->session->set_flashdata('message', 'Create Record Success');
       redirect(site_url('admin/user'));
     }
   }
 
   public function user_update($id)
   {
 
     $row = $this->User_model->get_by_id($id);
 
     if ($row) {
       $data = array(
         'title' => 'Admin Area - Form Data user',
         'button' => 'Update',
         'action' => site_url('admin/user_update_action'),
         'id' => set_value('id', $row->id),
         'firstname' => set_value('firstname', $row->firstname),
         'lastname' => set_value('lastname', $row->lastname),
         'username' => set_value('username', $row->username),
         'email' => set_value('email', $row->email),
         'phone' => set_value('phone', $row->phone),
         'facebook' => set_value('facebook', $row->facebook),
         'instagram' => set_value('instagram', $row->instagram),
         'is_active' => set_value('is_active', $row->is_active),
         'id_level' => set_value('id_level', $row->id_level),
         'uuid' => set_value('uuid', $row->uuid),
       );
       $this->template->load('template', 'Admin/User/user_form', $data);
     } else {
       $this->session->set_flashdata('message', 'Record Not Found');
       redirect(site_url('admin/user'));
     }
   }
 
   public function user_update_action()
   {
     $this->user_rules();
 
     if ($this->form_validation->run() == FALSE) {
       $this->user_update($this->input->post('id', TRUE));
     } else {
       $data = array(
         'firstname' => $this->input->post('firstname', TRUE),
         'lastname' => $this->input->post('lastname', TRUE),
         'username' => $this->input->post('username', TRUE),
         'email' => $this->input->post('email', TRUE),
         'phone' => $this->input->post('phone', TRUE),
         'facebook' => $this->input->post('facebook', TRUE),
         'instagram' => $this->input->post('instagram', TRUE),
        //  'is_active' => $this->input->post('is_active', TRUE),
         'id_level' => $this->input->post('id_level', TRUE),
       );
       if(!empty($this->input->post('password', TRUE)))  $data['password'] = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
 
       $this->User_model->update($this->input->post('id', TRUE), $data);
       $fileuploaded = array();
       if (!empty($_FILES['foto']['name'])) :
         $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['foto'], $this->input->post('id', TRUE), 5, 'foto[]');
       endif;
       $this->session->set_flashdata('message', 'Update Record Success');
       redirect(site_url('admin/user'));
     }
   }
 

  public function user_active()
  {
    $id = $this->input->post('id', TRUE);
    $is_active = $this->input->post('is_active', TRUE);
    $data = array(
      'is_active' => $is_active,
    );
    $this->User_model->update($id, $data);
  }

   public function user_delete($id)
   {
     $row = $this->User_model->get_by_id($id);
 
     if ($row) {
       $this->User_model->delete($id);
       // $this->session->set_flashdata('message', 'Delete Record Success');
       // redirect(site_url('admin/user'));
     } else {
       // $this->session->set_flashdata('message', 'Record Not Found');
       // redirect(site_url('admin/user'));
     }
   }
 
   public function user_rules()
   {
     $this->form_validation->set_rules('firstname', 'Nama User', 'trim|required');
 
     $this->form_validation->set_rules('id', 'id', 'trim');
     $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

}
