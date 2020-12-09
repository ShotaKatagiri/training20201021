<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['user_name']);
unset($_SESSION['auth']);

require_once('Model.php');
require_once('functions.php');

if (!empty($_POST['authentication'])) {
    if (empty($_POST['id']) || empty($_POST['pass'])) {
        $error = 'idかパスワードが入力されておりません';
    } else {
        try {
            $model = new Model();
            $model->connect();
            $stmt = $model->dbh->prepare('SELECT * FROM admin_user WHERE delete_flg = 0 and login_id = ?');
            //postされてきたidを元に検索させる
            $stmt->execute([$_POST['id']]);
            $result = $stmt->fetch();
            //$resultがあり、$passとpassを元に生成されたハッシュ値が一緒ならば<true></true>
            if ($result && password_verify($_POST['pass'], $result['login_pass'])) {
                //↓logout.phpにログインレコードのユーザーの名前を代入する。
                $_SESSION['id'] = $result['id'];
                $_SESSION['user_name'] = $result['name'];
                $_SESSION['auth'] = 1;
                header('Location: ./top.php');
                exit;
            }
            $error = 'IDかパスワードが間違っている為ログインできませんでした。<br>間違いがないか確認してください。';
        } catch(PDOException $e) {
            $error = 'ログインに関してシステム上に問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
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
        <link rel="stylesheet" href="../css/admin.css">
        <title>KEIBA navi 管理者ログイン画面</title>
    </head>
    <body class="login-body">
        <div id="login-wrapper">
            <main class="login-main">
                <h1 class="login-title">KEIBA navi 管理者ログイン画面</h1>
                <div class="login-input-wrapper">
                    <p class="error">
                        <?= !empty($error) ? $error : ''?>
                    </p>
                    <form action="" method="post">
                        <p>ログインID<input class="login-input" type="text" name="id" value="<?=!empty($_POST['id']) ? h($_POST['id']) : ''?>"></p>
                        <p>パスワード<input class="login-input" type="password" name="pass"></p>
                        <p><input class="login-auth" type="submit" name="authentication" value="認証"></p>
                    </form>
                </div>
            </main>
        </div>
    </body>
</html>