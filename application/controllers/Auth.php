<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
		if ($this->session->userdata('user')) {
			redirect('/dashboard');
		}
        $this->globalData = [
            'withNavbar' => true,
            'withSidebar' => false,
            'title' => 'Title',
        ];
    }
	public function index()
	{
        $data = $this->globalData;
		$this->load->view('layouts/header', $data);
		$this->load->view('pages/home');
		$this->load->view('layouts/footer');
	}
	public function login()
	{
		if ($this->input->post()){
			$this->form_validation->set_rules('email','email','trim|required|valid_email');
			$this->form_validation->set_rules('password','password','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
			} else {
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$user = $this->db->get_where('users', ['email' => $email])->row_array();
				if ($user){
					if (password_verify($password, $user['password'])){
						$this->session->set_flashdata('alertForm', 'Anda login');
						$sessionUser = [
							'email' => $email,
							'username' => $user['username']
						];
						$this->session->set_userdata('user',$sessionUser);
						redirect('/dashboard');
					} else {
						$this->session->set_flashdata('alertForm', 'Password Salah');
					}
				}else {
					$this->session->set_flashdata('alertForm', 'Email belum terdaftar');
				}
			}
		}
		$data = $this->globalData;
		$this->load->view('layouts/header', $data);
		$this->load->view('auth/login');
		$this->load->view('layouts/footer');
	}
	public function register()
	{
		if ($this->input->post()){
			$this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password','password','min_length[3]|trim|required|matches[confirm-password]');
			$this->form_validation->set_rules('confirm-password','confirm password','trim|required|matches[password]');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
			} else {
				$form = [
					'email' => $this->input->post('email'),
					'username' => 'username',
					'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
					'is_active' => 1
				];
				$this->db->insert('users', $form);
				redirect('/');
			}
		}
		$data = $this->globalData;
		$this->load->view('layouts/header', $data);
		$this->load->view('auth/register');
		$this->load->view('layouts/footer');
	}
	
}