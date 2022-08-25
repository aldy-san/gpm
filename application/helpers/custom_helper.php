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