<?php
session_start();
//sessionを消す。
unset($_SESSION['id']);
unset($_SESSION['user_name']);
unset($_SESSION['auth']);
header('Location: login.php');
exit;