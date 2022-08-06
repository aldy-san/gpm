<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'title' => false,
            'this_user' => $this->db->where(['id' => $this->session->userdata('user')['id']])->get('users')->row_array(),
            'survei_levels' => ['d4', 's1', 's2', 's3', false],
            'survei_roles' => ['mahasiswa', 'dosen', 'tendik', 'alumni', 'mitra', 'pengguna']
        ];
        if ($this->globalData['this_user']['role'] !== 'superadmin') {
            $this->session->set_flashdata('alertForm', 'Role anda tidak memiliki akses untuk halaman tersebut');
            $this->session->set_flashdata('alertType', 'danger');
            redirect('auth');
        }
    }
    public function index()
	{
        $data = $this->globalData;
		$this->load->view('layouts/header', $data);
		$this->load->view('admin/index');
		$this->load->view('layouts/footer');
	}
    public function survei($slug)
    {
        //get slug
        $data = $this->globalData;
        $data['slug'] = explode('-', $slug)[0];
        $data['sub_slug'] = count(explode('-', $slug)) > 1 ? explode('-', $slug)[1] : false;
        $table = 'survei';
        if(!in_array($data['sub_slug'], $this->globalData['survei_levels']) || !in_array($data['slug'], $this->globalData['survei_roles']) ) redirect('/dashboard');
        // Config Pagination
		$config['base_url'] = base_url('/survei/'.$slug);
		$config['total_rows'] = $this->db->where(['level' => $slug])->get($table)->num_rows();;
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        if ($data['sub_slug']){
            $data['data_table'] = $this->db->where(['role' => $data['slug'], 'level' => $data['sub_slug']])->limit($config['per_page'], $config['start'])->get($table)->result_array();
        }else {
            $data['data_table'] = $this->db->where(['role' => $data['slug']])->limit($config['per_page'], $config['start'])->get($table)->result_array();
        }

        // Config Template Table Page
        $data['title'] = 'Survei '.$data['slug'];
        $data['desc'] = '';
        $data['create_url'] = '/survei/'.$slug.'/create/';
        $data['edit_url'] = '/survei/'.$slug.'/edit/';
        $data['detail_url'] = '/survei/'.$slug.'/detail/';
        $data['delete_url'] = '/survei/'.$slug.'/delete/';
        $data['column_table'] = ['id','question', 'type', 'selections', 'bar_from', 'bar_to', 'bar_length', 'chart'];

        $this->load->view('layouts/header', $data);
        $this->load->view('template/table_page',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function create_survei($slug)
    {
        // get slug
        $data = $this->globalData;
        $data['slug'] = explode('-', $slug)[0];
        $data['sub_slug'] = count(explode('-', $slug)) > 1 ? explode('-', $slug)[1] : false;
        $data['data_slug'] = false;

        if($this->input->post()){
            $this->form_validation->set_rules('question','question','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    'level' => $data['sub_slug'],
                    'role' => $data['slug'],
                    'question' => $this->input->post('question'),
                    'type' => $this->input->post('type'),
                    'selections' => $this->input->post('selections'),
                    'bar_from' => $this->input->post('bar_from'),
                    'bar_to' => $this->input->post('bar_to'),
                    'bar_length' => $this->input->post('bar_length'),
                    'chart' => $this->input->post('chart'),
                ];
                $this->db->insert('survei', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/survei/'.$slug);
            }
        }
        $data['title'] = 'Tambah Survei '.$data['slug'];
        $this->load->view('layouts/header', $data);
        $this->load->view('superadmin/form/survei',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function detail_survei($slug, $id)
    {
        $data = $this->globalData;
        $data['slug'] = $slug;
        $data['data_slug'] = $this->db->where(['id' => $id])->get('survei')->row_array();
        $data['title'] = 'Detail Survei '.$data['slug'];
        $this->load->view('layouts/header', $data);
        $this->load->view('superadmin/form/survei',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function edit_survei($slug,$id)
    {
        $data = $this->globalData;
        $data['slug'] = explode('-', $slug)[0];
        $data['sub_slug'] = count(explode('-', $slug)) > 1 ? explode('-', $slug)[1] : false;

        if($this->input->post()){
            $this->form_validation->set_rules('question','question','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    'level' => $data['sub_slug'],
                    'role' => $data['slug'],
                    'question' => $this->input->post('question'),
                    'type' => $this->input->post('type'),
                    'selections' => $this->input->post('selections'),
                    'bar_from' => $this->input->post('bar_from'),
                    'bar_to' => $this->input->post('bar_to'),
                    'bar_length' => $this->input->post('bar_length'),
                    'chart' => $this->input->post('chart'),
                ];
                $this->db->where(['id' => $id])->update('survei', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
                $this->session->set_flashdata('alertType', 'success');
                redirect('/survei/'.$slug);
            }
        }
        $data['data_slug'] = $this->db->where(['id' => $id])->get('survei')->row_array();
        $data['title'] = 'Edit Survei '.$data['slug'];
        $this->load->view('layouts/header', $data);
        $this->load->view('superadmin/form/survei',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function delete_survei($slug)
    {
        $this->db->where(['id' => $this->input->post('id')])->delete('survei');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('/survei/'.$slug);
    }
}