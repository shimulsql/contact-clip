<?php

    namespace App\Model\Auth;


    use App\Model\Model;
    use PDOException;

    class Register extends Model{
        protected $table = 'user';

        public function create($req){

            $validated = $this->validation->validate($req, array(
                'name' => 'required|nsc|min:4',
                'email' => 'required|email|unique:user',
                'gender' => 'required|allow:male,female',
                'password' => 'required|min:6',
                'confirm_password' => 'required|match:password'
            ));

            if(error()->is_error($validated))
            {
                return $validated;
            }
            else
            {
                // encrypt password
                $validated['password'] = md5($validated['password']);


                return $this->_create($validated);
            }
        }



    }