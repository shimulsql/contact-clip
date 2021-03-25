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

        public function bind($param, $value, $type = null){
            if(is_null($type)){
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;

                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;

                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default: 
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
            
        }


        public function resultSet(){
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }


        public function single(){
            $this->stmt->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        public function rowCount(){
            $this->stmt->execute();
            return $this->stmt->rowCount();
        }

        
    }