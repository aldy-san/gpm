<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
        $this->db_master = $this->load->database('db_master', TRUE);

        $this->globalData = [
            'withNavbar' => true,
            'withSidebar' => false,
            'title' => false,
            'category_dosen' => $this->M_survei->getCategory('dosen', false),
            'category_mahasiswa' => $this->M_survei->getCategory('mahasiswa', false),
            'category_tendik' => $this->M_survei->getCategory('tendik', false),
        ];
        if ($this->session->userdata('user')){
            $this->globalData['this_user'] = $this->db_master->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
            if (getRole($this->globalData['this_user']['level']) === 'dosen'){
                $temp = $this->M_survei->getCategoryAnswered('dosen',$this->globalData['this_user']['username']);
                $category_dosen_avail = $this->M_survei->getCategory('dosen');
                $category_dosen_answered = [];
                foreach ($temp as $value) {
                    array_push($category_dosen_answered,$value['name']);
                }
                $this->globalData['category_dosen_avail'] = $category_dosen_avail;
                $this->globalData['category_dosen_answered'] = $category_dosen_answered;
            }
        }
    }
	public function logout()
	{
        if ($this->session->userdata('user')){
            $this->session->unset_userdata('user');
        }
        redirect(base_url());
	}
    public function alumni()
    {
        $data = $this->globalData;
        $this->session->unset_userdata('notLoggedSurvei');
        if($this->input->post()){
            $this->form_validation->set_rules('name','name','trim|required');
            $this->form_validation->set_rules('email','email','trim|required|valid_email');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $newSession = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'year_to' => $this->input->post('year_to'),
                    'year_from' => $this->input->post('year_from'),
                    'prodi' => $this->input->post('prodi'),
                    'activity' => $this->input->post('activity'),
                );
                $this->session->set_userdata('notLoggedSurvei', $newSession);
                redirect('/alumni/survei');
            }
        }
        customView('pages/not-logged/alumni', $data);
    }
    public function mitra()
    {
        $data = $this->globalData;
        $this->session->unset_userdata('notLoggedSurvei');
        if($this->input->post()){
            $this->form_validation->set_rules('position','position','trim|required');
            $this->form_validation->set_rules('agency','agency','trim|required');
            $this->form_validation->set_rules('phone','phone','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $newSession = array(
                    'position' => $this->input->post('position'),
                    'agency' => $this->input->post('agency'),
                    'phone' => $this->input->post('phone'),
                    'scale' => $this->input->post('scale'),
                    'year_since' => $this->input->post('year_since'),
                    'year_coop' => $this->input->post('year_coop'),
                );
                $this->session->set_userdata('notLoggedSurvei', $newSession);
                redirect('/mitra/survei');
            }
        }
        customView('pages/not-logged/mitra', $data);
    }
    public function pengguna()
    {
        $data = $this->globalData;
        $this->session->unset_userdata('notLoggedSurvei');
        if($this->input->post()){
            $this->form_validation->set_rules('position','position','trim|required');
            $this->form_validation->set_rules('email','email','trim|required|valid_email');
            $this->form_validation->set_rules('agency','agency','trim|required');
            $this->form_validation->set_rules('employee','employee','trim|required');
            $this->form_validation->set_rules('total_graduates','total_graduates','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $newSession = array(
                    'position' => $this->input->post('position'),
                    'email' => $this->input->post('email'),
                    'agency' => $this->input->post('agency'),
                    'year_since' => $this->input->post('year_since'),
                    'employee' => $this->input->post('employee'),
                    'total_graduates' => $this->input->post('total_graduates'),
                    'year_since' => $this->input->post('year_since'),
                    'scale' => $this->input->post('scale'),
                );
                $this->session->set_userdata('notLoggedSurvei', $newSession);
                redirect('/pengguna/survei');
            }
        }
        customView('pages/not-logged/pengguna', $data);
    }

    public function survei($role){
        $data = $this->globalData;
        $survei = $this->db->get_where('survei',['role' => $role, 'is_active' => '1'])->result_array();
        if ($this->input->post()){
            $this->db->select('id,bar_length');
            foreach($survei as $num => $sur){
                $this->form_validation->set_rules('answer'.$sur['id'],'answer '.($num+1),'trim|required');
            }
            if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
			}else{
                $loop = 0;
                $session = $this->session->userdata('notLoggedSurvei');
                $this->db->insert($role, $session);
                $insert_id = $this->db->insert_id();
                foreach($this->input->post() as $key => $answer){
                    if($survei[$loop]['bar_length'] == ''){
                        $this->db->insert('answer', [
                            'id_user' => $insert_id,
                            'id_survei' => filter_var($key, FILTER_SANITIZE_NUMBER_INT),
                            'answer' => $answer,
                            'created_at' => time()
                        ]);
                    }else{
                        // $detail = ($answer > 80 && $answer <=100) ? '81-100'
                        //         : (($answer > 60 && $answer <=80) ? '61-80'
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
                        $this->db->insert('answer', [
                            'id_user' => $insert_id,
                            'id_survei' => filter_var($key, FILTER_SANITIZE_NUMBER_INT),
                            'answer' => $detail,
                            'detail' => $answer,
                            'created_at' => time()
                        ]);
                    }
                    $loop++;
                }
                $this->session->set_flashdata('alertForm', 'Terima Kasih Telah Mengisi Survei Ini');
				$this->session->set_flashdata('alertType', 'success');
                redirect('/');
            }
        }
        $this->globalData['withSidebar'] = false;
        $data = $this->globalData;
        $data['survei'] = $survei;
        $data['notLogged'] = true;
        //$data['category'] = $this->db->get_where('category', ['id' => $id_category])->row_array();
        $data['bar_count'] = $this->db->get_where('survei',['type' => 'bar', 'role' => $role])->num_rows();
        $data['bar'] = 1;
        customView('pages/survei', $data);
    }


    public function survei_result()
    {
        $data = $this->globalData;
        $data['withNavbar'] = false;
        $data['withSidebar'] = true;
        # code...
        customView('pages/survei_result', $data);
    }

    public function result($role, $category = null)
	{
        $data = $this->globalData;
        $data['withNavbar'] = false;
        $data['withSidebar'] = true;

        if ($category){
            $data['survei'] = $this->db->get_where('survei', ['category' => $category])->result_array();
        } else {
            $data['survei'] = $this->db->get_where('survei', ['role' => $role])->result_array();
        }

        $data['period'] = $this->db->order_by("period_from", "desc")->get_where('period', ['category' => $category],9)->result_array();

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
        }   else if ($role === 'pengguna'){
            $data['population'] = ['year_since', 'scale'];
            $data['titles'] = ['Tahun Berdiri', 'Tingkat'];
        }

        $tempProdi = $this->db_master->select('user.kode_prodi, nama_prodi, id_jenjang, nama_jenjang')->from('user')->where(['level' => 1, 'prodi.kode_prodi !=' => 1])->join('prodi', 'user.kode_prodi=prodi.kode_prodi', 'left')->join('jenjang', 'user.jenjang=jenjang.id_jenjang', 'left')->group_by('user.kode_prodi')->group_by('jenjang')->get()->result_array();
        $data['prodi'] = [];
        $validProdi = ['D4 Teknologi Rekayasa Sistem Elektronika',
            'D4 Teknologi Rekayasa Pembangkit Energi', 'S1 Pendidikan Teknik Elektro',
            'S1 Teknik Elektro', 'S1 Pendidikan Teknik Informatika', 'S1 Teknik Informatika',
            'S2 Teknik Elektro', 'S3 Teknik Elektro dan Informatika'
        ];
        foreach($tempProdi as $index => $value){
            if (in_array($value['nama_jenjang'].' '.$value['nama_prodi'], $validProdi)){
                array_push($data['prodi'], $value);
            }
        }
        //echo json_encode($data['prodi']);die;
		customView('dosen/result', $data);
	}
	public function detail($id)
	{
        // get slug
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $data = $this->globalData;
        $data['withNavbar'] = false;
        $data['withSidebar'] = true;
        $data['slug'] = $id;
        $data['sub_slug'] = false;
        // Config Pagination
		$config['base_url'] = base_url('/detail/'.$id.'/');
		$config['total_rows'] = $this->M_survei->getDetailResultSurvei($id, $from, $to)->num_rows();
		$config['per_page'] = 10;
		$config['start'] = $this->uri->segment(4);
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
        $offset =  $this->input->get('per_page') ?  ($this->input->get('per_page')-1)*$config['per_page'] : 0;
        $data['data_table'] = $this->M_survei->getDetailResultSurvei($id, $from, $to, $config['per_page'], $offset)->result_array();
        $data['survei'] = $this->db->get_where('survei', ['id' => $id])->row_array();
        // Config Template Table Page
        $data['title'] = 'Detail - '.$data['survei']['question'];
        $data['desc'] = '';
        $data['create_url'] = false;
        $data['edit_url'] = false;
        $data['detail_url'] = false;
        $data['delete_url'] = false;
        $data['column_table'] = ['answer'];
        $data['column_alias'] = ['Jawaban'];
		customView('template/table_page', $data);
	}
    public function responden($role,$category){
        $data = $this->globalData;
        $data['period'] = $this->db->order_by("period_from", "desc")->get_where('period', ['category' => $category])->result_array();
        if(!$this->input->get('period')){
            redirect(current_url().'/?period='.$data['period'][0]['id']);
        } else{
            $data['current_period'] = $this->db->get_where('period', ['id' => $this->input->get('period')])->row_array();
        }
        if($this->input->get('search')){
            $where = "level = 1 AND (nama_lengkap LIKE '%".$this->input->get('search')."%'"." OR nama_prodi LIKE '%".$this->input->get('search')."%'"." OR nama_jenjang LIKE '%".$this->input->get('search')."%')";
        }
        else{
            $where = ['level' => '1'];
        }
        $data['withNavbar'] = false;
        $data['withSidebar'] = true;
        $data['slug'] = $category;
        $data['sub_slug'] = false;
        $table = 'user';
        // Config Pagination
		$config['base_url'] = base_url('/result/'.$role.'/'.$category.'/responden'.'/');
        $config['total_rows'] = $this->db_master->join('db_master.prodi','user.kode_prodi=prodi.kode_prodi')->join('db_master.jenjang','user.jenjang=jenjang.id_jenjang')->get_where($table,$where)->num_rows();
        $config['per_page'] = 10;
		$config['start'] = $this->uri->segment(5);
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $offset =  $this->input->get('per_page') ? ($this->input->get('per_page')-1)*$config['per_page'] : 0;

        $temp = $this->db_master->join('db_master.prodi','user.kode_prodi=prodi.kode_prodi')->join('db_master.jenjang','user.jenjang=jenjang.id_jenjang')->get_where($table,$where,$config['per_page'],$config['start'])->result_array();
        $data['data_table'] = [];
        $this->db->distinct();
        $this->db->select('id_user');
        $this->db->from('answer');
        $this->db->join('db_master.user','user.username=answer.id_user');
        $this->db->join('survei', 'survei.id=id_survei');
        $this->db->where(['survei.category' => $category, 'created_at >=' => $data['current_period']['period_from'], 'created_at <=' => $data['current_period']['period_to']]);
        $temp_fill_survey = $this->db->get()->result_array();
        $fill_survey = [];
        foreach($temp_fill_survey as $index => $value){
            array_push($fill_survey, $value['id_user']);
        }
        foreach($temp as $index => $value){
            if (strpos($value['nama_lengkap'],'-') !== false) {
                $nama = substr($value['nama_lengkap'], 0, strrpos($value['nama_lengkap'], '-'));
            } else $nama = $value['nama_lengkap'];
                array_push($data['data_table'],[
                    'username' => $value['username'],
                    'nama' => $nama,
                    'prodi' => $value['nama_prodi'],
                    'jenjang' => $value['nama_jenjang'],
                    'status' => (in_array($value['username'],$fill_survey)) ? 'Ya' : 'Tidak',
                ]);
        }
        $data['survei'] = $this->db->get_where('survei', ['id' => $category])->row_array();
        $data['title'] = 'Responden';
        $data['column_table'] = ['username', 'nama', 'prodi', 'jenjang','status'];
        // $data['column_alias'] = ['no', 'nama','status'];
        $data['column_badge'] = ['status'];

		customView('superadmin/form/responden', $data);
    }
    public function constitution(){
        $data = $this->globalData;
        $data['withNavbar'] = true;
        $data['withSidebar'] = false;
        $data['peraturan'] = $this->db->get('constitution')->result_array();
		customView('pages/not-logged/constitution', $data);
    }

    public function survei_dosen_result(){
        $data = $this->globalData;
        $data['withNavbar'] = false;
        $data['withSidebar'] = true;
        $data['list_dosen'] = $this->db_master->order_by("username", "asc")->get_where('user', ['level' => 11])->result_array();
        $data['list_tendik'] = $this->db_master->order_by("username", "asc")->get_where('user', 'level >= 2 AND level <= 7')->result_array();
        customView('pages/survei_dosen_result', $data);
    }
}