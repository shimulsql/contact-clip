<?php


    /**
     * Echo function
     * function to echo a variable. It helps to validate variable  
     * 
     */

     function _e($var){
         if(isset($var)){
             echo $var;
         }else{
             echo "Variable not exists";
         }
     }


     /**
     * error handler
     */
