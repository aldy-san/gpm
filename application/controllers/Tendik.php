<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendik extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->db_master = $this->load->database('db_master', TRUE);
        $this_user = $this->db_master->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();

        $temp = $this->M_survei->getCategoryAnswered('tendik',$this_user['username']);
        $category_tendik = $this->M_survei->getCategory('tendik');
        $category_tendik_answered = [];
        foreach ($temp as $value) {
            array_push($category_tendik_answered,$value['name']);
        }
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'this_user' => $this_user,
            'category_tendik_avail' => $category_tendik,
            'category_tendik_answered' => $category_tendik_answered,
            'title' => false
        ];
        if (getRole($this->globalData['this_user']['level']) !== 'tendik') {
            $this->session->set_flashdata('alertForm', 'Role anda tidak memiliki akses untuk halaman tersebut');
            $this->session->set_flashdata('alertType', 'danger');
            redirect('auth');
        }
    }
    public function index()
    {
        $data = $this->globalData;
        customView('tendik/index', $data);
    }
}