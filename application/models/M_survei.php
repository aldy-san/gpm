<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_survei extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

    public function getDetailResultSurvei($id, $limit = false, $offset = false)
    {
        $this->db->select('user.nama_lengkap, answer.answer');
        $this->db->from('db_gpm.answer');
        $this->db->where(['id_survei' => $id]);
        if ($limit){
            $this->db->limit($limit, $offset);
        }
        $this->db->join('db_master.user', 'user.username = answer.id_user', 'left');
        return $this->db->get();
    }
}
?>