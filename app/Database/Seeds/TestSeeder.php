<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
	public function run()
	{
		
		$data=[
			['question'=>'What is the best animal?',
			'answer'=>json_encode(['turtle','turtle','turtle','horse']),
			'best_answer'=>'0,1,2'
			],

			['question'=>'What is the best animal?',
			'answer'=>json_encode(['turtle','horse','horse','horse']),
			'best_answer'=>'0'
			],

			['question'=>'What is the best animal?',
			'answer'=>json_encode(['cat','turtle','dog','horse']),
			'best_answer'=>'1'
			],

			['question'=>'What is the best animal?',
			'answer'=>json_encode(['cat','turtle','turtle','horse']),
			'best_answer'=>'1,2'
			]

		];
		$this->db->table('tests')->insertBatch($data);
		// $this->db->query("INSERT INTO tests (login, password,role) VALUES(:login:, :password:,:role:)", $data);
		// Using Query Builder
	}
}
