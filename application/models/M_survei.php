<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_survei extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

    public function getDetailResultSurvei($id, $limit = false, $offset = false)
    {
        $this->db->select('user.nama_lengkap, answer.answer');
        $this->db->from('answer');
        $this->db->where(['id_survei' => $id]);
        if ($limit){
            $this->db->limit($limit, $offset);
        }
        $this->db->join('db_master.user', 'user.username = answer.id_user', 'left');
        return $this->db->get();
    }
    public function getCategory($role, $withPeriod = true)
    {
        $this->db->distinct('category.name');
        $this->db->select('category.id as id, category.name as name');
        $this->db->from('category');
        $where = [];
        if ($withPeriod){
            $where = ['role' => $role, 'period_from <=' => time(), 'period_to >=' => time()];
        } else {
            $where = ['role' => $role];
        }
        $this->db->where($where);
        if ($withPeriod){
            $this->db->join('period','category.id = period.category', 'left');
        }
        return $this->db->order_by('id','DESC')->get()->result_array();
    }
    public function getCategoryAnswered($role, $id)
    {
        $this->db->distinct('category.name');
        $this->db->select('category.name, period_from, period_to, created_at');
        $this->db->from('category');
        $this->db->where(['category.role' => $role, 'period_from <=' => time(), 'period_to >=' => time(), 'id_user' => $id]);
        $this->db->join('period','category.id = period.category', 'left');
        $this->db->join('survei','survei.category = category.id', 'left');
        $this->db->join('answer','id_survei = survei.id', 'left');
        $temp = $this->db->get()->result_array();
        $result = [];

        foreach ($temp as $val){
            if ($val['period_from'] <= $val['created_at'] && $val['period_to'] >= $val['created_at']){
                array_push($result,$val);
            }
        }
        return $result;
    }

    public function changePassword($password, $id)
    {
        $this->db->set('pwd_hash', md5($password));
        $this->db->where('username', $id);
        $this->db->update('db_master.user');
    }
}
?>