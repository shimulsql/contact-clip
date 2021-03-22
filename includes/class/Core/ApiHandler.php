<?php
    namespace App\Core;

    class ApiHandler{
        public $secure = true;
        protected $continue = true;

        public function __construct($secure = true)
        {
            $this->secure = $secure;
            header('Content-type: application/json');

            if($this->secure){
                if(!isset($_REQUEST['secret']) || $_REQUEST['secret'] != APPSECRET){
                    if($this->secure){
                        http_response_code(401);
                        echo json_encode(array('error' => array(
                            'type' => 'security',
                            'message' => 'Invalid or missing secret key. To make this request successful please provide a authentic secret key'
                        )));
                        $this->continue = false;
                    }
                }

                
            }
        }
        private function fileter_request($function){
            if(!isset($_REQUEST['secret']) || $_REQUEST['secret'] != APPSECRET){
                if($this->secure){
                    http_response_code(401);
                    echo json_encode(array('error' => array(
                        'type' => 'security',
                        'message' => 'Invalid or missing secret key. To make this request successful please provide a authentic secret key'
                    )));
                    $this->continue = false;
                }
            }


        }
        public function get($callback, $model = null){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                echo $callback($model);
            }
        }
        public function post($callback, $model = null){
            if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->continue){
                echo $callback($model);
            }
        }
        public function put($callback, $model = null){
            if($_SERVER['REQUEST_METHOD'] == 'PUT'){
                echo $callback($model);
            }
        }
        public function delete($callback, $model = null){
            if($_SERVER['REQUEST_METHOD'] == 'PUT'){
                echo $callback($model);
            }
        }


        public function encode($array){
            return json_encode($array);
        }

        public function secret_destroy(){
            $_REQUEST['secret'] = null;
        }
    }