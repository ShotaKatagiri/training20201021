<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}
require_once('Model.php');

if ($_GET['pages'] == 'edit') {
    try {
        $model = new Model();
        $model->connect();
        $stmt = $model->dbh->prepare('SELECT * FROM new_info WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        header("Content-type: text/html; charset=utf-8");
        $error = 'ログインに関してシステム上に問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
    }
}

?>
<?php require_once('header.php');?>
<h2 class="hero-h2"><?=get_page()?></h2>
<form action="new_info_conf.php?pages=conf&id=<?=!empty($_GET['id']) ? $_GET['id'] : ''?>" method="post">
    <table class="edit-table"  border="1" rules="all">
        <tr>
            <th>公開年月日</th>
            <td class="edit-table-date">
                <input type="text" name="release_date" value="<?=empty($_POST['release_date']) ? (!empty($article['release_date']) ? $article['release_date'] : '') : $_POST['release_date']?>">
            </td>
        </tr>
        <tr>
            <th>記事内容</th>
            <td class="edit-table-content">
                <textarea name="content" cols="30" rows="10"><?=empty($_POST['content']) ? (!empty($article['content']) ? $article['content'] : '') : $_POST['content']?></textarea>
            </td>
        </tr>
    </table>
    <p><input type="submit" name="conf" value="確認画面へ"></p>
</form>
<?php require_once('footer.php');?>