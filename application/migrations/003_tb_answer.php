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
            'created_at' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('answer');
        
        $seed = [
            [
                'id_user' => 1,
                'id_survei' => 3,
                'answer' => 'cool',
                'detail' => ''
            ],
            [
                'id_user' => 2,
                'id_survei' => 3,
                'answer' => 'yes',
                'detail' => ''
            ],
            [
                'id_user' => 3,
                'id_survei' => 3,
                'answer' => 'yo',
                'detail' => ''
            ],
            [
                'id_user' => 4,
                'id_survei' => 3,
                'answer' => 'yes',
                'detail' => ''
            ],
            [
                'id_user' => 1,
                'id_survei' => 9,
                'answer' => 'yo',
                'detail' => ''
            ],
            [
                'id_user' => 1,
                'id_survei' => 9,
                'answer' => 'ma',
                'detail' => ''
            ],
            [
                'id_user' => 1,
                'id_survei' => 10,
                'answer' => '81-100',
                'detail' => '87'],
            [
                'id_user' => 2,
                'id_survei' => 10,
                'answer' => '61-80',
                'detail' => '66'],
            [
                'id_user' => 2,
                'id_survei' => 2,
                'answer' => 'asdasd',
                'detail' => ''
            ],
            [
                'id_user' => 3,
                'id_survei' => 2,
                'answer' => 'sadasd',
                'detail' => ''
            ],
            [
                'id_user' => 3,
                'id_survei' => 2,
                'answer' => 'asdasd',
                'detail' => ''
            ],
            [
                'id_user' => 4,
                'id_survei' => 2,
                'answer' => 'sadasd',
                'detail' => '']
        ];
        $this->db->insert_batch('answer', $seed); 
    }
    public function down()
    {
        $this->dbforge->drop_table('answer');
    }
}