<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'usuarios';
    protected $allowedFields = ['nombre', 'apellido', 'email', 'password', 'actualizado'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected $db;

    protected function beforeInsert(array $data) {

        //HASHEAR CONTRASENIA
       $data = $this->passwordHash($data);
        
        return $data;
    }

     protected function beforeUpdate(array $data) {
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function passwordHash(array $data) {
         if(isset($data['data']['password'])) 
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        
        return $data;
    }

    function fetch_data() {
        return $this->db->table('usuarios')->get()->getResult();
    }


}