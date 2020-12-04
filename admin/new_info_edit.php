<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

require_once('Model.php');
require_once('functions.php');

$new_info = [];

if ($_GET['crud'] == 'update') {
    try {
        $model = new Model();
        $model->connect();

        $stmt = $model->dbh->prepare('SELECT * FROM new_info WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $new_info = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        $error = 'システム上の問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
    }
}

$new_info = $_POST + $new_info;

?>
<?php require_once('header.php');?>
<?php if(!empty($error)) :?>
    <p><?=$error?></p>
<?php endif;?>
<form action="new_info_conf.php?<?=!empty($_GET['id']) ? 'id=' . h($_GET['id']) . '&' : ''?>crud=<?=$_GET['crud'] == 'update' ? 'update' : 'create'?>" method="post">
    <table class="edit-table">
        <tr>
            <th>公開年月日</th>
            <td class="edit-table-date"><input type="text" name="release_date" value="<?=!empty($new_info['release_date']) ? h($new_info['release_date']) : ''?>"></td>
        </tr>
        <tr>
            <th>記事内容</th>
            <td class="edit-table-content"><textarea name="content" cols="30" rows="10"><?=!empty($new_info['content']) ? h($new_info['content']) : ''?></textarea></td>
        </tr>
    </table>
    <p><input class="edit-conf-button" type="submit" value="確認画面へ"></p>
</form>
<?php require_once('footer.php');?>