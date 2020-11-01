<?php
session_start();
//sessionを消す。
unset($_SESSION);
header('Location: login.php');
exit;
?>