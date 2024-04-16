<?php

class DbCRUD{

    public function create($login, $password, $email, $name){
        $storage = "./db.json";
        $stored_data = json_decode(file_get_contents($storage), true); 
        $new_record = array("login" => $login, "password" => $password, "email" => $email, "name" => $name); 
        $stored_data[] = $new_record;
        file_put_contents($storage, json_encode($stored_data));
    }

    public function read(){
        $storage = "./db.json";
        $stored_data = json_decode(file_get_contents($storage), true);
        return $stored_data;
    }

    public function update($old_record, $new_record){
        $storage = "./db.json";
        $stored_data = json_decode(file_get_contents($storage), true);
        foreach ($stored_data as $value) {
            if($value === $old_record){
                $value = $new_record;
            }
        }
        file_put_contents($storage, json_encode($stored_data));
    }

    public function delete($delete_record){
        $storage = "./db.json";
        $stored_data = json_decode(file_get_contents($storage), true);
        foreach ($stored_data as $key=>$value) {
            if($value === $delete_record){
                unset($stored_data[$key]);
            }
        }
        file_put_contents($storage, json_encode($stored_data));
    }
}

?>