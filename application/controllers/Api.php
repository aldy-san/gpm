<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function tes()
    {
        $result = $this->db->query('SELECT * FROM db_gpm.users')->result();
        $result = $this->db->query('SELECT * FROM db_master.user')->result();
        echo json_encode($result);
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
        $this->db->select('user.username, answer.answer');
        $this->db->from('answer');
        $this->db->where(['id_survei' => $id]);
        $this->db->join('db_master.user', 'user.username = answer.id_user', 'left');
        $this->db->limit($limit);
        $result = $this->db->get()->result();
        echo json_encode($result);
    }

    public function getChartDataByGroupBy($group_by)
    {
        $this->db->select($group_by.' as grouped, count('.$group_by.') as total');
        $this->db->from('answer');
        //$this->db->where(['created_at' => '']);
        $this->db->join('db_master.user', 'user.username = answer.id_user', 'left');
        $this->db->group_by($group_by);
        $result = $this->db->get()->result();
        echo json_encode($result);
    }
    public function getTable($table)
    {
        $db_master = $this->load->database('db_master', TRUE);
        $result = $db_master->get($table)->result_array();
        echo json_encode($result);
    }
}