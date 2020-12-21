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
echo '<pre>';
var_dump($_GET);
echo '</pre>';

if (!empty($_POST['done'])) {
    try {
        $model = new Model();
        $model->connect();

        $input_parameters = [
            (!empty($_POST['r_anchor_id']) ? h($_POST['r_anchor_id']) : NULL),
            (!empty($_POST['r_name']) ? h($_POST['r_name']) : NULL),
            (!empty($_POST['r_title']) ? h($_POST['r_title']) : NULL),
            (!empty($_POST['r_description']) ? h($_POST['r_description']) : NULL),
            (!empty($_POST['r_address']) ? h($_POST['r_address']) : NULL),
            (!empty($_POST['r_tel']) ? h($_POST['r_tel']) : NULL),
            (!empty($_POST['r_business_hours']) ? h($_POST['r_business_hours']) : NULL),
            (!empty($_POST['r_map_url']) ? h($_POST['r_map_url']) : NULL),
            (!empty($_POST['r_turn']) ? h($_POST['r_turn']) : NULL)
            // (!empty($_GET['id']) ? ', ' . $_GET['id'] : '')
        ];
        if ($_GET['crud'] == 'create') {
            //新規登録
            $sql =
                'INSERT INTO racecourse ( '
                    . ' anchor_id, '
                    . ' name, '
                    . ' title, '
                    . ' description, '
                    . ' address, '
                    . ' tel, '
                    . ' business_hours, '
                    . ' map_url, '
                    . ' turn, '
                    . ' created_at '
                . ' ) VALUES ( '
                    . ' ?, '
                    . ' ?, '
                    . ' ?, '
                    . ' ?, '
                    . ' ?, '
                    . ' ?, '
                    . ' ?, '
                    . ' ?, '
                    . ' ?, '
                    . ' NOW() '
                . ' ) '
            ;
            $model->dbh->prepare($sql)->execute($input_parameters);
            if (!empty($_POST['graded'])) {
                foreach ($_POST['graded'] as $key => $val) {
                    ${'rg_sql' . $key}  =
                        'INSERT INTO racecourse_graded_race ( '
                            . ' racecourse_id, '
                            . ' graded_race_id, '
                            . ' description, '
                            . ' turn '
                        . ' ) VALUES ( '
                            . ' ?, '
                            . ' ?, '
                            . ' ?, '
                            . ' ? '
                        . ' ) '
                    ;
                    ${'rg_input_parameters' . $key} = [
                        (empty($last_insert_id) ? $last_insert_id = $model->dbh->lastInsertId() : $last_insert_id),
                        $_POST['graded'][$key]['mg_name'],
                        $_POST['graded'][$key]['rg_description'],
                        $_POST['graded'][$key]['rg_turn']
                    ];
                    $model->dbh->prepare(${'rg_sql' . $key})->execute(${'rg_input_parameters' . $key});
                    echo '<pre>';
                    var_dump(${'rg_input_parameters' . $key});
                    echo '</pre>';
                }
            }
        } elseif ($_GET['crud'] == 'update') {
            //更新
            $sql =
                'UPDATE racecourse SET '
                    . ' anchor_id = ?, '
                    . ' name = ?, '
                    . ' title = ?, '
                    . ' description = ?, '
                    . ' address = ?, '
                    . ' tel = ?, '
                    . ' business_hours = ?, '
                    . ' map_url = ?, '
                    . ' turn = ?, '
                    . ' updated_at = NOW() '
                . ' WHERE '
                    . ' id = ? '
            ;
            if (!empty($_POST['graded'])) {
                foreach ($_POST['graded'] as $key => $val) {
                    ${'rg_sql' . $key}  =
                        'UPDATE racecourse_graded_race SET ( '
                            . ' racecourse_id = ?, '
                            . ' graded_race_id = ?, '
                            . ' description = ?, '
                            . ' turn = ? '
                        . ' WHERE '
                            . ' id = ? '
                    ;
                    ${'rg_input_parameters' . $key} = [
                        $_POST['graded'][$key]['rg_id'],
                        $_POST['graded'][$key]['mg_name'],
                        $_POST['graded'][$key]['rg_description'],
                        $_POST['graded'][$key]['rg_turn']
                    ];
                    $model->dbh->prepare($sql)->execute(${'rg_input_parameters' . $key});
                }
            }

        }
        // $model->dbh->prepare($sql)->execute($input_parameters);

    } catch (PDOException $e) {
        $error = 'システム上の問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
    }
}
// echo '<pre>';
// var_dump($model->dbh->lastInsertId());
// echo '</pre>';
// echo '<pre>';
// var_dump($rg_sql0);
// echo '</pre>';
// echo '<pre>';
// var_dump($rg_input_parameters0);
// echo '</pre>';
// echo '<pre>';
// var_dump($rg_sql1);
// echo '</pre>';
// echo '<pre>';
// var_dump($rg_input_parameters1);
// echo '</pre>';
?>
<?php require_once('header.php');?>
<?php if (!empty($error)) :?>
    <p><?=$error?></p>
<?php else :?>
    <h3 class="done-report"><?=GET_CRUD[$_GET['crud']]?>完了しました。</h3>
<?php endif;?>
<?php require_once('footer.php');?>