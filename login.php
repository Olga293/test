<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();

if(getallheaders()["X-Requested-With"] == "XMLHttpRequest"){

    $login = $_POST["login"];
    $password = $_POST["password"];

    include "classes/login_controller_class.php";

    $new_record = new LoginController($login, $password);

    $errors = $new_record -> checkErrors();

    if(empty($errors)){
        $name = $new_record -> getName();
        $_SESSION['user'] = [
            "login" => $login,
            "name" => $name,
        ];
        
    }

    $result = json_encode($errors, JSON_UNESCAPED_UNICODE);
    echo $result;


}
?>