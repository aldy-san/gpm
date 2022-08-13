<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\dompdf;
class Dosen extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'this_user' => $this->db->where(['id' => $this->session->userdata('user')['id']])->get('users')->row_array(),
            'title' => false
        ];
        if ($this->globalData['this_user']['role'] !== 'dosen') {
            $this->session->set_flashdata('alertForm', 'Role anda tidak memiliki akses untuk halaman tersebut');
            $this->session->set_flashdata('alertType', 'danger');
            redirect('auth');
        }
    }
	public function index()
	{
        $data = $this->globalData;
		$this->load->view('layouts/header', $data);
		$this->load->view('dosen/index');
		$this->load->view('layouts/footer');
	}
	public function result($role)
	{
        $data = $this->globalData;
        $data['survei'] = $this->db->get_where('survei', ['role' => $role])->result_array();
        $data['population'] = ['role'];
		$this->load->view('layouts/header', $data);
		$this->load->view('dosen/result', $data);
		$this->load->view('layouts/footer');
	}
	public function detail($id)
	{
        // get slug
        $data = $this->globalData;
        $data['slug'] = $id;
        $data['sub_slug'] = false;

        // Config Pagination
		$config['base_url'] = base_url('/dosen/detail/'.$id.'/');
		$config['total_rows'] = $this->M_survei->getDetailResultSurvei($id)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(4);
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
        $offset =  $this->input->get('per_page') ?  ($this->input->get('per_page')-1)*$config['per_page'] : 0;
        $data['data_table'] = $this->M_survei->getDetailResultSurvei($id, $config['per_page'], $offset)->result_array();
        $data['survei'] = $this->db->get_where('survei', ['id' => $id])->row_array();
        // Config Template Table Page
        $data['title'] = 'Detail - '.$data['survei']['question'];
        $data['desc'] = '';
        $data['create_url'] = false;
        $data['edit_url'] = false;
        $data['detail_url'] = false;
        $data['delete_url'] = false;
        $data['column_table'] = ['username', 'answer'];

        $this->load->view('layouts/header', $data);
        $this->load->view('template/table_page',$data);
        $this->load->view('layouts/footer', $data);
	}
}