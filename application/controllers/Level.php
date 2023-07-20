<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Level extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('Level_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $jurusan = $this->Level_model->get_all();

        $data = array(
            'level_data' => $jurusan,
            'title' => 'Siswa Member Area'
        );

        $this->template->load('template', 'Level/level_list', $data);
    }

    public function read($id)
    {
        $row = $this->Level_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_jurusan' => $row->id_jurusan,
                'jurusan' => $row->jurusan,
            );
            $this->template->load('template', 'Level/level_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurusan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jurusan/create_action'),
            'id_jurusan' => set_value('id_jurusan'),
            'jurusan' => set_value('jurusan'),
        );
        $this->template->load('template', 'Level/level_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'jurusan' => $this->input->post('jurusan', TRUE),
            );

            $this->Level_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jurusan'));
        }
    }

    public function update($id)
    {
        $row = $this->Level_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jurusan/update_action'),
                'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
                'jurusan' => set_value('jurusan', $row->jurusan),
            );
            $this->template->load('template', 'Level/level_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurusan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jurusan', TRUE));
        } else {
            $data = array(
                'jurusan' => $this->input->post('jurusan', TRUE),
            );

            $this->Level_model->update($this->input->post('id_jurusan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jurusan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Level_model->get_by_id($id);

        if ($row) {
            $this->Level_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jurusan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurusan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');

        $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
