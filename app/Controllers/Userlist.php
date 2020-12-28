<?php namespace App\Controllers;

use App\Models\UserModel;

class Userlist extends BaseController
{
	public function index()
	{


		$db = db_connect();
		$model = new UserModel($db);
		$result['datos'] = $model->fetch_data();
		// echo '<pre>';
		// print_r($result);
		// echo '<pre>';


      
		echo view('templates/header', $result);
       	echo view('userlist');
        echo view('templates/footer');
	

	}

	//--------------------------------------------------------------------

}
