<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

require_once('Model.php');
require_once('functions.php');

echo '<pre>';
var_dump($_POST);
echo '</pre>';

exit;
if (!empty($_POST['done'])) {
    try {
        $model = new Model();
        $model->connect();

        if ($_GET['crud'] == 'create') {
            //新規登録
            $sql =
                'INSERT INTO new_info ( '
                    . ' content, '
                    . ' release_date, '
                    . ' created_at '
                . ' ) VALUES ( '
                    . ' ?, '
                    . ' ?, '
                    . ' NOW() '
                . ' ) '
            ;
            $input_parameters = [
                (!empty($_POST['content']) ? h($_POST['content']) : NULL),
                (!empty($_POST['release_date']) ? h($_POST['release_date']) : NULL)
            ];
        } elseif ($_GET['crud'] == 'update') {
            //更新
            $sql =
                'UPDATE new_info SET '
                    . ' content = ?, '
                    . ' release_date = ?, '
                    . ' updated_at = NOW() '
                . ' WHERE '
                    . ' id = ? '
            ;
            $input_parameters = [
                (!empty($_POST['content']) ? h($_POST['content']) : NULL),
                (!empty($_POST['release_date']) ? h($_POST['release_date']) : NULL),
                h($_GET['id'])
            ];
        }
        $model->dbh->prepare($sql)->execute($input_parameters);

    } catch (PDOException $e) {
        $error = 'システム上の問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
    }
}

?>
<?php require_once('header.php');?>
<?php if (!empty($error)) :?>
    <p><?=$error?></p>
<?php else :?>
    <h3 class="done-report"><?=GET_CRUD[$_GET['crud']]?>完了しました。</h3>
<?php endif;?>
<?php require_once('footer.php');?>