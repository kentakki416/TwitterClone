<?php
// 設定関連を読み込み
include_once('../config.php');
// 便利な関数を読み込む
include_once('../util.php');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
<?php include_once('../Views/common/head.php');?>
  <title>つぶやく画面　/ Twitterクローン</title>
  <meta name="description" content="ホーム画面です" />
</head>

<body class="home">
  <div class="container">
  <!-- サイドメニューの読み込み -->
  <?php include_once('../Views/common/side.php');?>
    <!-- 投稿画面 -->
    <div class="main">
    <div class="main-header">
    <h1>つぶやく</h1>
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
      </div>
    </div>
    <!-- footerのJSの読み込み -->
<?php include_once('../Views/common/foot.php');?>


</body>

</html>