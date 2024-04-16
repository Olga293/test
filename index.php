<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start(); //открыть сессию
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="">Страница 1</a></li>
            <li><a href="">Страница 2</a></li>
            <li><a href="">Страница 3</a></li>
            <?php
                if(isset($_SESSION["user"])){
                    echo '<li class="authentication"><a href="index.php">Выйти ('.$_SESSION["user"]["login"].')</a></li>';
                }
                else{
                    echo '<li class="authentication"><a href="index.php">Войти</a></li>';
                }
            ?>
        </ul>
    </nav>

    <main>
        <section class="index-login">
            <div class="wrapper">
                <div class="index-login-signup">
                    <h4>Регистрация</h4>
                    <form id="signup_form">
                        <input type="text" name="login" placeholder="Login" value="userr3">
                        <label id="e_login_signup"></label>
                        <input type="password" name="password" placeholder="Password" value="userr3">
                        <label id="e_password_signup"></label>
                        <input type="password" name="confirm_password" placeholder="Confirmpassword" value="userr3">
                        <label id="e_confirm_password_signup"></label>
                        <input type="text" name="email" placeholder="Email" value="userr3@gmail.com">
                        <label id="e_email_signup"></label>
                        <input type="text" name="name" placeholder="Name" value="name">
                        <label id="e_name_signup"></label>
                        <button type="submit" name="submit">Зарегистрироваться</button>
                    </form>
                </div>

                <div class="index-login-login">
                <h4>Авторизация</h4>
                    <form id="login_form">
                        <input type="text" name="login" placeholder="Login">
                        <label id="e_login_login"></label>
                        <input type="password" name="password" placeholder="Password">
                        <label id="e_password_login"></label>
                        <button type="submit" name="submit">Авторизироваться</button>
                    </form>
                </div>
            </div>
        </section>

    </main>


    <!-- <script>
        document.addEventListener("DOMContentLoaded", function(){

            const signup_form = document.getElementById('signup_form');
            const login_form = document.getElementById('login_form');
            
            //обработка отправки формы регистрации
            signup_form.addEventListener('submit', async (event) => {
                event.preventDefault();
                const form_data = new FormData(signup_form);

                let response = await fetch("signup.php", {
                    method: 'POST',
                    body: form_data,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                    }
                });
                let result = await response.json();

                document.getElementById("e_login_signup").innerHTML = " ";
                document.getElementById("e_password_signup").innerHTML = " ";
                document.getElementById("e_confirm_password_signup").innerHTML = " ";
                document.getElementById("e_email_signup").innerHTML = " ";
                document.getElementById("e_name_signup").innerHTML = " ";

                if(result["e_login"] != null){
                    document.getElementById("e_login_signup").innerHTML = result["e_login"];
                }

                if(result["e_password"] != null){
                    document.getElementById("e_password_signup").innerHTML = result["e_password"];
                }

                if(result["e_confirm_password"] != null){
                    document.getElementById("e_confirm_password_signup").innerHTML = result["e_confirm_password"];
                }

                if(result["e_email"] != null){
                    document.getElementById("e_email_signup").innerHTML = result["e_email"];
                }

                if(result["name"] != null){
                    document.getElementById("e_name_signup").innerHTML = result["e_name"];
                }

                if(!Object.entries(result).length){
                    window.location.href = "page1.php";
                }
                
            });


            //обработка отправки формы авторизации
            login_form.addEventListener('submit', async (event) => {
                event.preventDefault();
                const form_data = new FormData(login_form);

                let response = await fetch("login.php", {
                    method: 'POST',
                    body: form_data,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                    }
                });
                let result = await response.json();

                document.getElementById("e_login_login").innerHTML = " ";
                document.getElementById("e_password_login").innerHTML = " ";

                if(result["e_login"] != null){
                    document.getElementById("e_login_login").innerHTML = result["e_login"];
                }

                if(result["e_password"] != null){
                    document.getElementById("e_password_login").innerHTML = result["e_password"];
                }

                if(!Object.entries(result).length){
                    window.location.href = "page1.php";
                }
                
            });
        });
    </script> -->
    <script src="js/script.js"></script>
    
</body>
</html>