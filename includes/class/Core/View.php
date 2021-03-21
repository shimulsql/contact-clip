<?php

    namespace App\Core;

    use Exception;

    class View{
            protected static $frontend_prefix = 'frontend/';

            public function get_area($name)
            {
                

                if(isset((new self)->sections[$name]))
                {
                    echo (new self)->sections[$name];
                }
                else 
                {
                    echo '<div style="border: 1px solid red; padding: 10px">"' . $name . '" Section not found</div>';
                }

            }


            public static function frontend($path, $data = []){
                return (new self)->view(self::$frontend_prefix . $path, $data);
            }

            protected function render($path, $data = []){
                $absolute_path = TEMPLATES . $path;
                try {
                    if(!file_exists($absolute_path)){
                        throw new Exception("View not found");
                        return;
                    }
                    
                    // extract data pass through template function
                    if(count($data) > 0){
                        extract($data);
                    }
                    include $absolute_path;
                    
                } catch (\Exception $th) {
                    echo '<div style="border: 1px solid red; padding: 10px">';
                    echo '<h4 style="padding-bottom: 0">View not Found</h4>';
                    echo '<h5>Template URL: ' . $th->getTrace()[0]['args'][0] . '</h5>';
                }
            }

            public static function view($path, $data = []){
                $exact_path = (new self)->dot_to_slash_url($path) . '.php';
                (new self)->render($exact_path, $data);
            }

            protected function dot_to_slash_url($path){
                $chunked_path = explode('.', $path);
                return implode('/', $chunked_path);
            }


        }

        

?>