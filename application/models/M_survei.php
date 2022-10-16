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
    public function getCategory($role, $withPeriod = true)
    {
        $this->db->select('category.id as id, category.name as name');
        $this->db->from('category');
        $where = [];
        if ($withPeriod){
            $where = ['role' => $role, 'period_from <=' => time(), 'period_to >=' => time()];
        } else {
            $where = ['role' => $role];
        }
        $this->db->where($where);
        $this->db->join('period','category.id = period.category', 'right');
        return $this->db->get()->result_array();
    }

    public function changePassword($password, $id)
    {
        $this->db->set('pwd_hash', md5($password));
        $this->db->where('username', $id);
        $this->db->update('db_master.user');
    }
}
?>