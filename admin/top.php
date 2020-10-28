<?php
session_start();

if (empty($_SESSION)) {
    header('Location: login.php');
    exit;
}
require_once '../util.inc.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>管理者ログイン</title>
</head>

<body>
    <div id="top-wrapper">
      <main>
        <div id="top-header-inner">
            <header class="cf">
                <div class="top-header-wrapper">
                    <h1 class="greeting">ログイン名[<?=$_SESSION['user_name']?>]さん、ご機嫌いかがですか？</h1>
                        <p class="header-logout"><a href="logout.php">ログアウトする</a></p>
                </div>
                <nav class="top-navigate">
                    <ul class="top-navi-ul">
                        <li class="top-navi-li"><a class="top-navi-a" href="./top.php">TOP</a></li>
                        <li class="top-navi-li"><a class="top-navi-a" href="./top.php">研修生管理</a></li>
                        <li class="top-navi-li"><a class="top-navi-a" href="./top.php">研修生課題管理</a></li>
                        <li class="top-navi-li"><a class="top-navi-a" href="./top.php">スキル管理</a></li>
                        <li class="top-navi-li"><a class="top-navi-a" href="./top.php">コミュニケーション管理</a></li>
                        <li class="top-navi-li"><a class="top-navi-a" href="./top.php">管理者管理</a></li>
                    </ul>
                </nav>
            </header>
        </div>
        <h2 class="top-h2">アラートはありません。</h2>


    <!--footer-->
    <?php require_once('footer.php') ?>
