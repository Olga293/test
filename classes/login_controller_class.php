<?php

require_once("db_crud_class.php");

class LoginController extends DbCRUD{

    public $login;
    public $password;
    private $salt="salt";

    public function __construct($login, $password)
    {
        $this -> login = $login;
        $this -> password = $password;
    }

    public function checkErrors(){
        $errors = array();

        if($this -> emptyLogin()){
            $errors["e_login"] = "* обязательное поле";
        }
        elseif(!$this -> userExist()){
            $errors["e_login"] = "* пользователя с таким логином не существует";
        }

        if($this -> emptyPassword()){
            $errors["e_password"] = "* обязательное поле";
        }
        elseif(!$this -> correctPassword()){
            $errors["e_password"] = "* неверный логин или пароль";
        }
        
        return $errors;
    }

    public function getName(){
        $all_data = $this -> read();
        $name = "";

        foreach ($all_data as $value) {
            if($value["login"] === $this->login){
                $name = $value["name"];
            }
        }
        return $name;
    }

    private function emptyLogin(){
        $result = true;
        if(empty($this->login)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function emptyPassword(){
        $result = true;
        if(empty($this->password)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function userExist(){
        $all_data = $this -> read();
        $result = false;

        foreach ($all_data as $value) {
            if($value["login"] === $this->login){
                $result = true;
            }
        }
        return $result;
    }

    private function correctPassword(){
        $all_data = $this -> read();
        $result = false;
        
        foreach ($all_data as $value) {
            if($value["login"] === $this->login && $value["password"] === md5(md5($this->password.$this->salt))){
                $result = true;
            }
        }
        return $result;
    }
}

?>