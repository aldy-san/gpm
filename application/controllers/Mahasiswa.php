<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->db_master = $this->load->database('db_master', TRUE);
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'this_user' => $this->db_master->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array(),
            'category_mahasiswa' => $this->M_survei->getCategory('mahasiswa'),
            'title' => false
        ];
        if (getRole($this->globalData['this_user']['level']) !== 'mahasiswa') {
            $this->session->set_flashdata('alertForm', 'Role anda tidak memiliki akses untuk halaman tersebut');
            $this->session->set_flashdata('alertType', 'danger');
            redirect('auth');
        }
    }
    public function index()
    {
        $data = $this->globalData;
        customView('mahasiswa/index', $data);
    }
}