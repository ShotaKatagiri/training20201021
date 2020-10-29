<?php
session_start();
// POSTされたトークンを持ち、セッションのトークンとマッチしなかった場合
if (!isset($_POST['csrf_token'])&& $_POST['csrf_token'] !== $_SESSION['csrf_token']){//値が入っていて、$_POST['csrf_token'] と $_SESSION['csrf_token']の値が間違っていた場合
    header('Location: contact.php');
    exit;
}
//$_SESSION中身を空にする
isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '';
//必須項目外の未記入の場合の処理
$_POST['apartment_etc'] = !empty($_POST['apartment_etc']) ? $_POST['apartment_etc'] : '未記入';
$_POST['age'] = !empty($_POST['age']) ? $_POST['age'] : '未記入';
$_POST['phoneNumber'] = !empty($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '未記入';
//メールタイトル
$subject = 'KEIBA navi にお問い合わせいただきありがとうございます。';
//本文
$message =
"

※このメールはシステムからの自動返信です

この度は、お問い合わせ頂き誠にありがとうございます。
+・・・・・・・・・・・・・・・・・・+

お名前:  " . $_POST['name'] .
"\r\nフリガナ:  " . $_POST['kana'] .
"\r\n都道府県:  " . $_POST['prefecture'] .
"\r\n市区町村:  " . $_POST['municipality'] .
"\r\n番地:  " . $_POST['address'] .
"\r\nマンション名等:  " . $_POST['apartment_etc'] .
"\r\n年齢:  " . $_POST['age'] .
"\r\n電話番号:  " . $_POST['phoneNumber'] .
"\r\n\r\n     --お問い合わせ内容--\r\n" . $_POST['inquiry'] .
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
$header = 'From: KEIBA-navi.info@gmail.com';
if(mb_send_mail($_POST['mail'], $subject, $message, $header)){
    $success = 1;
}
?>
    <!--header-->
<?php require_once('header.php') ?>
    <?php if($success === 1):?>
        <h1 class="doneH1"><img src="images/hourse.png" alt="horse" class="horse">送信完了しました。</h1>
            <h2 class="doneH2">この度はお問い合わせいただきありがとうございます。</h2>
                <p class="doneP">今後ともKEIBA navi をよろしくお願いい申し上げます。</p>
                <p class="doneP"><a href="index.php">トップへ画面へ戻る</a></p>
        <!--送信失敗画面-->
    <?php else:?>
        <h1 class="doneH1">送信失敗しました。</h1>
            <h2 class="doneH2">申し訳ありません、お問い合わせフォームの送信に失敗いたしました。</h2>
                <p class="doneP">お手数ですが、お問い合わせフォームより再度ご記入のをお願いいたします。<br>今後ともKEIBA navi をよろしくお願い申し上げます。</p>
                <p class="doneP"><a href="contact.php">お問い合わせ画面へ戻る</a></p>
    <?php endif;?>
    <!--footer-->
<?php require_once('footer.php') ?>