<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');

class Migration_Tb_users extends CI_Migration{
    public function __construct() {
        $this->load->dbforge();
        $this->load->database();
    }
    public function up()
    {
        $this->dbforge->drop_table('users');
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }
    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}