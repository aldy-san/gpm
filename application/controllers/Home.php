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
            }
        }
        $this->globalData['category_dosen_avail'] = $category_dosen_avail;
        $this->globalData['category_dosen_answered'] = $category_dosen_answered;
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
        $survei = $this->db->get_where('survei',['role' => $role])->result_array();
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
                        $detail = ($answer > 80 && $answer <=100) ? '81-100' 
                                : (($answer > 60 && $answer <=80) ? '61-80' 
                                : (($answer > 40 && $answer <=60) ? '41-60'
                                : (($answer > 20 && $answer <=40) ? '21-40' : '0-20')));
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
        $data['withNavbar'] = false;
        $data['withSidebar'] = true;
        $data['slug'] = $id;
        $data['sub_slug'] = false;
        // Config Pagination
		$config['base_url'] = base_url('/detail/'.$id.'/');
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
}