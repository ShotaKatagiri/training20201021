<?php
session_start();
require_once ('util.inc.php');
require_once ('register.php');
//ランダムなトークンを発行 *util.inc.php*
$_SESSION['csrf_token'] = randomToken();
?>
<!--▼ヘッダー-->
<?php require_once('header.php') ?>
<!--▲ヘッダー-->
<main>
    <h1 class="tittleh1"><img src="images/hourse.png" alt="horse" class="horse">お問い合わせ</h1>
        <div class="table">
    <form action="confirm.php" method="post">
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <table>
                <tr>
                    <th>お名前<span class="mandatory">（必須）</span></th>
                    <td><input size="61" type="text" name="name" value="<?=!empty($_POST['name']) ? h($_POST['name']) : ''?>"></td>
                    <td class="error">
                        <?=!empty($errorList['name']) ? $errorList['name'] : ''?>
                    </td>
                </tr>
                <tr>
                    <th>フリガナ<span class="mandatory">（必須）</span></th>
                    <td><input size="61" type="text" name="kana" value="<?=!empty($_POST['kana']) ? h($_POST['kana']) : ''?>"></td>
                    <td class="error">
                        <?=!empty($errorList['kana']) ? $errorList['kana'] : ''?>
                    </td>
                </tr>
                <tr>
                    <th>都道府県 （セレクトボックス）</th>
                    <td>
                        <select style="width:100%" name="prefecture">
                            <?php foreach ($prefs as $pref) : ?>
                                <option <?=h(isset($_POST['prefecture']) && $pref == $_POST['prefecture'] ? 'selected' : '' )?>><?=h($pref)?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>市区町村 <span class="mandatory">（必須）</span></th>
                    <td><input size="61" type="text" name="municipality" value="<?=!empty($_POST['municipality']) ? h($_POST['municipality']) : ''?>"></td>
                    <td class="error">
                        <?=!empty($errorList['municipality']) ? $errorList['municipality'] : ''?>
                    </td>
                </tr>
                <tr>
                    <th>番地<span class="mandatory">（必須）</span></th>
                    <td><input size="61" type="text" name="address" value="<?=!empty($_POST['address']) ? h($_POST['address']) : ''?>"></td>
                    <td class="error">
                        <?=!empty($errorList['address']) ? $errorList['address'] : ''?>
                    </td>
                </tr>
                <tr>
                    <th>マンション名等</th>
                    <td><input size="61" type="text" name="apartment_etc" value="<?=!empty($_POST['apartment_etc']) ? h($_POST['apartment_etc']) : ''?>"></td>
                </tr>
                <tr>
                    <th>年齢</th>
                    <td><input size="61" type="text" name="age" value="<?=!empty($_POST['age']) ? h($_POST['age']) : ''?>"></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><input size="61" type="text" name="phoneNumber" value="<?=!empty($_POST['phoneNumber']) ? h($_POST['phoneNumber']) : ''?>"></td>
                </tr>
                <tr>
                    <th>メールアドレス<span class="mandatory">（必須）</span></th>
                    <td><input size="61" type="text" name="mail" value="<?=!empty($_POST['mail']) ? h($_POST['mail']) : ''?>"></td>
                    <td class="error">
                        <?=!empty($errorList['mail']) ? $errorList['mail'] : ''?>
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス確認<span class="mandatory">（必須）</span></th>
                    <td><input size="61" type="text" name="mailCheck" value="<?=!empty($_POST['mailCheck']) ? h($_POST['mailCheck']) : ''?>">
                    </td>
                    <td class="error">
                        <?=!empty($errorList['mailCheck']) ? $errorList['mailCheck'] : ''?>
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容 <span class="mandatory">（必須）</span></th>
                    <td>
                        <textarea name="inquiry" id="" cols="60" rows="10"><?=!empty($_POST['inquiry']) ? h($_POST['inquiry']) : ''?></textarea>
                    </td>
                    <td class="error">
                        <?=!empty($errorList['inquiry']) ? $errorList['inquiry'] : ''?>
                    </td>
                </tr>
            </table>
        </div>
        <p class="submit"><a href="cofirm.php"><input class="submitInput" type="submit" value="確認へ"></a></p>
    </form>
</main>
<!--footer-->
<?php require_once('footer.php') ?>
