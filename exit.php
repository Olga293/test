<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
unset($_SESSION['user']);
header('Location: index.php');
?>