<?php
session_start();
$_SESSION = array();
require_once 'Model.php';
require_once '../util.inc.php';

if (!empty($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (empty($_POST['id']) or empty($_POST['pass'])) {
        $error['notValues'] = 'idかパスワードが入力されておりません';
    } else {
        try {
            $model = new Model();
            $model->connect();
            // $stmt = $model->dbh->prepare('SELECT * FROM admin_user WHERE login_id = ? AND login_pass = ?');
            $stmt = $model->dbh->prepare('SELECT * FROM admin_user WHERE login_id = ?');
            //postされてきたidを元に検索させる
            $stmt->execute([$_POST['id']]);
            $result = $stmt->fetch();
            //$resultがあり、postされたidとDBのIDが同じで、$passとpassを元に生成されたハッシュ値が一緒ならばtrue
            if (
                $result &&
                $_POST['id'] === $result['login_id'] &&
                password_verify($_POST['pass'], $result['login_pass'])
            ) {
                //↓logout.phpにログインレコードのユーザーの名前を代入する。
                $_SESSION['user_name'] = $result['name'];
                header('Location: top.php');
                exit;
            } else {
                $error['wrong'] = 'IDかパスワードが間違っています。';
            }
            //現在使っているセッションを終了させることなくセッションIDだけを新しい値に置き換えてくれます。
            // session_regenerate_id(true);
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>管理者ログイン</title>
</head>

<body>
    <div id="wrapper">
        <div id="header-inner">
            <header class="cf">
                <div id="header-tittle" class="cf">
                    <a href="./index.php"><img src="images/logon'tittle.png" alt="House Racing Navigation logo"></a>
                </div>
            </header>
        </div>
        <main class="login-main">
            <h1 class="login-title">新人研修進捗管理システム 管理者画面ログイン</h1>
            <?php if (isset($error['notValues'])) : ?>
                <?= $error['notValues'] ?>
            <?php endif; ?>
            <?php if (isset($error['wrong'])) : ?>
                <?= $error['wrong'] ?>
            <?php endif; ?>
            <form action="" method="post">
                <!-- ↓session変数の中のランダムなトークンを送信 -->
                <p>ログインID<input type="text" name="id" autofocus></p>
                <p>パスワード<input type="password" name="pass"></p>
                <p><input type="submit" value="認証"></p>
            </form>
            <!--footer-->
<?php require_once('footer.php') ?>