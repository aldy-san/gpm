<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_migration extends CI_Controller {

	public function index()
    {
        $this->load->library('migration');
        if($this->migration->latest()===false){
            show_error($this->migration->error_string());
        } else {
            echo 'success';
        }
    }
}