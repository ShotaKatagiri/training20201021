<?php
session_start();
//sessionを消す。
unset($_SESSION['user_name']);
header('Location: login.php');
exit;
?>