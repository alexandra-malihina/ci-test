<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{  	$session = session();
		$session->remove('user_id');
		$session->remove('user_role');
		$session->remove('lastURL');
		$session->set('lastURL','/');
		$data['title']=lang('home.title');
		$data['return_link']=false;
		$data['lang']=$session->get('lang');
		echo view('header',$data);
		echo view('welcome_message');
		echo view('footer');
	}
}
