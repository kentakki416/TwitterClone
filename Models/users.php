<?php
//////////////////////////////////////
////ユーザーデータを処理
/////////////////////////////////////

function createUser(array $data) {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // 接続チェック
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました：'.$mysqli->connect_error."\n";
        exit;
    }

    // 新規登録のSQLを生成
    $query = 'INSERT INTO users (email, name, nickname, password) VALUES (?, ?, ?, ?)';
    $statement = $mysqli->prepare($query);

    // パスワードをハッシュ化する
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    // ?の部分にセットする内容
    // 第一引数のｓは変数の方を指定（s=string)
    $statement->bind_param('ssss', $data['email'], $data['name'], $data['nickname'], $data['password']);

    // 処理を実行
    $response = $statement->execute();
    if($response === false) {
        echo 'エラーメッセージ:'.$mysqli->error ."\n";
    }

    // 接続を解法
    $statement->close();
    $mysqli->close();

    return $response;
}

function findUserAndCheckPassword(string $email, string $password) 
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // 接続チェック
    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。:'.$mysqli->connect_error."\n";
        exit;
    }

    $email = $mysqli->real_escape_string($email);

    // クエリを作成（外部からの入力は必ず、エスケープと「"'    '"」でかこむ
    $query = 'SELECT * FROM users WHERE email = "'.$email.'"';

    // SQLの実行
    $result = $mysqli->query($query);
    if (!$result) {
        // MySQLの処理中にエラー
        echo 'エラーメッセージ：'.$mysqli->error."\n";
        $mysqli->close();
        return false;
    }

    // ユーザー情報を取得(連想配列で取得）
    $user = $result->fetch_array(MYSQLI_ASSOC);
    if (!$user) {
        // ユーザーが存在しない
        $mysqli->close();
        return false;
    }

    // パスワードチェック
    // password_verify()でパスワードがハッシュ化されたパスワードと一致するかを調べる
    if(password_verify($password, $user['password'])) {
        // パスワード不一致
        $mysqli->close();
        return false;
    }

    $mysqli->close();
    return $user;


}