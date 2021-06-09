<?php

// 設定の読み込み
include_once '../config.php';
//便利な関数読み込み
include_once '../util.php';
// ユーザー情報をセッションから削除
deleteUserSession();
header('Location:./sign-in.php');