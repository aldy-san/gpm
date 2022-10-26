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
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true,
            'title' => false,
            'this_user' => $this->db_master->where(['username' => $this->session->userdata('user')['username']])->get('user')->row_array(),
            'category_dosen' => $this->M_survei->getCategory('dosen'),
            'category_mahasiswa' => $this->M_survei->getCategory('mahasiswa'),
            'category_tendik' => $this->M_survei->getCategory('tendik'),
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
                    var_dump($survei[$loop]['bar_length']);
                    if($survei[$loop]['type'] != 'bar'){
                        $this->db->insert('answer', [
                            'id_user' => $data['this_user']['username'],
                            'id_survei' => filter_var($key, FILTER_SANITIZE_NUMBER_INT),
                            'answer' => $answer,
                            'created_at' => time()
                        ]);
                    }else{
                        if (is_numeric($answer)){
                            $detail = ($answer > 80 && $answer <=100) ? '81-100' 
                                    : (($answer > 60 && $answer <=80) ? '61-100' 
                                    : (($answer > 40 && $answer <=60) ? '41-60'
                                    : (($answer > 20 && $answer <=40) ? '21-40' : '0-20')));
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
}