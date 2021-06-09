<?php
// エラー表示あり
ini_set('display_errors', 1);
// 日本時間に設定する
date_default_timezone_set('Asia/Tokyo');
// URLディレクトリ設定(相対パスのため省略)
define('HOME_URL', './TwitterClone');

// データベースの接続情報
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'twitter_clone');