<?php

// 設定の読み込み
include_once '../config.php';
//便利な関数読み込み
include_once '../util.php';

// ユーザーデータ操作モデル読み込み
include_once '../Models/users.php';

// ログインチェック
$try_login_result = null;
if(isset($_POST['email']) && isset($_POST['password'])) {
    // ログインチェック実行
    $user = findUserAndCheckPassword($_POST['email'], $_POST['password']);

    if($user) {
        //ログイン成功
        // TODO：ユーザー情報をセッションに保存
        saveUserSession($user);

        // ホーム画面に遷移
        header('Location:./home.php');
    } else {
        // ログイン失敗
        $try_login_result = false;
    }
}


//画面表示(Controllerの変数はそのままViewnに使えるが、分かりやすいように変数に入れなおしている)
$view_try_login_result = $try_login_result;
include_once '../Views/sign-in.php';