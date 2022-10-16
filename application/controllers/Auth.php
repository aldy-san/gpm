<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public $globalData;
	public $db_master;
    public function __construct() {
        parent::__construct();
		$this->db_master = $this->load->database('db_master', TRUE);
		if ($this->session->userdata('user')) {
			$user = $this->db_master->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
			$this->_redirect($user['level']);
		}
        $this->globalData = [
            'withNavbar' => true,
            'withSidebar' => false,
            'title' => false
        ];
    }
	public function index()
	{
		redirect('/login');
	}
	public function login()
	{
		if ($this->input->post()){
			$this->form_validation->set_rules('username','username','trim|required');
			$this->form_validation->set_rules('password','password','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
			} else {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$user = $this->db_master->get_where('user', ['username' => $username])->row_array();
				if ($user){
					if (md5($password) === $user['pwd_hash']){
						$this->session->set_flashdata('alertForm', 'Anda berhasil login');
						$this->session->set_flashdata('alertType', 'success');
						$sessionUser = [
							'username' => $user['username'],
							'jenjang' => $user['jenjang'],
							'kode_prodi' => $user['kode_prodi'],
							'offering' => $user['offering'],
							'level' => $user['level'],
							'nama_lengkap' => $user['nama_lengkap'],
						];
						$this->session->set_userdata('user',$sessionUser);
						$this->_redirect($user['level']);
					} else {
						$this->session->set_flashdata('alertForm', 'Password Salah');
					}
				}else {
					$this->session->set_flashdata('alertForm', 'Anda tidak terdaftar');
				}
			}
		}
		$data = $this->globalData;
		customView('auth/login', $data);
	}
	//public function register()
	//{
	//	if ($this->input->post()){
	//		$this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[users.email]');
	//		$this->form_validation->set_rules('username','username','trim|required|is_unique[users.username]');
	//		$this->form_validation->set_rules('password','password','min_length[3]|trim|required|matches[confirm-password]');
	//		$this->form_validation->set_rules('confirm-password','confirm password','trim|required|matches[password]');
	//		if(!$this->form_validation->run()){
	//			$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
	//		} else {
	//			$form = [
	//				'email' => $this->input->post('email'),
	//				'username' => $this->input->post('username'),
	//				'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
	//			];
	//			$this->db->insert('users', $form);
	//			redirect('/login');
	//		}
	//	}
	//	$data = $this->globalData;
	//	customView('auth/register', $data);
	//}
	private function _redirect($level){
		//echo getRole($level);exit;
		if (getRole($level) === 'superadmin'){
			redirect('dashboard');
		} else if (getRole($level) === 'mahasiswa') {
			redirect('/mahasiswa/dashboard');
		} else if (getRole($level) === 'dosen') {
			redirect('/dosen/dashboard');
		} else if (getRole($level) === 'tendik'){
			redirect('/tendik/dashboard');
		}
	}
}