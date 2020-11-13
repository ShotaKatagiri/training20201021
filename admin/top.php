<?php
session_start();

if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

?>
<?php require_once('header.php');?>
<h2 class="top-h2">アラートはありません。</h2>
<?php require_once('footer.php');?>