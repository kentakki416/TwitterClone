<?php
//////////////////////////////
/////ライクコントローラー
////////////////////////////

// 設定の読み込み
include_once '../config.php';
//便利な関数読み込み
include_once '../util.php';

// いいね！データ操作モデル読み込み
include_once '../Models/likes.php';

$user = getUserSession();
if(!$user) {
    // ログインしていない
    header('HTTP/1.0 404 Not Found');
    exit;
} 

// いいね！する
$like_id = null;
if(isset($_POST['tweet_id'])) {
    $data = [
        'tweet_id' =>$_POST['tweet_id'],
        'user_id' => $_POST['id'],
    ];
    // いいね！登録
    // TODO：後で作成
    $like_id = createLike($data);
}

// いいね！IDが指定されている場合、いいね！を削除
if(isset($_POST['like_id'])) {
    $data = [
        'like_id' => $_POST['like_id'],
        'user_id'=> $user['id'],
    ];
    // いいね！削除関数
    deleteLike($data);
}

// Json形式で結果を返す
$response = [
    'message' => 'sccessful', 
    // いいね！した時に値が入る
    'like_id'=> $like_id,
];
header('Content-Type:application/json; charset="utf-8');
echo json_encode($response);
