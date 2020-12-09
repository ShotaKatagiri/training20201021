<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

require_once('Model.php');
require_once('functions.php');

try {
    $model = new Model();
    $model->connect();

    if ($_GET['crud'] == 'details') {
        try {
            $model = new Model();
            $model->connect();
            $sql =
                'SELECT '
                    . ' r.id, '
                    . ' r.anchor_id, '
                    . ' r.name, '
                    . ' r.title, '
                    . ' r.description, '
                    . ' r.address, '
                    . ' r.tel, '
                    . ' r.business_hours, '
                    . ' r.map_url, '
                    . ' r.turn, '
                    . ' r.created_at, '
                    . ' r.updated_at, '
                    . ' rg.description rg_desc, '
                    . ' rg.turn rg_turn'
                . ' FROM '
                    . ' racecourse r '
                .' JOIN '
                    . ' racecourse_graded_race rg '
                . ' ON '
                    . ' r.id = rg.racecourse_id '
                . ' WHERE '
                    . ' delete_flg = 0 AND id = ?'
            ;

            $stmt = $model->dbh->prepare($sql);
            $stmt->execute([$_GET['id']]);
            $racecourse = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $error = 'システム上の問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
        }
    }

} catch (PDOException $e) {
    $error = 'システム上の問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
}

?>
<?php require_once('./header.php');?>
<?php if (!empty($error)) :?>
    <p><?=$error?></p>
<?php else :?>
    <table class="list-table" border="1">
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <td>
                    <?=$racecourse['id']?>
                </td>
            </tr>
            <tr>
                <th>
                    アンカー用ID
                </th>
                <td>
                    <?=$racecourse['anchor_id']?>
                </td>
            </tr>
            <tr>
                <th>
                    競馬場名
                </th>
                <td>
                    <?=$racecourse['name']?>
                </td>
            </tr>
            <tr>
                <th>
                    タイトル
                </th>
                <td>
                    <?=$racecourse['title']?>
                </td>
            </tr>
            <tr>
                <th>
                    説明文
                </th>
                <td>
                    <?=$racecourse['description']?>
                </td>
            </tr>
            <tr>
                <th>
                    所在地
                </th>
                <td>
                    <?=$racecourse['address']?>
                </td>
            </tr>
            <tr>
                <th>
                    電話番号
                </th>
                <td>
                    <?=$racecourse['tel']?>
                </td>
            </tr>
            <tr>
                <th>
                    営業時間
                </th>
                <td>
                    <?=$racecourse['business_hours']?>
                </td>
            </tr>
            <tr>
                <th>
                    GoogleMapURL
                </th>
                <td>
                    <?=$racecourse['map_url']?>
                </td>
            </tr>
            <tr>
                <th>
                    ユーザページの表示順
                </th>
                <td>
                    <?=$racecourse['turn']?>
                </td>
            </tr>
            <tr>
                <th>
                    作成日時
                </th>
                <td>
                    <?=h(date('Y-m-d H:i:s', strtotime($racecourse['created_at'])))?>
                </td>
            </tr>
            <tr>
                <th>
                    更新日時
                </th>
                <td>
                    <?=!empty($racecourse['updated_at']) ? h(date('Y-m-d H:i:s', strtotime($racecourse['updated_at']))) : ''?>
                </td>
            </tr>
        </thead>
        <tbody class="list-table-body">
            <form action="" method="post">
                <tr>
                    <th class="list-register">
                        競馬場情報
                        <!-- <form class="list-sort-form" action="racecourse_edit.php?crud=create" method="post">
                        </form> -->
                    </th>
                    <td>
                        <input class="list-register-a" type="submit" value="新規登録" formaction="racecourse_edit.php?crud=create">
                        <input class="list-edit-link" type="submit" value="編集" formaction="racecourse_edit.php?id=<?=$_GET['id']?>&crud=update">
                        <input class="list-delete-link event-btn" name="delete" type="submit" value="削除" onclick="return confirm('本当に削除しますか？')">
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
    <h3 class="racecourse-details-h3">重賞レース・詳細</h3>
    <table class="list-table" border="1">
        <thead>
            <tr>
                <th>
                    説明文
                </th>
                <td>
                    <?=$racecourse['rg_desc']?>
                </td>
            </tr>
            <tr>
                <th>
                    ユーザーページの表示順
                </th>
                <td>
                    <?=$racecourse['rg_turn']?>
                </td>
            </tr>
        </thead>
    </table>
<?php endif;?>
<?php require_once('footer.php');?>
