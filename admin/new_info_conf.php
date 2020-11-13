<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}
?>
<?php require_once('header.php');?>
<h2 class="hero-h2"><?=get_page()?></h2>
<table class="edit-table" border="1" rules="all">
    <tr>
        <th>公開年月日</th>
        <td><?=$_POST['release_date']?></td>
    </tr>
    <tr>
        <th>記事内容</th>
        <td><?=$_POST['content']?></td>
    </tr>
</table>
<form action="new_info_done.php?pages=done&id=<?=$_GET['id']?>" method="post">
    <input type="hidden" name="release_date" value="<?=$_POST['release_date']?>">
    <input type="hidden" name="content" value="<?=$_POST['content']?>">
    <p>
        <input type="submit" value="修正" formaction="new_info_edit.php?pages=edit&id=<?=!empty($_GET['id']) ? $_GET['id'] : ''?>">
        <input type="submit" value="送信" >
    </p>
</form>
<?php require_once('footer.php');?>