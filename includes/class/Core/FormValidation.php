<?php

    namespace App\Core;

    use App\Database\Database;

    class FormValidation{
        protected $formData = []; 
        protected $errors = []; 
        protected $db;

        // special characters , case insensitive
        const SPECIAL_CHARS_IN = "/[$&+,:;=?@#|'<>.^*()%!]/";


        public function __construct()
        {  
            $this->db = new Database;
        }

        
        /**
         * validate - form validate
         *
         * @param  array $data
         * @param  array $rules
         * @return array
         */

        public function validate($data, $rules)
        {
            // set data to class property
            $this->formData = $data;

            // data properties, that will be validated
            $dataProps = array_keys($rules);
            
            // looping validation props to action on each rule
            foreach($dataProps as $dataProp){
                
                if(isset($data[$dataProp]) | isset($_FILES[$dataProp])){

                    // each form data
                    $fieldData = (isset($_FILES[$dataProp]))? $_FILES[$dataProp] : $data[$dataProp];

                    // extract rule data from string
                    $extractedRules = $this->getRules($rules[$dataProp]);

                    // validate form data
                    $this->validateWithRules($fieldData, $extractedRules, $dataProp);
                }
                else
                {
                    $this->setError($dataProp, '!! This field is not defined !!');
                }
                
                
            }

            // has error
            if(count($this->errors) > 0){
                return error()->make_error($this->errors);
            }


            // if everything ok
            return $this->formData;

        }


                
        /**
         * validateWithRules - all rules have defined here
         *
         * @param  string $data
         * @param  array $rules
         * @param  string $dataProp - rule property name
         * @return null
         */

        public function validateWithRules($data, $rules, $dataProp)
        {

            foreach($rules as $ruleProp => $value){

                switch ($ruleProp) {

                    // required field
                    case 'required':
                        // for text
                        if(!is_array($data) && strlen($data) <= 0){

                            $this->setError($dataProp, self::capRU($dataProp) .' is required');

                        }
                        // for file
                        else if(is_array($data) && isset($data['size']) && $data['size'] <= 0){

                            $this->setError($dataProp, self::capRU($dataProp) .' is required');

                        }
                    break;

                    // allow only pre-defined values
                    case 'allow':

                        if(is_array($value)){

                            if(strlen($data) > 0 && !in_array($data, $value)){
                                $this->setError($dataProp, 'Given data not allowed. Allowed: '. implode(',', $value));
                            }

                        } else{
                            if(strlen($data) > 0 && $data == $value){
                                $this->setError($dataProp, 'Given data not allowed. Allowed: '. $value);
                            }
                        }

                    break;

                    // allow file extension only pre-defined values
                    case 'allow_ext':

                        // check data is array type, if array, it's a file

                        if(self::fileExists($data)){
                            $file_ext = strtolower(pathinfo($data['name'], PATHINFO_EXTENSION));

                            if(is_array($value)){

                                if(isset($data) && !in_array($file_ext, $value)){
                                    $this->setError($dataProp, 'Format not allowed. Support: '. implode(',', $value));
                                }

                            } else{
                                if(strlen($data) > 0 && $file_ext == $value){
                                    $this->setError($dataProp, 'Format not allowed. Only support: '. $value);
                                }
                            }
                        }

                    break;

                    // require minimum character
                    case 'min':
                        if(strlen($data) > 0 && strlen($data) < $value){
                            $this->setError($dataProp, 'Minimum '. $value .' characters required');
                        }
                    break;

                    // require minimum file size | in megabyte
                    case 'min_size': 
                        if(self::fileExists($data)){
                            $invokedSize = 1000000 * $value;
                            if(is_array($data) && $data['size'] < $invokedSize){
                                $this->setError($dataProp, 'Required filesize minimum '. $value .'MB');
                            }
                        }
                        
                    break;


                    // maximum characters allowed
                    case 'max':
                        if(strlen($data) > 0 && strlen($data) < $value){
                            $this->setError($dataProp, 'Maximum '. $value .' characters allowed');
                        }
                    break;

                    // require minimum file size | in megabyte
                    case 'max_size': 
                        if(self::fileExists($data)){
                            $invokedSize = 1000000 * $value;
                            if(is_array($data) && $data['size'] > $invokedSize){
                                $this->setError($dataProp, 'Allowed filesize '. $value .'MB or less');
                            }
                        }
                    break;


                    // email validation
                    case 'email':

                        if(strlen($data) > 0 && !filter_var($data, FILTER_VALIDATE_EMAIL)){
                            $this->setError($dataProp, 'Invalid email address');
                        }

                    break;

                    // match with other field
                    case 'match':

                        if(strlen($data) > 0 && $data != $this->formData[$value]){
                            $this->setError($dataProp, self::capRU($value). ' not matched');
                        }

                    break;


                    case 'file':
                        if(!self::fileExists($data)){
                            $this->setError($dataProp, 'This field requires file');
                        }
                    break;

                    // nsc = no special character
                    case 'nsc':

                        if(preg_match(self::SPECIAL_CHARS_IN, $data)){
                            $this->setError($dataProp, 'Invalid '. $dataProp);
                        }

                    break;

                    // unique in database table
                    case 'unique':

                        $this->db->query('SELECT * FROM `'. $value .'` WHERE '. $dataProp .' = :prop');
                        $this->db->bind(':prop', $data);
                        $rowCount = $this->db->rowCount();

                        if($rowCount > 0){
                            $this->setError($dataProp, self::capRU($dataProp) .' already exists');
                        }

                    break;

                    default:
                       
                        break;
                }
            }
        }
        
        /**
         * getRules
         *
         * @param  string $rules
         * @return array
         */

        public function getRules($rules)
        {
            // separate each rule by '|'
            $rules = explode('|', $rules);

            // rules key and value storage
            $ruleKeyValue = [];

            // looping rules
            foreach($rules as $rule){

                // separate rule's property and value by ':'
                $extractedRule = explode(':', $rule);

                $prop = $extractedRule[0];
                $value = (isset($extractedRule[1])) ? $extractedRule[1]: 1;

                // multiple values define with comma
                // handle multiple value seperated by comma
                if(preg_match('/,/', $value)){
                    $extMultiValue = explode(',', $value);
                    $value = $extMultiValue;
                }

                // set rule to rules storage
                $ruleKeyValue[$prop] = $value;
            }

            // return rules
            return $ruleKeyValue;
        }
        
        /**
         * setError
         *
         * @param  string $field
         * @param  string $msg
         * @return null
         */

        protected function setError($field, $msg)
        {
            $this->errors[$field] = $msg; 
        }
        
        /**
         * capRU - capitalize value and remove underscore
         *
         * @param  string $value
         * @return void
         */
        protected static function capRU($value){
            $rmus = str_replace('_', ' ', $value);

            $arrStr = str_split($rmus);
            $arrStr[0] = strtoupper($arrStr[0]);

            return implode('', $arrStr);
        }

        protected static function fileExists($file){
            if(isset($file['tmp_name']) && file_exists($file['tmp_name'])){
                return true;
            }
            return false;
        }




        

        





    }
