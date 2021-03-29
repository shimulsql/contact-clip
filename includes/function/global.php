<?php

use App\Core\View;

    /**
     * Template functions
     */
    
    function frontend($path, $data = []){
        View::frontend($path, $data);
    }
    function view($path, $data = []){
        View::view($path, $data);
    }

    /**
     * URL function
     */

     function get_asset_path(){
         echo ASSETS;
     }
     function get_asset_url(){
         echo ASSETS;
     }

     function get_dir_path(){
         echo BASE;
     }

     function get_dir_url(){
         echo URLROOT;
     }
     function app_url(){
         return URLROOT;
     }



     /**
     * security
     */

     function app_secret(){
         return APPSECRET;
     }


?>