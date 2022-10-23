<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function tes()
    {
        $result = $this->db->query('SELECT * FROM db_master.user')->result();
        echo json_encode($result);
    }
	public function getChartDataByIdSurvei($id)
    {
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $this->db->select('answer, count(*) as total');
        $this->db->from('answer');
        $this->db->where(['id_survei' => $id]);
        if($from && $to){
            $this->db->where(['created_at >=' => $from, 'created_at <=' => $to]);
        }
        $this->db->group_by('answer');
        $result = $this->db->get()->result();
        echo json_encode($result);
    }
    public function getListDataByIdSurvei($id, $limit = 4)
    {
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $role = $this->input->get('role');
        if ($role == 'alumni'){
            $this->db->select('alumni.name as username, answer.answer');
        } else if ($role == 'mitra'){
            $this->db->select('mitra.agency as username, answer.answer');
        } else if ($role == 'pengguna'){
            $this->db->select('pengguna.email as username, answer.answer');
        } else {
            $this->db->select('user.nama_lengkap as username, answer.answer');
        }
        $this->db->from('answer');
        $this->db->where(['id_survei' => $id]);
        if($from && $to){
            $this->db->where(['created_at >=' => $from, 'created_at <=' => $to]);
        }
        if (in_array($role, ['alumni', 'mitra', 'pengguna'])){
            $this->db->join($role, $role.'.id = answer.id_user', 'left');
        } else {
            $this->db->join('db_master.user', 'user.username = answer.id_user', 'left');
        }
        $this->db->limit($limit);
        $result = $this->db->get()->result();
        echo json_encode($result);
    }

    public function getChartDataByGroupBy($group_by)
    {
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $role = $this->input->get('role');
        $this->db->distinct('id_user');
        $this->db->select($group_by.' as grouped, count(DISTINCT id_user) as total');
        $this->db->from('answer');
        if($from && $to){
            $this->db->where(['created_at >=' => $from, 'created_at <=' => $to]);
        }
        if (in_array($role, ['alumni', 'mitra', 'pengguna'])){
            $this->db->join($role, $role.'.id = answer.id_user', 'left');
        } else {
            $this->db->join('db_master.user', 'user.username = answer.id_user', 'left');
        }
        //$this->db->group_by('id_user,'.$group_by);
        $result = $this->db->get()->result();
        echo json_encode($result);
    }
    public function getMonev()
    {
        $monev_id = array(1, 2, 3);
        //$db_master = $this->load->database('db_master', TRUE);
        $this->db->select('AVG(detail) as avg');
        $this->db->from('answer');
        $this->db->where_in('survei.category', $monev_id);
        $this->db->where(['survei.type' => 'bar']);
        $this->db->join('survei', 'survei.id=id_survei');
        $result = $this->db->get()->result();
        echo json_encode($result);
    }
    public function getMonevProdiPerPeriod()
    {
        $monev_id = array(1, 2, 3);
        $this->db->select("kode_prodi, AVG(detail) as avg, FROM_UNIXTIME(answer.created_at , '%Y') AS year, QUARTER(from_unixtime(answer.created_at)) as quarter");
        $this->db->from('answer');
        $this->db->where_in('survei.category', $monev_id);
        $this->db->where(['survei.type' => 'bar']);
        $this->db->join('survei', 'survei.id=id_survei');
        $this->db->join('db_master.user', 'user.username=answer.id_user');
        $this->db->group_by('kode_prodi, year, quarter');
        $this->db->order_by(' year, quarter, kode_prodi');
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