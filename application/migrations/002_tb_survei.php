<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');

class Migration_Tb_survei extends CI_Migration{
    public function __construct() {
        $this->load->dbforge();
        $this->load->database();
    }
    public function up()
    {
        //$this->dbforge->drop_table('survei');
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => TRUE
            ),
            'level' => array(
                'type' => 'VARCHAR',
                'constraint' => '3',
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'question' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'selections' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'NULL'
            ),
            'bar_from' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'NULL'
            ),
            'bar_to' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'NULL'
            ),
            'bar_length' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'NULL'
            ),
            'chart' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'bar'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('survei');
    }
    public function down()
    {
        $this->dbforge->drop_table('survei');
    }
}