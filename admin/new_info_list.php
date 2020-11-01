<?php
session_start();
require_once ('Model.php');
require_once ('../util.inc.php');

try {
    $model = new Model();
    $model->connect();
    $stmt = $model->dbh->prepare('SELECT * FROM admin_user WHERE login_id = ?');
    //postされてきたidを元に検索させる
    $stmt->execute([$_POST['id']]);
    $result = $stmt->fetch();
    if (!empty($_POST['delete'])) {
        // $'DELETE FROM new_info WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_GET['id']]);
        header('Location: news_delete_done.php');
        exit;
    }



} catch(PDOException $e){
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>

</html>