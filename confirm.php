<?php
session_start();
if (
    !isset($_POST['csrf_token'])
    && $_POST['csrf_token'] !== $_SESSION['csrf_token']
) {
       header('Location: contact.php');
    exit;
}
require_once ('util.inc.php');
require_once ('data.php');

 {
    if ($_POST['name'] === '') {
        $error_List['name'] = 'お名前を入力してください。';
    }
    if ($_POST['kana'] === '') {
        $error_List['kana'] = 'フリガナを入力してください。';
    } elseif (!preg_match('/^[ァ-ヶー ]+$/u', $_POST['kana'])) {
        $error_List['kana'] = 'フリガナの形式が正しくありません。';
    }
    if ($_POST['municipality'] === '') {
        $error_List['municipality'] = '市区町村名を入力してください。';
    }
    if ($_POST['address'] === '') {
        $error_List['address'] = '番地を入力してください。';
    }
    if ($_POST['mail'] === '') {
        $error_List['mail'] = 'メールアドレスを入力してください。';
    }
    if ($_POST['mail_Check'] === '') {
        $error_List['mail_Check'] = 'メールアドレス確認を入力してください。';
    } elseif ($_POST['mail'] !== $_POST['mail_Check']) {
        $error_List['mail_Check'] = 'メールアドレスが一致しておりません。';
    }
    if ($_POST['inquiry'] === '') {
        $error_List['inquiry'] = 'お問い合わせ内容を入力してください。';
    } elseif (preg_match('/¥A[ r n[:^cntrl:]]{20,}+¥z/u', $_POST['inquiry'])) {
        $error_List['inquiry'] = 'お問い合わせ内容は20文字以上でご記入ください。';
    }
}
if(isset($error_List)){
    session_destroy();
    require_once ('contact.php');
    exit;
}

 ?>
<!--header-->
<?php require_once ('header.php');?>
    <main>
      <h1 class="tittleh1"><img src="images/hourse.png" alt="horse" class="horse">お問い合わせ</h1>
        <form action="done.php" method="post">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
             <table class="verification">
                <tr>
                    <th>お名前<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="name" value="<?=h($_POST['name'])?>"><?=h($_POST['name'])?></td>
                </tr>
                <tr>
                    <th>フリガナ<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="kana" value="<?=h($_POST['kana'])?>"><?=h($_POST['kana'])?></td>
                </tr>
                <tr>
                    <th>都道府県 （セレクトボックス）</th>
                    <td><input type="hidden" name="prefecture" value="<?=h($_POST['prefecture'])?>"><?=h($_POST['prefecture'])?></td>
                </tr>
                <tr>
                    <th>市区町村 <span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="municipality" value="<?=h($_POST['municipality'])?>"><?=h($_POST['municipality'])?></td>
                </tr>
                <tr>
                    <th>番地<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="address" value="<?=h($_POST['address'])?>"><?=h($_POST['address'])?></td>
                </tr>
                <tr>
                    <th>マンション名等</th>
                    <td><input type="hidden" name="address_etc" value="<?=h($_POST['address_etc'])?>"><?=h($_POST['address_etc'])?></td>
                </tr>
                <tr>
                    <th>年齢</th>
                    <td><input type="hidden" name="age" value="<?=h($_POST['age'])?>"><?=h($_POST['age'])?></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><input type="hidden" name="tell" value="<?=h($_POST['tell'])?>"><?=h($_POST['tell'])?></td>
                </tr>
                <tr>
                    <th>メールアドレス<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="mail" value="<?=h($_POST['mail'])?>"><?=h($_POST['mail'])?></td>
                </tr>
                <tr>
                    <th>メールアドレス確認<span class="mandatory">（必須）</span></th>
                    <td><input type="hidden" name="mail_Check" value="<?=h($_POST['mail_Check'])?>"><?=h($_POST['mail_Check'])?></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容 <span class="mandatory">（必須）</span></th>
                    <td class="inquiryverifi"><input type="hidden" name="inquiry" value="<?=h($_POST['inquiry'])?>"><?=h($_POST['inquiry'])?></td>
                </tr>
            </table>
            <p class="submit">
                <input class="submitin1" type="submit" value="←  修正" formaction="contact.php">
                <input class="submitin2" type="submit" name="done" value="送信">
            </p>
        </form>
    </main>
<!--footer-->
<?php require_once('footer.php') ?>
</body>

</html>