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
            'survei_roles' => ['mahasiswa', 'dosen', 'tendik', 'alumni', 'mitra', 'pengguna'],
            'category_dosen' => $this->M_survei->getCategory('dosen', false),
            'category_mahasiswa' => $this->M_survei->getCategory('mahasiswa', false),
            'category_tendik' => $this->M_survei->getCategory('tendik', false),
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
        $data['category'] = $this->db->order_by('id', 'DESC')->get_where('category')->result_array();
		customView('dosen/index', $data);
	}
    // Constitution ===========================================================================================
    public function constitution()
    {
        //config
        $data = $this->globalData;
        $table = 'constitution';
        $root_url = '/manage-constitution/';
        $data['title'] = 'Peraturan';
        $data['desc'] = '';
        $data['create_url'] = $root_url.'create/';
        $data['edit_url'] = $root_url.'edit/';
        $data['detail_url'] = $root_url.'detail/';
        $data['delete_url'] = $root_url.'delete/';
        //$data['download_url'] = '/sertifikat/';
        $data['column_table'] = ['id','name', 'type'];
        $data['column_alias'] = ['id','nama', 'tipe'];

        // Config Pagination
        $config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
        $config['per_page'] = 10;
        $config['start'] = $this->uri->segment(2);
        $this->pagination->initialize($config);
        $data['data_table'] = $this->db->get($table, $config['per_page'], $config['start'])->result_array();
        customView('template/table_page', $data);
    }
    public function create_constitution()
    {
        // get slug
        $data = $this->globalData;
        $data['is_edit'] = true;
        $data['data_slug'] = false;
        if($this->input->post()){
            $this->form_validation->set_rules('name','Nama Sertifikat','trim|required');
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
                    //$error = array('error' => $this->upload->display_errors());
                    //echo json_encode($error);
                    //die();
                    $file = '';
                } else {
                    $file = $this->upload->data('file_name');
                }
                $form = [
                    'name' => $this->input->post('name'),
                    'type' => $this->input->post('type'),
                    'url' => $this->input->post('url'),
                    'files' => $file,
                ];
                $this->db->insert('constitution', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('manage-constitution');
            }
        }
        $data['title'] = 'Tambah Peraturan';
        customView('superadmin/form/constitution', $data);
    }
    public function edit_constitution($id)
    {
        // get slug
        $data = $this->globalData;
        $data['is_edit'] = true;
        $data['data_slug'] = false;
        if($this->input->post()){
            $this->form_validation->set_rules('name','Nama Sertifikat','trim|required');
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
                    //$error = array('error' => $this->upload->display_errors());
                    //echo json_encode($error);
                    //die();
                    $file = '';
                } else {
                    $file = $this->upload->data('file_name');
                }
                $form = [
                    'name' => $this->input->post('name'),
                    'type' => $this->input->post('type')
                ];
                if ($form['type'] === 'url'){
                    $form['url'] = $this->input->post('url');
                } else {
                    $form['files'] = $file;
                }
                $this->db->where(['id' => $id])->update('constitution', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('manage-constitution');
            }
        }
        $data['data_slug'] = $this->db->where(['id' => $id])->get('constitution')->row_array();
        $data['title'] = 'Edit Peraturan';
        customView('superadmin/form/constitution', $data);
    }
    public function detail_constitution($id)
    {
        $data = $this->globalData;
        $data['data_slug'] = $this->db->where(['id' => $id])->get('constitution')->row_array();
        $data['is_edit'] = false;
        $data['title'] = 'Detail Peraturan '. $data['data_slug']['name'];
        customView('superadmin/form/constitution', $data);
    }
    public function delete_constitution()
    {
        $this->db->where(['id' => $this->input->post('id')])->delete('constitution');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('manage-constitution');
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
        $data['custom_url'] = '/manage-period/analisis/';
        $data['custom_url_name'] = 'Analisis';
        $data['column_table'] = ['id','name', 'category', 'period_from', 'period_to'];
        $data['column_alias'] = ['id','nama', 'kategori', 'dari tanggal', 'sampai tanggal'];

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(2);
		$this->pagination->initialize($config);
        $temp = $this->db->order_by('period_from DESC')->get($table, $config['per_page'], $config['start'])->result_array();
        $data['data_table'] = [];
        $category = $this->db->get('category')->result_array();
        foreach ($temp as $value) {
            $value['category'] = findObjectBy('id', $value['category'], $category)['name'];
            $value['period_from'] = gmdate("d M, Y", $value['period_from']+25200);
            $value['period_to'] = gmdate("d M, Y", $value['period_to']+25200);
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
        $data['custom_url_end'] = '/0';
        $data['custom_url_name'] = 'Survei';
        $data['column_table'] = ['name', 'role'];
        $data['column_alias'] = ['no','nama kategori', 'role'];
        $data['is_survei_dosen_active'] = $this->db->get_where('survei_activation', ['name' => 'dosen'])->row_array();

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(2);
		$this->pagination->initialize($config);
        $data['data_table'] = $this->db->get_where($table,['name !=' => 'Dosen Terbaik'],$config['per_page'], $config['start'])->result_array();
        // var_dump($data['data_table']); die();
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
        if($id === "dosen_terbaik") $data['data_slug'] = $this->db->where(['name' => 'Dosen Terbaik'])->get('category')->row_array();
        else $data['data_slug'] = $this->db->where(['id' => $id])->get('category')->row_array();
        $data['is_edit'] = false;
        $data['title'] = 'Detail Kategory '. $data['data_slug']['name'];
        customView('superadmin/form/category', $data);
    }
    public function delete_category()
    {
        $this->db->where(['id' => $this->input->post('id')])->delete('category');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('/manage-category/');
    }

    // SURVEI ===========================================================================================
    public function survei($slug)
    {
        //get slug
        //var_dump($this->uri->segment(3));die;
        if ($this->uri->segment(3) == NULL){
            redirect(current_url().'/0');
        }
        $data = $this->globalData;
        $data['slug'] = $slug;
        //$data['sub_slug'] = count(explode('-', $slug)) > 1 ? explode('-', $slug)[1] : false;
        $table = 'survei';

        //if(!in_array($data['sub_slug'], $this->globalData['survei_levels']) || !in_array($data['slug'], $this->globalData['survei_roles']) ) redirect('/dashboard');
        if (is_numeric($data['slug'])){
            $where = ['category' => $data['slug']];
            $category = $this->db->get('category')->result_array();
            $data['title'] = 'Survei '.findObjectBy('id', $data['slug'], $category)['name'];
        }
        else {
            $where = ['role' => $data['slug']];
            $data['title'] = 'Survei '.$data['slug'];
            $data['activation'] = $data['slug'];
            $data['is_survei_active'] = $this->db->get_where('survei_activation', ['name' => $data['slug']])->row_array();
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
            $data['column_table'] = ['id', 'question', 'type', 'chart', 'klasifikasi', 'analisis', 'is_active'];
            $data['column_alias'] = ['id', 'pertanyaan', 'tipe', 'grafik', 'klasifikasi', 'analisis', 'aktif'];
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
                    'klasifikasi' => $this->input->post('klasifikasi'),
                    'analisis' => $this->input->post('analisis'),
                    'is_active' => $this->input->post('is_active'),
                    'description' => $this->input->post('description'),
                ];
                //var_dump($form);die;
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
        } else if($slug === 'dosen-terbaik'){
            $data['title'] = 'Survei Dosen & Tendik Terbaik';
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
        $data['sub_slug'] = count(explode('-', $slug)) > 1  ? explode('-', $slug)[1] : false;
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
                        'klasifikasi' => $this->input->post('klasifikasi'),
                        'analisis' => $this->input->post('analisis'),
                        'is_active' => $this->input->post('is_active'),
                        'description' => $this->input->post('description'),
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
        } else if($data['slug'] === 'dosen-terbaik'){
            $data['category'] = $this->db->get('category')->result_array();
            $data['title'] = 'Survei '.findObjectBy('id', $id, $data['category'])['name'];
        }else {
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

    public function analisis($slug, $type = false){
        $data = $this->globalData;
        $data['list_type'] = ['keunggulan', 'kelemahan', 'ancaman', 'peluang', 'temuan', 'strategi'];
        if (!in_array($type, $data['list_type'])){
            redirect(base_url().'manage-period/analisis/'.$slug.'/keunggulan');
        }
        if($this->input->post('description')){
            $this->form_validation->set_rules('description','Deskripsi','trim|required');
			if($this->form_validation->run()){
                $form = [
                    'description' => $this->input->post('description'),
                    'type' => $type,
                    'id_period' => $slug,
                    'status' => 'draft',
                    'updated_at' => time(),
                ];
                $this->db->insert('analisis', $form);
            }
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
        $data['kadep'] = $this->db_master->get_where('user', ['level' => 10])->row_array();
        //var_dump($data['period']);die;
        //echo json_encode($data['data_info']);die;
        customView('superadmin/analisis', $data);
    }
    public function edit_analisis($slug, $type = false){
        $form = [];
        if ($this->input->post('description')){
            $form['description'] = $this->input->post('description');
            $form['updated_at'] = time();
            //if ($this->db->get_where('analisis', ['id' => $this->input->post('id')])->row_array()['status'] === 'revised'){
            //    $form['status'] = 'submitted';
            //}
            $this->db->where(['id' => $this->input->post('id')])->update('analisis', $form);
            $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
        }
        if ($this->input->post('status')){
            $form['status'] = $this->input->post('status');
            $this->db->where(['id_period' => $slug])->update('analisis', $form);
            $this->db->where(['id' => $slug])->update('period', ['status' => $this->input->post('status')]);
            $this->session->set_flashdata('alertForm', 'Data berhasil diajukan');
        }
		$this->session->set_flashdata('alertType', 'success');
        redirect('/manage-period/analisis/'.$slug.'/'.$this->input->post('type'));
    }
    public function delete_analisis($slug)
    {
        $this->db->where(['id' => $this->input->post('id')])->delete('analisis');
        $this->session->set_flashdata('alertForm', 'Data berhasil dihapus');
		$this->session->set_flashdata('alertType', 'success');
        redirect('/manage-period/analisis/'.$slug.'/'.$this->input->post('type'));
    }

    public function settings()
    {
        //config
        $data = $this->globalData;
        $data['population_graph'] = [
            'Mahasiswa/Dosen/Tendik' => $this->db->get_where('settings', ['type' => 'population_graphic_mahasiswa'])->result_array(),
            'Mitra' => $this->db->get_where('settings', ['type' => 'population_graphic_mitra'])->result_array(),
            'Alumni' => $this->db->get_where('settings', ['type' => 'population_graphic_alumni'])->result_array(),
            'Pengguna' => $this->db->get_where('settings', ['type' => 'population_graphic_pengguna'])->result_array()
        ];
        customView('superadmin/settings', $data);
    }
}