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

    public function analisis_periode()
    {
        //config
        $data = $this->globalData;
        $table = 'period';
        $root_url = '/analisis-period/';
        $data['title'] = 'Analisis Periode';
        $data['desc'] = '';
        $data['detail_url'] = false;
        $data['create_url'] = false;
        $data['edit_url'] = false;
        $data['delete_url'] = false;
        $data['custom_url'] = '/analisis-periode/analisis/';
        $data['custom_url_name'] = 'Analisis';
        $data['column_table'] = ['id','name', 'category', 'status', 'period_from', 'period_to'];
        $data['column_alias'] = ['id','nama', 'kategori', 'status', 'dari tanggal', 'sampai tanggal'];

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get_where($table, 'status = "submitted" OR status = "revised"')->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $temp = $this->db->get_where($table, 'status = "submitted" OR status = "revised"', $config['per_page'], $config['start'])->result_array();
        $data['data_table'] = [];
        $category = $this->db->get('category')->result_array();
        $data['column_badge'] = ['status'];
        foreach ($temp as $value) {
            $value['category'] = findObjectBy('id', $value['category'], $category)['name'];
            $value['period_from'] = gmdate("d-m-Y", $value['period_from']+25200);
            $value['period_to'] = gmdate("d-m-Y", $value['period_to']+25200);
            array_push($data['data_table'],$value);
        }
        customView('template/table_page', $data);
    }

    public function analisis($slug, $type = false){
        $data = $this->globalData;
        $data['list_type'] = ['keunggulan', 'kelemahan', 'ancaman', 'peluang', 'temuan', 'strategi'];
        if (!in_array($type, $data['list_type'])){
            redirect(base_url().'analisis-periode/analisis/'.$slug.'/keunggulan');
        }
        $data['data_table'] = $this->db->get_where('analisis', ['id_period' => $slug, 'type' => $type])->result_array();
        $data['check_status'] = $this->db->get_where('period', ['id' => $slug])->row_array()['status'];
        $this->db->select('answer, nama_lengkap, survei.id');
        $this->db->from('period');
        $this->db->where(['analisis' => $type, 'period.id' => $slug]);
        $this->db->join('category', 'period.category=category.id');
        $this->db->join('survei', 'survei.category=category.id');
        $this->db->join('answer', 'answer.id_survei=survei.id');
        $this->db->join('db_master.user', 'answer.id_user=user.username');
        $data['data_info'] = $this->db->limit(5)->get()->result_array();
        $data['period'] = $this->db->get_where('period', ['id' => $slug])->row_array();

        customView('dosen/analisis', $data);
    }
    public function edit_analisis($slug, $type = false){
        if ($this->input->post('status') === 'accepted'){
            $form['status'] = $this->input->post('status');
            $this->db->where(['id_period' => $slug])->update('analisis', $form);
            $this->db->where(['id' => $slug])->update('period', ['status' => $this->input->post('status')]);
            $this->session->set_flashdata('alertForm', 'Data berhasil divalidasi');
        }
        if ($this->input->post('status') === 'revised'){
            $form['status'] = $this->input->post('status');
            $form['note'] = $this->input->post('note');
            $this->db->where(['id' => $this->input->post('id')])->update('analisis', $form);
            $this->db->where(['id' => $slug])->update('period', ['status' => $this->input->post('status')]);
            $this->session->set_flashdata('alertForm', 'Data berhasil direvisi');
        }
		$this->session->set_flashdata('alertType', 'success');
        redirect('/analisis-periode/analisis/'.$slug.'/'.$this->input->post('type'));
    }
}