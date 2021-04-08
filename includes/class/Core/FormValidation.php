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
                
                if(isset($data[$dataProp])){

                    // each form data
                    $fieldData = $data[$dataProp];

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
                        if(strlen($data) <= 0){
                            $this->setError($dataProp, self::capRU($dataProp) .' is required');
                        }
                    break;

                    // require minimum character
                    case 'min':
                        if(strlen($data) > 0 && strlen($data) < $value){
                            $this->setError($dataProp, 'Minimum '. $value .' characters required');
                        }
                    break;

                    // maximum characters allowed
                    case 'max':
                        if(strlen($data) > 0 && strlen($data) < $value){
                            $this->setError($dataProp, 'Maximum '. $value .' characters allowed');
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




        

        





    }
