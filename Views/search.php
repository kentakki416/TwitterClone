<?php
// 設定関連を読み込み
include_once('../config.php');
// 便利な関数を読み込む
include_once('../util.php');
///////////////////////////////
//ツイート一覧
//////////////////////////////
$view_tweets = [
  [
    'user_id' => 1,
    'user_name' => 'taro',
    'user_nickname' => '太郎',
    'user_image_name' => 'sample-person.jpg',
    'tweet_body' => '今プログラミングしています',
    'tweet_image_name'=>null,
    'tweet_created_at' => '2021-03-15 14:00:00',
    'like_id' => null,
    'like_count' => 0,
  ],
  [
    'user_id' => 2,
    'user_name' => 'jiro',
    'user_nickname' => '次郎',
    'user_image_name' => null,
    'tweet_body' => 'ワーキングスペースをオープンしました',
    'tweet_image_name'=> 'sample-post.jpg',
    'tweet_created_at' => '2021-05-15 14:00:00',
    'like_id' => 1,
    'like_count' => 1,
  ],
];


?>

<!DOCTYPE html>
<html lang="ja">

<head>
<?php include_once('../Views/common/head.php');?>
  <title>検索画面　/ Twitterクローン</title>
  <meta name="description" content="ホーム画面です" />
</head>

<body class="home search text-center">
  <div class="container">
  <!-- サイドメニューの読み込み -->
  <?php include_once('../Views/common/side.php');?>
    <!-- 投稿画面 -->
    <div class="main">
      <div class="main-header">
        <h1>検索</h1>
      </div>

      <form action="search.php" method="get">
        <div class="search-area">
          <input type="text" class="form-control" placeholder="キーワード検索" name="keyword" value="">
          <button type="submit" class="btn">検索</button>
        </div>
      </form>

      <div class="ditch"></div>
      <?php if (empty($view_tweets)):?>
      <p class="p-3">ツイートがまだありません</p>
      <?php else:?>
      <!-- 投稿一覧 -->
      <div class="tweet-list">
        <?php foreach ($view_tweets as $view_tweet):?>
      <?php include('../Views/common/tweet.php');?>

        <?php endforeach;?>
        <?php endif;?>
      </div>
    </div>
    <!-- footerのJSの読み込み -->
<?php include_once('../Views/common/foot.php');?>


</body>

</html>