<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'this_user' => $this->db->where(['id' => $this->session->userdata('user')['id']])->get('users')->row_array(),
            'title' => false
        ];
        if ($this->globalData['this_user']['role'] !== 'mahasiswa') {
            $this->session->set_flashdata('alertForm', 'Role anda tidak memiliki akses untuk halaman tersebut');
            $this->session->set_flashdata('alertType', 'danger');
            redirect('auth');
        }
    }
    public function index()
    {
        $data = $this->globalData;
        customView('mahasiswa/index', $data);
    }
    public function survei($type){
        $data = $this->globalData;
        if ($this->input->post()){
            $this->db->select('id,bar_length');
            $survei = $this->db->get_where('survei',['role' => $data['this_user']['role']])->result_array();
            foreach($survei as $num => $sur){
                $this->form_validation->set_rules('answer'.$sur['id'],'answer '.($num+1),'trim|required');
            }
            if(!$this->form_validation->run()){
				$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
			}else{
                $loop = 0;
                foreach($this->input->post() as $key => $answer){
                    var_dump($survei[$loop]['bar_length']);
                    if($survei[$loop]['bar_length'] == ''){
                        $this->db->insert('answer', [
                            'id_user' => $data['this_user']['id'],
                            'id_survei' => filter_var($key, FILTER_SANITIZE_NUMBER_INT),
                            'answer' => $answer,
                            'created_at' => floor(microtime(true) * 1000)
                        ]);
                    }else{
                        $detail = ($answer > 80 && $answer <=100) ? '80-100' 
                                : (($answer > 60 && $answer <=80) ? '60-100' 
                                : (($answer > 40 && $answer <=60) ? '40-60'
                                : (($answer > 20 && $answer <=40) ? '20-40' : '0-20')));
                        $this->db->insert('answer', [
                            'id_user' => $data['this_user']['id'],
                            'id_survei' => filter_var($key, FILTER_SANITIZE_NUMBER_INT),
                            'answer' => $detail,
                            'detail' => $answer,
                            'created_at' => floor(microtime(true) * 1000)
                        ]);     
                    }
                    $loop++;
                }
                redirect('/');
            }
        }
        $this->globalData['withSidebar'] = false;
        $data = $this->globalData;
        $data['survei'] = $this->db->get_where('survei', ['role' => $data['this_user']['role']])->result_array();
        $data['bar_count'] = $this->db->get_where('survei',['type' => 'bar', 'role' => $data['this_user']['role']])->num_rows();
        $data['bar'] = 1;
        customView('mahasiswa/survei', $data);
    }
}