<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Test extends Migration
{
	protected $table='tests';
	public function up()
	{
		//
		$this->forge->addField([
			'test_id'=>[
				'type'=>'INT',
				'constraint'=>5,
				'unsigned'=>true,
				'auto_increment'=>true,
				'null'=>false
			],
			'question'=>[
				'type'=>'VARCHAR',
				'null'=>false,
				'constraint'=>255,
			],

			'answer'=>[
				'type'=>'JSON',
				'null'=>false,
			],
			'best_answer'=>[
				'type'=>'VARCHAR',
				'null'=>false,
				'constraint'=>8
			],
			'created_date datetime default current_timestamp',
            'updated_date datetime default null on update current_timestamp', 
			'deleted_date datetime default null',

		]);
		$this->forge->addKey('test_id',true);
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		//
		$this->forge->dropTable($this->table);
	}
}
