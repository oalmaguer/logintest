<?php namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//validar
			$rules = [
				
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]|validarUsuario[email, password]',
				//crear nuevo folder en app para validateUser
			];
				//crear mensaje de error para validateUser metodo
			$errors = [
				'password' => [
					'validarUsuario' => 'Email o Contrasenia es incorrecto'
				]
			];

				//si validacion no es exitosa
			if (!$this->validate($rules, $errors)) {
				//crear variable de validacion para obtener todos los errores
				$data['validation'] = $this->validator;
			} else {
				
				//agregar App\Models\UserModel; arriba
				// si validacion funciona crear nueva instancia de user model
				$model = new userModel();

				$user = $model->where('email', $this->request->getVar('email'))
							//find first record
							->first();

				//session
				$this->setUserSession($user);
				return redirect()->to('dashboard');


			}
		} 

		echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer');
	}

	private function setUserSession($user) {
		$data = [
			'id' => $user['id'],
			'nombre' => $user['nombre'],
			'apellido' => $user['apellido'],
			'email' => $user['email'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}


	public function register() {
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//validar
			$rules = [
				'nombre' => 'required|min_length[3]|max_length[20]',
				'apellido' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[usuarios.email]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				//almacena usuario en BDD
				//agregar App\Models\UserModel; arriba
				// si validacion funciona crear nueva instancia de user model
				$model = new userModel();

				$newData = [
					'nombre' => $this->request->getVar('nombre'),
					'apellido' => $this->request->getVar('apellido'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Registro Exitoso');
				return redirect()->to('/'); 
			}
		} 


		echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer');
	}

	public function profile() {

		$data = [];
		helper(['form']);
		$model = new UserModel();


		if ($this->request->getMethod() == 'post') {
			//validar
			$rules = [
				'nombre' => 'required|min_length[3]|max_length[20]',
				'apellido' => 'required|min_length[3]|max_length[20]',
			
			];
				//usuario cambia contrasenia
			if($this->request->getPost('password') != '') {
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				//actualizar usuario en BDD
				//agregar App\Models\UserModel; arriba
				// si validacion funciona crear nueva instancia de user model
				$model = new userModel();

				$newData = [
					//id para que no cree nuevo registro
					'id' => session()->get('id'),
					'nombre' => $this->request->getPost('nombre'),
					'apellido' => $this->request->getPost('apellido'),
				];

					//getvar checa variables de request
					//getpost checa especificamente post 
				if($this->request->getPost('password') != '') {
				$newData['password'] = $this->request->getPost('password');
				}


				$model->save($newData);
				session()->setFlashdata('success', 'Actualizado!');
				return redirect()->to('/profile'); 
			}
		} 

		//usuario, declarar model fuera de post
		$data['user'] = $model->where('id', session()->get('id')) ->first();
		echo view('templates/header', $data);
		echo view('profile');
		echo view('templates/footer');
	}

	public function logout() {
		session()->destroy();
		return redirect()->to('/');
	}



	//--------------------------------------------------------------------

}
