<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'this_user' => $this->db->where(['id' => $this->session->userdata('user')['id']])->get('users')->row_array(),
            'title' => false
        ];
        if ($this->globalData['this_user']['role'] !== 'mahasiswa') {
            $this->session->set_flashdata('alertForm', 'Role anda tidak memiliki akses untuk halaman tersebut');
            $this->session->set_flashdata('alertType', 'danger');
            redirect('auth');
        }
    }
    public function index()
    {
        $data = $this->globalData;
        $this->load->view('layouts/header', $data);
        $this->load->view('mahasiswa/index');
        $this->load->view('layouts/footer');
    }
    public function survei($type){
        $this->globalData['withSidebar'] = false;
        $data = $this->globalData;
        $data['survei'] = $this->db->get_where('survei', ['role' => $data['this_user']['role']])->result_array();
        $data['bar_count'] = $this->db->get_where('survei',['type' => 'bar', 'role' => $data['this_user']['role']])->num_rows();
        $data['bar'] = 1;
        $this->load->view('layouts/header', $data);
        $this->load->view('mahasiswa/survei',$data);
        $this->load->view('layouts/footer');
    }
    public function store(){
        $data = $this->globalData;
        if ($this->input->post()){
            $this->db->select('id');
            $survei = $this->db->get_where('survei',['role' => $data['this_user']['role']])->result_array();
            foreach($survei as $num => $sur){
                $this->form_validation->set_rules('answer'.$sur['id'],'answer '.($num+1),'trim|required');
            }
            if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
			}else{
                foreach($this->input->post() as $key => $answer){
                    $this->db->insert('answer', [
                        'id_user' => $data['this_user']['id'],
                        'id_survei' => filter_var($key, FILTER_SANITIZE_NUMBER_INT),
                        'answer' => $answer,
                    ]);
                }
                redirect('/');
            }
        }
        $this->globalData['withSidebar'] = false;
        $data = $this->globalData;
        $data['survei'] = $this->db->get_where('survei', ['role' => $data['this_user']['role']])->result_array();
        $data['bar_count'] = $this->db->get_where('survei',['type' => 'bar', 'role' => $data['this_user']['role']])->num_rows();
        $data['bar'] = 1;
        $this->load->view('layouts/header', $data);
        $this->load->view('mahasiswa/survei',$data);
        $this->load->view('layouts/footer');
    }
}