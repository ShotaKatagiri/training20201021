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

    //削除処理
    if (!empty($_POST['delete'])) {
        $stmt = $model->dbh->prepare('UPDATE new_info SET delete_flg = 1 WHERE id = ?');
        $stmt->execute([h($_POST['id'])]);
        header('Location: new_info_list.php');
        exit;
    }
    $sql =
        'SELECT * FROM '
            . ' new_info '
        . ' WHERE '
            .' delete_flg = 0 '
        . ' ORDER BY '
            . (!empty($_GET['name']) ? h($_GET['name']) : 'id')
            . ' '
            . (!empty($_GET['sort']) ? h($_GET['sort']) : 'DESC')
    ;
    $stmt = $model->dbh->query($sql);
    $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $error = 'システム上の問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
}

?>
<?php require_once('header.php');?>
<?php if (!empty($error)) :?>
    <p><?=$error?></p>
<?php else :?>
    <table class="list-table" border="1">
        <thead>
            <tr>
                <form class="list-sort-form" action="new_info_edit.php?crud=create" method="post">
                    <th>
                        <input class="list-sort-button" type="submit" value="▲" formaction="new_info_list.php?name=id&sort=DESC"><br>
                        ID<br>
                        <input class="list-sort-button" type="submit" value="▼" formaction="new_info_list.php?name=id&sort=ASC">
                    </th>
                    <th>
                        掲載内容
                    </th>
                    <th>
                        <input class="list-sort-button" type="submit" value="▲" formaction="new_info_list.php?name=release_date&sort=DESC"><br>
                        公開日<br>
                        <input class="list-sort-button" type="submit" value="▼" formaction="new_info_list.php?name=release_date&sort=ASC">
                    </th>
                    <th>
                        登録日時
                    </th>
                    <th>
                        <input class="list-sort-button" type="submit" value="▲" formaction="new_info_list.php?name=updated_at&sort=DESC"><br>
                        更新日時<br>
                        <input class="list-sort-button" type="submit" value="▼" formaction="new_info_list.php?name=updated_at&sort=ASC">
                    </th>
                    <th class="list-register">
                        <input class="list-register-a" type="submit" value="新規登録">
                    </th>
                </form>
            </tr>
        </thead>
        <?php if (!empty($new_info)) :?>
            <tbody class="list-table-body">
                <?php foreach ($new_info as $val) :?>
                    <tr>
                        <td>
                            <?=h($val['id'])?>
                        </td>
                        <td>
                            <?=h($val['content'])?>
                        </td>
                        <td>
                            <?=h($val['release_date'])?>
                        </td>
                        <td>
                            <?=h(date('Y-m-d H:i:s', strtotime($val['created_at'])))?>
                        </td>
                        <td>
                            <?=!empty($val['updated_at']) ? h(date('Y-m-d H:i:s', strtotime($val['updated_at']))) : ''?>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input class="list-edit-link" type="submit" value="編集" formaction="new_info_edit.php?id=<?=h($val['id'])?>&crud=update">
                                <input class="list-delete-link event-btn" name="delete" type="submit" value="削除" onclick="return confirm('本当に削除しますか？')">
                                <input type="hidden" name="id" value="<?=h($val['id'])?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        <?php else :?>
            <tbody style="border-style: none;">
                <tr style="border-style: none;">
                    <td class="list-error" colspan="6">
                        表示できる新着情報がありません
                    </td>
                </tr>
            </tbody>
        <?php endif;?>
    </table>
<?php endif;?>
<?php require_once('footer.php');?>