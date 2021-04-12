<?php
    namespace App\Core\FileSystem;

    use PDOException;

    class ImageHandler{

        /** All images will be uploaded in this location */
        protected   $upload_dir = BASE . 'resource/uploads/';

        /** Image informations */
        protected   $imageInfo = [];

        /** Supported format */
        public      $supports  = ['.jpg', '.jpeg', '.png'];

        /** Resize entries */
        public      $resizes = ['md' => 800, 'sm' => 400, 'xs' => 150];

        /** resource image */
        protected   $image;


                
        /**
         * Process the image
         *
         * @param  resource $image
         * @return string image name
         */

        public function process($image){


            if($image['size'] > 0)
            {
                // extract all image information
                $this->extractInfo($image);


                if(in_array($this->get('ext'), $this->supports)){

                    // create image by mime type
                    $this->createImage();

                    /*
                    -------------------------------        
                     Resize image in various sizes      
                    -------------------------------
                    */

                    // original size
                    $imagname = $this->resize();

                    // resizing from resize entries
                    foreach($this->resizes as $key => $value){
                        $this->resize($value, $imagname . '-'. $key);
                    }

                    // return image name
                    return $imagname . $this->get('ext');
                }
                else
                {
                    return error()->make_error('Only support these formats: '. implode(', ', $this->supports));
                }
                
            }
            else{
                return false;
            }

        }
        
        /**
         * removeImage - Remove image from server
         *
         * @param  string $filename
         * @return null
         */

        public function remove($filename){

            $extracted_filename = explode('.', $filename);
            $onlyName = reset($extracted_filename);
            $extension = '.'. end($extracted_filename);

            // remove original file
            if(file_exists($this->upload_dir . $filename))
            {
                unlink($this->upload_dir . $filename);
            }

            foreach($this->resizes as $key => $value){
                $filepath = $this->upload_dir . $onlyName .'-'. $key . $extension;
                if(file_exists($filepath)){
                    unlink($filepath);
                }
            }

        }

        
        /**
         * Upload file to server
         *
         * @param  resource $image
         * @param  string $name
         * @return null
         */

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

        
        /**
         * resize image
         *
         * @param  int $newWidth
         * @param  string $name
         * @return string image name
         */

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




        
        /**
         * Extract image information and store to $imageInfo property
         *
         * @param  resource $image
         * @return null
         */
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
        
        /**
         * create blank image from input image
         *
         * @return null
         */

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