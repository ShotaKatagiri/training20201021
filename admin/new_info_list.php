<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

require_once('Model.php');

try {
    $model = new Model();
    $model->connect();

    //削除処理
    if (!empty($_GET['id'])) {
        $model->dbh->prepare('UPDATE new_info SET delete_flg = 1 WHERE id = ?')->execute([$_GET['id']]);
        header('Location: new_info_list.php?pages=list');
        exit;
    }
    //初期表示
    $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 0 ORDER BY release_date DESC LIMIT 10');
    //ソート機能
    if (!empty($_GET['sort']) && $_GET['sort'] == 'id_desc') {
        $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 0 ORDER BY id DESC LIMIT 10');
    }
    if (!empty($_GET['sort']) && $_GET['sort'] == 'id_asc') {
        $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 0 ORDER BY id ASC LIMIT 10');
    }
    if (!empty($_GET['sort']) && $_GET['sort'] == 'release_asc') {
        $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 0 ORDER BY release_date ASC LIMIT 10');
    }
    if (!empty($_GET['sort']) && $_GET['sort'] == 'update_desc') {
        $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 0 ORDER BY updated_at DESC LIMIT 10');
    }
    if (!empty($_GET['sort']) && $_GET['sort'] == 'update_asc') {
        $stmt = $model->dbh->query('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 0 ORDER BY updated_at ASC LIMIT 10');
    }
    $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
//公開日を押したとしても、今日以降の日にちは表示させない。
} catch (PDOException $e) {
    echo 'サーバーのデータベース接続に失敗いたしました。<br>下記お問い合わせ画面よりご一報ください。<br>'.'<a href='.'../contact.php>'.'お問い合わせ画面に移動します。</a>';
    exit($e -> getMessage());
}

?>
<?php require_once('header.php');?>
    <h2 class="hero-h2"><?=get_page()?></h2>
    <form action="" method="post">
        <table class="list-table" border="1" rules="all">
            <tr class="list-first-tr">
                <th>
                    <input type="submit" value="▲" formaction="new_info_list.php?pages=list&sort=id_desc"><br>ID<br><input type="submit" value="▼" formaction="new_info_list.php?pages=list&sort=id_asc">
                </th>
                <th>掲載内容</th>
                <th>
                    <input type="submit" value="▲" formaction="new_info_list.php?pages=list"><br>公開日<br><input type="submit" value="▼" formaction="new_info_list.php?pages=list&sort=release_asc">
                </th>
                <th>作成日時</th>
                <th>
                    <input type="submit" value="▲" formaction="new_info_list.php?pages=list&sort=update_desc"><br>更新日<br><input type="submit" value="▼" formaction="new_info_list.php?pages=list&sort=update_asc">
                </th>
                <th class="list-register"><a class="list-register-a" href="new_info_edit.php?pages=sign_up">新規登録</a></th>
            </tr>
            <?php foreach($new_info as $key => $val):?>
                <tr>
                    <td><?=$val['id']?></td>
                    <td><?=$val['content']?></td>
                    <td><?=$val['release_date']?></td>
                    <td><?=date('Y-m-d g:i:s', strtotime($val['created_at']))?></td>
                    <td><?=!empty($val['updated_at']) ? date('Y-m-d g:i:s', strtotime($val['updated_at'])) : ''?></td>
                    <td>
                        <input class="list-edit-link" type="submit" value="編集" formaction="new_info_edit.php?pages=edit&id=<?=$val['id']?>">
                        <input class="list-delete-link event-btn" type="submit" name="delete" value="削除" formaction="new_info_list.php?pages=list&id=<?=$val['id']?>">
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </form>
    <script>
        //複数クラスの返り値は配列のため、forEachで指定。各にaddEventListenerの処理を加える。
        var btn = document.querySelectorAll(".event-btn");

        btn.forEach(function(target) {
        target.addEventListener('click', function(e) {
            var result = window.confirm('本当に削除しますか？');
        if ( result ) {
            console.log('削除');
        } else {
            console.log('キャンセル');
            e.preventDefault()
                }
            })
        });
    </script>
<?php require_once('footer.php');?>