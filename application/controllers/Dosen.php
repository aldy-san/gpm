<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\dompdf;
class Dosen extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
		$this->db_master = $this->load->database('db_master', TRUE);
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'this_user' => $this->db_master->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array(),
            'title' => false,
            'category_dosen' => $this->M_survei->getCategory('dosen'),
            'category_mahasiswa' => $this->M_survei->getCategory('mahasiswa'),
            'category_tendik' => $this->M_survei->getCategory('tendik'),
        ];
        if (getRole($this->globalData['this_user']['level']) !== 'dosen') {
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
	public function result($role, $category = null)
	{
        $data = $this->globalData;
        $data['survei'] = $this->db->get_where('survei', ['role' => $role])->result_array();
        $data['period'] = $this->db->order_by("period_from", "desc")->get_where('period', ['category' => $category])->result_array();

        $data['population'] = [];
        $data['labels'] = [];
        if ($role === 'mahasiswa') {
            $data['population'] = ['jenis_kelamin', 'jenjang', 'kode_prodi', 'tahun_masuk'];
            $data['titles'] = ['Jenis Kelamin', 'Jenjang', 'Prodi', 'Tahun Masuk'];
            $data['labels'] = [false, 'jenjang', 'prodi', false];
        } else if ($role === 'alumni'){
            $data['population'] = ['year_to', 'year_from', 'prodi', 'activity'];
            $data['titles'] = ['Tahun Masuk', 'Tahun Lulus', 'Prodi', 'Aktifitas Setelah Lulus'];
        } else if ($role === 'mitra'){
            $data['population'] = ['position', 'agency', 'scale', 'year_since', 'year_coop'];
            $data['titles'] = ['Position', 'Instansi', 'Skala', 'Tahun Berdiri', 'Tahun Kerjasama'];
        } 
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
        $data['column_table'] = ['nama_lengkap', 'answer'];

        $this->load->view('layouts/header', $data);
        $this->load->view('template/table_page',$data);
        $this->load->view('layouts/footer', $data);
	}

    public function repository()
    {
        //config
        $data = $this->globalData;
        $table = 'repository';
        $root_url = '/dosen/repository/';
        $data['title'] = 'Repository';
        $data['desc'] = '';
        $data['create_url'] = $root_url.'create/';
        $data['edit_url'] = $root_url.'edit/';
        $data['detail_url'] = $root_url.'detail/';
        $data['delete_url'] = $root_url.'delete/';
        $data['column_table'] = ['id','name', 'institution', 'date', 'category'];

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $temp = $this->db->get($table, $config['per_page'], $config['start'])->result_array();
        $data['data_table'] = [];
        foreach ($temp as $value) {
            $value['date'] = gmdate("d-m-Y", $value['date']);
            array_push($data['data_table'],$value);
        }
        customView('template/table_page', $data);
    }
    public function create_repository()
    {
        // get slug
        $data = $this->globalData;
        $data['is_edit'] = true;
        $data['data_slug'] = false;
        if($this->input->post()){
            $this->form_validation->set_rules('name','Nama Sertifikat','trim|required');
            $this->form_validation->set_rules('institution','Nama Lembaga','trim|required');
            $this->form_validation->set_rules('date','Tanggal Kegiatan','trim|required');
            $this->form_validation->set_rules('category','Kategori','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    'name' => $this->input->post('name'),
                    'institution' => $this->input->post('institution'),
                    'date' => strtotime($this->input->post('date')),
                    'category' => $this->input->post('category'),
                ];
                $this->db->insert('repository', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/dosen/repository');
            }
        }
        $data['title'] = 'Tambah Periode';
        customView('/dosen/repository', $data);
    }
    public function edit_repository($id)
    {
        // get slug
        $data = $this->globalData;
        $data['is_edit'] = true;
        $data['data_slug'] = false;
        if($this->input->post()){
            $this->form_validation->set_rules('name','Nama Sertifikat','trim|required');
            $this->form_validation->set_rules('institution','Nama Lembaga','trim|required');
            $this->form_validation->set_rules('date','Tanggal Kegiatan','trim|required');
            $this->form_validation->set_rules('category','Kategori','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    'name' => $this->input->post('name'),
                    'institution' => $this->input->post('institution'),
                    'date' => strtotime($this->input->post('date')),
                    'category' => $this->input->post('category'),
                ];
                $this->db->where(['id' => $id])->update('repository', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/dosen/repository');
            }
        }
        $data['data_slug'] = $this->db->where(['id' => $id])->get('repository')->row_array();
        $data['title'] = 'Edit Sertifikat';
        customView('/dosen/repository', $data);
    }
    public function detail_repository($id)
    {
        $data = $this->globalData;
        $data['data_slug'] = $this->db->where(['id' => $id])->get('repository')->row_array();
        $data['is_edit'] = false;
        $data['title'] = 'Detail Sertifikat '. $data['data_slug']['name'];
        customView('/dosen/repository', $data);
    }
    public function delete_repository()
    {
        var_dump($this->input->post('id'));
        $this->db->where(['id' => $this->input->post('id')])->delete('repository');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('/dosen/repository');
    }
}