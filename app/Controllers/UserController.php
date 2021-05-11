<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TestModel;

// $validation =  \Config\Services::validation();
class UserController extends BaseController
{
	// protected 
	public function index()
	{
		//
	}
	public function checkUserRole($role){
		$session = session();
		$session->remove('message');
		helper(['form', 'url']);
		$userModel = new UserModel();
		$data['login']=$this->request->getPost('login');
		$password=$this->request->getPost('password');
		$error=[];
		if($data['login']==''){
			$error['error']['form']['validate']['login']='required';
			$error['error']['form']['name_action']='check'.$role;
		}
		if($password==''){
			$error['error']['form']['validate']['password']='required';
			$error['error']['form']['name_action']='check'.$role;
			$data['password']=$password;
		}
		var_dump($session->get('lastURL'));
		if(count($error)>0){
			echo 'yes';
			$error['error']['form']['table']='users';
			$error['error']['form']['data']=$data;
			$session->set('message', $error);
			return redirect()->to($session->get('lastURL'));
		}


		// var_dump($error);
		// echo '<br>';
		// echo 'user<br>';
		// echo $role;
		// echo '<br>';
		// echo $login;
		// echo '<br>';
		// $rules=$userModel->getValidationRules();
		// $messages=$userModel->getValidationMessages();
		// var_dump ($userModel->getValidationMessages());
		// echo '<br>';
		// if( !$this->validate($rules,$messages))
		// {

		// }
		// echo 'error<br>';
		$data['role']=$role;
		$user=$userModel->getUserByColumnValue($data);
			var_dump($user);
		if(!$user || !password_verify($password, $user['password'])){
			$error['error']['form']['name_action']='check'.$role;
			$error['error']['form']['error_message']['en']='Check the entered data. Can`t find you.';
			$error['error']['form']['error_message']['ru']='Проверьте введенные данные. НЕ можем найти Вас.';
			unset($data['role']);
			$data['password']=$password;
			$error['error']['form']['data']=$data;

			$session->set('message', $error);
			return redirect()->to($session->get('lastURL'));
		}
		else{ 
			$session->set('user_id',$user['user_id']);
			$session->set('user_role',$user['role']);
			$session->set('user_login',$user['login']);
			// return redirect()->to($session->get('lastURL'));
			return redirect()->to(base_url().'/'.$role);
		}


	}
	public function getAdmin(){
		$userModel = new UserModel();

		$testModel = new TestModel();

		$session = session();


		if($session->get('user_role')!='admin'){
			return redirect()->to('/');
		}
		$session->set('lastURL','/admin');
		$data['title']=lang('user.admin_title');
		 $data['return_link']=true;
		$data['lang']=$session->get('lang');
		$data['message']=$session->get('message');
		echo view('header',$data);
		$data_admin['users']=$userModel->findAll();
		$data_admin['tests']=$testModel->findAll();
		echo view('admin',$data_admin);
		echo view('footer');
		$session->remove('message');
	}

	public function addUser(){
		$userModel = new UserModel();
		helper(['form', 'url']);
		$session = session();
		$session->remove('message');
		$data['login']=$this->request->getPost('login');
		$data['password']=password_hash($this->request->getPost('password'),PASSWORD_BCRYPT);
		$data['role']='user';
		$rules=$userModel->getValidationRules();
		$messages=$userModel->getValidationMessages();
		// $userModel->insert($data);
		if(! $userModel->insert($data))
		{
			$errors['error']['form']['validate'] =$userModel->errors();
			$errors['error']['form']['data']=$data;
			$errors['error']['form']['name_action']='adduser';
			$errors['error']['form']['table']='users';
			$errors['error']['form']['error_message']['en']='';
			$errors['error']['form']['error_message']['ru']='';
			$session->set('message', $errors);
		}
		

		// if($this->validate($rules,$messages))
		// {
		// 	$userModel->insert($data);
		// }
		// else{
		// 	$errors =$validation->listErrors() ;
		// 	$session->set('message', $errors);
		// }

				// $rules=$userModel->getValidationRules();
		// $messages=$userModel->getValidationMessages();
		// var_dump ($userModel->getValidationMessages());
		// echo '<br>';
		// if( !$this->validate($rules,$messages))
		// {

		// }
		return redirect()->to('/admin');
	}

}
