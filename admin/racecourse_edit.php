<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

require_once('Model.php');
require_once('functions.php');

$racecourse = [];

if ($_GET['crud'] == 'update') {
    try {
        $model = new Model();
        $model->connect();

        $stmt = $model->dbh->prepare('SELECT * FROM racecourse WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $racecourse = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        $error = 'システム上の問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
    }
}

$racecourse = $_POST + $racecourse;

?>
<?php require_once('header.php');?>
<?php if(!empty($error)) :?>
    <p><?=$error?></p>
<?php endif;?>
<form action="racecourse_conf.php?<?=!empty($_GET['id']) ? 'id=' . h($_GET['id']) . '&' : ''?>crud=<?=$_GET['crud'] == 'update' ? 'update' : 'create'?>" method="post">
    <table class="edit-table">
        <tr>
            <th>アンカー用ID<span class="edit-table-span"> (必須)</span></th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="anchor_id" value="<?=!empty($racecourse['anchor_id']) ? h($racecourse['anchor_id']) : ''?>"></td>
        </tr>
        <tr>
            <th>競馬場名</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="name" value="<?=!empty($racecourse['name']) ? h($racecourse['name']) : ''?>"></td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="title" value="<?=!empty($racecourse['title']) ? h($racecourse['title']) : ''?>"></td>
        </tr>
        <tr>
            <th>説明文</th>
            <td class="edit-table-content"><textarea name="description" cols="30" rows="10"><?=!empty($racecourse['description']) ? h($racecourse['description']) : ''?></textarea></td>
        </tr>
        <tr>
            <th>所在地</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="address" value="<?=!empty($racecourse['address']) ? h($racecourse['address']) : ''?>"></td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="tel" value="<?=!empty($racecourse['tel']) ? h($racecourse['tel']) : ''?>"></td>
        </tr>
        <tr>
            <th>営業時間</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="business_hours" value="<?=!empty($racecourse['business_hours']) ? h($racecourse['business_hours']) : ''?>"></td>
        </tr>
        <tr>
            <th>GoogleMapURL</th>
            <td class="edit-table-map"><textarea name="map_url" cols="30" rows="10"><?=!empty($racecourse['map_url']) ? h($racecourse['map_url']) : ''?></textarea></td>
        </tr>
        <tr>
            <th>ユーザーぺージの表示順</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="turn" value="<?=!empty($racecourse['turn']) ? h($racecourse['turn']) : ''?>"></td>
        </tr>
    </table>
    <p><input class="edit-conf-button" type="submit" value="確認画面へ"></p>
</form>
<?php require_once('footer.php');?>