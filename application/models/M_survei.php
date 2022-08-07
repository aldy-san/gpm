<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_survei extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

    public function getChartDataByIdSurvei($id)
    {
        $this->db->select('answer, count(*) as total');
        $this->db->from('answer');
        $this->db->where(['id' => $id]);
        $this->db->group_by('answer');
        $result = $this->db->get()->result();
        return $result;
    }
}
?>