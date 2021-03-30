<?php

    namespace App\Core;

    use App\Database\Database;

    class AuthToken{

        public $token_table = 'access_token';
        public $user_table = 'user';
        public $token_col = 'token';

        // error handler
        public $eh;

        public function __construct()
        {
            $this->db = new Database;
            $this->eh = new ErrorHandler;
        }
        public function get_token(){
            if(isset($_POST['email']) && isset($_POST['password']))
            {

                $email = $_POST['email'];
                $password = md5($_POST['password']);

                // user id
                $user = $this->get_user_query($email, $password, 'id');

                if(!$user){
                    return $this->eh->make_error(array(
                            'issue' => 'Credential Problem',
                            'message' => 'Incorrect username or password'
                    ));
                }

                // user token
                $user_token = $this->get_user_token($user->id);

                return $this->eh->make_success($user_token);
            } 
            else
            {
                return $this->eh->make_error(array(
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
            
            $this->db->query('SELECT ' . $field . ' FROM '. $this->user_table .' WHERE email = :email AND password = :password');
            $this->db->bind(':email', $email);
            $this->db->bind(':password', $password);
            
            return $this->db->single();
        }

                
        /**
         * get_user_token - get the user token from token table by "user_id"
         *
         * @param  int $user_id
         * @param  string $field - column name. default is token. you can write multiple column name separated by comma example: id, token
         * @return object
         */

         
        public function get_user_token($user_id, $field = 'token'){
            $this->db->query('SELECT * FROM '. $this->token_table .' WHERE user_id = :user_id');
            $this->db->bind(':user_id', $user_id);

            if($this->db->rowCount() == 0)
            {
                // insert new token record
                $this->insert_token($user_id);
            }
            else if($this->db->rowCount() > 0)
            {
                // update exists token record
                $this->update_token($user_id);
            }

            // finally return token
            $this->db->query('SELECT '. $field .' FROM '. $this->token_table .' WHERE user_id = :user_id');
            $this->db->bind(':user_id', $user_id);

            return $this->db->single();
        }
        
        /**
         * insert_token - insert a new token to database
         *
         * @param  int $user_id
         * @return void
         */
        protected function insert_token($user_id){
            $token = $this->generate_token();
            $this->db->query('INSERT INTO '. $this->token_table .'(user_id, token) VALUES(:user_id, :token)');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':token', $token);
            $this->db->execute();
        }
        
        /**
         * update_token - update token on database
         *
         * @param  mixed $user_id
         * @return void
         */
        
        protected function update_token($user_id){
            $token = $this->generate_token();
            $this->db->query('UPDATE '. $this->token_table .' SET token = :token WHERE user_id = :user_id');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':token', $token);
            $this->db->execute();
        }
        
        /**
         * generate_token - generate a new token
         *
         * @return string
         */

        protected function generate_token(){
            $one = md5(time() . app_secret());
            $two = sha1(time() . app_secret());
            return sha1($one) . md5($two);
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
                
        /**
         * valid_token - check token validation
         *
         * @param  string $token
         * @return bool
         */

        public function valid_token($token){
            $this->db->query('SELECT * FROM '. $this->token_table .' WHERE '. $this->token_col .' = :token');
            $this->db->bind(':token', $token);

            if($this->db->rowCount() > 0){
                return true;
            }

            return false;
        }

        public function get_user_by_token($token){
            $this->db->query('SELECT user_id FROM '. $this->token_table .' WHERE '. $this->token_col .' = :token');
            $this->db->bind(':token', $token);

            $user_id = $this->db->single()->user_id;

            $this->db->query('SELECT * FROM '. $this->user_table .' WHERE id = :user_id');
            $this->db->bind(':user_id', $user_id);
            return $this->db->single();

        }


                
        
        
    }