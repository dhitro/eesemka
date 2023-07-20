<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->library('upload');
      $this->load->library('uuid');
      is_logged_in();
    }

	public function index()
	{
        $data = array(
            'title' => 'Siswa Member Area'
        );
        $this->template->load('template', 'Siswa/dashboard', $data);
	}
}
