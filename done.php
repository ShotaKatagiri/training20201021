<?php
session_start();
// POSTされたトークンを持ち、セッションのトークンとマッチしなかった場合
if (!isset($_POST['csrf_token'])&& $_POST['csrf_token'] != $_SESSION['csrf_token']){//値が入っていて、$_POST['csrf_token'] と $_SESSION['csrf_token']の値が間違っていた場合
    header('Location: contact.php');
    exit;
}
//tokenのセッションを消す。
unset($_SESSION['csrf_token']);
require_once('const.php');
require_once('util.inc.php');
//メールタイトル
$subject = 'KEIBA navi にお問い合わせいただき、ありがとうございます。';
//本文
$message =
    '※このメールはシステムからの自動返信です。' .
    "\n\n" . 'この度は、お問い合わせ頂き誠にありがとうございます。' .
    "\n" . '+・・・・・・・・・・・・・・・・・・+' .
    "\n\n" . 'お名前:' . h($_POST['name']) .
    "\n" . 'フリガナ:' . h($_POST['kana']) .
    "\n" . '都道府県:' . h(PREFLIST[$_POST['prefecture']]) .
    "\n" . '市区町村:' . h($_POST['municipality']) .
    "\n" . '番地:' . h($_POST['address']) .
    "\n" . 'マンション名等:' . (!empty($_POST['apartment']) ? h($_POST['apartment']) : '未記入') .
    "\n" . '年齢:' . (!empty($_POST['age']) ? h($_POST['age']) : '未記入') .
    "\n" . '電話番号:' . (!empty($_POST['tel']) ? h($_POST['tel']) : '未記入') .
    "\n\n" . '--お問い合わせ内容--' . "\n" . h($_POST['inquiry']) .
    "\n\n" . '+・・・・・・・・・・・・・・・・・・+' .
    "\n\n" . '上記お問い合わせ内容について' .
    "\n" . '担当者より確認後、返答いたしますので、' .
    "\n" . 'お手数ですが、もう暫くお待ちください。' .
    "\n\n" . '※本メールアドレスにお心当りがない方は、' .
    "\n" . '下記メールアドレスよりお問い合わせください。' .
    "\n\n" . 'KEIBA-navi・ホーム' .
    "\n" . 'https://extremesites.tokyo/training/keiba-navi-katagiri/index.php' .
    "\n" . 'KEIBA-navi・お問い合わせ' .
    "\n" . 'https://extremesites.tokyo/training/keiba-navi-katagiri/contact.php' .
    "\n\n" . '************************' .
    "\n" . '競馬サイト評価【競馬情報】' .
    "\n" . '住所:東京都新宿区西新宿' .
    "\n" . 'TEL:03-5778-4829' .
    "\n" . 'FAX:03-5909-0716' .
    "\n" . 'E-mail: KEIBA-navi.info@gmail.com' .
    "\n" . '************************'
;
//送信もとメールアドレス
$header = 'From: KEIBA-navi.info@gmail.com';
$mail_send_flag = mb_send_mail($_POST['mail'], $subject, $message, $header);
?>
    <!--header-->
<?php require_once('header.php');?>
<?php if ($mail_send_flag) :?>
    <h1 class="done-h1"><img src="images/hourse.png" alt="horse" class="horse">送信完了しました。</h1>
    <h2 class="done-h2">この度はお問い合わせいただき、ありがとうございます。</h2>
    <p class="done-p">今後ともKEIBA navi をよろしくお願い致します。</p>
    <p class="done-p"><a href="index.php">トップ画面へ戻る</a></p>
    <!--送信失敗画面-->
<?php else :?>
    <h1 class="done-h1">送信失敗しました。</h1>
    <h2 class="done-h2">申し訳ありません、お問い合わせフォームの送信に失敗いたしました。</h2>
    <p class="done-p">お手数ですが、お問い合わせフォームより再度ご記入をお願い致します。<br>今後ともKEIBA navi をよろしくお願い致します。</p>
    <p class="done-p"><a href="contact.php">お問い合わせ画面へ戻る</a></p>
<?php endif;?>
<!--footer-->
<?php require_once('footer.php');?>