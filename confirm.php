<?php
session_start();
if (!isset($_POST['csrf_token']) && $_POST['csrf_token'] != $_SESSION['csrf_token']) {
    header('Location: contact.php');
    exit;
}
require_once('util.inc.php');
require_once('const.php');
//バリデーションチェック
if ($_POST['name'] == '') {
    $error_list['name'] = 'お名前を入力してください。';
}
if ($_POST['kana'] == '') {
    $error_list['kana'] = 'フリガナを入力してください。';
} elseif (!preg_match('/^[ァ-ヶー 　]+$/u', $_POST['kana'])){
    $error_list['kana'] = 'フリガナの形式が正しくありません。';
}
if ($_POST['municipality'] == '') {
    $error_list['municipality'] = '市区町村名を入力してください。';
}
if ($_POST['address'] == '') {
    $error_list['address'] = '番地を入力してください。';
}
if ($_POST['mail'] == '') {
    $error_list['mail'] = 'メールアドレスを入力してください。';
}
if ($_POST['mail_check'] == '') {
    $error_list['mail_check'] = 'メールアドレス確認を入力してください。';
} elseif ($_POST['mail'] !== $_POST['mail_check']){
    $error_list['mail_check'] = 'メールアドレスが一致しておりません。';
}
if ($_POST['inquiry'] == '') {
    $error_list['inquiry'] = 'お問い合わせ内容を入力してください。';
} elseif (mb_strlen(preg_replace('/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $_POST['inquiry'])) < 20) {
    ///\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u'は空白を指定、第二引数に変換、対象の文字
    $error_list['inquiry'] = 'お問い合わせ内容は20文字以上でご記入ください。';
}
//errorが出た場合の処理
if (isset($error_list)) {
    require_once('contact.php');
    exit;
}
?>
<!--header-->
<?php require_once('header.php');?>
<main>
    <h1 class="title-h1"><img src="images/hourse.png" alt="horse" class="horse">お問い合わせ</h1>
    <table class="verification">
        <tr>
            <th>お名前</th>
            <td><?=h($_POST['name'])?></td>
        </tr>
        <tr>
            <th>フリガナ</th>
            <td><?=h($_POST['kana'])?></td>
        </tr>
        <tr>
            <th>都道府県</th>
            <td><?=PREFLIST[$_POST['prefecture']]?></td>
        </tr>
        <tr>
            <th>市区町村</th>
            <td><?=h($_POST['municipality'])?></td>
        </tr>
        <tr>
            <th>番地</th>
            <td><?=h($_POST['address'])?></td>
        </tr>
        <tr>
            <th>マンション名等</th>
            <td><?=h($_POST['apartment'])?></td>
        </tr>
        <tr>
            <th>年齢</th>
            <td><?=h($_POST['age'])?></td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td><?=h($_POST['tel'])?></td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td><?=h($_POST['mail'])?></td>
        </tr>
        <tr>
            <th>お問い合わせ内容 </th>
            <td class="confirm-inquiry"><?=h($_POST['inquiry'])?></td>
        </tr>
    </table>
    <form action="done.php" method="post">
        <input type="hidden" name="csrf_token" value="<?=h($_SESSION['csrf_token'])?>">
        <input type="hidden" name="name" value="<?=h($_POST['name'])?>">
        <input type="hidden" name="kana" value="<?=h($_POST['kana'])?>">
        <input type="hidden" name="prefecture" value="<?=h($_POST['prefecture'])?>">
        <input type="hidden" name="municipality" value="<?=h($_POST['municipality'])?>">
        <input type="hidden" name="address" value="<?=h($_POST['address'])?>">
        <input type="hidden" name="apartment" value="<?=h($_POST['apartment'])?>">
        <input type="hidden" name="age" value="<?=h($_POST['age'])?>">
        <input type="hidden" name="tel" value="<?=h($_POST['tel'])?>">
        <input type="hidden" name="mail" value="<?=h($_POST['mail'])?>">
        <input type="hidden" name="mail_check" value="<?=h($_POST['mail_check'])?>">
        <input type="hidden" name="inquiry" value="<?=h($_POST['inquiry'])?>">
        <p class="submit">
            <input class="submit-input1" type="submit" value="←  修正" formaction="contact.php">
            <input class="submit-input2" type="submit" name="done" value="送信">
        </p>
    </form>
</main>
<!--footer-->
<?php require_once('footer.php');?>