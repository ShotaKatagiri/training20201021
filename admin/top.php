<?php
session_start();
require_once '../util.inc.php';


if ($_SESSION == true) {


} else {
    //不正なリクエストです
    header('Location: login.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>管理者編集画面</title>
</head>

<body>
    <!--header-->
    <?php require_once("../header.php") ?>

    <h1>管理者編集画面</h1>
<p>ログイン名[<?=$_SESSION['user_name']?>]さん、ご機嫌いかがですか？</p>
<h2><a href="logout.php">ログアウトする</a></h2>

    <!--footer-->
    <?php require_once("../footer.php") ?>

</body>

</html>