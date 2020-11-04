<?php
session_start();
if ($_SESSION['auth'] != 1) {
    header('Location: login.php');
    exit;
}
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>
<?php require_once('header.php');?>
<h2 class="top-h2">アラートはありません。</h2>
<?php require_once('footer.php');?>