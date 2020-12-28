<?php namespace App\Validation;

use App\Models\UserModel;

class ValidarUsuario
{   
    //nombre del metodo en login
    public function validarUsuario(string $str, string $fields, array $data) {
        $model = new UserModel();
        $user = $model->where('email', $data['email'])

                    ->first();

                    if (!$user)
                    return false;
                                            //pw de login            //pw de BDD
                    return password_verify($data['password'], $user['password']);
    }
}

//agregar \App\Validation\UserRules::class,  en validaciones de codeIgniter app/validations
