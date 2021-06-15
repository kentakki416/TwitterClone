<?php
////////////////////////
///フォローデータを処理
//////////////////////

function createFollow(array $data)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // 接続チェック
    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。:'.$mysqli->connect_error."\n";
        exit;
    }

    // SQLを作成
    $query = 'INSERT INTO follows (follow_user_id, followed_user_id) VALUES (?, ?)';
    $statement = $mysqli->prepare($query);

    // プレースホルダーに値をセット
    $statement->bind_param('ii', $data['follow_user_id'], $data['followed_user_id']);

    if ($statement->execute()) {
        // 結果をIDで取得
        $response = $mysqli->insert_id;
    } else {
        $response = false;
        echo 'エラーメッセージ：'. $mysqli->error."\n";
    }

    $statement->close();
    $mysqli->close();
    return $response;
}

function deleteFollow(array $data)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // 接続チェック
    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。:'.$mysqli->connect_error."\n";
        exit;
    }

    // 更新日時
    $data['updated_at'] = date('Y-m-d H:i:s');
    // 更新のSQLを作成
    $query = 'UPDATE follows SET status = "deleted", updated_at = ? WHERE id = ? AND follow_user_id = ?';
    $statement = $mysqli->prepare($query);

    $statement->bind_param('sii', $data['updated_at'], $data['follow_id'], $data['follow_user_id']);

    $response = $statement->execute();

    if ($response === false) {
        echo 'エラーメッセージ：'. $mysqli->error. "\m";
    }

    $statement->close();
    $mysqli->close();

    return $response;

}