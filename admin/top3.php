<?php
session_start();
require_once('../util.inc.php');
require_once('Model.php');
if ($_SESSION['user_name'] == false) {
    header('Location: login.php');
    exit;
}
try {
    $model = new Model();
    $model->connect();
    $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) ORDER BY release_date DESC LIMIT 10');
    $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // var_dump($new_info);
    // echo '</pre>';
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e -> getMessage());
}
?>
<?php require_once('header.php');?>
    <h2 class="top-h2">アラートはありません。</h2>
    <table class="top-table">
        <tr>新着情報</tr>
        <?php foreach($new_info as $key => $val):?>
        <tr>
            <td><?=$val['release_date']?></td><td><?=$val['content']?></td>
        </tr>
        <?php endforeach;?>
    </table>
<?php require_once('footer.php');?>