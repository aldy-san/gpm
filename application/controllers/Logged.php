<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logged extends CI_Controller {

	public $globalData;
	public $db_master;
    public function __construct() {
        parent::__construct();
		if (!$this->session->userdata('user')) {
            redirect('auth');
        }
        $this->db_master = $this->load->database('db_master', TRUE);
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'title' => false,
            'this_user' => $this->db_master->where(['username' => $this->session->userdata('user')['username']])->get('user')->row_array(),
            'category_dosen' => $this->db->get_where('category', ['role' => 'dosen'])->result_array(),
            'category_mahasiswa' => $this->db->get_where('category', ['role' => 'mahasiswa'])->result_array(),
            'category_tendik' => $this->db->get_where('category', ['role' => 'tendik'])->result_array(),
        ];
    }

    public function Profile()
    {
        $data = $this->globalData;
        customView('pages/logged/profile', $data);
    }
}