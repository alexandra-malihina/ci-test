<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TestModel;

class TestController extends BaseController
{
	public function index()
	{
		$testModel=new TestModel();
		$session=session();
		if($session->get('user_role')!='user'){
			return redirect()->to('/');
		}
		$session->set('lastURL','/user');
		$data['title']=lang('user.admin_title');
		$data['return_link']=true;
		$data['lang']=$session->get('lang');
		$data['message']=$session->get('message');

		$data_test['test']=null;
		$test=$testModel->getRandTest();
		if($test)
		{
			$session->set('test_id',$test[0]['test_id']);
			$session->set('best_answer',$test[0]['best_answer']);//=json_decode($test[0]['best_answer']);
			$data_test['test']['question']=$test[0]['question'];
			$data_test['test']['answer']=$test[0]['answer'];
			if(strlen($session->get('best_answer'))>1)
			{
				$data_test['test']['count_answers']=true;
			}
			else{
				$data_test['test']['count_answers']=false;
			}
		}


		echo view('header',$data);
		echo view('tests',$data_test);
		echo view('footer');

		$session->remove('message');
	}

	public function setAnswer(){
		$session = session();
		$data['user_answer']=$this->request->getPost('answer');
		$data['correct_answer']=$session->get('best_answer');

		if($data['user_answer']==$data['correct_answer'])
			$data['success']=true;
		
		echo json_encode($data);
	}
	
}
