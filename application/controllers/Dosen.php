<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\dompdf;
class Dosen extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
		$this->db_master = $this->load->database('db_master', TRUE);
        $this_user = $this->db_master->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();

        $temp = $this->M_survei->getCategoryAnswered('dosen',$this_user['username']);
        $category_dosen_avail = $this->M_survei->getCategory('dosen');
        $category_dosen_answered = [];
        foreach ($temp as $value) {
            array_push($category_dosen_answered,$value['name']);
        }

        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'this_user' => $this_user,
            'title' => false,
            'category_dosen_avail' => $category_dosen_avail,
            'category_dosen_answered' => $category_dosen_answered,
            'category_dosen' => $this->M_survei->getCategory('dosen', false),
            'category_mahasiswa' => $this->M_survei->getCategory('mahasiswa', false),
            'category_tendik' => $this->M_survei->getCategory('tendik', false),
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
		customView('dosen/index', $data);
	}
	public function result($role, $category = null)
	{
        $data = $this->globalData;
        
        if ($category){
            $data['survei'] = $this->db->get_where('survei', ['category' => $category])->result_array();
        } else {
            $data['survei'] = $this->db->get_where('survei', ['role' => $role])->result_array();
        }

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
		customView('dosen/result', $data);
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
        $data['column_alias'] = ['nama_lengkap', 'jawaban'];
		customView('template/table_page', $data);
	}

    public function all_repository()
    {
        //config
        $data = $this->globalData;
        $table = 'repository';
        $root_url = '/dosen/repository/';
        $data['title'] = 'Semua Repositori';
        $data['desc'] = '';
        $data['create_url'] = false;
        $data['edit_url'] = false;
        $data['detail_url'] = false;
        $data['delete_url'] = false;
        $data['download_url'] = '/sertifikat/';
        $data['column_table'] = ['id','name', 'institution', 'date', 'category','nama_lengkap'];
        $data['column_alias'] = ['id','nama', 'Nama Lembaga', 'Tanggal', 'kategori','nama lengkap'];

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $temp = $this->db->join('db_master.user', 'user.username=id_user')->get($table, $config['per_page'], $config['start'])->result_array();
        $data['data_table'] = [];
        foreach ($temp as $value) {
            $value['date'] = gmdate("d M, Y", $value['date']);
            array_push($data['data_table'],$value);
        }
        customView('template/table_page', $data);
    }
    public function repository()
    {
        //config
        $data = $this->globalData;
        $table = 'repository';
        $root_url = '/dosen/repository/';
        $data['title'] = 'Repositori Saya';
        $data['desc'] = '';
        $data['create_url'] = $root_url.'create/';
        $data['edit_url'] = $root_url.'edit/';
        $data['detail_url'] = $root_url.'detail/';
        $data['delete_url'] = $root_url.'delete/';
        $data['download_url'] = '/sertifikat/';
        $data['column_table'] = ['id','name', 'institution', 'date', 'category'];
        $data['column_alias'] = ['id','nama', 'Nama Lembaga', 'Tanggal', 'kategori'];

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $temp = $this->db->get_where($table, ['id_user' => $data['this_user']['username']], $config['per_page'], $config['start'])->result_array();
        $data['data_table'] = [];
        foreach ($temp as $value) {
            $value['date'] = gmdate("d M, Y", $value['date']);
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
                $config['upload_path']	= './sertifikat';
                $config['allowed_types'] = 'pdf';
                $file = $_FILES['sertifikat']['name'];
                $this->load->library('upload');
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('sertifikat')) {
                    $error = array('error' => $this->upload->display_errors());
                    echo json_encode($error);
                    die();
                } else {
                    $file = $this->upload->data('file_name');
                }
                $form = [
                    'name' => $this->input->post('name'),
                    'institution' => $this->input->post('institution'),
                    'date' => strtotime($this->input->post('date')),
                    'category' => $this->input->post('category'),
                    'files' => $file,
                    'id_user' => $data['this_user']['username'],
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
                $config['upload_path']	= './sertifikat';
                $config['allowed_types'] = 'pdf';
                $file = $_FILES['sertifikat']['name'];
                $this->load->library('upload');
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('sertifikat')) {
                    $error = array('error' => $this->upload->display_errors());
                    echo json_encode($error);
                    die();
                } else {
                    $file = $this->upload->data('file_name');
                }
                $form = [
                    'name' => $this->input->post('name'),
                    'institution' => $this->input->post('institution'),
                    'date' => strtotime($this->input->post('date')),
                    'category' => $this->input->post('category'),
                    'files' => $file,
                    'id_user' => $data['this_user']['username']
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
        $this->db->where(['id' => $this->input->post('id')])->delete('repository');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('/dosen/repository');
    }
}