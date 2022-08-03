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
	public function index()
	{
        $data = $this->globalData;
		$this->load->view('layouts/header', $data);
		$this->load->view('pages/home');
		$this->load->view('layouts/footer');
	}
	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect(base_url());
	}
}