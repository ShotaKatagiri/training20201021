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

        $sql_racecourse =
            'SELECT '
                . ' * '
            . ' FROM '
                    . ' racecourse '
            . ' WHERE '
                . ' delete_flg = 0 AND '
                . ' id = ?'
        ;
        $stmt_racecourse = $model->dbh->prepare($sql_racecourse);
        $stmt_racecourse->execute([$_GET['id']]);
        $racecourse = $stmt_racecourse->fetch(PDO::FETCH_ASSOC);


        $sql_graded =
            'SELECT '
                . ' rg.description rg_desc, '
                . ' rg.turn rg_turn, '
                . ' rg.racecourse_id rg_id, '
                . ' mg.name mg_name, '
                . ' mg.class mg_class '
                . '  '
            . ' FROM '
                . ' racecourse_graded_race rg '
            . ' JOIN '
                . ' m_graded_race mg '
            . ' ON '
                . ' rg.graded_race_id = mg.id '
            . ' WHERE '
                . ' rg.racecourse_id = ?'
        ;
        $stmt_graded = $model->dbh->prepare($sql_graded);
        $stmt_graded->execute([$_GET['id']]);
        $graded = $stmt_graded->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $e) {
        $error = 'システム上の問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
        echo '<pre>';
        var_dump($model->dbh->errorInfo() );
        echo '</pre>';
    }
}

echo '<pre>';
var_dump($racecourse);
echo '</pre>';

echo '<pre>';
var_dump($graded);
echo '</pre>';


// $racecourse = $_POST + $racecourse;

?>
<?php require_once('header.php');?>
<?php if(!empty($error)) :?>
    <p><?=$error?></p>
<?php endif;?>
<form action="racecourse_conf.php?<?=!empty($_GET['id']) ? 'id=' . h($_GET['id']) . '&' : ''?>crud=<?=$_GET['crud'] == 'update' ? 'update' : 'create'?>" method="post">
    <table class="edit-table">
        <tr>
            <th>アンカー用ID<span class="edit-table-span"> (必須)</span></th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="r_anchor_id" value="<?=!empty($racecourse['anchor_id']) ? h($racecourse['anchor_id']) : ''?>"></td>
        </tr>
        <tr>
            <th>競馬場名</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="r_name" value="<?=!empty($racecourse['name']) ? h($racecourse['name']) : ''?>"></td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="r_title" value="<?=!empty($racecourse['title']) ? h($racecourse['title']) : ''?>"></td>
        </tr>
        <tr>
            <th>説明文（レース場）</th>
            <td class="edit-table-content"><textarea name="r_description" cols="30" rows="10"><?=!empty($racecourse['description']) ? h($racecourse['description']) : ''?></textarea></td>
        </tr>
        <tr>
            <th>所在地</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="r_address" value="<?=!empty($racecourse['address']) ? h($racecourse['address']) : ''?>"></td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="r_tel" value="<?=!empty($racecourse['tel']) ? h($racecourse['tel']) : ''?>"></td>
        </tr>
        <tr>
            <th>営業時間</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="r_business_hours" value="<?=!empty($racecourse['business_hours']) ? h($racecourse['business_hours']) : ''?>"></td>
        </tr>
        <tr>
            <th>GoogleMapURL</th>
            <td class="edit-table-map"><textarea name="r_map_url" cols="30" rows="10"><?=!empty($racecourse['map_url']) ? h($racecourse['map_url']) : ''?></textarea></td>
        </tr>
        <tr>
            <th>ユーザーぺージの表示順（レース場）</th>
            <td class="edit-table-date"><input class="racecourse-edit-input" type="text" name="r_turn" value="<?=!empty($racecourse['turn']) ? h($racecourse['turn']) : ''?>"></td>
        </tr>
    </table>
    <?php if (!empty($graded)) :?>
        <?php for ($i = 0 ; $i < count($graded) ; $i++) :?>
            <table class="edit-table">
                <tr>
                    <th>
                        説明文
                    </th>
                    <td>
                        <input class="racecourse-edit-input" type="text" name="graded[<?=$i?>][rg_description]" value="<?=h($graded[$i]['rg_desc'])?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        ユーザーページの表示順（重賞レース）
                    </th>
                    <td class="edit-table-date">
                        <input class="racecourse-edit-input" type="text" name="graded[<?=$i?>][rg_turn]" value="<?=!empty($graded[$i]['rg_turn']) ? h($graded[$i]['rg_turn']) : ''?>">
                    </td>
                </tr>
                <tr>
                <th>
                    レース名選択
                </th>
                    <td>
                        <select name="graded[<?=$i?>][mg_name]" id="">
                            <option value="">選択なし</option>
                            <?php foreach ($graded as $key => $val) :?>
                                <option value="<?=$val['mg_name']?>"<?=($val['mg_name'] == $val['mg_name'] ? ' selected ' : '')?>><?=$val['mg_name']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="graded[<?=$i?>][rg_id]" value="<?=$graded[$i]['rg_id']?>">
        <?php endfor;?>
    <?php else :?>
    <h3>重賞レース</h3>
    <?php for ($i = 0 ; $i < 5 ; $i++) :?>

    <table class="edit-table">
        <tr>
            <th>
                説明文（重賞レース）
            </th>
            <td class="edit-table-date">
                <input class="racecourse-edit-input" type="text" name="graded[<?=$i?>][rg_description]" value="<?=!empty($racecourse['rg_description']) ? h($racecourse['rg_description']) : ''?>">
            </td>
        </tr>
        <tr>
            <th>
                ユーザーページの表示順（重賞レース）
            </th>
            <td class="edit-table-date">
                <input class="racecourse-edit-input" type="text" name="graded[<?=$i?>][rg_turn]" value="<?=!empty($racecourse['turn']) ? h($racecourse['turn']) : ''?>">
            </td>
        </tr>
        <tr>
            <th>
                レース名選択
            </th>
            <td>
                <select name="graded[<?=$i?>][mg_name]" id="">
                    <option value="">選択なし</option>
                    <option value="1">G1レース</option>
                    <option value="2">G2レース</option>
                    <option value="3">G3レース</option>
                </select>
            </td>
        </tr>
    </table>

    <?php endfor;?>
    <?php endif;?>
    <p><input class="edit-conf-button" type="submit" value="確認画面へ"></p>
</form>
<?php require_once('footer.php');?>