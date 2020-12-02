<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

require_once('../util.inc.php');

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
<form action="new_info_done.php?id=<?=!empty($_GET['id'])? h($_GET['id']): ''?>&crud=<?=$_GET['crud'] == 'update' ? 'update' : 'create'?>" method="post">
    <input type="hidden" name="release_date" value="<?=h($_POST['release_date'])?>">
    <input type="hidden" name="content" value="<?=h($_POST['content'])?>">
    <input type="hidden" name="id" value="<?=h($_GET['id'])?>">
    <p>
        <input type="submit" value="修正" formaction="new_info_edit.php?id=<?=!empty($_GET['id']) ? h($_GET['id']) : ''?>">
        <input type="submit" name="done" value="送信">
    </p>
</form>
<?php require_once('footer.php');?>