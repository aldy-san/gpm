<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->db_master = $this->load->database('db_master', TRUE);
        $this_user = $this->db_master->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
        $temp = $this->M_survei->getCategoryAnswered('mahasiswa',$this_user['username']);
        $category_mahasiswa = $this->M_survei->getCategory('mahasiswa');
        $category_mahasiswa_answered = [];
        foreach ($temp as $value) {
            array_push($category_mahasiswa_answered,$value['name']);
        }
        $another_survey_answered = $this->db->get_where('answer',['id_user' => $this_user['username'],'survei_dosen' => 1])->result_array();
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'this_user' => $this_user,
            'category_mahasiswa_avail' => $category_mahasiswa,
            'category_mahasiswa_answered' => $category_mahasiswa_answered,
            'title' => false,
            'another_survey_answered' => $another_survey_answered
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