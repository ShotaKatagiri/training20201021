<?php
session_start();
//sessionに空の配列を挿入
$_SESSION = array();
header('Location: login.php');
exit;
?>