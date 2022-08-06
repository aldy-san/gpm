<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');

class Migration_Tb_answer extends CI_Migration{
    public function __construct() {
        $this->load->dbforge();
        $this->load->database();
    }
    public function up()
    {
        $this->dbforge->drop_table('answer');
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'id_survei' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'answer' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'detail' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('answer');
    }
    public function down()
    {
        $this->dbforge->drop_table('answer');
    }
}