<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'user_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'login','password','role'
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_date';
	protected $updatedField         = 'updated_date';
	protected $deletedField         = 'deleted_date';

	// Validation
	protected $validationRules      = [
		'login'=>'required|is_unique[users.login]|max_length[10]',
		'password'=>'required',//|max_length[10]',
	];
	protected $validationMessages   = [
		'login'=>[
			'is_unique'=>'unique',
			'required'=>'required',
			'max_length'=>'max_length'
		],
		'password'=>[
			'required'=>'required',
			'max_length'=>'max_length'
		]
	];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getUserByColumnValue($data){
		return $this->asArray()->where($data)->first();

	}
	// // Callbacks
	// protected $allowCallbacks       = true;
	// protected $beforeInsert         = [];
	// protected $afterInsert          = [];
	// protected $beforeUpdate         = [];
	// protected $afterUpdate          = [];
	// protected $beforeFind           = [];
	// protected $afterFind            = [];
	// protected $beforeDelete         = [];
	// protected $afterDelete          = [];
}
