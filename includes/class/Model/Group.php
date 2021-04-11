<?php

    namespace App\Model;


    class Group extends Model{

        public function insertGroup($data){
            $validated = $this->validation->validate($data, array(
                'name' => 'required|min:2|nsc|unique:group'
            ));


            if(error()->is_error($validated)){
                return $validated;
            }
            else{
                $data["user_id"] = auth()->user()->id;

                return $this->_create($data);
            }
        }



    }