<?php
session_start();

if (empty($_SESSION)) {
    header('Location: login.php');
    exit;
}
require_once '../util.inc.php';
?>
    <!--header-->
    <?php require_once('header.php') ?>
    <h1>管理者編集画面</h1>
            <p>ログイン名[<?=$_SESSION['user_name']?>]さん、ご機嫌いかがですか？</p>
        <h2><a href="logout.php">ログアウトする</a></h2>
    <!--footer-->
    <?php require_once('footer.php') ?>
