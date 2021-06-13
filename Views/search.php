

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
          <input type="text" class="form-control" placeholder="キーワード検索" name="keyword"
            value="<?php echo htmlspecialchars($view_keyword)?>">
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