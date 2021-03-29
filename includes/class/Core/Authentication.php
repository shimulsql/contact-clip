<?php

    namespace App\Core;

    use App\Database\Database;

    class Authentication{
        public $db;
        public $session;
        public $cookie;
        public $authToken;
        public $user_table = 'user';

        public function __construct()
        {
            $this->session = new Session;
            $this->cookie = new Cookie;
            $this->authToken = new AuthToken;
            $this->db = new Database;
        }

        public function init()
        {
            $this->session->session_init();


            // $token = $this->cookie->get('access_token');

            // if(!$this->is_logged_in()){
            //     if($this->cookie->isset('access_token')){
            //         if($this->authToken->valid_token($token)){
            //             $user = $this->authToken->get_user_by_token($token);
            //             $this->session->set('logged_in', true);
            //             $this->session->set('logged_user', $user);
            //         }else{
            //             $this->session->set('logged_in', false);
            //             $this->cookie->destroy('access_token');
            //         }
            //     }
                
            // }
            // else
            // {
            //     if(!$this->authToken->valid_token($token)){
            //         $this->session->set('logged_in', false);
            //         $this->cookie->destroy('access_token');
            //     }
            // }




        }
        public function login($user){
            $this->session->set('logged_in', true);
            $this->session->set('logged_user', $user);
            return true;
        }

        public function logout(){
            $this->session->unset('logged_in');
            $this->session->unset('logged_user');
            $this->cookie->destroy('access_token');
        }

        public function protect()
        {
            if(!$this->is_logged_in()){
                $this->redirect_login();
            }
        }

        public function user(){
            if($this->is_logged_in()){
                return $this->session->get('logged_user');
            }
        }

        public function only_guest(){
            if($this->is_logged_in()){
                $this->redirect_admin();
            }
        }

        public function is_logged_in()
        {
            if($this->session->isset('logged_in'))
            {
                return true;
            }
            else 
            {
                return false;
            }
        }

        public function redirect_login(){
            header('Location: '. app_url() .'login.php');
        }

        public function redirect_admin(){
            header('Location: '. app_url() .'admin/');
        }

        /**
         * get_user - get user information
         *
         * @param  string $email
         * @param  string $password
         * @return object
         */

        public function get_user($email, $password){
            
            $this->db->query('SELECT * FROM user WHERE email = :email AND password = :password');
            $this->db->bind(':email', $email);
            $this->db->bind(':password', md5($password));
            $user = $this->db->single();
            return $user;
        }

        /**
         * user_exists - get user information
         *
         * @param  string $email
         * @param  string $password
         * @return bool
         */

        public function user_exists($email, $password){
            
            $this->db->query('SELECT id FROM user WHERE email = :email AND password = :password');
            $this->db->bind(':email', $email);
            $this->db->bind(':password', md5($password));
            
            if($this->db->rowCount() > 0){
                return true;
            }

            return false;


        }

            
    }