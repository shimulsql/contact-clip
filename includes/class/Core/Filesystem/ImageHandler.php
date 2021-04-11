<?php
    namespace App\Core\FileSystem;


    class ImageHandler{

        public     $upload_dir = BASE . 'resource/uploads/';
        protected  $imageInfo = [];
        protected  $support  = ['.jpg', '.jpeg', '.png'];

        protected  $image;

        public function process($image){

            $this->extractInfo($image);

            $this->createImage();

            /**
             * Resize image in various sizes
             */

             // original size
            $imagname = $this->resize();

            // width: 800 medium
            $this->resize(800, $imagname . '-md');

            // width: 400, small
            $this->resize(400, $imagname . '-sm');

            // width: 150, extra small
            $this->resize(150, $imagname . '-xs');

            return $imagname . $this->get('ext');

        }


        protected function upload($image, $name){


            switch ($this->get('mime')) {

                case 'image/jpg':
                case 'image/jpeg':
                    imagejpeg($image, $this->upload_dir . $name . $this->get('ext'));
                break;

                case 'image/png':
                    imagepng($image, $this->upload_dir . $name . $this->get('ext'));
                break;
                
                default:
                    
                break;
            }
        }


        protected function resize($newWidth = null, $name = null){

            // generate name or input name
            $name = ($name == null) ? substr(md5(time()),0,20) : $name;

            if($newWidth != null){
                
                $ratio = $this->get('width') / $this->get('height');

                if($newWidth < $this->get('width')){

                    $newHeight = $newWidth / $ratio;

                }
                else{
                    $newWidth = $this->get('width');
                    $newHeight = $this->get('height');
                }

                $dist = imagecreatetruecolor($newWidth, $newHeight);

                imagecopyresampled($dist, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $this->get('width'), $this->get('height'));

                $this->upload($dist, $name);
                
                imagedestroy($dist);

            }
            else{
                $this->upload($this->image, $name);
            }

            return $name;

        }





        protected function extractInfo($image){
            $temp_arr = [];

            $size = getimagesize($image['tmp_name']);

            // extract width, height, type and attr
            list($temp_arr['width'], $temp_arr['height'], $temp_arr['ext'], $temp_arr['attr']) = $size;

            // extract mime
            $temp_arr['mime'] = $size['mime'];

            // name, path, and size[kB]
            $temp_arr['name'] = $image['name'];
            $temp_arr['path'] = $image['tmp_name'];
            $temp_arr['size'] = round($image['size'] / (1024), 2);

            // set image type in string (ex: jpg, png)
            $temp_arr['ext'] = image_type_to_extension($temp_arr['ext']);

            $this->imageInfo = $temp_arr;
        }

        protected function createImage(){
            switch ($this->get('mime')) {
                case 'image/jpg':
                case 'image/jpeg':
                    $this->image = imagecreatefromjpeg($this->get('path'));
                break;
                case 'image/png':
                    $this->image = imagecreatefrompng($this->get('path'));
                break;
                
                default:

                    break;
            }
        }

                
        /**
         * get - Get image informations
         *
         * @param  string $name
         * @return string
         */

        protected function get($name){
            if(isset($this->imageInfo[$name]))
                return $this->imageInfo[$name];
            return false;
        }

        


    }