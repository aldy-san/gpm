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
        $per_page =  $this->input->get('per_page') ?  $this->input->get('per_page')-1 : 0;
        // Config Pagination
		$config['base_url'] = base_url('/dosen/detail/'.$id.'/');
		$config['total_rows'] = $this->db->select('users.username, answer.answer')->from('answer')->where(['id_survei' => $id])->join('users', 'users.id = answer.id_user', 'left')->get()->num_rows();
		$config['per_page'] = 2;
		$config['start'] = $this->uri->segment(4);
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
        $data['data_table'] = $this->db->select('users.username, answer.answer')->from('answer')->where(['id_survei' => $id])->join('users', 'users.id = answer.id_user', 'left')->limit($config['per_page'],$per_page * $config['per_page'])->get()->result_array();

        // Config Template Table Page
        $data['title'] = 'Detail Result '.$data['slug'];
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