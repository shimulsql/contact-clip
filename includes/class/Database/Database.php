<?php
    namespace App\Database;

    use PDO;
    use PDOException;

    class Database{
        private $db_name = DB_NAME;
        private $db_user = DB_USER;
        private $db_pass = DB_PASS;
        private $db_host = DB_HOST;

        private $connection;
        private $stmt;

        public function __construct(){
            $dsn = 'mysql:host=' . $this->db_host . '; dbname=' . $this->db_name;
            try{
                $this->connection = new PDO($dsn, $this->db_user, $this->db_pass);
            }
            catch (PDOException $e){
                echo '<h1>Error to Establishing Database Connection</h1>';
                echo '<p>' . $e->getMessage() . '</p>';
                die();
            }
        }

        public function query($query){
            $this->stmt = $this->connection->prepare($query);
        }

        public function execute(){
            return $this->stmt->execute();
        }

        
    }