<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');

class Migration_Tb_category extends CI_Migration{
    public function __construct() {
        $this->load->dbforge();
        $this->load->database();
    }
    public function up()
    {
        //$this->dbforge->drop_table('category');
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('category');
        $seed = [
            [
                'name' => 'Survei Kepuasan Mahasiswa',
                'role' => 'mahasiswa',
            ],
            [
                'name' => 'Survei Afektifitas Dosen',
                'role' => 'dosen',
            ],
        ];
        $this->db->insert_batch('category', $seed); 
    }
    public function down()
    {
        $this->dbforge->drop_table('category');
    }
}