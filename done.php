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
    $body = $_POST['body'];
}

//メールタイトル
$subject = "KEIBA navi にお問い合わせいただきありがとうございます。";

//本文
$message = "この度は、お問い合わせ頂き誠にありがとうございます。
+・・・・・・・・・・・・・・・・・・+"
    . $body .
    "+・・・・・・・・・・・・・・・・・・+
上記お問い合わせ内容について
担当者より確認後、返答いたしますので
お手数ですが、もう暫くお待ちください。";

//送信もとメールアドレス
$header = "From: KEIBA-navi.info@gmail.com";


// if(!empty(mb_send_mail($mail, $subject, $message, $header))){
//     $_SESSION['mail'] = mb_send_mail($mail, $subject, $message, $header);
//     $isValidated = true;
// }else{
//     echo '送信失敗しました。';
// }


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
    <link rel="stylesheet" href="css/done.css">
    <title>送信完了しました。</title>
</head>

<body>
    <?php if ($isValidated == true) : ?>
        <h1 class="tittleh1"><img src="images/hourse.png" alt="horse" class="horse">送信完了しました。</h1>
        <h2>この度はお問い合わせいただきありがとうございます。</h2>
        <p>今後ともKEIBA navi をよろしくお願いい申し上げます。</p>

        <p><a href="index.html">トップへ画面へ戻る</a></p>

    <?php else : ?>
        <h1 class="falseh1">送信失敗しました。</h1>

        <h2>申し訳ありません、お問い合わせフォームの送信に失敗いたしました。</h2>

        <p>お手数ですが、お問い合わせフォームより再度ご記入のをお願いいたします。<br>今後ともKEIBA navi をよろしくお願いい申し上げます。</p>

        <p><a href="contact.php">お問い合わせ画面へ戻る</a></p>

    <?php endif; ?>

</body>

</html>