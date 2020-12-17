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
    <thead>
        <tr>
            <th>
                ID
            </th>
            <td>
                <?=!empty($_POST['id']) ? $_POST['id'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                アンカー用ID
            </th>
            <td>
                <?=!empty($_POST['anchor_id']) ? $_POST['anchor_id'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                競馬場名
            </th>
            <td>
                <?=!empty($_POST['name']) ? $_POST['name'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                タイトル
            </th>
            <td>
                <?=!empty($_POST['title']) ? $_POST['title'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                説明文
            </th>
            <td>
                <?=!empty($_POST['description']) ? $_POST['description'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                所在地
            </th>
            <td>
                <?=!empty($_POST['address']) ? $_POST['address'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                電話番号
            </th>
            <td>
                <?=!empty($_POST['tel']) ? $_POST['tel'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                営業時間
            </th>
            <td>
                <?=!empty($_POST['business_hours']) ? $_POST['business_hours'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                GoogleMapURL
            </th>
            <td>
                <?=!empty($_POST['map_url']) ? $_POST['map_url'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                ユーザページの表示順
            </th>
            <td>
                <?=!empty($_POST['turn']) ? $_POST['turn'] : ''?>
            </td>
        </tr>
    </thead>
</table>
<h3>重賞レース</h3>
<table>
<tr>
            <th>
                説明文（重賞レース）
            </th>
            <td colspan="2" class="edit-table-date">
                <input class="racecourse-edit-input" type="text" name="turn" value="<?=!empty($racecourse['turn']) ? h($racecourse['turn']) : ''?>">
            </td>
        </tr>
        <tr>
            <th>
                ユーザーページの表示順（重賞レース）
            </th>
            <th>
                レース名選択
            </th>
            <td>
                <select name="" id="">
                    <option value="">選択なし</option>
                    <option value="G1">G1レース</option>
                    <option value="G2">G2レース</option>
                    <option value="G3">G3レース</option>
                </select>
            </td>
        </tr>
-</table>
<form action="racecourse_done.php?<?=!empty($_GET['id']) ? 'id=' . $_GET['id'] . '&' : ''?>crud=<?=$_GET['crud']?>" method="post">
    <input type="hidden" name="anchor_id" value="<?=h($_POST['anchor_id'])?>">
    <input type="hidden" name="title" value="<?=h($_POST['title'])?>">
    <input type="hidden" name="description" value="<?=h($_POST['description'])?>">
    <input type="hidden" name="address" value="<?=h($_POST['address'])?>">
    <input type="hidden" name="tel" value="<?=h($_POST['tel'])?>">
    <input type="hidden" name="business_hours" value="<?=h($_POST['business_hours'])?>">
    <input type="hidden" name="map_url" value="<?=h($_POST['map_url'])?>">
    <input type="hidden" name="turn" value="<?=h($_POST['turn'])?>">
    <div class="conf-buttons">
        <p><input class="conf-fix-button" type="submit" value="修正" formaction="racecourse_edit.php?<?=!empty($_GET['id']) ? 'id=' . h($_GET['id']) : ''?>&crud=<?=$_GET['crud']?>"></p>
        <p class="conf-signup-p"><input class="conf-signup-button" type="submit" name="done" value="<?=GET_CRUD[$_GET['crud']]?>完了"></p>
    </div>
</form>
<?php require_once('footer.php');?>