<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{  $data['title']=lang('home.title');
		echo view('header',$data);
		echo view('welcome_message');
	}
}
