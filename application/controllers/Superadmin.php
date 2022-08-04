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
            'this_user' => $this->db->where(['id' => $this->session->userdata('user')['id']])->get('users')->row_array()
        ];
    }
    public function survei_mahasiswa($slug)
    {
        $data = $this->globalData;
        // Config Pagination
		$config['base_url'] = base_url('/survei-mahasiswa/'.$slug);
		$config['total_rows'] = $this->db->where(['level' => $slug])->get('survei_mahasiswa')->num_rows();;
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $data['data_table'] = $this->db->where(['level' => $slug])->limit($config['per_page'], $config['start'])->get('survei_mahasiswa')->result_array();

        // Config Template Table Page
        $data['title'] = 'Survei Mahasiswa';
        $data['desc'] = '';
        $data['create_url'] = '/survei-mahasiswa/'.$slug.'/create/';
        $data['edit_url'] = '/survei-mahasiswa/'.$slug.'/edit/';
        $data['detail_url'] = '/survei-mahasiswa/'.$slug.'/detail/';
        $data['delete_url'] = '/survei-mahasiswa/'.$slug.'/delete/';
        $data['column_table'] = ['question', 'type', 'selections', 'bar_from', 'bar_to', 'bar_length'];

        $this->load->view('layouts/header', $data);
        $this->load->view('template/table_page',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function create_survei_mahasiswa($slug)
    {
        if($this->input->post()){
            $this->form_validation->set_rules('question','question','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    'level' => $slug,
                    'question' => $this->input->post('question'),
                    'type' => $this->input->post('type'),
                    'selections' => $this->input->post('selections'),
                    'bar_from' => $this->input->post('bar_from'),
                    'bar_to' => $this->input->post('bar_to'),
                    'bar_length' => $this->input->post('bar_length'),
                ];
                $this->db->insert('survei_mahasiswa', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/survei-mahasiswa/'.$slug);
            }
        }
        $data = $this->globalData;
        $data['slug'] = $slug;
        $data['data_slug'] = false;
        $data['title'] = 'Create Survei Mahasiswa';
        $this->load->view('layouts/header', $data);
        $this->load->view('superadmin/form/survei_mahasiswa',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function detail_survei_mahasiswa($slug, $id)
    {
        $data = $this->globalData;
        $data['slug'] = $slug;
        $data['data_slug'] = $this->db->where(['id' => $id])->get('survei_mahasiswa')->row_array();
        $data['title'] = 'Detail Survei Mahasiswa';
        $this->load->view('layouts/header', $data);
        $this->load->view('superadmin/form/survei_mahasiswa',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function edit_survei_mahasiswa($slug,$id)
    {
        if($this->input->post()){
            $this->form_validation->set_rules('question','question','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    'level' => $slug,
                    'question' => $this->input->post('question'),
                    'type' => $this->input->post('type'),
                    'selections' => $this->input->post('selections'),
                    'bar_from' => $this->input->post('bar_from'),
                    'bar_to' => $this->input->post('bar_to'),
                    'bar_length' => $this->input->post('bar_length'),
                ];
                $this->db->where(['id' => $id])->update('survei_mahasiswa', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
                $this->session->set_flashdata('alertType', 'success');
                redirect('/survei-mahasiswa/'.$slug);
            }
        }
        $data = $this->globalData;
        $data['slug'] = $slug;
        $data['data_slug'] = $this->db->where(['id' => $id])->get('survei_mahasiswa')->row_array();
        $data['title'] = 'Create Survei Mahasiswa';
        $this->load->view('layouts/header', $data);
        $this->load->view('superadmin/form/survei_mahasiswa',$data);
        $this->load->view('layouts/footer', $data);
    }
    public function delete_survei_mahasiswa($slug)
    {
        $this->db->where(['id' => $this->input->post('id')])->delete('survei_mahasiswa');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('/survei-mahasiswa/'.$slug);
    }
}