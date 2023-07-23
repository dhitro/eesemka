<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {

        $this->form_validation->set_rules('user', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {

            // $data['title'] = "EESEMKA - BISA";
            // $data['header'] = "Kolaborasi Pemanfaatan Hasil Riset dan Penerapan Inovasi Daerah Provinsi Sumatera Utara Terintegrasi";
            // $this->load->view('auth/header', $data);
        $this->load->view('auth/login');

            // $this->load->view('auth/login', $data);
            // $this->load->view('auth/footer');

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
                        'timeout' => time() + (60*60)
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
        redirect(site_url());
    }


    function mypdf()
    {


        $this->load->library('pdf');
        $this->pdf->load_view('auth/mypdf');
        $this->pdf->render();
        $this->pdf->stream("welcome.pdf");
    }
    
}
