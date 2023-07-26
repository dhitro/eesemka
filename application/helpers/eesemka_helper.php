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
        redirect(base_url());
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

if (!function_exists('loaduserall')) {
  function loaduserall($id=null,$id2=null)
  {
    $ci = get_instance();
    $ci->load->model('User_model');
    $data = $ci->User_model->get_all();
    return $data;
  }
}

if (!function_exists('loadpermintaan')) {
  function loadpermintaan($id=null,$id2=null)
  {
    $ci = get_instance();
    $ci->load->model('Permintaan_model');
    $data = $ci->Permintaan_model->get_all();
    return $data;
  }
}

if (!function_exists('loadpermintaanid')) {
  function loadpermintaanid($id=null,$id2=null)
  {
    $ci = get_instance();
    $ci->load->model('Permintaan_model');
    $data = $ci->Permintaan_model->get_allpermintaan($id);
    return $data;
  }
}

if (!function_exists('loadpermintaansiswa')) {
  function loadpermintaansiswa($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Permintaan_model');
    $data = $ci->Permintaan_model->get_allpermintaansis($id);
    return $data;
  }
}


if (!function_exists('loadlowongan')) {
  function loadlowongan($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Lowongan_model');
    $data = $ci->Lowongan_model->get_all();
    return $data;
  }
}

if (!function_exists('loadlowonganid')) {
  function loadlowonganid($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Lowongan_model');
    $data = $ci->Lowongan_model->get_alllowongan($id);
    return $data;
  }
}


if (!function_exists('loadsiswa')) {
  function loadsiswa($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Siswa_model');
    $data = $ci->Siswa_model->get_all();
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

if (!function_exists('loadlowonganposisi')) {
  function loadlowonganposisi($id=null)
  {
    $ci = get_instance();
    $ci->load->model('PsLowongan_model');
    $data = $ci->PsLowongan_model->get_allposisi($id);
    return $data;
  }
}
if (!function_exists('loadlamaran')) {
  function loadlamaran($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Lamaran_model');
    $data = $ci->Lamaran_model->get_alllamaran($id);
    return $data;
  }
}

if (!function_exists('loadlamaranall')) {
  function loadlamaranall($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Lamaran_model');
    $data = $ci->Lamaran_model->get_all();
    return $data;
  }
}

if (!function_exists('loadlevel')) {
  function loadlevel($id=null)
  {
    $ci = get_instance();
    $ci->load->model('Level_model');
    $data = $ci->Level_model->get_all();
    return $data;
  }
}


if (!function_exists('getfotoprofil')) {
  function getfotoprofil($id=null ,$tipe =null)
  {
    $ci = get_instance();
    $ci->load->model('File_model');
    $data = $ci->File_model->get_by_idsiswa($id,$tipe);
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


if (!function_exists('getnamalevel')) {
  function getnamalevel($id)
  {
    $ci = get_instance();
    $ci->load->model('Level_model');
    $data = $ci->Level_model->get_by_id($id);
    if ($data) :
      return $data->nama;
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

if (!function_exists('getnamalowongan')) {
  function getnamalowongan($id)
  {
    $ci = get_instance();
    $ci->load->model('Lowongan_model');
    $data = $ci->Lowongan_model->get_by_id($id);
    if ($data) :
      return $data->nama_lowongan;
    else :
      return '-';
    endif;
  }
}


if (!function_exists('getnamaperusahaanbylowongan')) {
  function getnamaperusahaanbylowongan($id)
  {
    $ci = get_instance();
    $ci->load->model('Lowongan_model');
    $data = $ci->Lowongan_model->get_perusahaan_by_id($id);
    if ($data) :
      return $data->nama_perusahaan;
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

if (!function_exists('getnamasiswa')) {
  function getnamasiswa($id)
  {
    $ci = get_instance();
    $ci->load->model('Siswa_model');
    $data = $ci->Siswa_model->get_by_id($id);
    if ($data) :
      return $data->nama_siswa;
    else :
      return ' <small class="text-danger"> Siswa Not Found </small>';
    endif;
  }
}


if (!function_exists('getsiswa')) {
  function getsiswa($id)
  {
    $ci = get_instance();
    $ci->load->model('Siswa_model');
    $data = $ci->Siswa_model->get_by_id($id);
    if ($data) :
      return $data->nama_siswa;
    else :
      return '-';
    endif;
  }
}

if (!function_exists('getidsiswa')) {
  function getidsiswa($id)
  {
    $ci = get_instance();
    $ci->load->model('Siswa_model');
    $data = $ci->Siswa_model->get_by_iduser($id);
    if ($data) :
      return $data->id;
    else :
      return null;
    endif;
  }
}

if (!function_exists('getidsiswa')) {
  function getidsiswa($id)
  {
    $ci = get_instance();
    $ci->load->model('Siswa_model');
    $data = $ci->Siswa_model->get_by_iduser($id);
    if ($data) :
      return $data->id;
    else :
      return null;
    endif;
  }
}

if (!function_exists('getidsekolah')) {
  function getidsekolah($id)
  {
    $ci = get_instance();
    $ci->load->model('Sekolah_model');
    $data = $ci->Sekolah_model->get_by_iduser($id);
    if ($data) :
      return $data->id;
    else :
      return null;
    endif;
  }
}

if (!function_exists('getidperusahaan')) {
  function getidperusahaan($id)
  {
    $ci = get_instance();
    $ci->load->model('Perusahaan_model');
    $data = $ci->Perusahaan_model->get_by_iduser($id);
    if ($data) :
      return $data->id;
    else :
      return null;
    endif;
  }
}

if (!function_exists('getlowongan')) {
  function getlowongan($id)
  {
    $ci = get_instance();
    $ci->load->model('Lowongan_model');
    $data = $ci->Lowongan_model->get_by_id($id);
    if ($data) :
      return $data->nama_lowongan;
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
