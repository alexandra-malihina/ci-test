<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		//
		$data=[
			'login'=>'admin',
			'password'=>password_hash('123465',PASSWORD_BCRYPT),
			'role'=>'admin'

		];
		$this->db->query("INSERT INTO users (login, password,role) VALUES(:login:, :password:,:role:)", $data);
		// Using Query Builder

	}
}
