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
            $keep = $req['keep_login'];

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

                if($keep == 'true'){
                    $logged_in = auth()->login($user, true);
                }else{
                    $logged_in = auth()->login($user);
                }

                if($logged_in){
                    return error()->make_success([
                        'message' => 'Logged in',
                        'access_token' => authToken()->get_user_token($user->id)->token
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