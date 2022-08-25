<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');

class Migration_Tb_period extends CI_Migration{
    public function __construct() {
        $this->load->dbforge();
        $this->load->database();
    }
    public function up()
    {
        $this->dbforge->drop_table('period');
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
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'period_from' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'period_to' => array(
                'type' => 'INT',
                'constraint' => '11',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('period');
        $seed = [
            [
                'name' => 'GENAP 2021/2022 - Monevjar Awal',
                'type' => 'mahasiswa',
                'period_from' => '1659304800',
                'period_to' => '1661896800'
            ],
        ];
        $this->db->insert_batch('period', $seed); 
    }
    public function down()
    {
        $this->dbforge->drop_table('period');
    }
}