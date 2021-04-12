<?php

    namespace App\Core;


    class ErrorHandler{
        /**
         * make_error
         *
         * @param  array $array
         * @return array
         */
        
        public function make_error($msg = null){
            $error = array(
                'status' => 'error',
                'response' => $msg
            );
            return $error;
        }


        public function data($array){
            return ['data' => $array];
        }
        
        /**
         * make_success
         *
         * @param  array $response
         * @return array
         */

        public function make_success($response){
            return array('status' => 'success',
                        'response' => $response);
        }
        
        /**
         * is_error
         *
         * @param  array $response
         * @return bool
         */

        public function is_error($response){
            if(isset($response['status']) && $response['status'] == 'error'){
                return true;
            }
        }
        
        /**
         * is_success
         *
         * @param  array $response
         * @return bool
         */

        public function is_success($response){
            if(isset($response['status']) && $response['status'] == 'success'){
                return true;
            }
        }
    }