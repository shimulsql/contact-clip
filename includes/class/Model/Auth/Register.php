<?php

    namespace App\Model\Auth;


    use App\Model\Model;
use PDOException;

class Register extends Model{


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


                try
                {
                    $this->db->query('INSERT INTO user(name, email, gender, password) VALUES(:name, :email, :gender, :password)');
                    $this->db->bind(':name', $validated['name']);
                    $this->db->bind(':email', $validated['email']);
                    $this->db->bind(':gender', $validated['gender']);
                    $this->db->bind(':password', $validated['password']);
                    if($this->db->execute()){
                        return error()->make_success('Registration successful');
                    }
                }
                catch(PDOException $e)
                {
                    return error()->make_error(array('db' => $e->getMessage()));
                }
            }
        }



    }