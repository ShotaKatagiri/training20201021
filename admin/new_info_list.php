<?php
session_start();
if ($_SESSION['user_name'] == false) {
    header('Location: login.php');
    exit;
}
require_once('../util.inc.php');
require_once('Model.php');
require_once('../const.php');

try {
    $model = new Model();
    $model->connect();

    $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 1 ORDER BY release_date DESC LIMIT 10');
    $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //削除処理
        if (!empty($_GET['id'])) {
            $model->dbh->prepare('UPDATE new_info SET delete_flg = 0 WHERE id = ?')->execute([$_GET['id']]);
            header('Location: new_info_list.php');
            exit;
        }
        //ソート機能
        if (!empty($_GET['sort']) && $_GET['sort'] == 'id_desc') {
            $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 1 ORDER BY id DESC LIMIT 10');
            $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        if (!empty($_GET['sort']) && $_GET['sort'] == 'id_asc') {
            $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 1 ORDER BY id ASC LIMIT 10');
            $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        if (!empty($_GET['sort']) && $_GET['sort'] == 'release_asc') {
            $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 1 ORDER BY release_date ASC LIMIT 10');
            $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        if (!empty($_GET['sort']) && $_GET['sort'] == 'update_desc') {
            $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 1 ORDER BY updated_at DESC LIMIT 10');
            $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        if (!empty($_GET['sort']) && $_GET['sort'] == 'update_asc') {
            $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 1 ORDER BY updated_at ASC LIMIT 10');
            $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
//公開日を押したとしても、今日以降の日にちは表示させない。
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e -> getMessage());
}
?>
<?php require_once('header.php');?>
    <h2 class="hero-h2">記事一覧</h2>
    <form action="" method="post">
        <table class="list-table">
            <tr>
                <th class="list-th">
                    <input type="submit" value="▲" formaction="new_info_list.php?sort=id_desc">ID<input type="submit" value="▼" formaction="new_info_list.php?sort=id_asc">
                </th>
                <th class="list-th">掲載内容</th>
                <th>
                    <input type="submit" value="▲" formaction="new_info_list.php">公開日<input type="submit" value="▼" formaction="new_info_list.php?sort=release_asc">
                </th>
                <th class="list-th">作成日時</th>
                <th class="list-th">
                    <input type="submit" value="▲" formaction="new_info_list.php?sort=update_desc">更新日<input type="submit" value="▼" formaction="new_info_list.php?sort=update_asc">
                </th>
                <th class="list-register"><a class="list-register-a" href="new_info_edit.php?get_page=1">新規登録</a></th>
            </tr>
            <?php foreach($new_info as $key => $val):?>
            <!-- <input type="hidden" value=""> -->
            <tr>
                <td><?=$val['id']?></td>
                <td><?=$val['content']?></td>
                <td><?=$val['release_date']?></td>
                <td><?=date('Y-m-d g:i:s', strtotime($val['created_at']))?></td>
                <td><?=!empty($val['updated_at']) ? date('Y-m-d g:i:s', strtotime($val['updated_at'])) : ''?></td>
                <td>
                    <input type="hidden" name="release_date" value="<?=$val['release_date']?>">
                    <input type="hidden" name="content" value="<?=$val['content']?>">
                    <input class="list-edit-link" type="submit" name="edit" value="編集" formaction="new_info_edit.php?get_page=2&id=<?=$val['id']?>">
                    <input class="list-delete-link" type="submit" name="delete" value="削除" formaction="new_info_list.php?id=<?=$val['id']?>">
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </form>
<?php require_once('footer.php');?>