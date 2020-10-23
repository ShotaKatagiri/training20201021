<?php
session_start();
require_once '../Model.php';
require_once '../util.inc.php';

// $eba = password_hash('a', PASSWORD_DEFAULT);

// echo $eba;



// $id = $_POST['id'];
// $pass = $_POST['pass'];

try {
    $model = new Model();
    $model->connect();



    // $sql = 'SELECT * FROM admin_user WHERE login_id = ? AND login_pass = ?';
    // $stmt = $pdo->prepare($sql);
    // //postされてきたidとpassを検索
    // $stmt->execute([$id, $pass]);
    // $result = $stmt->fetch - all();


    // //password_hash($pass, PASSWORD_DEFAULT)<-ハッシュ生成関数
    // //$resultがあり、postされたidとDBのIDが同じで、$passとpassを元に生成されたハッシュ値が一緒ならばtrue
    // if (
    //     $result &&
    //     $id === $result['login_id'] &&
    //     password_verify($pass, $result['login_pass'])
    // ) {
    // }
    // //現在使っているセッションを終了させることなくセッションIDだけを新しい値に置き換えてくれます。
    // session_regenerate_id(true);
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン</title>
</head>

<body>
<h1>管理者ログイン</h1>

<form action="" method="post">

<input type="text" name="login_id">

<input type="text" name="login_pass">

    <p><input type="submit" value="送信"></p>
</form>

</body>

</html>