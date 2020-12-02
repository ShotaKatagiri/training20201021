<?php
// function getPage() {
//     if ($_GET['pages'] == 'list') {
//         return '記事管理一覧';
//     }
//     if ($_GET['pages'] == 'sign_up') {
//         return '記事管理新規登録';
//     }
//     if ($_GET['pages'] == 'edit') {
//         return '記事管理編集';
//     }
//     if ($_GET['pages'] == 'conf') {
//         return '記事管理確認';
//     }
//     if ($_GET['pages'] == 'done') {
//         return '記事管理完了';
//     }
// }
function getPage() {
    if ($_GET['pages'] == 'conf') {
        $article_lists['conf'] = '確認';
    }
    if ($_GET['pages'] == 'list') {
        $article_lists['list'] = 'リスト';
    }
    if ($_GET['pages'] == 'edit') {
        $article_lists['edit'] = '編集';
    }
    if ($_GET['pages'] == 'sign_up') {
        $article_lists['sign_up'] = '新規登録';
    }
    if ($_GET['pages'] == 'done') {
        $article_lists['done'] = '完了';
    }
    if ($_GET['pages'] == 'top') {
        $article_lists['top'] = 'Top';
    }
    return '記事管理' .  $article_lists[$_GET['pages']];
}



// $url = basename($_SERVER['PHP_SELF'], 'keiba-navi-katagiri/admin/'.'');
// // $url = rtrim($_SERVER["PHP_SELF"], '.php');//.phpをトリム
// // $keys = parse_url($url); //パース処理
// // $path = explode("/", $keys['path']); //分割処理
// // $url = end($path);


    // $url = str_replace('_list', '管理リスト', $url);
    // $url = str_replace('_edit', '管理新規登録', $url);
    // $url = str_replace('_conf', '管理登録確認', $url);
    // $url = str_replace('_done', '管理登録完了', $url);



//idと別のgetをつける
// 切り分ける
// キーを取得して、返す

    // $b = $url[$second_filename];

    // $second_button = str_replace(
    //     array_keys($second_filename),
    //     array_values($second_filename),
    //     str_replace(array_keys($first_filename),
    //                 array_values($first_filename),
    //                 $url['filename']
    //                 )
    //     );
  // $a = str_replace(array_keys($first_filename), array_values($first_filename), $url['filename']);
    // $b = stristr($url['filename'], '_', true);
// $strurl = stristr($url, '_', true) . (!empty($_POST['button']) ? $_POST['button'] : 'リスト');


// function getPage() {
//     $url = pathinfo($_SERVER['PHP_SELF']);

//     $first_filename = [
//         'new_info' => '新着情報管理',
//     ];

//     $second_filename = [
//         '_list' => '一覧',
//         '_conf' => '確認',
//         '_done' => '完了',
//         '_edit' => '',
//     ];

//     $get_crud = [
//         'update' => '編集',
//         'create' => '新規作成',
//         '' => '',
//     ];

//     $first_url = substr($url['filename'], 0, 8);
//     $first_button_name = $first_filename[($first_url)];

//     $second_url = substr($url['filename'], 8, 12);
//     $second_button_name = $second_filename[($second_url)];

//     $crud = $get_crud[((!empty($_GET['crud']) ? $_GET['crud'] : ''))];

//     return '<button class="button-getpage">'. $first_button_name . $second_button_name . $crud.'</button>';
// }

sql共通化試験的;

// $a = (!empty($_GET['id']) ? ', ' . h($_GET['id']) : '');
// $input_parameters = [(!empty($_POST['content']) ? h($_POST['content']) : NULL), (!empty($_POST['release_date']) ? h($_POST['release_date']) : NULL) . $a ];

// echo '<pre>';
// var_dump($input_parameters);
// echo '</pre>';

//   $model->dbh->prepare($sql)->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
//         $model->dbh->prepare($sql)->bindValue(':release', $_POST['release_date'], PDO::PARAM_STR);
//         call_user_func($_POST['content'], $_POST['release_date'], $_GET['id']);

//         $input_parameters = [(!empty($_POST['content']) ? h($_POST['content']) : NULL),
//         (!empty($_POST['release_date']) ? h($_POST['release_date']) : NULL)
//         ];
//         $model->dbh->prepare($sql)->execute($input_parameters(!empty($_GET['id']) ?', ' . h($_GET['id']) : ''));
