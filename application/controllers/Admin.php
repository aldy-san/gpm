<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public $globalData;
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')) {
			redirect('/');
		}
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'title' => false,
            'this_user' => $this->db->where(['id' => $this->session->userdata('user')['id']])->get('users')->row_array()
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

        // Config Pagination
		$config['base_url'] = base_url('/tes/');
		$config['total_rows'] = $this->db->get('users')->num_rows();;
		$config['per_page'] = 2;
		$config['start'] = $this->uri->segment(2);
		$this->pagination->initialize($config);
        $data['users'] = $this->db->limit($config['per_page'], $config['start'])->get('users')->result_array();

        // Config Template Table Page
        $data['title'] = 'Test Template Table';
        $data['desc'] = 'Reusable template for table page';
        $data['create_url'] = '/tes/create/';
        $data['edit_url'] = '/tes/edit/';
        $data['detail_url'] = 'tes/detail/';
        $data['delete_url'] = '/tes/delete/';
        $data['column_table'] = ['email', 'username'];

        $this->load->view('layouts/header', $data);
        $this->load->view('template/table_page',$data);
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
        $data['title'] = 'Create Test';
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/tes/form',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function detailTes($id)
    {
        $data = $this->globalData;
        $data['user'] = $this->db->where(['id' => $id])->get('users')->row_array();
        $data['title'] = 'Detail Test';
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
        $data['title'] = 'Edit Test';
        $data['user'] = $this->db->where(['id' => $id])->get('users')->row_array();
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/tes/form',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function deleteTes()
    {
        $this->db->where(['id' => $this->input->post('id')])->delete('users');
        redirect('/tes');
    }
}