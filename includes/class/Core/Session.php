<?php
    namespace App\Core;

    class Session {
        public function __construct()
        {
            
        }

        public function session_init(){
            session_start();
        }

        public function set($key, $value){
            if($key != '' && $value != ''){
                $_SESSION[$key] = $value; 
                return true;
            }
            return false;
        }

        public function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }
            return false;
        }

        public function isset($key){
            if(isset($_SESSION[$key])){
                return true;
            }
            return false;
        }

        public function unset($key){
            if(isset($_SESSION[$key])){
                unset($_SESSION[$key]);
                return true;
            }
            return false;
        }
    }