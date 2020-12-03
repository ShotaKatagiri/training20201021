<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

require_once('apply.php');

?>
<?php require_once('header.php');?>
<table class="edit-table" border="1" rules="all">
    <tr>
        <th>公開年月日</th>
        <td><?=h($_POST['release_date'])?></td>
    </tr>
    <tr>
        <th>記事内容</th>
        <td><?=h($_POST['content'])?></td>
    </tr>
</table>
<form action="new_info_done.php?crud=<?=$_GET['crud']?>" method="post">
    <input type="hidden" name="release_date" value="<?=h($_POST['release_date'])?>">
    <input type="hidden" name="content" value="<?=h($_POST['content'])?>">
    <input type="hidden" name="id" value="<?=h($_GET['id'])?>">
    <div class="conf-buttons">
        <p><input class="conf-fix-button" type="submit" value="修正" formaction="new_info_edit.php?id=<?=!empty($_GET['id']) ? h($_GET['id']) : ''?>&crud=<?=$_GET['crud']?>"></p>
        <p><input class="conf-signup-button" type="submit" name="done" value="<?=$_GET['crud'] == 'create' ? '新規登録完了' : '編集完了'?>"></p>
    </div>
</form>
<?php require_once('footer.php');?>