<?php
//////////////////////////////////
///////ホームコントローラー
/////////////////////////////////

// 設定を読み込み
include_once '../config.php';

// 便利な関数を読み込み
include_once '../util.php';

include_once '../Models/follows.php';

// ツイートデータ操作モデルを読み込む
include_once '../Models/tweets.php';

// TODO:ログインしているか
$user = getUserSession();
if (!$user) {
    // ログインしていない
    header('Location:./sign-in.php');
    exit;
}

// 自分がフォローしているユーザーID一覧を取得
$following_user_ids = findFollowingUserIds($user['id']);
// 自分のツイートも表示するために自分のIDも追加
$following_user_ids[] = $user['id'];

// 画面表示
$view_user = $user;
//ツイート一覧
// 自分とフォロワーのツイートのみ表示
$view_tweets = findTweets($user, null, $following_user_ids);

// すべての投稿表示
// $view_tweets = findTweets($user);

include_once '../Views/home.php';
?>

