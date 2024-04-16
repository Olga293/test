<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию

if(getallheaders()["X-Requested-With"] == "XMLHttpRequest"){

    $login = $_POST["login"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    $name = $_POST["name"];

    include "classes/signup_controller_class.php";

    $new_record = new SignupController($login, $password, $confirm_password, $email, $name);

    $errors = $new_record -> checkErrors();

    if(empty($errors)){
        $salt = "salt";
        $new_record->password = md5(md5($new_record->password.$salt));
        $new_record -> create($new_record->login, $new_record->password, $new_record->email, $new_record->name);
        $_SESSION['user'] = [
            "login" => $login,
            "name" => $name,
        ];
    }

    $result = json_encode($errors, JSON_UNESCAPED_UNICODE);
    echo $result;


}
?>