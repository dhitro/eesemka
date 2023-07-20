<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

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
            'title' => 'Sekolah Member Area'
        );
        $this->template->load('template', 'Sekolah/dashboard', $data);
	}
}
