<?php
session_start();
if ($_SESSION['user_name'] == false) {
    header('Location: login.php');
    exit;
}

require_once('../const.php');
?>
<?php require_once('header.php');?>
<h2 class="hero-h2"><?=get_page[$_GET['get_page']]?></h2>
<table class="edit-table">
    <tr>
        <th>公開年月日</th>
        <td><?=$_POST['release_date']?></td>
    </tr>
    <tr>
        <th>記事内容</th>
        <td><?=$_POST['content']?></td>
    </tr>
</table>
<form action="new_info_done.php?get_page=4&id=<?=$_GET['id']?>" method="post">
    <input type="hidden" name="release_date" value="<?=$_POST['release_date']?>">
    <input type="hidden" name="content" value="<?=$_POST['content']?>">
    <p>
        <input type="submit" value="修正" formaction="new_info_edit.php">
        <input type="submit" value="送信" >
    </p>
</form>
<?php require_once('footer.php');?>