<?php

    namespace App\Core;

    use App\Database\Database;

    class AuthToken extends Database{

        public $token_table = 'access_token';
        public $user_table = 'user';
        public $token_col = 'token';

        public function get_token(){
            if(isset($_POST['email']) && isset($_POST['password']))
            {

                $email = $_POST['email'];
                $password = md5($_POST['password']);

                // user id
                $user = $this->get_user_query($email, $password, 'id');
                if(!$user){
                    return $this->make_error(array(
                            'issue' => 'Credential Problem',
                            'message' => 'Incorrect username or password'
                    ));
                }
                // user token
                $user_token = $this->get_user_token($user->id);
                return $this->make_success($user_token);
            } 
            else
            {
                return $this->make_error(array(
                        'issue' => 'Credential Problem',
                        'message' => 'Please provide email & password'
                    ));
            }
        }
                
        /**
         * get_user_query - get user information
         *
         * @param  string $email
         * @param  string $password
         * @param  string $field
         * @return object
         */

        protected function get_user_query($email, $password, $field = '*'){
            
            $this->query('SELECT ' . $field . ' FROM '. $this->user_table .' WHERE email = :email AND password = :password');
            $this->bind(':email', $email);
            $this->bind(':password', $password);
            
            return $this->single();
        }

                
        /**
         * get_user_token - get the user token from token table by "user_id"
         *
         * @param  int $user_id
         * @param  string $field - column name. default is token. you can write multiple column name separated by comma example: id, token
         * @return object
         */
        protected function get_user_token($user_id, $field = 'token'){
            $this->query('SELECT * FROM '. $this->token_table .' WHERE user_id = :user_id');
            $this->bind(':user_id', $user_id);

            if($this->rowCount() == 0)
            {
                // insert new token record
                $this->insert_token($user_id);
            }
            else if($this->rowCount() > 0)
            {
                // update exists token record
                $this->update_token($user_id);
            }

            // finally return token
            $this->query('SELECT '. $field .' FROM '. $this->token_table .' WHERE user_id = :user_id');
            $this->bind(':user_id', $user_id);

            return $this->single();
        }
        
        /**
         * insert_token - insert a new token to database
         *
         * @param  int $user_id
         * @return void
         */
        protected function insert_token($user_id){
            $token = $this->generate_token();
            $this->query('INSERT INTO '. $this->token_table .'(user_id, token) VALUES(:user_id, :token)');
            $this->bind(':user_id', $user_id);
            $this->bind(':token', $token);
            $this->execute();
        }

        protected function update_token($user_id){
            $token = $this->generate_token();
            $this->query('UPDATE '. $this->token_table .' SET token = :token WHERE user_id = :user_id');
            $this->bind(':user_id', $user_id);
            $this->bind(':token', $token);
            $this->execute();
        }

        protected function generate_token(){
            $one = md5(time() . app_secret());
            $two = sha1(time() . app_secret());
            return sha1($one) . md5($two);
        }

        public function make_error($array){
            if(is_array($array)){
                $error = array(
                    'status' => 'error',
                    'response' => $array
                );
                return $error;
            }
        }
                
        /**
         * access_token - return access token with json format from response data
         *
         * @return string JSON
         */

        public function access_token($response){
            $token_column = $this->token_col;

            if(isset($response['response'])){
                echo json_encode(array('access_token' => $response['response']->$token_column));
            }
        }

        public function valid_token($token){
            $this->query('SELECT * FROM '. $this->token_table .' WHERE '. $this->token_col .' = :token');
            $this->bind(':token', $token);

            if($this->rowCount() > 0){
                return true;
            }
            
            return false;
        }

        public function make_success($response){
            return array('status' => 'success',
                        'response' => $response);
        }

        public function is_error($response){
            if(isset($response['status']) && $response['status'] == 'error'){
                return true;
            }
        }
        public function is_success($response){
            if(isset($response['status']) && $response['status'] == 'success'){
                return true;
            }
        }
        
    }