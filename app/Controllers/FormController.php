<?php

namespace App\Controllers;
use App\Models\FormsModel;

class FormController extends BaseController
{
    public function getForm(){
        $tables=$this->request->getPost('tables');
        $formModel=new FormsModel();

        // echo
        echo json_encode($formModel->getFormsJSON($tables));
        // echo '90');
    }
	public function index()
	{  
		$session = session();
        $locale = $this->request->getLocale();
        $session->remove('lang');
        $session->set('lang', $locale);
        $url = base_url();
        return redirect()->back();
	}
}
