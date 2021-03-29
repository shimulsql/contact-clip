<?php

    namespace App\Core;

    class Cookie{
        public function get($name){
            if(isset($_COOKIE[$name])){
                return $_COOKIE[$name];
            }
        }
        public function set($name, $value, $time = null){
            if(!isset($_COOKIE[$name])){
                return setcookie($name, $value, $time);
            }
        }
        public function isset($name){
            if(isset($_COOKIE[$name])){
                return true;
            }
        }
        public function destroy($name){
            if(isset($_COOKIE[$name])){
                return setcookie($name, '' , time() - 999999999);
            }
        }
    }