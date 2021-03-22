<?php
    namespace App\Model;

use App\Database\Database;

    class Model{
        protected $db;

        public function __construct()
        {
            $this->db = new Database;
        }

    }