<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');

class Migration_Tb_survei extends CI_Migration{
    public function __construct() {
        $this->load->dbforge();
        $this->load->database();    
    }   
    public function up()
    {
        $this->dbforge->drop_table('survei');
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
        $seed = [
            [
                'level'=>'d4',
                'role' => 'mahasiswa',
                'question' => '123',
                'type' => 'selection',
                'selections' => 'cool,excellent,yoma',
                'bar_from' => '',
                'bar_to' => '',
                'bar_length' => '',
                'chart' => 'bar'
            ],
            [
                'level'=>'d4',
                'role' => 'mahasiswa',
                'question' => 'tes',
                'type' => 'description',
                'selections' => 'cool,excellent,yoma',
                'bar_from' => '',
                'bar_to' => '',
                'bar_length' => '',
                'chart' => 'bar'
            ],
            [
                'level'=>'s1',
                'role' => 'mahasiswa',
                'question' => 'tes1',
                'type' => 'selection',
                'selections' => 'cool,yes,yo',
                'bar_from' => '',
                'bar_to' => '',
                'bar_length' => '',
                'chart' => 'pie'
            ],
            [
                'level'=>'',
                'role' => 'dosen',
                'question' => 'dosen',
                'type' => 'bar',
                'selections' => '',
                'bar_from' => '',
                'bar_to' => '',
                'bar_length' => '',
                'chart' => 'pie'
            ],
            [
                'level'=>'',
                'role' => 'tendik',
                'question' => 'tendik',
                'type' => 'selection',
                'selections' => '123',
                'bar_from' => '',
                'bar_to' => '',
                'bar_length' => '',
                'chart' => 'pie'
            ],
            [
                'level'=>'0',
                'role' => 'tendik',
                'question' => '123',
                'type' => 'bar',
                'selections' => '',
                'bar_from' => '',
                'bar_to' => '',
                'bar_length' => '',
                'chart' => 'pie'
            ],
            [
                'level'=>'0',
                'role' => 'alumni',
                'question' => '123',
                'type' => 'bar',
                'selections' => '',
                'bar_from' => '',
                'bar_to' => '',
                'bar_length' => '',
                'chart' => 'bar'
            ],
            [
                'level'=>'0',
                'role' => 'alumni',
                'question' => '5',
                'type' => 'bar',
                'selections' => '',
                'bar_from' => '',
                'bar_to' => '',
                'bar_length' => '',
                'chart' => 'bar'
            ],
            [
                'level'=>'s1',
                'role' => 'mahasiswa',
                'question' => 'tes2',
                'type' => 'selection',
                'selections' => 'yo,ma,men',
                'bar_from' => '',
                'bar_to' => '',
                'bar_length' => '',
                'chart' => 'bar'
            ],
            [
                'level'=>'s1',
                'role' => 'mahasiswa',
                'question' => 'tes bar',
                'type' => 'bar',
                'selections' => '',
                'bar_from' => 'tidak puas',
                'bar_to' =>  'sangat puas',
                'bar_length' =>  '100',
                'chart' =>  'bar'
            ]
        ];
        $this->db->insert_batch('survei', $seed);
    }
    public function down()
    {
        $this->dbforge->drop_table('survei');
    }
}