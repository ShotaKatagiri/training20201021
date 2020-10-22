
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
