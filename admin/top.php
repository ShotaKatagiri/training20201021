<?php
session_start();

if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

require_once('functions.php');

?>
<?php require_once('header.php');?>
<?php require_once('footer.php');?>