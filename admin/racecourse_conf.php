<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}
echo '<pre>';
var_dump($_POST);
echo '</pre>';
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
                <?=!empty($_GET['id']) ? $_GET['id'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                アンカー用ID
            </th>
            <td>
                <?=!empty($_POST['r_anchor_id']) ? $_POST['r_anchor_id'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                競馬場名
            </th>
            <td>
                <?=!empty($_POST['r_name']) ? $_POST['r_name'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                タイトル
            </th>
            <td>
                <?=!empty($_POST['r_title']) ? $_POST['r_title'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                説明文
            </th>
            <td>
                <?=!empty($_POST['r_description']) ? $_POST['r_description'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                所在地
            </th>
            <td>
                <?=!empty($_POST['r_address']) ? $_POST['r_address'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                電話番号
            </th>
            <td>
                <?=!empty($_POST['r_tel']) ? $_POST['r_tel'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                営業時間
            </th>
            <td>
                <?=!empty($_POST['r_business_hours']) ? $_POST['r_business_hours'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                GoogleMapURL
            </th>
            <td>
                <?=!empty($_POST['r_map_url']) ? $_POST['r_map_url'] : ''?>
            </td>
        </tr>
        <tr>
            <th>
                ユーザページの表示順
            </th>
            <td>
                <?=!empty($_POST['r_turn']) ? $_POST['r_turn'] : ''?>
            </td>
        </tr>
    </thead>
</table>
<h3>重賞レース</h3>
<?php for ($i = 0 ; $i < count($_POST['graded']) ; $i++) :?>
    <table>
            <tr>
                <th>
                    説明文（重賞レース）
                </th>
                <td colspan="2" class="edit-table-date">
                    <?=$_POST['graded'][$i]['rg_description']?>
                </td>
            </tr>
            <tr>
                <th>
                    ユーザーページの表示順（重賞レース）
                </th>
                <td>
                    <?=$_POST['graded'][$i]['rg_turn']?>
                </td>
            </tr>
                <th>
                    レース名選択
                </th>
                <td>
                <?=$_POST['graded'][$i]['mg_name']?>
                </td>
            </tr>
    </table>
<?php endfor;?>
<form action="racecourse_done.php?<?=!empty($_GET['id']) ? 'id=' . $_GET['id'] . '&' : ''?>crud=<?=$_GET['crud']?>" method="post">
    <input type="hidden" name="r_anchor_id" value="<?=h($_POST['r_anchor_id'])?>">
    <input type="hidden" name="r_name" value="<?=h($_POST['r_name'])?>">
    <input type="hidden" name="r_title" value="<?=h($_POST['r_title'])?>">
    <input type="hidden" name="r_description" value="<?=h($_POST['r_description'])?>">
    <input type="hidden" name="r_address" value="<?=h($_POST['r_address'])?>">
    <input type="hidden" name="r_tel" value="<?=h($_POST['r_tel'])?>">
    <input type="hidden" name="r_business_hours" value="<?=h($_POST['r_business_hours'])?>">
    <input type="hidden" name="r_map_url" value="<?=h($_POST['r_map_url'])?>">
    <input type="hidden" name="r_turn" value="<?=h($_POST['r_turn'])?>">
    <?php for ($i = 0 ; $i < count($_POST['graded']) ; $i++) :?>
    <?=!empty($_POST['graded'][$i]['rg_id']) ? '<input type="hidden" name="graded[' . $i . '][rg_id]" value="' . $_POST['graded'][$i]['rg_id'] . '">' : ''?>
    <?=!empty($_POST['graded'][$i]['rg_description']) ? '<input type="hidden" name="graded[' . $i . '][rg_description]" value="' . $_POST['graded'][$i]['rg_description'] . '">' : ''?>
    <?=!empty($_POST['graded'][$i]['rg_turn']) ? '<input type="hidden" name="graded[' . $i . '][rg_turn]" value="' . $_POST['graded'][$i]['rg_turn'] . '">' : ''?>
    <?=!empty($_POST['graded'][$i]['mg_name']) ? '<input type="hidden" name="graded[' . $i . '][mg_name]" value="' . $_POST['graded'][$i]['mg_name'] . '">' : ''?>

    <?php endfor;?>
    <div class="conf-buttons">
        <p><input class="conf-fix-button" type="submit" value="修正" formaction="racecourse_edit.php?<?=!empty($_GET['id']) ? 'id=' . h($_GET['id']) : ''?>&crud=<?=$_GET['crud']?>"></p>
        <p class="conf-signup-p"><input class="conf-signup-button" type="submit" name="done" value="<?=GET_CRUD[$_GET['crud']]?>完了"></p>
    </div>
</form>
<?php require_once('footer.php');?>