<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');

class Migration_Tb_test extends CI_Migration{
    public function __construct() {
        $this->load->dbforge();
        $this->load->database();
    }
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
            )
        ));
        $this->dbforge->add_key('id');
        $this->dbforge->create_table('test');
    }
    public function down()
    {
        $this->dbforge->drop_table('test');
    }
}