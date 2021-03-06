<?php
require_once('./functions.php');
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/admin.css">
        <title>KEIBA navi 管理画面</title>
    </head>
    <body class="top-body">
        <div id="top-wrapper">
            <main>
                <div id="top-header-inner">
                    <header>
                        <div class="top-header-wrapper">
                            <h1 class="greeting">ログイン名[<?=$_SESSION['user_name']?>]さん、ご機嫌いかがですか？</h1>
                            <p class="header-logout"><a href="logout.php">ログアウトする</a></p>
                        </div>
                        <div class="top-header-title">
                            <h2 class="top-header-h2">KEIBA navi</h2>
                        </div>
                        <nav class="top-navigate">
                            <ul class="top-navi-ul">
                                <li><a href="./top.php">top</a></li>
                                <li><a href="./new_info_list.php">新着情報管理</a></li>
                                <li><a href="./racecourse_list.php">競馬場情報管理</a></li>
                                <li><a href="./top.php">〇〇管理</a></li>
                                <li><a href="./top.php">〇〇管理</a></li>
                                <li><a href="./top.php">〇〇管理</a></li>
                            </ul>
                        </nav>
                    </header>
                </div>
                <div class="main-contents">
                    <p class="main-contents-button"><?php getPage();?></p>
