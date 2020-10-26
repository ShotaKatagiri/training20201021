<?php
session_start();
require_once 'util.inc.php';
$isValidated = false;


if (
    isset($_POST["csrf_token"])
    && $_POST["csrf_token"] === $_SESSION['csrf_token']
) {
    //postのなかのトークンが入っている&&postされてきた値とセッション変数のなかの値が合っていたら
} else {
    //トークンの中に値が入っているのに、postされてきた値とセッション変数のなかの値が合っていない。
    //不正なリクエストです
    header('Location: contact.php');
    exit;
}






//ランダムなトークンを発行 *util.inc.php*
$_SESSION['csrf_token'] = random();


$pref = array(
    1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県', 6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県',
    10 => '群馬県', 11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県', 16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県',
    20 => '長野県', 21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県', 26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県',
    31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県', 36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県',
    41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県', 46 => '鹿児島県', 47 => '沖縄県'
);

$name = '';
$kana = '';
$zip_code  = '';
$address = '';
$address_etc = '';
$age = '';
$prefecture = '';
$tell = '';
$mail = '';
$mail_check = '';
$body =  '';



if (!empty($_POST)) {
    $name = $_POST['name'];
    $kana = $_POST['kana'];
    $zip_code = $_POST['zip_code'];
    $address = $_POST['address'];
    $address_etc = $_POST['address_etc'];
    $age = $_POST['age'];
    $prefecture = $_POST['prefecture'];
    $tell = $_POST['tell'];
    $mail = $_POST['mail'];
    $mail_check = $_POST['mail_check'];
    $body = $_POST['body'];
    $isValidated = true;

    if ($name === '') {
        $nameError = 'お名前を入力してください。';
        $isValidated = false;
    }
    if ($kana === '') {
        $kanaError = 'フリガナを入力してください。';
        $isValidated = false;
    } elseif (!preg_match("/^[ァ-ヶー ]+$/u", $kana)) {
        $kanaError = 'フリガナの形式が正しくありません。';
        $isValidated = false;
    }
    if ($zip_code === '') {
        $zip_codeError = '市町村を入力してください。';
        $isValidated = false;
    }
    if ($address === '') {
        $addressError = '番地を入力してください。';
        $isValidated = false;
    }
    if ($mail === '') {
        $mailError = 'メールアドレスを入力してください。';
        $isValidated = false;
    }
    if ($mail_check === '') {
        $mail_checkError = 'メールアドレス確認を入力してください。';
        $isValidated = false;
    } elseif ($mail !== $mail_check) {
        $mail_checkError = 'メールアドレスが一致しておりません。';
        $isValidated = false;
    }
    if ($body === '') {
        $bodyError = 'お問い合わせ内容を入力してください。';
        $isValidated = false;
    } elseif (preg_match("/¥A[ r n[:^cntrl:]]{20,}+¥z/u", $body)) {
        $bodyError = 'お問い合わせ内容は20文字以上でご記入ください。';
        $isValidated = false;
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contact.css">
    <title>お問い合わせ</title>
</head>

<body>
    <div id="wrapper">
        <!--▼ヘッダー-->
        <?php require_once("header.php") ?>
        <!--▲ヘッダー-->

        <h1 class="confirmTittleh1"><img src="images/hourse.png" alt="horse" class="horse">お問い合わせ</h1>
        <form action="confirm.php" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <!-- 表示に間違いがなければ表示されない。 -->
            <?php if ($isValidated == false) : ?>
                <!-- contactを読み込み -->
                <?php require_once("fromInput.php") ?>
                <p class="submit">
                    <input class="submitin" type="submit" value="確認" formaction="confirm.php">
                </p>
        </form>
        <!-- バリデーションがfalseであれば。 -->
    <?php else : ?>
        <form action="" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <table class="verification">
                <tr>
                    <th>お名前<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="name" value="<?= h($name) ?>"><?= h($name) ?></td>
                </tr>
                <tr>
                    <th>フリガナ<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="kana" value="<?= h($kana) ?>"><?= h($kana) ?></td>
                </tr>
                <tr>
                    <th>都道府県 （セレクトボックス）</th>
                    <td><input type="hidden" name="prefecture" value="<?= h($prefecture) ?>"><?= h($prefecture) ?></td>
                </tr>
                <tr>
                    <th>市区町村 <span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="zip_code" value="<?= h($zip_code) ?>"><?= h($zip_code) ?></td>
                </tr>
                <tr>
                    <th>番地<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="address" value="<?= h($address) ?>"><?= h($address) ?></td>
                </tr>
                <tr>
                    <th>マンション名等</th>
                    <td><input type="hidden" name="address_etc" value="<?= h($address_etc) ?>"><?= h($address_etc) ?></td>
                </tr>
                <tr>
                    <th>年齢</th>
                    <td><input type="hidden" name="age" value="<?= h($age) ?>"><?= h($age) ?></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><input type="hidden" name="tell" value="<?= h($tell) ?>"><?= h($tell) ?></td>
                </tr>
                <tr>
                    <th>メールアドレス<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="mail" value="<?= h($mail) ?>"><?= h($mail) ?></td>
                </tr>
                <tr>
                    <th>メールアドレス確認<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="mail_check" value="<?= h($mail_check) ?>"><?= h($mail_check) ?></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容 <span class="mandatory">（必須）</span></th>
                    <td class="bodyverifi"><input type="hidden" name="body" value="<?= h($body) ?>"><?= h($body) ?></td>
                </tr>
            </table>
            <p class="submit">
                <input class="submitin1" type="submit" value="←  修正" formaction="contact.php">
                <input class="submitin2" type="submit" name="done" value="送信" formaction="done.php">
            </p>
        </form>
    <?php endif; ?>
    <!--header-->
    <?php require_once("footer.php") ?>
</body>

</html>