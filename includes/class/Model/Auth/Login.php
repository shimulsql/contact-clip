<?php

    namespace App\Model\Auth;
    use App\Core\AuthToken;

    class Login {
        
        public function __construct()
        {
            
        }


        public function login($req){
            $email = $req['email'];
            $password = $req['password'];

            if($email == '' || $password == '')
            {
                return error()->make_error([
                    'issue' => 'Credential problem',
                    'data' => array(
                        'fields' => 'Empty fields'
                    )
                ]);
            } 


           if(!auth()->user_exists($email, $password))
           {
                return error()->make_error([
                    'issue' => 'Credential problem',
                    'message' => 'Incorrect Credentials'
                ]);
           }
           else
           {
                $user = auth()->get_user($email, $password);
                $logged_in = auth()->login($user);
                if($logged_in){
                    return error()->make_success([
                        'message' => 'Logged in'
                    ]);
                }

           }

            


        }




        public function logout(){
            auth()->logout();
            return error()->make_success([
                'message' => 'Logged out'
            ]);
        }
    }