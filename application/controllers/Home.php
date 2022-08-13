<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
        $this->globalData = [
            'withNavbar' => true,
            'withSidebar' => false,
            'title' => false
        ];
    }
	public function logout()
	{
        if ($this->session->userdata('user')){
            $this->session->unset_userdata('user');
        }
        redirect(base_url());
	}
    public function alumni()
    {
        $data = $this->globalData;
        $this->load->view('layouts/header', $data);
		$this->load->view('pages/not-logged/alumni');
		$this->load->view('layouts/footer');
    }
    public function mitra()
    {
        $data = $this->globalData;
        $this->load->view('layouts/header', $data);
		$this->load->view('pages/not-logged/mitra');
		$this->load->view('layouts/footer');
    }
    public function pengguna()
    {
        $data = $this->globalData;
        $this->load->view('layouts/header', $data);
		$this->load->view('pages/not-logged/pengguna');
		$this->load->view('layouts/footer');
    }
}