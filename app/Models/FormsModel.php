<?php

namespace App\Models;

use CodeIgniter\Model;

class FormsModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'form_2_table';
	protected $primaryKey           = 'form_2_table_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_date';
	protected $updatedField         = 'updated_date';
	protected $deletedField         = 'deleted_date';

	// // Validation
	// protected $validationRules      = [];
	// protected $validationMessages   = [];
	// protected $skipValidation       = false;
	// protected $cleanValidationRules = true;

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
	public function getFormsJSON($tableName){
		$query=$this->db->query("SELECT table_name, JSON_OBJECT( 'fields',fields, 'link_buttons',link_buttons) form_data  FROM form_2_table WHERE table_name in ($tableName) ");
		$res=[];
		foreach ($query->getResult() as $row)
		{
			//$obj=(object)array($row['table_name']=>$row['form_data']);
			$res[$row->table_name]=$row->form_data;
		}
		return $res;
	}
}
