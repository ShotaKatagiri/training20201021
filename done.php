<?php

// セッション開始
session_start();
$isValidated = false;
$body = '';
$mail = '';


$token = isset($_POST["token"]) ? $_POST["token"] : "";
// セッション変数のトークンを取得
$session_token = isset($_SESSION["token"]) ? $_SESSION["token"] : "";
// セッション変数のトークンを再利用防止のため削除



if (!empty($_SERVER["REQUEST_METHOD"] == "POST")) {
    // フォームから送信されたデータを各変数に格納
    $mail = $_POST['mail'];
    $name = $_POST['name'];
    $kana = $_POST['kana'];
    $zip_code  = $_POST['zip_code'];
    $address = $_POST['address'];
    $address_etc = $_POST['address_etc'];
    $prefecture = $_POST['prefecture'];
    $age = $_POST['age'];
    $tell = $_POST['tell'];
    $body = $_POST['body'];
}
if(isset($address_etc)){
    $address_etc = "未記入";
}
if(isset($age)){
    $age = "未記入";
}
if(isset($tell)){
    $tell = "未記入";
}

//メールタイトル
$subject = "KEIBA navi にお問い合わせいただきありがとうございます。";

//本文
$message =
"

※このメールはシステムからの自動返信です

この度は、お問い合わせ頂き誠にありがとうございます。
+・・・・・・・・・・・・・・・・・・+

お名前:  " . $name .
"\r\nフリガナ:  " . $kana .
"\r\n都道府県:  " . $prefecture .
"\r\n市区町村:  " . $zip_code .
"\r\n番地:  " . $address .
"\r\nマンション名等:  " . $address_etc .
"\r\n年齢:  " . $age .
"\r\n電話番号:  " . $tell .
"\r\n\r\n     --お問い合わせ内容--\r\n". $body .
"\r\n\r\n+・・・・・・・・・・・・・・・・・・+

上記お問い合わせ内容について
担当者より確認後、返答いたしますので
お手数ですが、もう暫くお待ちください。



※本メールアドレスにお心当りがない方は、
下記メールアドレスよりお問い合わせください。



KEIBA-navi・ホーム
https://extremesites.tokyo/training/keiba-navi-katagiri/index.php

KEIBA-navi・お問い合わせ
https://extremesites.tokyo/training/keiba-navi-katagiri/contact.php



************************ 
競馬サイト評価【競馬情報】
住所:東京都新宿区西新宿
TEL:03-5778-4829
FAX:03-5909-0716
E-mail: KEIBA-navi.info@gmail.com
************************ ";

//送信もとメールアドレス
$header = "From: KEIBA-navi.info@gmail.com";


    // POSTされたトークンを持ち、セッションのトークンとマッチした場合

    if (isset($_POST["csrf_token"])
    && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
       mb_send_mail($mail, $subject, $message, $header);
       $isValidated = true;
   } else {
    echo "不正なリクエストです。";

   }



?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="css/contact.css">
    <title>送信完了しました。</title>
</head>

<body>
    <!--header-->
    <?php include("header.php")?>
    <?php if ($isValidated == true) : ?>
        <h1 class="doneH1"><img src="images/hourse.png" alt="horse" class="horse">送信完了しました。</h1>
        <h2 class="doneH2">この度はお問い合わせいただきありがとうございます。</h2>
        <p class="doneP">今後ともKEIBA navi をよろしくお願いい申し上げます。</p>

        <p class="doneP"><a href="index.php">トップへ画面へ戻る</a></p>

        <!--送信失敗画面-->
    <?php else : ?>
        <h1 class="doneH1">送信失敗しました。</h1>

        <h2 class="doneH2">申し訳ありません、お問い合わせフォームの送信に失敗いたしました。</h2>

        <p class="doneP">お手数ですが、お問い合わせフォームより再度ご記入のをお願いいたします。<br>今後ともKEIBA navi をよろしくお願いい申し上げます。</p>

        <p class="doneP"><a href="contact.php">お問い合わせ画面へ戻る</a></p>

    <?php endif; ?>
    <?php include("footer.php")?>
</body>

</html>