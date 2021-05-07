<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	protected $table='users';
	public function up()
	{
		//
		$this->forge->addField([
			'user_id'=>[
				'type'=>'INT',
				'constraint'=>5,
				'unsigned'=>true,
				'auto_increment'=>true,
				'null'=>false
			],
			'login'=>[
				'type'=>'VARCHAR',
				'constraint'=>10,
				'unique'=>true,
				'null'=>false
			],

			'password'=>[
				'type'=>'VARCHAR',
				'constraint'=>255,
				'null'=>false
			],
			'role'=>[
				'type'=>'VARCHAR',
				'constraint'=>10,
				'null'=>false,
				'default'=>'user'
			],
			'created_date datetime default current_timestamp',
            'updated_date datetime default null on update current_timestamp', 
			'deleted_date datetime default null',

		]);
		$this->forge->addKey('user_id',true);
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		//
		$this->forge->dropTable($this->table);
	}
}
