<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_survei extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

    public function getDetailResultSurvei($id, $limit = false, $offset = false)
    {
        $this->db->select('users.username, answer.answer');
        $this->db->from('answer');
        $this->db->where(['id_survei' => $id]);
        if ($limit){
            $this->db->limit($limit, $offset);
        }
        $this->db->join('users', 'users.id = answer.id_user', 'left');
        return $this->db->get();
    }
}
?>