<?php
// エラー表示あり
ini_set('display_errors', 1);
// 日本時間に設定する
date_default_timezone_set('Asia/Tokyo');
// URLディレクトリ設定(相対パスのため省略)
define('HOME_URL', '');

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
    'tweet_created_at' => '2021-03-15 14:00:00',
    'like_id' => 1,
    'like_count' => 1,
  ]
];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="ホーム画面です" />
  <link rel="icon" href="img\logo-twitterblue.svg" />
  <!-- Bootstrap CSS-->
  <!-- CSS only -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />
  <title>ホーム画面　/ Twitterクローン</title>
</head>

<body class="home">
  <div class="container">
    <div class="side">
      <div class="side-inner">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a href="home.php" class="nav-link">
              <img src="img\logo-twitterblue.svg" alt="" class="icon" />
            </a>
          </li>
          <li class="nav-item">
            <a href="home.php" class="nav-link">
              <img src="img\icon-home.svg" alt="" />
            </a>
          </li>
          <li class="nav-item">
            <a href="search.php" class="nav-link">
              <img src="img\icon-search.svg" alt="" />
            </a>
          </li>
          <li class="nav-item">
            <a href="notification.php" class="nav-link">
              <img src="img\icon-notification.svg" alt="" />
            </a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link">
              <img src="img\icon-profile.svg" alt="" />
            </a>
          </li>
          <li class="nav-item">
            <a href="post.php" class="nav-link">
              <img src="img\icon-post-tweet-twitterblue.svg" alt="" class="post-tweet" />
            </a>
          </li>
          <li class="navitem my-icon">
            <img src="img_uploaded\user\sample-person.jpg" alt="" />
          </li>
        </ul>
      </div>
    </div>
    <!-- 投稿画面 -->
    <div class="main">
      <div class="main-header">
        <h1>ホーム</h1>
      </div>
      <div class="tweet-post">
        <div class="my-icon">
          <img src="img_uploaded\user\sample-person.jpg" alt="" />
        </div>
        <div class="input-area">
          <form action="post.php" method="post" enctype="mulitipart/form-data">
            <textarea name="body" placeholder="いまどうしてる？" maxlength="140"></textarea>
            <div class="bottom-area">
              <div class="mb-0">
                <input type="file" name="image" class="form-control form-control-sm" />
              </div>
              <button class="btn" type="submit">つぶやく</button>
            </div>
          </form>
        </div>
      </div>
  
      <div class="ditch"></div>
      <?php if(empty($view_tweets)):?>
      <p class="p-3">ツイートがまだありません</p>
      <?php else:?>
      <!-- 投稿一覧 -->
      <div class="tweet-list">
        <?php foreach($view_tweets as $view_tweet):?>
        <div class="tweet">
          <div class="user">
            <a href="profile.php?user_id=1">
              <img src="img_uploaded\user\sample-person.jpg" alt="">
            </a>
          </div>
          <div class="content">
            <div class="name">
              <a
                href="profile.php?user_id=<?php echo $view_tweet['user_id'];?>">
                <span class="nickname">
                  <?php echo $view_tweet['user_nickname'];?>
                </span>
                <span class="user_name">
                  <?php echo $view_tweet['user_name'];?>・<?php echo $view_tweet['tweet_created_at'];?>
                </span>
              </a>
            </div>
            <p>
              <?php echo $view_tweet['tweet_body'];?>
            </p>
            <?php if(isset($view_tweet['user_image_name'])):?>
              <img src="img_uploaded/tweet/sample-post.jpg" alt="" class="post-image">
            <?php endif;?>
            <div class="icon-list">
              <div class="like">
                <?php
              if (isset($view_tweet['like_id'])) {
                //いいね！している場合
                echo '<img src="img\icon-heart-twiiterblue.svg" alt="" />';
              } else {
                echo '<img src="img\icon-heart.svg" alt="" />';
              }
              ?>

              </div>
              <div class="like-count"><?php echo $view_tweet['like_count'];?></div>
            </div>
          </div>
        </div>
        <?php endforeach;?>

        <div class="tweet">
          <div class="user">
            <a href="profile.php?user_id=1">
              <img src="img\icon-default-user.svg" alt="">
            </a>
          </div>
          <div class="content">
            <div class="name">
              <a href="profile.php?user_id=1">
                <span class="nickname">次郎</span>
                <span class="user_name">＠jiro -24日前</span>
              </a>
            </div>
            <p>コワーキングスペースをオープンしました！</p>
            <img src="img_uploaded\tweet\sample-post.jpg" alt="" class="post-image">
            <div class="icon-list">
              <div class="like">
                <img src="img\icon-heart-twitterblue.svg" alt="" />
              </div>
              <div class="like-count">１</div>
            </div>
          </div>
        </div>
      </div>
    </div>


</body>

</html>