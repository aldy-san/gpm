<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public $globalData;
    public function __construct() {
        parent::__construct();
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true
        ];
    }
    public function index()
    {
        $data = $this->globalData;
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/index');
        $this->load->view('layouts/footer', $data);
    }
    public function tes()
    {
        $data = $this->globalData;
        $data['users'] = $this->db->get('users')->result();
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/tes/index',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function createTes()
    {
        if($this->input->post()){
            $this->form_validation->set_rules('email','email','trim|required|valid_email');
			$this->form_validation->set_rules('username','password','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
			} else {
                $form = [
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                ];
                $this->db->insert('users', $form);
                redirect('/tes');
            }
        }
        $data = $this->globalData;
        $data['user'] = false;
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/tes/form',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function editTes($id)
    {
        if($this->input->post()){
            $this->form_validation->set_rules('email','email','trim|required|valid_email');
			$this->form_validation->set_rules('username','password','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
			} else {
                $form = [
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                ];
                $data['user'] = $this->db->where(['id' => $id])->update('users', $form);
                redirect('/tes');
            }
        }
        $data = $this->globalData;
        $data['user'] = $this->db->where(['id' => $id])->get('users')->row_array();
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/tes/form',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function deleteTes($id)
    {
        $this->db->where(['id' => $id])->delete('users');
        redirect('/tes');
    }
}