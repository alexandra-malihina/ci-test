<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FormstableSeeder extends Seeder
{
	public function run()
	{
		$fields=[
			'user_id'=>[
				'enable'=>true,
				'type'=>'hidden'
			],
			'login'=>[
				'title'=>[
					'en'=>'Login',
					'ru'=>'Логин'
				],
				'type'=>'text',
				'enable'=>true,
				'edit'=>true,
				'validate'=>[
					'rules'=>'required|is_unique[users.login]|max_length[10]',
					'errors'=>[
						'en'=>[
							'required'=>'Enter login',
							'is_unique'=>'This login is already in the system',
							'max_length'=>'The login is too long. (maximum length 10 characters)'
						],
						'ru'=>[
							'required'=>'Введите логин',
							'is_unique'=>'Такой логин уже есть в системе',
							'max_length'=>'Слишком длинный логин. (Максимальная длина - 10 символов)'
						]
					]
				]
			],
			'password'=>[
				'title'=>[
					'en'=>'Password',
					'ru'=>'Пароль'
				],
				'type'=>'text',
				'enable'=>true,
				'edit'=>true,
				'validate'=>[
					'rules'=>'required|max_length[10]',
					'errors'=>[
						'en'=>[
							'required'=>'Enter password',
							'max_length'=>'The password is too long. (maximum length 7 characters)'
						],
						'ru'=>[
							'required'=>'Введите логин',
							'max_length'=>'Слишком длинный пароль. (Максимальная длина - 7 символов)'
						]
					]
				]
			],
			'role'=>[
				'title'=>[
					'en'=>'Role',
					'ru'=>'Роль'
				],
				'enable'=>true,
				'edit'=>true,
				'type'=>'checkbox',
			],
		];
		$data=[
			'table_name'=>'users',
			'fields'=>json_encode($fields),
			'link_buttons'=>json_encode([
				'admin'=>[
					'edit'=>true,
					'add'=>true,
					'delete'=>true,
					
				]
			])

		];
		$this->db->query("INSERT INTO form_2_table (table_name, fields, link_buttons) VALUES(:table_name:, :fields:,:link_buttons:)", $data);
	}
}
