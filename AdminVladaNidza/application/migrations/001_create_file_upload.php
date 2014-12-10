<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_File_upload extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
			),
			'file_name' => array(
				'type' => 'TEXT',
				'constraint' => '100',
			),
		));
                $this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('file');
	}

	public function down()
	{
		$this->dbforge->drop_table('file');
	}
}