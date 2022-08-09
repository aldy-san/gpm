<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function getDataSurvei($slug)
    {
        $data['slug'] = explode('-', $slug)[0];
        $data['sub_slug'] = count(explode('-', $slug)) > 1 ? explode('-', $slug)[1] : false;
        if ($data['sub_slug']){
            echo json_encode($this->db->get_where('survei', ['role' => $data['slug'], 'level' => $data['sub_slug']])->result());
        }else {
            echo json_encode($this->db->get_where('survei', ['role' => $data['slug']])->result());
        }
    }
	public function getChartDataByIdSurvei($id)
    {
        $this->db->select('answer, count(*) as total');
        $this->db->from('answer');
        $this->db->where(['id_survei' => $id]);
        $this->db->group_by('answer');
        $result = $this->db->get()->result();
        echo json_encode($result);
        //return $result;
    }
    public function getListDataByIdSurvei($id, $limit = 4)
    {
        $this->db->select('users.username, answer.answer');
        $this->db->from('answer');
        $this->db->where(['id_survei' => $id]);
        $this->db->join('users', 'users.id = answer.id_user', 'left');
        $this->db->limit($limit);
        $result = $this->db->get()->result();
        echo json_encode($result);
    }
}