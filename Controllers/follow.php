<?php
//////////////////////////////
/////フォローコントローラー
////////////////////////////

// 設定の読み込み
include_once '../config.php';
//便利な関数読み込み
include_once '../util.php';

// いいね！データ操作モデル読み込み
include_once '../Models/follows.php';

// 通知データ操作モデル読み込み
include_once '../Models/notifications.php';

$user = getUserSession();
if(!$user) {
    // ログインしていない
    header('HTTP/1.0 404 Not Found');
    exit;
} 

// フォローする
$follow_id = null;
if(isset($_POST['followed_user_id'])) {
    $data = [
        'followed_user_id' =>$_POST['followed_user_id'],
        'follow_user_id' => $user['id'],
    ];
    // フォロー登録
    $follow_id = createFollow($data);

    // 通知を登録
    $data_notification = [
        'recieved_user_id' => $_POST['followed_user_id'],
        'sent_user_id' => $user['id'],
        'message' => 'フォローされました。',
    ];
    createNotification($data_notification);

}

// フォローIDが指定されている場合、フォローを削除
if(isset($_POST['follow_id'])) {
    $data = [
        'follow_id' => $_POST['follow_id'],
        'follow_user_id'=> $user['id'],
    ];
    // フォロー削除関数
    deleteFollow($data);
}

// Json形式で結果を返す
$response = [
    'message' => 'sccessful', 
    // フォローした時に値が入る
    'follow_id'=> $follow_id,
];
// ブラウザにレスポンスがJSON形式であることを伝える
header('Content-Type:application/json; charset=utf-8');
echo json_encode($response);
