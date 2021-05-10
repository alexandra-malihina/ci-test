<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Form2Table extends Migration
{
	protected $table='form_2_table';
	public function up()
	{
		//
		$this->forge->addField([
			'form_2_table_id'=>[
				'type'=>'INT',
				'constraint'=>5,
				'unsigned'=>true,
				'auto_increment'=>true,
				'null'=>false
			],
			'table_name'=>[
				'type'=>'VARCHAR',
				'constraint'=>40,
				'unique'=>true,
				'null'=>false
			],
			'fields'=>[
				'type'=>'JSON',
				'default'=>null,
			],
			'link_buttons'=>[
					'type'=>'JSON',
					'default'=>null
			],	
			'created_date datetime default current_timestamp',
            'updated_date datetime default null on update current_timestamp', 
			'deleted_date datetime default null',

		]);
		$this->forge->addKey('form_2_table_id',true);
		$this->forge->createTable($this->table);
	}

	public function down()
	{
		//
		$this->forge->dropTable($this->table);
	}
}
