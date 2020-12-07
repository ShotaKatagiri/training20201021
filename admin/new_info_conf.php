<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

require_once('functions.php');

?>
<?php require_once('header.php');?>
<table class="edit-table" border="1" rules="all">
    <tr>
        <th>公開年月日</th>
        <td class="conf-table-releasedate"><?=h($_POST['release_date'])?></td>
    </tr>
    <tr>
        <th>記事内容</th>
        <td class="conf-table-content"><?=h($_POST['content'])?></td>
    </tr>
</table>
<form action="new_info_done.php?<?=!empty($_GET['id']) ? 'id=' . $_GET['id'] . '&' : ''?>crud=<?=$_GET['crud']?>" method="post">
    <input type="hidden" name="release_date" value="<?=h($_POST['release_date'])?>">
    <input type="hidden" name="content" value="<?=h($_POST['content'])?>">
    <div class="conf-buttons">
        <p><input class="conf-fix-button" type="submit" value="修正" formaction="new_info_edit.php?<?=!empty($_GET['id']) ? 'id=' . h($_GET['id']) : ''?>&crud=<?=$_GET['crud']?>"></p>
        <p><input class="conf-signup-button" type="submit" name="done" value="<?=GET_CRUD[$_GET['crud']]?>完了"></p>
    </div>
</form>
<?php require_once('footer.php');?>