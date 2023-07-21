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
    $this->load->model('Sekolah_model');
    $this->load->model('Siswa_model');
    $this->load->model('Perusahaan_model');
    $this->load->model('Bdperusahaan_model');
    $this->load->model('Lowongan_model');
    $this->load->model('Posisi_model');
    $this->load->model('PsLowongan_model');
    $this->load->model('Swpengalaman_model');
    $this->load->model('File_model');
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
        $fileuploaded =  upload_files('upload/dokumen', $uuid, $_FILES['foto'], $idlast, 3, 'foto[]');
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
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['foto'], $this->input->post('id', TRUE), 3, 'foto[]');
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
        $fileuploaded =  upload_files('upload/dokumen', $uuid, $_FILES['foto'], $idlast, 3, 'foto[]');
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
        $fileuploaded =  upload_files('upload/dokumen', $this->input->post('uuid', TRUE), $_FILES['foto'], $this->input->post('id', TRUE), 3, 'foto[]');
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

  // Module lowongann
  public function Lowongan()
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

    $Lowongan = $this->Lowongan_model->get_limit_data($limit, $offset, $cari);


    $this->pagination->initialize($config);
    $data = array(
      'title' => 'Admin Area - Data Lowongan',
      'data' => $Lowongan,
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
        'persayaratan' => $row->persayaratan,
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
        $this->session->set_flashdata('message', 'Error Record'. var_dump($this->db->error()) );
        redirect(site_url('admin/lowongan'));
      endif;
    }
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
}
