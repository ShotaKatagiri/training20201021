<?php
require_once 'util.inc.php';
session_start();
$isValidated = false;


if (isset($_POST["csrf_token"])
 && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
//postのなかのトークンが入っている&&postされてきた値とセッション変数のなかの値が合っていたら
} else {
 //トークンの中に値が入っているのに、postされてきた値とセッション変数のなかの値が合っていない。
 //不正なリクエストです
 header('Location: contact.php');
 exit;
}


// mailを確認
// if (isset($_SESSION['mail'])) {
//     header('Location: contact.php');
//     exit();
// } else {
//     $_SESSION = array();
//     session_destroy();
// }


function getToken()
{
    return hash('sha256',session_id());
}

$csrf_token = getToken();

$_SESSION['csrf_token'] = $csrf_token;


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


if (!empty($_SERVER["REQUEST_METHOD"] == "POST")) {
    // フォームから送信されたデータを各変数に格納
    $name = $_POST['name'];
    $kana = $_POST['kana'];
    $zip_code  = $_POST['zip_code'];
    $address = $_POST['address'];
    $address_etc = $_POST['address_etc'];
    $prefecture = $_POST['prefecture'];
    $age = $_POST['age'];
    $tell = $_POST['tell'];
    $mail = $_POST['mail'];
    $mail_check = $_POST['mail_check'];
    $body = $_POST['body'];
} else {

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
}


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
    // if($isValidated == true){
    //     //tokenに値が入っていた場合はcontact.phpに飛ばす。
    //     if(isset($_SESSION["token"])){
    //         header('Location: contact.php');
    //         exit;
    //     }
    // }

}

//全てのエラーがNULLじゃなかった場合には。
// if (!empty($nameError)|| !empty($kanaError)|| !empty($zip_codeError)|| !empty($addressError)||
// !empty($ageError)|| !empty($tellError)|| !empty($mailError)|| !empty($mail_checkError)|| !empty($bodyError)) {
//     exit;
//     header('Location: confirm.php');
// }else{
//     header('Location: done.php');
//     exit;
// }

// if (!isset($nameError, $kanaError, $zip_codeError, $addressError,
// $ageError, $tellError, $mailError, $mail_checkError, $bodyError,)) {
//     header('Location: done.php');
//     exit;
// }else{
//     header('Location: https://extremesites.tokyo/training/keiba-navi-katagiri/confirm.php');
//     exit;
// }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/confirm.css">
    <title>お問い合わせ</title>
</head>

<body>
    <div id="wrapper">
        <!--▼ヘッダー-->
        <div id="header-inner">
            <header class="cf">
                <div id="header-tittle" class="cf">
                    <a href="./index.html"><img src="images/logon'tittle.png" alt="House Racing Navigation logo"></a>
                </div>
                <nav class="navigate cf">
                    <ul class="navi cf">
                        <li><a href="./index.html">TOP</a></li>
                        <li><a href="./keibajou.html">競馬場</a></li>
                        <li><a href="./yougo.html">馬の脚質</a></li>
                        <li><a href="./contact.php">お問い合わせ</a></li>
                    </ul>
                </nav>
            </header>
        </div>
        <!--▲ヘッダー-->


        <h1 class="tittleh1"><img src="images/hourse.png" alt="horse" class="horse">お問い合わせ</h1>
        <form action="confirm.php" method="post">
        <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            <!-- バリデーションがtrueであれば -->
            <?php if ($isValidated == false) : ?>
                <table>
                    <tr>
                        <th>お名前<span class="mandatory">（必須）</span></th>
                        <td><input size="61" type="text" name="name" value="<?= h($name) ?>"></td>
                        <td class="error">
                            <?php if (isset($nameError)) : ?>
                                <?= $nameError ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>フリガナ<span class="mandatory">（必須）</span></th>
                        <td><input size="61" type="text" name="kana" value="<?= h($kana) ?>">
                        </td>
                        <td class="error">
                            <?php if (isset($kanaError)) : ?>
                                <?= $kanaError ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>都道府県 （セレクトボックス）</th>
                        <td>
                            <select style="width:100%" name="prefecture" id="" value="<?= h($prefecture) ?>">
                                <?php foreach ($pref as $pre) : ?>
                                    <option value="<?=$pre?>"<?= h($pre == $prefecture ? 'selected' : '') ?>><?= $pre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>市区町村 <span class="mandatory">（必須）</span></th>
                        <td><input size="61" type="text" name="zip_code" value="<?= h($zip_code) ?>"></td>
                        <td class="error">
                            <?php if (isset($zip_codeError)) : ?>
                                <?= $zip_codeError ?>
                            <?php endif; ?>

                        </td>
                    </tr>
                    <tr>
                        <th>番地<span class="mandatory">（必須）</span></th>
                        <td><input size="61" type="text" name="address" value="<?= h($address) ?>"></td>
                        <td class="error">
                            <?php if (isset($addressError)) : ?>
                                <?= $addressError ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>マンション名等</th>
                        <td><input size="61" type="text" name="address_etc" value="<?= h($address_etc) ?>"></td>
                    </tr>
                    <tr>
                        <th>年齢</th>
                        <td><input size="61" type="text" name="age" value="<?= h($age) ?>"></td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td><input size="61" type="text" name="tell" value="<?= h($tell) ?>"></td>
                    </tr>
                    <tr>
                        <th>メールアドレス<span class="mandatory">（必須）</span></th>
                        <td><input size="61" type="text" name="mail" value="<?= h($mail) ?>"></td>
                        <td class="error">
                            <?php if (isset($mailError)) : ?>
                                <?= $mailError ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス確認<span class="mandatory">（必須）</span></th>
                        <td><input size="61" type="text" name="mail_check" value="<?= h($mail_check) ?>">
                        </td>
                        <td class="error">
                            <?php if (isset($mail_checkError)) : ?>
                                <?= $mail_checkError ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容 <span class="mandatory">（必須）</span></th>
                        <td>
                            <textarea name="body" id="" cols="60" rows="10"><?= h($body) ?></textarea>
                        </td>
                        <td class="error">
                            <?php if (isset($bodyError)) : ?>
                                <?= $bodyError ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <p class="submit">
                    <input class="submitin2" type="submit" value="確認" formaction="confirm.php">
                </p>

        </form>
        <?php /*  <?php if($isValidated == true):?>
                            done.php
                        <?php else:?>
                            confirm.php
                        <?php endif;?>">  */ ?>

        <!-- バリデーションがfalseであれば。 -->
    <?php else: ?>
        <form action="" method="post">
        <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            <table class="verification">
                <tr>
                    <th>お名前<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="name" value="<?=h($name)?>"><?= h($name) ?></td>
                </tr>
                <tr>
                    <th>フリガナ<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="kana" value="<?=h($kana)?>"><?= h($kana) ?></td>
                </tr>
                <tr>
                    <th>都道府県 （セレクトボックス）</th>
                    <td><input type="hidden" name="prefecture" value="<?=h($prefecture)?>"><?= h($prefecture) ?></td>
                </tr>
                <tr>
                    <th>市区町村 <span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="zip_code" value="<?=h($zip_code)?>"><?= h($zip_code) ?></td>
                </tr>
                <tr>
                    <th>番地<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="address" value="<?=h($address)?>"><?= h($address) ?></td>
                </tr>
                <tr>
                    <th>マンション名等</th>
                    <td><input type="hidden" name="address_etc" value="<?=h($address_etc)?>"><?= h($address_etc) ?></td>
                </tr>
                <tr>
                    <th>年齢</th>
                    <td><input type="hidden" name="age" value="<?=h($age)?>"><?= h($age) ?></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><input type="hidden" name="tell" value="<?=h($tell)?>"><?= h($tell) ?></td>
                </tr>
                <tr>
                    <th>メールアドレス<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="mail" value="<?=h($mail)?>"><?= h($mail) ?></td>
                </tr>
                <tr>
                    <th>メールアドレス確認<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="mail_check" value="<?=h($mail_check)?>"><?= h($mail_check) ?></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容 <span class="mandatory">（必須）</span></th>
                    <td class="bodyverifi"><input type="hidden" name="body" value="<?=h($body)?>"><?= h($body) ?></td>
                </tr>
            </table>
            <p class="submit">
                <input class="submitin1" type="submit" value="←  修正" formaction="contact.php">

                <input class="submitin2" type="submit" name="done" value="送信" formaction="done.php">
            </p>


        </form>
    <?php endif; ?>

</body>

</html>