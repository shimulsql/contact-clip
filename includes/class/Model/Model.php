<?php

    namespace App\Model;

    use App\Core\FormValidation;
    use App\Database\Database;
    use PDOException;

    class Model{

        protected $table;
        protected $db;
        protected $validation;
        protected $table_cols = [];

        public function __construct()
        {
            $this->db = new Database;
            $this->validation = new FormValidation;

            // dynamically set model's class name as table name
            if(strlen($this->table) <= 0){
                $this->table = $this->className();
            }
            
            
        }


        public function _create($req){

            // table columns
            $table_cols =  $this->getTableColumns();

            // set table columns to $table_col property
            $this->setTableCols($table_cols, $req);
            
            // column name as string
            $cols_str = $this->tableColStr();

            // column placeholder string
            $cols_placeholder = $this->tableColPlaceholder();

            
            // generate query
            $query = "INSERT INTO `$this->table`($cols_str) VALUES($cols_placeholder)";
            // var_dump($query);
            try{
                $this->db->query($query);

                // auto binding columns
                foreach($this->table_cols as $col){
                    if(isset($req[$col])){
                        $this->db->bind(':'. $col, $req[$col]);
                    }
                }

                // insert data
                if($this->db->execute()){
                    return error()->make_success($this->table .' created successfully');
                }
            }
            catch(PDOException $e){
                // error
                return error()->make_error(array('db' => $e->getMessage()));
            }
            
        }
        
        /**
         * Table columns as comma separated string
         *
         * @return string
         */
        
        protected function tableColStr(){
            return $this->table_cols_str = implode(',', $this->table_cols);
        }
        
        /**
         * Table columns as comma separated PDO placeholder string
         *
         * @return string
         */

        protected function tableColPlaceholder(){
            $arr = [];

            // add ':' before every column name
            foreach($this->table_cols as $col){
                $arr[] = ':'. $col;
            }

            // join array with ','
            return implode(',', $arr);
        }
        
        /**
         * Table columns set to $table_cols property, in index array format
         *
         * @param  object $cols
         * @return null
         */

        protected function setTableCols($cols, $req){

            // add to array from object
            foreach($cols as $col){
                // only store columns which has given by request
                if(isset($req[$col->COLUMN_NAME])){
                    $this->table_cols[] = $col->COLUMN_NAME;
                }
                
            }
        }
        
        /**
         * Get all columns name of a table
         *
         * @return object
         */

        public function getTableColumns(){

            // table columns query
            $query = "SELECT COLUMN_NAME

            FROM INFORMATION_SCHEMA.COLUMNS
            
            WHERE TABLE_NAME = :table_name
            
            AND
            
            TABLE_SCHEMA = :db_name";


            $this->db->query($query);
            $this->db->bind(':table_name', $this->table);
            $this->db->bind(':db_name', DB_NAME);

            return $this->db->resultSet();
        }
        
        /**
         * Class name, use to define dynamically table name from class name
         *
         * @return string
         */

        protected function className(){
            $class_name = get_class($this);
            $extracted_cname = explode('\\', $class_name);
            return strtolower(end($extracted_cname));
        }

    }