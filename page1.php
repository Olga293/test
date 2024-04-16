<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
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
            <li><a href="page1.php">Страница 1</a></li>
            <li><a href="page2.php">Страница 2</a></li>
            <li><a href="page3.php">Страница 3</a></li>
            <?php
                if(isset($_SESSION["user"])){
                    echo '<li class="authentication"><a href="exit.php">Выйти ('.$_SESSION["user"]["login"].')</a></li>';
                }
                else{
                    echo '<li class="authentication"><a href="index.php">Войти</a></li>';
                }
            ?>
        </ul>
    </nav>

    <main>
        <h1>Page 1</h1>
        <h2>
        <?php
            if(isset($_SESSION["user"])){
                $say_hi = "Hello ".$_SESSION["user"]["name"]."!";
                echo $say_hi;
            }
            else{
                echo "Вход не выполнен";
            }
        ?>
        </h2>
        

    </main>
    
</body>
</html>