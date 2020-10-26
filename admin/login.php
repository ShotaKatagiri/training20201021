<?php
session_start();
require_once 'Model.php';
require_once '../util.inc.php';
$isValidated = true;


$id = '';
$pass = '';


if (!empty($_POST)) {
    $id = $_POST['id'];
    $pass = $_POST['pass'];
    if ($isValidated === true) {
        try {
            $model = new Model();
            $model->connect();
            // $stmt = $model->dbh->prepare('SELECT * FROM admin_user WHERE login_id = ? AND login_pass = ?');
            $stmt = $model->dbh->prepare('SELECT * FROM admin_user WHERE login_id = ?');
            //postされてきたidを元に検索させる
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            //$resultがあり、postされたidとDBのIDが同じで、$passとpassを元に生成されたハッシュ値が一緒ならばtrue
            if (
                $result &&
                $id === $result['login_id'] &&
                password_verify($pass, $result['login_pass'])
            ) {
                //↓logout.phpにログインレコードのユーザーの名前を代入する。
                $_SESSION['user_name'] = $result['name'];
                header('Location: top.php');
                exit;
            } else {
                $isValidated = false;
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
    <!--header-->
    <?php require_once("../header.php") ?>


    <h1 class="title">管理者ログイン</h1>
    <?php if ($id === ''|| mb_ereg_match('/^[\s| ]+$/', $id) OR $pass === '' || mb_ereg_match('/^[\s| ]+$/', $id)) : ?>
        <p>IDかパスワードが入力されていません。</p>
    <?php endif; ?>
    <?php if ($isValidated === false) : ?>
        <p>IDかパスワードが間違っています。</p>
    <?php endif; ?>
    <form action="" method="post">
        <!-- ↓session変数の中のランダムなトークンを送信 -->
        <p>ログインID<input type="text" name="id" value="<?= h($id) ?>" autofocus></p>

        <p>パスワード<input type="text" name="pass" value="<?= h($pass) ?>"></p>

        <p><input type="submit" value="認証" ></p>
    </form>


    <!--footer-->
    <?php require_once("../footer.php") ?>

</body>

</html>