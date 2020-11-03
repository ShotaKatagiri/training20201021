<?php
session_start();
require_once('../util.inc.php');
require_once('Model.php');
require_once('../const.php');
if ($_SESSION['user_name'] == false) {
    header('Location: login.php');
    exit;
}
try {
    $model = new Model();
    $model->connect();

    $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 1 ORDER BY release_date DESC LIMIT 10');
    $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>';
    var_dump($new_info);
    echo '</pre>';
    if (!empty($_SERVER['REQUEST_METHOD'] == 'POST')){
        // if($_POST['edit']){
        //     header('Location: new_info_edit.php?get_page=2');
        //     exit;
        // }
        if($_POST['delete']){
            $model->dbh->prepare('UPDATE new_info SET delete_flg = 0 WHERE id = ?')->execute([$_POST['delete']]);
            header('Location: new_info_list.php');
            exit;
        }
    }
    // echo '<pre>';
    // var_dump($new_info);
    // echo '</pre>';
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
                <th class="list-th">ID</th>
                <th class="list-th">掲載内容</th>
                <th class="list-th">公開日</th>
                <th class="list-th">作成日時</th>
                <th class="list-th">更新日時</th>
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
                    <input class="list-edit-link" type="submit" name="edit" value="編集" formaction="new_info_edit.php?get_page=2&id=<?=$_val['id']?>">
                    <input class="list-delete-link" type="submit" name="delete" value="<?=$val['id']?>" formaction="<?=$val['id']?>">
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </form>
<?php require_once('footer.php');?>