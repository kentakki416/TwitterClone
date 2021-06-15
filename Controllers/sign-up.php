<?php
///////////////////////////
/////サインアップコントローラー
//////////////////////////

// 設定を読み込む
include_once '../config.php';
// ユーザーデータ操作モデルを読み込む
include_once '../Models/users.php';

// エラーメッセージ格納用
$error_message = [];

// ユーザー作成
if (isset($_POST['nickname']) && isset($_POST['name'])&& isset($_POST['email']) && isset($_POST['password'])) {
    $data = [
        'nickname' => (string)$_POST['nickname'],
        'name'=> (string)$_POST['name'],
        'email'=> (string)$_POST['email'],
        'password'=> (string)$_POST['password'],
    ];

    // バリデーション

    //文字数制限（すべての入力に対して行う）
    $length = mb_strlen($data['nickname']);
    if ($length <1 || $length > 50) {
        $error_message[] = 'ニックネームは1~50文字にしてください';
    }

    // メールアドレス
    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $error_message[] = 'メールアドレスが不正です';
    }

    // // 既存チェック
    // if (findUser($data['email'])) {
    //     $error_message[] = 'このメールアドレスはすでに使用されています';
    // }

    // if (findUser($data['name'])) {
    //     $error_message[] = 'このユーザー名はすでに使用されています';
    // }

    if(!$error_message) {
        
    if(createUser($data)) {
        //ログイン画面に移動
        header('Location: ../Controllers/sign-in.php');
        exit;
    }

    }


}

include_once '../Views/sign-up.php';
