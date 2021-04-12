<?php

    namespace App\Model;

    class Contact extends Model{

        public function insert($data){
            
            $validated = $this->validation->validate($data, array(
                'name' => 'required|nsc',
                'email' => 'email',
                'mobile' => 'required',
                'group_id' => 'required',
                'blood_group' => 'allow:a+,b+,ab+,o+,a-,b-,ab-,o-,NULL',
                'image' => 'max_size:2|allow_ext:jpg,png,jpeg'
            ));

            if(error()->is_error($validated)){
                return $validated;
            }

            if(isset($validated['image'])){
                $uploaded_img = $this->imageH->process($validated['image']);
                if($uploaded_img != false){
                    $validated['image'] = $uploaded_img;
                }else{
                    $validated['image'] = NULL;
                }
            }

            $validated['user_id'] = auth()->user()->id;


            return $this->_create($validated);

            

            




        }
    }