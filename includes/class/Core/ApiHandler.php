<?php
    namespace App\Core;


    class ApiHandler{
            public $secure = true;
            protected $process = true;

            public function __construct()
            {
                // header cotent type json to receive the response as JSON format
                header('Content-type: application/json');

            }
            
            
            /**
             * filter_request - Filter and process the request
             *
             * @param  function $callback
             * @param  function $request
             * @param  class $model
             * @return string return string as json
             */


            private function filter_request($callback, $request, $model){

                if(!isset($_REQUEST['secret']) || $_REQUEST['secret'] != APPSECRET){
                    if($this->secure){

                        // unauthorize status
                        http_response_code(401);

                        // return error
                        $this->error_handler(array(
                            'issue' => 'security',
                            'message' => 'Invalid or missing secret key. To make this request successful please provide a authentic secret key'
                        ));
                        $this->process = false;
                    }

                }

                // if everything is ok then process the request

                if($this->process){
                    echo $callback($request, $model);
                }

                


            }

                    
            /**
             * get - handle get request
             *
             * @param  function $callback - play with the request inside this function
             * @param  object $model
             * @return string - return string as json format
             */
            
            public function get($callback, $model = null){

                if($_SERVER['REQUEST_METHOD'] == 'GET'){
                    $this->filter_request(function($callback, $model){

                        $callback($model);

                    }, $callback, $model);
                }

            }

            /**
             * post - handle post request
             *
             * @param  function $callback - play with the request inside this function
             * @param  object $model
             * @return string - return string as json format
             */
            public function post($callback, $model = null){
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->process){

                    // filter the request
                    $this->filter_request(function($callback, $model){

                        $callback($model);

                    }, $callback, $model);
                }
            }

            /**
             * put - handle put/patch request
             *
             * @param  function $callback - play with the request inside this function
             * @param  object $model
             * @return string - return string as json format
             */

            public function put($callback, $model = null){
                if($_SERVER['REQUEST_METHOD'] == 'PUT'){
                    echo $callback($model);
                }
            }

            /**
             * delete - handle delete request
             *
             * @param  function $callback - play with the request inside this function
             * @param  object $model
             * @return string - return string as json format
             */
            public function delete($callback, $model = null){
                if($_SERVER['REQUEST_METHOD'] == 'PUT'){
                    echo $callback($model);
                }
            }


            public function encode($array){
                echo json_encode($array);
            }

                    
            /**
             * error_handler - error message manager
             *
             * @param  array $array
             * @return string - return string as json
             */

            public function error_handler($array){
                $error = array(
                    'error' => $array
                );

                echo json_encode($error);
            }
    }