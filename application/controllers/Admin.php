<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public $globalData;
    public function __construct() {
        parent::__construct();
        $this->globalData = [
            'withNavbar' => false,
            'withSidebar' => true
        ];
    }
    public function index()
    {
        $data = $this->globalData;
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/index');
        $this->load->view('layouts/footer');
    }
}