<?php
session_start();
require_once('../util.inc.php');
require_once('Model.php');
if (!empty($_SERVER['REQUEST_METHOD'] == 'POST')){
    try {
        $model = new Model();
        $model->connect();
        $stmt = $model->dbh->prepare('INSERT INTO new_info (content, release_date, created_at, updated_at, delete_flg) VALUES(?, DATE(NOW()), NOW(), NOW(), false)')->execute([$_POST['content'],]);
        if (!empty($_POST['content'])) {
            header('Location: top.php');
            exit;
        }
    } catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e -> getMessage());
    }
}
?>
<?php require_once('header.php');?>
<h2 class="edit-h2">記事新規登録</h2>
<form action="" method="post">
    <table class="edit-table">
        <!-- <tr>
            <th>作成年月日</th>
            <td><input type="text" name="release_date" value=""></td>
        </tr> -->
        <tr>
            <th>記事内容</th>
            <td><textarea name="content" id="" cols="30" rows="10"></textarea></td>
        </tr>

    </table>
<p><input type="submit" value="送信"></p>
</form>
<?php require_once('footer.php');?>