<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function tes()
    {
        $result = $this->db->query('SELECT * FROM db_master.user')->result();
        echo json_encode($result);
    }
    public function getTotalData($id=false){
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $role = $this->input->get('role');
        $this->db->select('count(DISTINCT id_user) as total');
        $this->db->from('answer');
        //where
        if ($id){
            $this->db->where(['category.id' => $id]);
        }
        if($from && $to){
            $this->db->where(['created_at >=' => $from, 'created_at <=' => $to]);
        }
        //join
        if (in_array($role, ['alumni', 'mitra', 'pengguna'])){
            $this->db->join($role, $role.'.id = answer.id_user', 'right');
        } else {
            $this->db->join('db_master.user', 'user.username = answer.id_user', 'left');
        }
        $this->db->join('survei', 'survei.id=id_survei', 'left');
        $this->db->join('category', 'category.id=survei.category', 'left');

        $result = $this->db->get()->result();
        echo json_encode($result);
    }
	public function getChartDataByIdSurvei($id)
    {
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $this->db->select('answer, count(*) as total, sum(detail) as sum, survei.klasifikasi');
        $this->db->from('answer');
        $this->db->where(['id_survei' => $id]);
        if($from && $to){
            $this->db->where(['created_at >=' => $from, 'created_at <=' => $to]);
        }
        $this->db->join('survei', 'survei.id = answer.id_survei', 'left');
        $this->db->group_by('answer');
        $result = $this->db->get()->result();
        echo json_encode($result);
    }
    public function getListDataByIdSurvei($id, $limit = 3)
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

    public function getChartDataByGroupBy($group_by, $id=false)
    {
        $from = $this->input->get('from');
        $to = $this->input->get('to');
        $role = $this->input->get('role');
        $this->db->select($group_by.' as grouped, count(DISTINCT id_user) as total');
        $this->db->from('answer');
        //where
        if ($id){
            $this->db->where(['category.id' => $id]);
        }
        if($from && $to){
            $this->db->where(['created_at >=' => $from, 'created_at <=' => $to]);
        }
        //join
        if (in_array($role, ['alumni', 'mitra', 'pengguna'])){
            $this->db->join($role, $role.'.id = answer.id_user', 'right');
        } else {
            $this->db->join('db_master.user', 'user.username = answer.id_user', 'left');
        }
        $this->db->join('survei', 'survei.id=id_survei', 'left');
        $this->db->join('category', 'category.id=survei.category', 'left');

        $this->db->group_by($group_by);
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
        $this->db->select("user.kode_prodi, jenjang, AVG(detail) as avg, FROM_UNIXTIME(answer.created_at , '%Y') AS year, QUARTER(from_unixtime(answer.created_at)) as quarter");
        $this->db->from('answer');
        $this->db->where_in('survei.category', $monev_id);
        $this->db->where(['survei.type' => 'bar']);
        $this->db->join('survei', 'survei.id=id_survei');
        $this->db->join('db_master.user', 'user.username=answer.id_user');
        // BY TABLE 
        $this->db->group_by('kode_prodi');
        // BY NAMA_PRODI
        //$this->db->join('db_master.prodi', 'user.kode_prodi=prodi.kode_prodi', 'left');
        //$this->db->group_by('nama_prodi');
        // END
        $this->db->group_by('jenjang, year, quarter');
        $this->db->order_by('year, quarter, kode_prodi');
        $result = $this->db->get()->result();
        echo json_encode($result);
    }
    public function getProdi()
    {
        $db_master = $this->load->database('db_master', TRUE);

        $db_master->select('user.kode_prodi, nama_prodi, id_jenjang, nama_jenjang');
        $db_master->from('user');
        $db_master->where(['level' => 1]);
        $db_master->join('prodi', 'user.kode_prodi=prodi.kode_prodi', 'left');
        $db_master->join('jenjang', 'user.jenjang=jenjang.id_jenjang', 'left');
        // BY TABLE 
        $db_master->group_by('user.kode_prodi');
        // BY NAMA_PRODI
        //$db_master->group_by('nama_prodi');
        // END
        $db_master->group_by('jenjang');
        $result = $db_master->get()->result_array();
        echo json_encode($result);
    }
    public function getTable($table)
    {
        $db_master = $this->load->database('db_master', TRUE);
        $result = $db_master->get($table)->result_array();
        echo json_encode($result);
    }
    public function updateSurveiActivation()
    {
        $name = $this->input->post('name');
        $value = $this->input->post('value');
        $this->db->set('is_active', $value);
        $this->db->where('name', $name);
        $this->db->update('survei_activation');
    }

    public function getTotalDataDosen(){
        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $this->db->select('count(id_user) as total');
        $this->db->from('survei_dosen_answer');
        if($from && $to){
            $this->db->where(['created_at >=' => $from, 'created_at <=' => $to]);
        }
        $result = $this->db->get()->result();
        echo json_encode($result);
    }
    public function getDataDosen(){
        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $this->db->select('id_dosen, id_user');
        $this->db->from('survei_dosen_answer');
        if($from && $to){
            $this->db->where(['created_at >=' => $from, 'created_at <=' => $to]);
        }
        $this->db->join('db_master.user', 'user.username = survei_dosen_answer.id_dosen', 'left');
        $result = $this->db->get()->result();
        echo json_encode($result);
    }

    public function getDataAnalisis($slug){
        $result = $this->db->get_where('analisis', ['id_period' => $slug])->result();
        echo json_encode($result);
    }
}