<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');

class Migration_Tb_users extends CI_Migration{
    public function __construct() {
        $this->load->dbforge();
        $this->load->database();
    }
    public function up()
    {
        $this->dbforge->drop_table('survei_mahasiswa');
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => TRUE
            ),
            'level' => array(
                'type' => 'VARCHAR',
                'constraint' => '3',
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
                'default' => 'null'
            ),
            'bar_from' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'null'
            ),
            'bar_to' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'null'
            ),
            'bar_length' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'null'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('survei_mahasiswa');
    }
    public function down()
    {
        $this->dbforge->drop_table('survei_mahasiswa');
    }
}