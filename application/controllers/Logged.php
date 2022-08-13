<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logged extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
		if (!$this->session->userdata('user')) {
            redirect('auth');
        }
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'title' => false,
            'this_user' => $this->db->where(['id' => $this->session->userdata('user')['id']])->get('users')->row_array()
        ];
    }

    public function Profile()
    {
        $data = $this->globalData;
        $this->load->view('layouts/header', $data);
		$this->load->view('pages/logged/profile', $data);
		$this->load->view('layouts/footer');
    }
}