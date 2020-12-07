<?php
//csrf_tokenを持っていなかった場合、true（session_startを実行。）
if (empty($_SESSION['csrf_token'])) {
    session_start();
}
require_once('util.inc.php');
require_once('const.php');
//ランダムなトークンを発行 *util.inc.php*
$_SESSION['csrf_token'] = randomToken();
?>
<!--▼headerー-->
<?php require_once('header.php');?>
<main>
    <h1 class="title-h1"><img src="images/hourse.png" alt="horse" class="horse">お問い合わせ</h1>
    <form action="confirm.php" method="post">
        <input type="hidden" name="csrf_token" value="<?=h($_SESSION['csrf_token'])?>">
        <table>
            <tr>
                <th>お名前<span class="mandatory">（必須）</span></th>
                <td><input size="61" type="text" name="name" value="<?=!empty($_POST['name']) ? h($_POST['name']) : ''?>"></td>
                <td class="error"><?=!empty($error_list['name']) ? $error_list['name'] : ''?></td>
            </tr>
            <tr>
                <th>フリガナ<span class="mandatory">（必須）</span></th>
                <td><input size="61" type="text" name="kana" value="<?=!empty($_POST['kana']) ? h($_POST['kana']) : ''?>"></td>
                <td class="error"><?=!empty($error_list['kana']) ? $error_list['kana'] : ''?></td>
            </tr>
            <tr>
                <th>都道府県</th>
                <td>
                    <select style="width:100%" name="prefecture">
                        <?php foreach (PREFLIST as $key => $val) :?>
                            <option value="<?=$key?>"<?=h(isset($_POST['prefecture']) && $key == $_POST['prefecture'] ? ' selected' : '' )?>><?=$val?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>市区町村<span class="mandatory">（必須）</span></th>
                <td><input size="61" type="text" name="municipality" value="<?=!empty($_POST['municipality']) ? h($_POST['municipality']) : ''?>"></td>
                <td class="error"><?=!empty($error_list['municipality']) ? $error_list['municipality'] : ''?></td>
            </tr>
            <tr>
                <th>番地<span class="mandatory">（必須）</span></th>
                <td><input size="61" type="text" name="address" value="<?=!empty($_POST['address']) ? h($_POST['address']) : ''?>"></td>
                <td class="error"><?=!empty($error_list['address']) ? $error_list['address'] : ''?></td>
            </tr>
            <tr>
                <th>マンション名等</th>
                <td><input size="61" type="text" name="apartment" value="<?=!empty($_POST['apartment']) ? h($_POST['apartment']) : ''?>"></td>
            </tr>
            <tr>
                <th>年齢</th>
                <td><input size="61" type="text" name="age" value="<?=!empty($_POST['age']) ? h($_POST['age']) : ''?>"></td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td><input size="61" type="text" name="tel" value="<?=!empty($_POST['tel']) ? h($_POST['tel']) : ''?>"></td>
            </tr>
            <tr>
                <th>メールアドレス<span class="mandatory">（必須）</span></th>
                <td><input size="61" type="text" name="mail" value="<?=!empty($_POST['mail']) ? h($_POST['mail']) : ''?>"></td>
                <td class="error"><?=!empty($error_list['mail']) ? $error_list['mail'] : ''?></td>
            </tr>
            <tr>
                <th>メールアドレス確認<span class="mandatory">（必須）</span></th>
                <td><input size="61" type="text" name="mail_check" value="<?=!empty($_POST['mail_check']) ? h($_POST['mail_check']) : ''?>">
                </td>
                <td class="error"><?=!empty($error_list['mail_check']) ? $error_list['mail_check'] : ''?></td>
            </tr>
            <tr>
                <th>お問い合わせ内容<span class="mandatory">（必須）</span></th>
                <td><textarea name="inquiry" cols="60" rows="10"><?=!empty($_POST['inquiry']) ? h($_POST['inquiry']) : ''?></textarea></td>
                <td class="error"><?=!empty($error_list['inquiry']) ? $error_list['inquiry'] : ''?></td>
            </tr>
        </table>
        <p class="submit"><a href="cofirm.php"><input class="submit-input" type="submit" value="確認へ"></a></p>
    </form>
</main>
<!--footer-->
<?php require_once('footer.php');?>
