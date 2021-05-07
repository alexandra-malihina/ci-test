<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{  	$session = session();
		$session->remove('user_id');
		$session->remove('user_role');
		$data['title']=lang('home.title');
		$data['return_link']=false;
		echo view('header',$data);
		echo view('welcome_message');
	}
}
