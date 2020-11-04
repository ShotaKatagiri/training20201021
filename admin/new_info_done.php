<?php
session_start();
if ($_SESSION['user_name'] == false) {
    header('Location: login.php');
    exit;
}

require_once('../const.php');
require_once('Model.php');
if ($_GET['get_page'] == 4) {

    try {
        $model = NEW Model();
        $model->connect();
        if (!empty($_GET['id'])) {
            //新規登録
            $stmt = $model->dbh->prepare('INSERT INTO new_info (content, release_date, created_at) VALUES(?, DATE(NOW()), NOW())')->execute([$_POST['content'],]);
        } else {
            //更新登録
            $stmt = $model->dbh->prepare('UPDATE new_info SET content = ?, release_date = ?, updated_at = NOW() WHERE id = ?')->execute([$_POST['content'], $_POST['release_date'], $_GET['id']]);
        }
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e -> getMessage());
    }
}
?>
<?php require_once('header.php');?>
<h2 class="hero-h2"><?=get_page[$_GET['get_page']]?></h2>
<h3>新規登録完了しました。</h3>
<?php require_once('footer.php');?>