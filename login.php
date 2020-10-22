<?php
session_start();
require_once 'db.inc.php';



$id = $_POST['id'];
$pass = $_POST['pass'];

try{
    $pdo = db_init();

    $sql = 'SELECT * FROM addmin WHERE login_id = ? AND login_pass = ?';
    $stmt = $pdo->prepare($sql);
    //postされてきたidとpassを検索
    $stmt->execute([$id, $pass]);
    $result = $stmt->fetch-all();

    //password_hash($pass, PASSWORD_DEFAULT)<-ハッシュ生成関数
    //$resultがあり、postされたidとDBのIDが同じで、$passとpassを元に生成されたハッシュ値が一緒ならばtrue
    if($result &&
    $id === $result['login_id'] &&
    password_verify($pass, $result['login_pass'])){


    }
//現在使っているセッションを終了させることなくセッションIDだけを新しい値に置き換えてくれます。
    session_regenerate_id(true);


}catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
?>