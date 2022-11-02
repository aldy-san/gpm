<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
        $this->db_master = $this->load->database('db_master', TRUE);
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'this_user' => $this->db_master->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array(),
            'title' => false,
            'survei_levels' => ['d4', 's1', 's2', 's3', false],
            'survei_roles' => ['mahasiswa', 'dosen', 'tendik', 'alumni', 'mitra', 'pengguna']
        ];
        if (getRole($this->globalData['this_user']['level'])  !== 'superadmin') {
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

    // PERIODE ===========================================================================================
    public function period()
    {
        //config
        $data = $this->globalData;
        $table = 'period';
        $root_url = '/manage-period/';
        $data['title'] = 'Periode';
        $data['desc'] = '';
        $data['create_url'] = $root_url.'create/';
        $data['edit_url'] = $root_url.'edit/';
        $data['detail_url'] = $root_url.'detail/';
        $data['delete_url'] = $root_url.'delete/';
        $data['column_table'] = ['id','name', 'category', 'period_from', 'period_to'];
        $data['column_alias'] = ['id','nama', 'kategori', 'dari tanggal', 'sampai tanggal'];

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $temp = $this->db->get($table, $config['per_page'], $config['start'])->result_array();
        $data['data_table'] = [];
        $category = $this->db->get('category')->result_array();
        foreach ($temp as $value) {
            $value['category'] = findObjectBy('id', $value['category'], $category)['name'];
            $value['period_from'] = gmdate("d-m-Y", $value['period_from']);
            $value['period_to'] = gmdate("d-m-Y", $value['period_to']);
            array_push($data['data_table'],$value);
        }
        customView('template/table_page', $data);
    }
    
    public function create_period()
    {
        // get slug
        $data = $this->globalData;
        $data['is_edit'] = true;
        $data['data_slug'] = false;
        if($this->input->post()){
            $this->form_validation->set_rules('name','name','trim|required');
            $this->form_validation->set_rules('category','category','trim|required');
            $this->form_validation->set_rules('period_from','period_from','trim|required');
            $this->form_validation->set_rules('period_to','period_to','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    'name' => $this->input->post('name'),
                    'category' => $this->input->post('category'),
                    'period_from' => strtotime($this->input->post('period_from'))+1,
                    'period_to' => strtotime($this->input->post('period_to'))+1,
                ];
                $this->db->insert('period', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/manage-period/');
            }
        }
        $data['title'] = 'Tambah Periode';
        $data['category'] = $this->db->get('category')->result_array();
        customView('superadmin/form/period', $data);
    }
    public function edit_period($id)
    {
        // get slug
        $data = $this->globalData;
        $data['is_edit'] = true;
        $data['data_slug'] = false;
        if($this->input->post()){
            $this->form_validation->set_rules('name','name','trim|required');
            $this->form_validation->set_rules('category','category','trim|required');
            $this->form_validation->set_rules('period_from','period_from','trim|required');
            $this->form_validation->set_rules('period_to','period_to','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    'name' => $this->input->post('name'),
                    'category' => $this->input->post('category'),
                    'period_from' => strtotime($this->input->post('period_from')),
                    'period_to' => strtotime($this->input->post('period_to')),
                ];
                $this->db->where(['id' => $id])->update('period', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/manage-period/');
            }
        }
        $data['data_slug'] = $this->db->where(['id' => $id])->get('period')->row_array();
        $data['title'] = 'Edit Periode';
        $data['category'] = $this->db->get('category')->result_array();
        customView('superadmin/form/period', $data);
    }
    public function detail_period($id)
    {
        $data = $this->globalData;
        $data['data_slug'] = $this->db->where(['id' => $id])->get('period')->row_array();
        $data['is_edit'] = false;
        $data['title'] = 'Detail Period '. $data['data_slug']['name'];
        $data['category'] = $this->db->get('category')->result_array();
        customView('superadmin/form/period', $data);
    }
    public function delete_period()
    {
        var_dump($this->input->post('id'));
        $this->db->where(['id' => $this->input->post('id')])->delete('period');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('/manage-period/');
    }
    
    // CATEGORY ===========================================================================================
    public function category()
    {
        //config
        $data = $this->globalData;
        $table = 'category';
        $root_url = '/manage-category/';
        $data['title'] = 'Kategori Survei';
        $data['desc'] = '';
        $data['create_url'] = $root_url.'create/';
        $data['edit_url'] = $root_url.'edit/';
        $data['detail_url'] = $root_url.'detail/';
        $data['delete_url'] = $root_url.'delete/';
        $data['custom_url'] = '/survei/';
        $data['column_table'] = ['id','name', 'role'];
        $data['column_alias'] = ['id','nama kategori', 'role'];

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $data['data_table'] = $this->db->get($table, $config['per_page'], $config['start'])->result_array();

        customView('template/table_page', $data);
    }
    public function create_category()
    {
        // get slug
        $data = $this->globalData;
        $data['is_edit'] = true;
        $data['data_slug'] = false;
        if($this->input->post()){
            $this->form_validation->set_rules('name','name','trim|required');
            $this->form_validation->set_rules('role','role','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
                var_dump('as');
			} else {
                $form = [
                    'name' => $this->input->post('name'),
                    'role' => $this->input->post('role'),
                ];
                $this->db->insert('category', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/manage-category/');
            }
        }
        $data['title'] = 'Tambah Kategori';
        customView('superadmin/form/category', $data);
    }
    public function edit_category($id)
    {
        // get slug
        $data = $this->globalData;
        $data['is_edit'] = true;
        $data['data_slug'] = false;
        if($this->input->post()){
            $this->form_validation->set_rules('name','name','trim|required');
            $this->form_validation->set_rules('role','role','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    'name' => $this->input->post('name'),
                    'role' => $this->input->post('role'),
                ];
                $this->db->where(['id' => $id])->update('category', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/manage-category/');
            }
        }
        $data['data_slug'] = $this->db->where(['id' => $id])->get('category')->row_array();
        $data['title'] = 'Edit Kategori';
        customView('superadmin/form/category', $data);
    }
    public function detail_category($id)
    {
        $data = $this->globalData;
        $data['data_slug'] = $this->db->where(['id' => $id])->get('category')->row_array();
        $data['is_edit'] = false;
        $data['title'] = 'Detail Kategory '. $data['data_slug']['name'];
        customView('superadmin/form/category', $data);
    }
    public function delete_category()
    {
        var_dump($this->input->post('id'));
        $this->db->where(['id' => $this->input->post('id')])->delete('category');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('/manage-category/');
    }

    // SURVEI ===========================================================================================
    public function survei($slug)
    {
        //get slug
        $data = $this->globalData;
        $data['slug'] = $slug;
        //$data['sub_slug'] = count(explode('-', $slug)) > 1 ? explode('-', $slug)[1] : false;
        $table = 'survei';

        //if(!in_array($data['sub_slug'], $this->globalData['survei_levels']) || !in_array($data['slug'], $this->globalData['survei_roles']) ) redirect('/dashboard');

        if (is_numeric($data['slug'])){
            $where = ['category' => $data['slug']];
            $category = $this->db->get('category')->result_array();
            $data['title'] = 'Survei '.findObjectBy('id', $data['slug'], $category)['name'];
        } else {
            $where = ['role' => $data['slug']];
            $data['title'] = 'Survei '.$data['slug'];
        }

        // Config Pagination
		$config['base_url'] = base_url('/survei/'.$slug.'/');
        $config['total_rows'] = $this->db->get_where($table, $where)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $data['data_table'] = $this->db->get_where($table, $where, $config['per_page'], $config['start'])->result_array();

        // Config Template Table Page
       
        $data['desc'] = '';
        $data['create_url'] = '/survei/'.$slug.'/create/';
        $data['edit_url'] = '/survei/'.$slug.'/edit/';
        $data['detail_url'] = '/survei/'.$slug.'/detail/';
        $data['delete_url'] = '/survei/'.$slug.'/delete/';
        if (is_numeric($data['slug'])){
            $data['column_table'] = ['question', 'type', 'selections', 'bar_from', 'bar_to', 'chart', 'category', 'is_active'];
            $data['column_alias'] = ['pertanyaan', 'tipe', 'pilihan', 'bar from', 'bar to', 'grafik', 'kategori', 'aktif'];
            $temp = $this->db->get_where($table, $where, $config['per_page'], $config['start'])->result_array();
            $data['data_table'] = [];
            foreach ($temp as $value) {
                $value['category'] = findObjectBy('id', $value['category'], $category)['name'];
                $value['is_active'] = $value['is_active'] ? 'Ya' : 'Tidak';
                array_push($data['data_table'],$value);
            }
        }else {
            $data['column_table'] = ['question', 'type', 'selections', 'bar_from', 'bar_to', 'chart'];
            $data['column_alias'] = ['pertanyaan', 'tipe', 'pilihan', 'bar from', 'bar to', 'grafik'];
        }
        $data['column_badge'] = ['is_active'];
        customView('template/table_page', $data);
    }
    public function create_survei($slug)
    {
        // get slug
        $data = $this->globalData;
        $data['slug'] = explode('-', $slug)[0];
        $data['sub_slug'] = count(explode('-', $slug)) > 1 ? explode('-', $slug)[1] : false;
        $data['data_slug'] = false;
        $data['is_edit'] = true;

        if($this->input->post()){
            $this->form_validation->set_rules('question','Pertanyaan','trim|required');
            //$this->form_validation->set_rules('category','Kategori','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $form = [
                    //'level' => $data['sub_slug'],
                    'role' => $data['slug'],
                    'question' => $this->input->post('question'),
                    'type' => $this->input->post('type'),
                    'selections' => $this->input->post('selections'),
                    'bar_from' => $this->input->post('bar_from') ? $this->input->post('bar_from') : '0%',
                    'bar_to' => $this->input->post('bar_to') ? $this->input->post('bar_to') : '100%',
                    'bar_length' => 100,
                    'chart' => $this->input->post('chart'),
                    'is_active' => $this->input->post('is_active'),
                ];
            if (is_numeric($data['slug'])){
                $form['category'] = $data['slug'];
            }else {
                $form['role'] = $data['slug'];
            }
            $this->db->insert('survei', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/survei/'.$slug);
            }
        }
        if (is_numeric($data['slug'])){
            $data['category'] = $this->db->get('category')->result_array();
            $data['title'] = 'Survei '.findObjectBy('id', $data['slug'], $data['category'])['name'];
        } else{
            $data['title'] = 'Survei '.$data['slug'];
        }
        customView('superadmin/form/survei', $data);
    }
    public function detail_survei($slug, $id)
    {
        $data = $this->globalData;
        $data['slug'] = explode('-', $slug)[0];
        $data['sub_slug'] = count(explode('-', $slug)) > 1 ? explode('-', $slug)[1] : false;
        $data['data_slug'] = $this->db->where(['id' => $id])->get('survei')->row_array();
        $data['is_edit'] = false;
        if (is_numeric($data['slug'])){
            $data['category'] = $this->db->get('category')->result_array();
            $data['title'] = 'Survei '.findObjectBy('id', $data['slug'], $data['category'])['name'];
        } else{
            $data['title'] = 'Survei '.$data['slug'];
        }
        customView('superadmin/form/survei', $data);
    }
    public function edit_survei($slug,$id)
    {
        $data = $this->globalData;
        $data['slug'] = explode('-', $slug)[0];
        $data['sub_slug'] = count(explode('-', $slug)) > 1 ? explode('-', $slug)[1] : false;
        $data['is_edit'] = true;

        if($this->input->post()){
            $this->form_validation->set_rules('question','Pertanyaan','trim|required');
            //$this->form_validation->set_rules('category','Kategori','trim|required');
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
                    'bar_length' => 100,
                    'chart' => $this->input->post('chart'),
                    'category' => $slug,
                    'is_active' => $this->input->post('is_active'),
                ];
                $this->db->where(['id' => $id])->update('survei', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
                $this->session->set_flashdata('alertType', 'success');
                redirect('/survei/'.$slug);
            }
        }
        $data['data_slug'] = $this->db->where(['id' => $id])->get('survei')->row_array();
        if (is_numeric($data['slug'])){
            $data['category'] = $this->db->get('category')->result_array();
            $data['title'] = 'Survei '.findObjectBy('id', $data['slug'], $data['category'])['name'];
        } else{
            $data['title'] = 'Survei '.$data['slug'];
        }
        customView('superadmin/form/survei', $data);
    }
    public function delete_survei($slug)
    {
        $this->db->where(['id' => $this->input->post('id')])->delete('survei');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('/survei/'.$slug);
    }
}