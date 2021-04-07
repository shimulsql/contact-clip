<?php

    namespace App\Model;

    class Contact extends Model{

        public function create($data){
            
            return $this->_create($data);
        }
    }