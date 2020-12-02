<?php
function getPage() {
    $url = pathinfo($_SERVER['PHP_SELF']);

    $first_filename = [
        'new_info_' => '新着情報管理',
    ];

    $second_filename = [
        'list' => '一覧',
        'conf' => '確認',
        'done' => '登録完了',
        'edit' => '',
    ];

    $get_crud = [
        'update' => '(編集)',
        'create' => '(新規登録)',
    ];

    preg_match('/(\w+)(?<=_)/', $url['filename'], $first_url);
    preg_match('/(\w+)(?<=_)(\w+)/', $url['filename'], $second_url);

    if (!empty($first_url)) {
        $first_button_name = $first_filename[($first_url[1])];
        $second_button_name = $second_filename[($second_url[2])];
        $crud = (!empty($_GET['crud']) ? $get_crud[($_GET['crud'])] : '');

        echo '<button class="button-getpage">' . $first_button_name . $second_button_name . '<br>' . $crud . '</button>';
    }

}