<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongankerja extends CI_Controller {

	
	public function index()
	{
		$data = array(
            'title' => 'Lowongan Kerja | SMK Siap Kerja'
        );
        $this->template->load('template_front', 'frontend/lowongankerja', $data);

	}

	public function detail($id=null)
	{
		$data = array(
            'title' => 'Lowongan Kerja | SMK Siap Kerja'
        );
        $this->template->load('template_front', 'frontend/singleloker', $data);
		
	}
}
