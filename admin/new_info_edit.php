<?php
session_start();
if ($_SESSION['user_name'] == false) {
    header('Location: login.php');
    exit;
}

require_once('../util.inc.php');
require_once('../const.php');
?>
<?php require_once('header.php');?>
<h2 class="hero-h2"><?=get_page[$_GET['get_page']]?></h2>
<form action="new_info_conf.php?get_page=3&id=<?=!empty($_GET['id']) ? $_GET['id'] : ''?>" method="post">
    <table class="edit-table">
        <tr>
            <th>公開年月日</th>
            <td><input type="text" name="release_date" value="<?=!empty($_POST['release_date']) ? $_POST['release_date'] : ''?>"></td>
        </tr>
        <tr>
            <th>記事内容</th>
            <td><textarea name="content" cols="30" rows="10"><?=!empty($_POST['content']) ? $_POST['release_date'] : ''?></textarea></td>
        </tr>
    </table>
    <p><input type="submit" name="conf" value="確認画面へ"></p>
</form>
<?php require_once('footer.php');?>