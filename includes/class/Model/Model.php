<?php

    namespace App\Model;

    use App\Core\FormValidation;
    use App\Database\Database;

    class Model{

        protected $db;
        protected $validation;

        public function __construct()
        {
            $this->db = new Database;
            $this->validation = new FormValidation;
        }

    }