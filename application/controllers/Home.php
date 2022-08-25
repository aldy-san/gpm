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
        customView('pages/not-logged/alumni', $data);
    }
    public function mitra()
    {
        $data = $this->globalData;
        customView('pages/not-logged/mitra', $data);
    }
    public function pengguna()
    {
        $data = $this->globalData;
        customView('pages/not-logged/alpenggunamni', $data);
    }
}