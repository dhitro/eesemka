<?php

if (!function_exists('is_logged_in')) {
  function is_logged_in()
  {

    $ci = get_instance();
    if ($ci->session->userdata('logged_in') === false) {
      redirect('auth');
    } else {
      $timeout = $ci->session->userdata('timeout');
      if (time() < $timeout) {
        $ci->session->set_userdata('timeout', time() + 900);
      } else {
        redirect(site_url());
      }
    }
  }
}

if (!function_exists('getuserdata')) {
  function getuserdata()
  {
    $ci = get_instance();
    $data = $ci->db
      ->where(['username' => $ci->session->userdata('username')])
      ->get('eesemka_user')
      ->row();
    return $data;
  }
}

if (!function_exists('loadbidang')) {
  function loadbidang($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Bidang_model');
    $data = $ci->Bidang_model->get_all();
    return $data;
  }
}

if (!function_exists('loadposisi')) {
  function loadposisi($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Posisi_model');
    $data = $ci->Posisi_model->get_all();
    return $data;
  }
}


if (!function_exists('loadperusahaan')) {
  function loadperusahaan($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Perusahaan_model');
    $data = $ci->Perusahaan_model->get_all();
    return $data;
  }
}

if (!function_exists('loadbidangperusahaan')) {
  function loadbidangperusahaan($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Perusahaan_model');
    $data = $ci->Perusahaan_model->get_allbidang($id);
    return $data;
  }
}
if (!function_exists('loadposisilowongan')) {
  function loadposisilowongan($id=null)
  {
    $ci = get_instance();
    $ci->load->model('PsLowongan_model');
    $data = $ci->PsLowongan_model->get_allposisi($id);
    return $data;
  }
}

if (!function_exists('loadsekolah')) {
  function loadsekolah($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Sekolah_model');
    $data = $ci->Sekolah_model->get_all();
    return $data;
  }
}

if (!function_exists('loaduser')) {
  function loaduser($id=null,$id2=null)
  {
    $ci = get_instance();
    $ci->load->model('User_model');
    $data = $ci->User_model->get_all_by_level($id,$id2);
    return $data;
  }
}


if (!function_exists('loadsiswasekolah')) {
  function loadsiswasekolah($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Siswa_model');
    $data = $ci->Siswa_model->get_allsekolah($id);
    return $data;
  }
}

if (!function_exists('loadsiswapengalaman')) {
  function loadsiswapengalaman($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Swpengalaman_model');
    $data = $ci->Swpengalaman_model->get_allpengalaman($id);
    return $data;
  }
}

if (!function_exists('loadsiswakeahlian')) {
  function loadsiswakeahlian($id=null)
  {
    $ci = get_instance();
    $ci->load->model('File_model');
    $data = $ci->File_model->get_allsertifikat($id,1);
    return $data;
  }
}

if (!function_exists('loadsiswapendukung')) {
  function loadsiswapendukung($id=null)
  {
    $ci = get_instance();
    $ci->load->model('File_model');
    $data = $ci->File_model->get_allsertifikat($id,2);
    return $data;
  }
}

if (!function_exists('getfotoprofil')) {
  function getfotoprofil($id)
  {
    $ci = get_instance();
    $ci->load->model('File_model');
    $data = $ci->File_model->get_by_idsiswa($id,3);
    if ($data) :
      return $data;
    else :
      return [];
    endif;
  }
}


if (!function_exists('getfotofeeds')) {
  function getfotofeeds($id)
  {
    $ci = get_instance();
    $ci->load->model('File_model');
    $data = $ci->File_model->get_by_idsiswa($id,4);
    if ($data) :
      return $data;
    else :
      return [];
    endif;
  }
}


if (!function_exists('getnamasekolah')) {
  function getnamasekolah($id)
  {
    $ci = get_instance();
    $ci->load->model('Sekolah_model');
    $data = $ci->Sekolah_model->get_by_id($id);
    if ($data) :
      return $data->nama_sekolah;
    else :
      return '-';
    endif;
  }
}

if (!function_exists('getnamaperusahaan')) {
  function getnamaperusahaan($id)
  {
    $ci = get_instance();
    $ci->load->model('Perusahaan_model');
    $data = $ci->Perusahaan_model->get_by_id($id);
    if ($data) :
      return $data->nama_perusahaan;
    else :
      return '-';
    endif;
  }
}


if (!function_exists('getnamaposisi')) {
  function getnamaposisi($id)
  {
    $ci = get_instance();
    $ci->load->model('Posisi_model');
    $data = $ci->Posisi_model->get_by_id($id);
    if ($data) :
      return $data->nama;
    else :
      return '-';
    endif;
  }
}


if (!function_exists('getnamauser')) {
  function getnamauser($id)
  {
    $ci = get_instance();
    $ci->load->model('User_model');
    $data = $ci->User_model->get_by_id($id);
    if ($data) :
      return $data->firstname. ' - '.$data->username;
    else :
      return ' <small class="text-danger"> User Not Found!!</small>';
    endif;
  }
}


if (!function_exists('getsiswa')) {
  function getsiswa($id)
  {
    $ci = get_instance();
    $ci->load->model('Sekolah_model');
    $data = $ci->Sekolah_model->get_by_id($id);
    if ($data) :
      return $data->nama_sekolah;
    else :
      return '-';
    endif;
  }
}


if (!function_exists('loadrole')) {
  function loadrole()
  {
    $ci = get_instance();
    $data = $ci->db
      ->get('sirinov_role')->result_array();
    return $data;
  }
}



if (!function_exists('loadtahun')) {
  function loadtahun()
  {
    $ci = get_instance();
    $data = $ci->db
      ->get('sirinov_tahun')->result_array();
    return $data;
  }
}

if (!function_exists('loadtahapan')) {
  function loadtahapan()
  {
    $ci = get_instance();
    $data = $ci->db
      ->get('sirinov_tahapan_inovasi')->result_array();
    return $data;
  }
}

if (!function_exists('loadfile')) {
  function loadfile($id = null)
  {
    $ci = get_instance();
    $data = $ci->db
      ->where('uuid',$id)
      ->get('sirinov_file')->result_array();
    return $data;
  }
}

if (!function_exists('loadfilelaporan')) {
  function loadfilelaporan($id = null)
  {
    $ci = get_instance();
    $data = $ci->db
      ->where('uuid',$id)
      ->get('sirinov_file_laporan')->result_array();
    return $data;
  }
}


if (!function_exists('gettahun')) {
  function gettahun($id)
  {
    $ci = get_instance();
    $data = $ci->db
      ->where(['id' => $id])
      ->get('sirinov_tahun')
      ->row();
    if ($data) :
      return $data->tahun;
    else :
      return '-';
    endif;
  }
}

if (!function_exists('angka')) {
  function angka($angka)
  {
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
  }
}

if (!function_exists('upload_files')) {
  function upload_files($path = null, $uuid = null, $files = null ,$id = null,$tipe = null,$arrt = null)
  {
    $ci = get_instance();
    $config = array(
      'upload_path'   => $path,
      'allowed_types' => 'jpg|gif|png|pdf',
      'overwrite'     => TRUE,
      'encrypt_name'  => TRUE
    );

    $ci->load->model('File_model');
    $ci->load->library('upload', $config);
    $file = array();
    foreach ($files['name'] as $key => $fl) {
      $_FILES[$arrt]['name'] = $files['name'][$key];
      $_FILES[$arrt]['type'] = $files['type'][$key];
      $_FILES[$arrt]['tmp_name'] = $files['tmp_name'][$key];
      $_FILES[$arrt]['error'] = $files['error'][$key];
      $_FILES[$arrt]['size'] = $files['size'][$key];
      $fileName = $fl;
      $file[] = $fileName;
      // $config['file_name'] = $fileName;
      $ci->upload->initialize($config);

      if ($ci->upload->do_upload($arrt)) {
        $ci->upload->data();
        $cmpr = $ci->upload->data();
        $new_file = $cmpr['file_name'];
        $payload = [
          'file' => $new_file,
          'file_name' => $fileName,
          'id_siswa' => $id,
          'uuid' => $uuid,
          'id_tipefile' => $tipe,
          'created_by' => $ci->session->userdata('user_id'),
          'created_at' => date('Y-m-d H:i:s'),
        ];
        // $insert =  $ci->db->insert('eesemka_file', $payload);
        $insert = $ci->File_model->insert($payload);
        if ($insert) {
        }
      } else {
        return false;
      }
    }

    return $file;
  }
}
