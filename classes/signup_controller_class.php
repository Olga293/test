<?php

require_once("db_crud_class.php");

class SignupController extends DbCRUD{

    public $login;
    public $password;
    public $confirm_password;
    public $email;
    public $name;

    public function __construct($login, $password, $confirm_password, $email, $name)
    {
        $this -> login = $login;
        $this -> password = $password;
        $this -> confirm_password = $confirm_password;
        $this -> email = $email;
        $this -> name = $name;
    }

    public function checkErrors(){
        $errors = array();

        if($this -> emptyLogin()){
            $errors["e_login"] = "* обязательное поле";
        }
        elseif($this -> invalidLogin()){
            $errors["e_login"] = "* должен состоять минимум из 6 символов";
        }
        elseif(!$this -> uniqueUserLogin()){
            $errors["e_login"] = "* пользователь с таким именем уже существует";
        }

        if($this -> emptyPassword()){
            $errors["e_password"] = "* обязательное поле";
        }
        elseif($this -> invalidPassword()){
            $errors["e_password"] = "* должен состоять минимум из 6 символов, включать цифры и буквы";
        }

        if($this -> emptyConfirmPassword()){
            $errors["e_confirm_password"] = "* обязательное поле";
        }
        elseif(!$this -> passwordMatch()){
            $errors["e_confirm_password"] = "* должен совпадать с паролем";
        }

        if($this -> emptyEmail()){
            $errors["e_email"] = "* обязательное поле";
        }
        elseif($this -> invalidEmail()){
            $errors["e_email"] = "* неверный адрес электронной почты";
        }
        elseif(!$this -> uniqueUserEmail()){
            $errors["e_email"] = "* пользователь с таким почтовым адресом уже существует";
        }

        if($this -> emptyName()){
            $errors["e_name"] = "* обязательное поле";
        }
        elseif($this -> invalidName()){
            $errors["e_name"] = "* должно состоять минимум из 2 символов, только буквы";
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

    private function emptyConfirmPassword(){
        $result = true;
        if(empty($this->confirm_password)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function emptyEmail(){
        $result = true;
        if(empty($this->email)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function emptyName(){
        $result = true;
        if(empty($this->name)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function invalidLogin(){
        $result = true;
        if(!preg_match('/^[0-9a-zA-Zа-яА-Я\S]{6,}$/', $this->login)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function invalidPassword(){
        $result = true;
        if(!preg_match('/(?=.*[0-9])(?=.*[a-zA-Zа-яА-Я])(^[0-9a-zA-Zа-яА-Я\S]{6,}$)/', $this->password)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function invalidEmail(){
        $result = true;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function passwordMatch(){
        $result = false;
        if($this->password !== $this->confirm_password){
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidName(){
        $result = true;
        if(!preg_match("/^[a-zA-Zа-яА-Я]{2,}$/", $this->name)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function uniqueUserLogin(){
        $all_data = $this -> read();
        $result = true;

        foreach ($all_data as $value) {
            if($value["login"] === $this->login){
                $result = false;
            }
        }
        return $result;
    }

    private function uniqueUserEmail(){
        $all_data = $this -> read();
        $result = true;

        foreach ($all_data as $value) {
            if($value["email"] === $this->email){
                $result = false;
            }
        }
        return $result;
    }
}

?>