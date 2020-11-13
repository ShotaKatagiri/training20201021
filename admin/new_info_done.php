<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}
require_once('Model.php');

if ($_GET['pages'] == 'done') {
    try {
        $model = NEW Model();
        $model->connect();
        if (empty($_GET['id'])) {
            //新規登録
            $stmt = $model->dbh->prepare('INSERT INTO new_info (content, release_date, created_at) VALUES(?, ?, NOW())')->execute([$_POST['content'], $_POST['release_date']]);
        } else {
            //更新登録
            $stmt = $model->dbh->prepare('UPDATE new_info SET content = ?, release_date = ?, updated_at = NOW() WHERE id = ?')->execute([$_POST['content'], $_POST['release_date'], $_GET['id']]);
        }
    } catch (PDOException $e) {
        header("Content-type: text/html; charset=utf-8");
        echo 'サーバーのデータベース接続に失敗いたしました。<br>下記お問い合わせ画面よりご一報ください。<br>'.'<a href='.'../contact.php>'.'お問い合わせ画面に移動します。</a>';
    }
}
?>
<?php require_once('header.php');?>
<h2 class="hero-h2"><?=get_page()?></h2>
<h3>記事登録完了しました。</h3>
<?php require_once('footer.php');?>