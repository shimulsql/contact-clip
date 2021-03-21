<?php
    namespace App\Core;

    class Header{
        private $templateLocation = BASE . 'templates/inc/header.php';
        private $headerAttr = [];

        public function __construct(){
            // default page title
        //    $this->set_page_title('Blank page');
        }

        public function set_page_title($title){
            $this->set_attr('page_title', $title . ' | ' .SITETITLE);
        }

        public function set_attr($key, $value){
            $this->headerAttr[$key] = $value;
        }

        public function get_header(){
            extract($this->headerAttr);
            
            if(file_exists($this->templateLocation)){
                include $this->templateLocation;
            }
        }

        public function get_attr($key){
            if(array_key_exists($key, $this->headerAttr)){
                return $this->headerAttr[$key];
            }
        }


    }


?>