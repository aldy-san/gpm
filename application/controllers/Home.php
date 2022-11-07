<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $globalData;
    public function __construct() {
        parent::__construct();
        $this->globalData = [
            'withNavbar' => true,
            'withSidebar' => false,
            'title' => false
        ];
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
            $this->form_validation->set_rules('year_since','year_since','trim|required');
            $this->form_validation->set_rules('year_from','year_from','trim|required');
            $this->form_validation->set_rules('prodi','prodi','trim|required');
            $this->form_validation->set_rules('activity','activity','trim|required');
			if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
				$this->session->set_flashdata('alertType', 'danger');
			} else {
                $newSession = array(
                    'position' => $this->input->post('position'),
                    'year_since' => $this->input->post('year_since'),
                    'year_from' => $this->input->post('year_from'),
                    'prodi' => $this->input->post('prodi'),
                    'activity' => $this->input->post('activity'),
                );
                $this->session->set_userdata('notLoggedSurvei', $newSession);
                redirect('/alumni/survei');
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
}