<?php 
    namespace App\Core;

    class Footer{
        private $templateLocation = BASE . 'templates/inc/footer.php';
        private $footerAttr = [];

        public function set_attr($key, $value){
            $this->headerAttr[$key] = $value;
        }

        public function get_footer(){
            extract($this->footerAttr);
            
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