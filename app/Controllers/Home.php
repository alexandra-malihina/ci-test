<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{  	$session = session();
		$session->remove('user_id');
		$session->remove('user_role');
		$session->remove('user_login');		
		$session->remove('lastURL');

		$session->set('lastURL','/');
		$data['title']=lang('home.title');
		// $data['return_link']=false;
		$data['lang']=$session->get('lang');
		$data['message']=$session->get('message');
		echo view('header',$data);
		echo view('welcome_message');
		echo view('footer');
		// $session->remove('message');
	}
}
