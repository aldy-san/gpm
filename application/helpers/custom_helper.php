<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function findObjectBy($by, $search, $array){
    foreach ( $array as $element ) {
        if ( $search == $element[$by] ) {
            return $element;
        }
    }
    return false;
}
if(!function_exists('customView')){

    function customView($viewName, $data=array()){
        $CI = &get_instance();
        $CI->load->view('layouts/header', $data);
        $CI->load->view($viewName, $data);
        $CI->load->view('layouts/footer', $data);
    }
  }
if(!function_exists('getRole')){

    function getRole($id_level){
        $CI = &get_instance();
        $db_master = $CI->load->database('db_master', TRUE);
        $level_name = $db_master->get_where('level', ['id_level' => $id_level])->row_array()['nama_level'];
		$list_dosen = ['Dosen', 'Ketua Jurusan', 'Sekretaris Jurusan', 'Koorprodi'];
		$list_tendik = ['Kepala Laboratorium', 'Staff Perpus', 'Staff Administrasi', 'PLP/Laboran', 'Asisten Laboratorium', 'Asisten Praktikum'];
        if ($level_name === 'Administrator Web'){
			return 'superadmin';
		} else if($level_name === 'Mahasiswa') {
			return 'mahasiswa';
		} else if(in_array($level_name, $list_dosen)) {
            return 'dosen';
		} else if(in_array($level_name, $list_tendik)){
            return 'tendik';
        }
    }
  }
//if(!function_exists('getRoleName')){

//    function getRoleName($id_level){
//        $CI = &get_instance();
//        $db_master = $CI->load->database('db_master', TRUE);
//        $level_name = $db_master->get_where('level', ['id_level' => $id_level])->row_array()['nama_level'];
//		$list_dosen = ['Dosen', 'Ketua Jurusan', 'Sekretaris Jurusan', 'Koorprodi'];
//        if ($level_name === 'superadmin'){
//			return 'superadmin';
//		} else if($level_name === 'Mahasiswa') {
//			return 'mahasiswa';
//		} else if(in_array($level_name, $list_dosen)) {
//            return 'dosen';
//		} else {
//            return 'tendik';
//        }
//    }
//  }