<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');

class Migration_Tb_answer extends CI_Migration{
    public function __construct() {
        $this->load->dbforge();
        $this->load->database();
    }
    public function up()
    {
        //$this->dbforge->drop_table('answer');
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
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
            'created_at' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('answer');
        $seed = [
            [
                'id_user' => '19053564604',
                'id_survei' => 3,
                'answer' => 'cool',
                'detail' => '',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564641',
                'id_survei' => 3,
                'answer' => 'yes',
                'detail' => '',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564644',
                'id_survei' => 3,
                'answer' => 'yo',
                'detail' => '',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564655',
                'id_survei' => 3,
                'answer' => 'yes',
                'detail' => '',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564654',
                'id_survei' => 9,
                'answer' => 'yo',
                'detail' => '',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564624',
                'id_survei' => 9,
                'answer' => 'ma',
                'detail' => '',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564684',
                'id_survei' => 10,
                'answer' => '81-100',
                'detail' => '87',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564614',
                'id_survei' => 10,
                'answer' => '61-80',
                'detail' => '66',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564605',
                'id_survei' => 2,
                'answer' => 'asdasd',
                'detail' => '',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564609',
                'id_survei' => 2,
                'answer' => 'sadasd',
                'detail' => '',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564651',
                'id_survei' => 2,
                'answer' => 'asdasd',
                'detail' => '',
                'created_at' => '1663538401'
            ],
            [
                'id_user' => '19053564641',
                'id_survei' => 2,
                'answer' => 'sadasd',
                'detail' => '',
                'created_at' => '1663538401']
        ];
        $this->db->insert_batch('answer', $seed); 
    }
    public function down()
    {
        $this->dbforge->drop_table('answer');
    }
}