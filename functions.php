<?php
// function get_page() {
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
function get_page() {
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