<?php
session_start();
unset($_SESSION['user_name']);
require_once('Model.php');
require_once('../util.inc.php');
if (!empty($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (empty($_POST['id']) or empty($_POST['pass'])) {
        $error['notValues'] = 'idかパスワードが入力されておりません';
    } else {
        try {
            $model = new Model();
            $model->connect();
            $stmt = $model->dbh->prepare('SELECT * FROM admin_user WHERE login_id = ?');
            //postされてきたidを元に検索させる
            $stmt->execute([$_POST['id']]);
            $result = $stmt->fetch();
            //$resultがあり、postされたidとDBのIDが同じで、$passとpassを元に生成されたハッシュ値が一緒ならばtrue
            if ($result &&$_POST['id'] === $result['login_id'] &&password_verify($_POST['pass'], $result['login_pass'])) {
                //↓logout.phpにログインレコードのユーザーの名前を代入する。
                $_SESSION['user_name'] = $result['name'];
                header('Location: top.php');
                exit;
            } else {
                $error['wrong'] = 'IDかパスワードが間違っています。';
            }
        } catch(PDOException $e) {
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
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/login.css">
        <title>管理者ログイン</title>
    </head>
    <body class="login-body">
        <div id="login-wrapper">
            <main class="login-main">
                <h1 class="login-title">新人研修進捗管理システム 管理者画面ログイン</h1>
                <div class="login-input-wrapper">
                    <?php if (isset($error['notValues'])) :?>
                    <?=$error['notValues']?>
                    <?php endif;?>
                    <?php if (isset($error['wrong'])) :?>
                    <?=$error['wrong']?>
                    <?php endif;?>
                    <form action="" method="post">
                        <p>ログインID<input class="login-input" type="text" name="id" autofocus></p>
                        <p>パスワード<input class="login-input" type="password" name="pass"></p>
                        <p><input type="submit" value="認証"></p>
                    </form>
                </div>
            </main>
        </div>
    </body>
</html>