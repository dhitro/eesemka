<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('uuid');
        $this->load->model([
            'User_model'
          ]);
        // date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {

        $this->form_validation->set_rules('user', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('auth/login');
        } else {

            $this->_login();
        }
    }

    public function login()
    {

        $this->_login();
    }

    private function _login()
    {
        $username = htmlspecialchars($this->input->post('user', true));
        $password = ($this->input->post('password', true));

        $this->db->where('username =', $username);
        $this->db->or_where('email =', $username);
        $user = $this->db
            ->select("u.*,r.nama level")
            ->join("eesemka_level r", "u.id_level = r.id")
            ->get('eesemka_user u')
            ->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $idsiswa = getidsiswa($user['id']);
                    $idsekolah = getidsekolah($user['id']);
                    $idperusahaan = getidperusahaan($user['id']);
                    $data = [
                        'username' => $user['username'],
                        'firstname' => $user['firstname'],
                        'lastname' => $user['lastname'],
                        'user_id' => $user['id'],
                        'email' => $user['email'],
                        'id_level' => $user['id_level'],
                        'id_sekolah' => $idsekolah,
                        'id_siswa' => $idsiswa,
                        'id_perusahaan' => $idperusahaan,
                        'level' => $user['level'],
                        'timeout' => time() + (60 * 60)
                    ];

                    $this->session->set_userdata($data);
                    if ($user['id_level'] == 1) :
                        redirect('admin');
                    elseif ($user['id_level'] == 2) :
                        redirect('sekolah');
                    elseif ($user['id_level'] == 3) :
                        redirect('perusahaan');
                    elseif ($user['id_level'] == 4) :
                        redirect('siswa');
                    elseif ($user['id_level'] == 5) :
                        redirect('alumni');
                    else :
                        redirect('home');
                    endif;

                    echo "berhasil";
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">
                            <i class="fa fa-times-circle"></i>
                            <h2>Error!</h2> Your Password Incorrect!! 
                            
                        </div>');
                    redirect('home');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">
                            <i class="fa fa-times-circle"></i>
                            <h2>Error!</h2> Your Account Is Not Activated 
                           
                        </div>');
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">
        
                            <i class="fa fa-times-circle"></i>
                            <h2>Error!</h2> Your Account Not Registered. Please Register 
                         
                        </div>');
            redirect('home');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');

        $this->session->set_flashdata('message', '<div class="alert alert-success">
                          
                            <i class="fa fa-check-circle"></i>
                            <h2>Well done!</h2> You successfully Logout From Your Account. 
                           
                        </div>');
        redirect(base_url());
    }

    public function signup()
    {
        echo $this->db->error();
        $this->user_rules();

        if ($this->form_validation->run() == FALSE) {
            // $this->user_create();
            $this->session->set_flashdata('message', '<div class="alert alert-danger">
                        <i class="fa fa-times-circle"></i>
                        <h2>Error!</h2> Error Create Your Account. 
                        </div>');
                        redirect(base_url('home'));
        } else {
            $uuid = $this->uuid->v4();
            $data = array(
                'firstname' => $this->input->post('firstname', TRUE),
                'lastname' => $this->input->post('lastname', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                'email' => $this->input->post('email', TRUE),
                'id_level' => $this->input->post('id_level', TRUE),
                'uuid' =>  $uuid,
            );

            $idlast =   $this->User_model->insert($data);
            
                $this->session->set_flashdata('message', '<div class="alert alert-success">                 
                <i class="fa fa-check-circle"></i>
                <h2>Well done!</h2> You successfully Create Your Account.  Wait For Adminn To Approve
                </div>');
                // $this->session->set_flashdata('message', '<div class="alert alert-danger">
                //         <i class="fa fa-times-circle"></i>
                //         <h2>Error!</h2> Error Create Your Account. 
                //         </div>');
            
            redirect(base_url('home'));
        }
    }

    public function user_rules()
    {
        $this->form_validation->set_rules('firstname', 'Nama Depan', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    function mypdf()
    {


        $this->load->library('pdf');
        $this->pdf->load_view('auth/mypdf');
        $this->pdf->render();
        $this->pdf->stream("welcome.pdf");
    }
}
