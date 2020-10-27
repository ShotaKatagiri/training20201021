<?php
session_start();
require_once ('util.inc.php');
require_once ('data.php');
//ランダムなトークンを発行 *util.inc.php*
$_SESSION['csrf_token'] = randomToken();

$_POST['prefecture'] = '';



?>
        <!--▼ヘッダー-->
        <?php require_once('header.php') ?>
        <!--▲ヘッダー-->
        <main>
            <h1 class="tittleh1"><img src="images/hourse.png" alt="horse" class="horse">お問い合わせ</h1>
            <form action="confirm.php" method="post">
                <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
                <div class="table">
                    <table>
                        <tr>
                            <th>お名前<span class="mandatory">（必須）</span></th>
                            <td><input size="61" type="text" name="name" value="<?=!empty($_POST['name']) ? h($_POST['name']) : ''?>"></td>
                            <td class="error">
                                <?php if (isset($error_List['name'])) : ?>
                                    <?=$error_List['name']?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>フリガナ<span class="mandatory">（必須）</span></th>
                            <td><input size="61" type="text" name="kana" value="<?=!empty($_POST['kana']) ? h($_POST['kana']) : ''?>">
                            </td>
                            <td class="error">
                                <?php if (isset($error_List['kana'])) : ?>
                                    <?=$error_List['kana']?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>都道府県 （セレクトボックス）</th>
                            <td>
                                <select style="width:100%" name="prefecture" id="" value="<?=h($_POST['prefecture'])?>">
                                    <?php foreach ($pref as $pre) : ?>
                                        <option value="<?=$pre?>" <?=h($pre == $_POST['prefecture'] ? 'selected' : '' )?>><?=$pre?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>市区町村 <span class="mandatory">（必須）</span></th>
                            <td><input size="61" type="text" name="municipality" value="<?=!empty($_POST['municipality']) ? h($_POST['municipality']) : ''?>"></td>
                            <td class="error">
                                <?php if (isset($error_List['municipality'])) : ?>
                                    <?=$error_List['municipality']?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>番地<span class="mandatory">（必須）</span></th>
                            <td><input size="61" type="text" name="address" value="<?=!empty($_POST['address']) ? h($_POST['address']) : ''?>"></td>
                            <td class="error">
                                <?php if (isset($error_List['address'])) : ?>
                                    <?=$error_List['address']?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>マンション名等</th>
                            <td><input size="61" type="text" name="address_etc" value="<?=!empty($_POST['address_etc']) ? h($_POST['address_etc']) : ''?>"></td>
                        </tr>
                        <tr>
                            <th>年齢</th>
                            <td><input size="61" type="text" name="age" value="<?=!empty($_POST['age']) ? h($_POST['age']) : ''?>"></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><input size="61" type="text" name="tell" value="<?=!empty($_POST['tell']) ? h($_POST['tell']) : ''?>"></td>
                        </tr>
                        <tr>
                            <th>メールアドレス<span class="mandatory">（必須）</span></th>
                            <td><input size="61" type="text" name="mail" value="<?=!empty($_POST['mail']) ? h($_POST['mail']) : ''?>"></td>
                            <td class="error">
                                <?php if (isset($error_List['mail'])) : ?>
                                    <?=$error_List['mail']?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>メールアドレス確認<span class="mandatory">（必須）</span></th>
                            <td><input size="61" type="text" name="mail_Check" value="<?=!empty($_POST['mail_Check']) ? h($_POST['mail_Check']) : ''?>">
                            </td>
                            <td class="error">
                                <?php if (isset($error_List['mail_Check'])) : ?>
                                    <?=$error_List['mail_Check']?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>お問い合わせ内容 <span class="mandatory">（必須）</span></th>
                            <td>
                                <textarea name="inquiry" id="" cols="60" rows="10"><?=!empty($_POST['inquiry']) ? h($_POST['inquiry']) : ''?></textarea>
                            </td>
                            <td class="error">
                                <?php if (isset($error_List['inquiry'])) : ?>
                                    <?=$error_List['inquiry']?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <p class="submit"><a href="cofirm.php" class="sub"><input class="submitin" type="submit" value="確認へ"></a></p>
            </form>
        </main>
        <!--footer-->
        <?php require_once('footer.php') ?>
