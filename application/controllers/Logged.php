<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logged extends CI_Controller {

	public $globalData;
	public $db_master;
    public function __construct() {
        parent::__construct();
		if (!$this->session->userdata('user')) {
            redirect('auth');
        }
        $this->db_master = $this->load->database('db_master', TRUE);
        $this_user = $this->db_master->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();

        $temp = $this->M_survei->getCategoryAnswered('dosen',$this_user['username']);
        $category_dosen_avail = $this->M_survei->getCategory('dosen');
        $category_dosen_answered = [];
        foreach ($temp as $value) {
            array_push($category_dosen_answered,$value['name']);
        }
        $temp = $this->M_survei->getCategoryAnswered('tendik',$this_user['username']);
        $category_tendik = $this->M_survei->getCategory('tendik');
        $category_tendik_answered = [];
        foreach ($temp as $value) {
            array_push($category_tendik_answered,$value['name']);
        }
        $temp = $this->M_survei->getCategoryAnswered('mahasiswa',$this_user['username']);
        $category_mahasiswa = $this->M_survei->getCategory('mahasiswa');
        $category_mahasiswa_answered = [];
        foreach ($temp as $value) {
            array_push($category_mahasiswa_answered,$value['name']);
        }
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'title' => false,
            'this_user' => $this_user,
            'category_dosen_avail' => $category_dosen_avail,
            'category_dosen_answered' => $category_dosen_answered,
            'category_mahasiswa_avail' => $category_mahasiswa,
            'category_mahasiswa_answered' => $category_mahasiswa_answered,
            'category_tendik_avail' => $category_tendik,
            'category_tendik_answered' => $category_tendik_answered,
            'category_dosen' => $this->M_survei->getCategory('dosen', false),
            'category_mahasiswa' => $this->M_survei->getCategory('mahasiswa', false),
            'category_tendik' => $this->M_survei->getCategory('tendik', false),
        ];
    }

    public function Profile()
    {
        $data = $this->globalData;
        customView('pages/logged/profile', $data);
    }

    public function change_password()
    {
        $data = $this->globalData;
        if ($this->input->post()){
            $this->form_validation->set_rules('old_password','Kata Sandi Lama','trim|required');
            $this->form_validation->set_rules('password','Kata Sandi Baru','min_length[3]|trim|required');
            $this->form_validation->set_rules('confirm_password','Konfirmasi Kata Sandi Baru','trim|required|matches[password]');
            if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
                $this->session->set_flashdata('alertType', 'danger');
			} else {
				$password = $this->input->post('old_password');
                if(md5($password) ===  $data['this_user']['pwd_hash']){
                    $this->M_survei->changePassword($this->input->post('password'), $data['this_user']['username']);
                    $this->session->set_flashdata('alertForm', 'Anda Berhasil Mengganti Password');
                    $this->session->set_flashdata('alertType', 'success');
                    redirect('profile');
                } else {
                    $this->session->set_flashdata('alertForm', 'Password Lama Salah');
                    $this->session->set_flashdata('alertType', 'danger');
                }
            }
        }
        customView('pages/logged/change-password', $data);
    }

    public function survei($id_category){
        $data = $this->globalData;
        $survei = $this->db->get_where('survei',['category' => $id_category, 'is_active' => '1'])->result_array();

        if ($this->input->post()){
                //$this->db->select('id,bar_length');
                foreach($survei as $num => $sur){
                    $this->form_validation->set_rules('answer'.$sur['id'],'answer '.($num+1),'trim|required');
                }
                if(!$this->form_validation->run()){
                    $this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
                }else{
                    $loop = 0;
                    foreach($this->input->post() as $key => $answer){
                        if($survei[$loop]['type'] != 'bar'){
                            $this->db->insert('answer', [
                                'id_user' => $data['this_user']['username'],
                                'id_survei' => filter_var($key, FILTER_SANITIZE_NUMBER_INT),
                                'answer' => $answer,
                                'created_at' => time()
                            ]);
                        }else{
                            if (is_numeric($answer)){
                                // $detail = ($answer > 80 && $answer <=100) ? '81-100'
                                //         : (($answer > 60 && $answer <=80) ? '61-100'
                                //         : (($answer > 40 && $answer <=60) ? '41-60'
                                //         : (($answer > 20 && $answer <=40) ? '21-40' : '0-20')));
                                if($answer > 91 && $answer <=100) $detail='91-100';
                                else if($answer > 81 && $answer <= 90) $detail='81-90';
                                else if($answer > 71 && $answer <= 80) $detail='71-80';
                                else if($answer > 61 && $answer <= 70) $detail='61-70';
                                else if($answer > 51 && $answer <= 60) $detail='51-60';
                                else if($answer > 41 && $answer <= 50) $detail='41-50';
                                else if($answer > 31 && $answer <= 40) $detail='31-40';
                                else if($answer > 21 && $answer <= 30) $detail='21-30';
                                else if($answer > 11 && $answer <= 20) $detail='11-20';
                                else $detail='0-10';
                            }
                            $this->db->insert('answer', [
                                'id_user' => $data['this_user']['username'],
                                'id_survei' => filter_var($key, FILTER_SANITIZE_NUMBER_INT),
                                'answer' => $detail,
                                'detail' => $answer,
                                'created_at' => time()
                            ]);
                        }
                        $loop++;
                    }
                    redirect('/');
                }
        }
        $this->globalData['withSidebar'] = false;
        $data = $this->globalData;
        $data['survei'] = $survei;
        $data['notLogged'] = false;
        $data['category'] = $this->db->get_where('category', ['id' => $id_category])->row_array();
        $data['bar_count'] = $this->db->get_where('survei',['type' => 'bar', 'role' => getRole($this->globalData['this_user']['level'])])->num_rows();
        $data['bar'] = 1;
        customView('pages/survei', $data);
    }

    public function all_repository()
    {
        //config
        $data = $this->globalData;
        $table = 'repository';
        $root_url = 'repository/';
        $data['title'] = 'Semua Repositori';
        $data['desc'] = '';
        $data['create_url'] = false;
        $data['edit_url'] = false;
        $data['detail_url'] = false;
        $data['delete_url'] = false;
        $data['download_url'] = '/sertifikat/';
        $data['column_table'] = ['id','name', 'institution', 'from_date','end_date', 'level','nama_lengkap','category'];
        $data['column_alias'] = ['id','nama', 'Nama Lembaga', 'Tanggal Mulai', 'Tanggal Berakhir', 'Tingkat','nama lengkap','Kategori'];

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $temp = $this->db->join('db_master.user', 'user.username=id_user')->get($table, $config['per_page'], $config['start'])->result_array();

        $data['data_table'] = [];
        foreach ($temp as $value) {
            $value['from_date'] = gmdate("d M, Y", $value['from_date']+25200);
            $value['end_date'] = gmdate("d M, Y", $value['end_date']+25200);
            array_push($data['data_table'],$value);
        }
        customView('template/table_page', $data);
    }
    public function repository()
    {
        //config
        $data = $this->globalData;
        $table = 'repository';
        $root_url = 'repository/';
        $data['title'] = 'Repositori Saya';
        $data['desc'] = '';
        $data['create_url'] = $root_url.'create/';
        $data['edit_url'] = $root_url.'edit/';
        $data['detail_url'] = $root_url.'detail/';
        $data['delete_url'] = $root_url.'delete/';
        $data['download_url'] = '/sertifikat/';
        $data['column_table'] = ['id','name', 'institution', 'from_date','end_date', 'level','category'];
        $data['column_alias'] = ['id','nama', 'Nama Lembaga', 'Tanggal Mulai','Tanggal Akhir', 'Tingkat','Kategori'];

        // Config Pagination
		$config['base_url'] = base_url($root_url);
        $config['total_rows'] = $this->db->get($table)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(3);
		$this->pagination->initialize($config);
        $temp = $this->db->get_where($table, ['id_user' => $data['this_user']['username']], $config['per_page'], $config['start'])->result_array();
        $data['data_table'] = [];
        foreach ($temp as $value) {
            $value['from_date'] = gmdate("d M, Y", $value['from_date']+25200);
            $value['end_date'] = gmdate("d M, Y", $value['end_date']+25200);
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
            $this->form_validation->set_rules('from_date','Tanggal Mulai Sertifikat','trim|required');
            $this->form_validation->set_rules('end_date','Tanggal Akhir Sertifikat','trim|required');
            $this->form_validation->set_rules('level','Level','trim|required');
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
                    'from_date' => strtotime($this->input->post('from_date')),
                    'end_date' => strtotime($this->input->post('end_date')),
                    'level' => $this->input->post('level'),
                    'category' => $this->input->post('category'),
                    'files' => $file,
                    'id_user' => $data['this_user']['username'],
                ];
                $this->db->insert('repository', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('repository');
            }
        }
        $data['title'] = 'Tambah Sertifikat';
        customView('dosen/repository', $data);
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
            $this->form_validation->set_rules('from_date','Tanggal Mulai Sertifikat','trim|required');
            $this->form_validation->set_rules('end_date','Tanggal Akhir Sertifikat','trim|required');
            $this->form_validation->set_rules('level','level','trim|required');
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
                    'from_date' => strtotime($this->input->post('from_date')),
                    'end_date' => strtotime($this->input->post('end_date')),
                    'level' => $this->input->post('level'),
                    'category' => $this->input->post('category'),
                    'files' => $file,
                    'id_user' => $data['this_user']['username']
                ];
                $this->db->where(['id' => $id])->update('repository', $form);
                $this->session->set_flashdata('alertForm', 'Data berhasil disimpan');
				$this->session->set_flashdata('alertType', 'success');
                redirect('repository');
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
        redirect('repository');
    }

    public function survei_dosen(){
        $data = $this->globalData;
        $data['withNavbar'] = false;
        $data['withSidebar'] = false;
        $data['list_dosen'] = $this->db_master->get_where('user', ['level' => 11])->result_array();

        if ($this->input->post()){
            $this->db->insert('survei_dosen_answer', [
                'id_user' => $this->session->userdata('user')['username'],
                'id_dosen' => $this->input->post('answer'),
                'created_at' => time()
            ]);
            redirect('dashboard');
        }
        customView('mahasiswa/survei_dosen', $data);
    }
}