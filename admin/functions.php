<?php
require_once('../const.php');

function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function getPage() {

    $url = pathinfo($_SERVER['PHP_SELF']);

    $first_filename =
    [
        'new_info_' => '新着情報管理',
    ];

    $second_filename =
    [
        'list' => 'リスト',
        'conf' => '確認',
        'done' => '完了',
        'edit' => '',
    ];

    preg_match('/(\w+)(?<=_)/', $url['filename'], $first_url);
    preg_match('/(\w+)(?<=_)(\w+)/', $url['filename'], $second_url);

    if (!empty($first_url)) {
        $first_button_name = $first_filename[($first_url[1])];
        $second_button_name = $second_filename[($second_url[2])];
        $crud = (!empty($_GET['crud']) ? GET_CRUD[$_GET['crud']] : '');

        echo '<button class="button-getpage">' . $first_button_name . $crud . $second_button_name . '</button>';
    }
}