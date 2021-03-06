<?php
////////////////////////////////////
//便利な関数
//////////////////////////////////
/**
 * 画像ファイル名から画像のURLを生成
 *
 * @param string $name 画像ファイル名
 * @param string $type　$type　ユーザー画像かツイート画像
 * @return void
 */
function buildImagePath(string $name = null, string $type)
{
    if ($type === 'user' && !isset($name)) {
        return 'img/icon-default-user.svg';
    }

    return 'img_uploaded/'.$type.'/'.htmlspecialchars($name);
}

function convertToDayTimeAgo(string $datetime)
{
    $unix = strtotime($datetime);
    $now = time();
    $diff_sec = $now - $unix;

    if ($diff_sec < 60) {
        $time = $diff_sec;
        $unit = '秒前';
    } elseif ($diff_sec < 3600) {
        $time = $diff_sec / 60;
        $unit = '分前';
    } elseif ($diff_sec < 86400) {
        $time = $diff_sec / 3600;
        $unit = '時間前';
    } elseif ($diff_sec < 2764800) {
        $time = $diff_sec / 86400;
        $unit = '日前';
    } else {
        if (date('Y') != date('Y', $unix)) {
            $time = date('Y年n月j日', $unix);
        } else {
            $time = date('n月j日', $unix);
        }

        return $time;
    }

    return (int)$time . $unit;
}

function saveUserSession(array $user)
{
    //セッションを開始していない場合
    if (session_status() === PHP_SESSION_NONE) {
        // セッション開始（session_start()の前に処理を記述するとエラーになるので注意）
        session_start();
    }

    $_SESSION['USER'] = $user;
}

function deleteUserSession()
{
      //セッションを開始していない場合
    if (session_status() === PHP_SESSION_NONE) {
        // セッション開始（session_start()の前に処理を記述するとエラーになるので注意）
        session_start();
    }
    
    // セッションのユーザー情報を削除
    unset($_SESSION['USER']);
}

function getUserSession() 
{
    if (session_status() === PHP_SESSION_NONE) {
        // セッション開始（session_start()の前に処理を記述するとエラーになるので注意）
        session_start();
    }

    if (!isset($_SESSION['USER'])) {
        // セッションにユーザー情報がない
        return false;

    
    }   

    $user = $_SESSION['USER'];

    // 画像のファイル名からファイルのURLを取得
    if (!isset($user['image_name'])) {
        $user['image_name'] = null;
    }
    $user['image_path'] = buildImagePath($user['image_name'], 'user');

    return $user;
        
    }

    function uploadImage(array $user, array $file, string $type) 
    {

        // 画像のファイル名から拡張子を取得
        $image_extention = strrchr($file['name'], '.');

        // 画像のファイル名を生成
        $image_name = $user['id'].'_'.date('YmdHis').$image_extention;

        // 保存先のディレクトリ
        $directory = './img_uploaded/'.$type.'/';

        // 画像のパス
        $image_path = $directory.$image_name;

        // 画像を設置
        move_uploaded_file($file['tmp_name'], $image_path);

        // 画像ファイルかチェック
        if (exif_imagetype($image_path)) {
            return $image_name;
        }

        // 画像ファイル以外の場合
        echo '選択されたファイルが画像ではないため処理を停止しました';
        exit;

    }
