
<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include_once('../Views/common/head.php');?>
  <title>通知画面　/ Twitterクローン</title>
  <meta name="description" content="ホーム画面です" />
</head>

<body class="home notification text-center">
  <div class="container">
    <!-- サイドメニューの読み込み -->
    <?php include_once('../Views/common/side.php');?>
    <!-- 投稿画面 -->
    <div class="main">
      <div class="main-header">
        <h1>通知</h1>
      </div>

      <div class="ditch"></div>

      <div class="notification-list">
                <?php if (empty($view_notifications)) : ?>
                    <p class="no-result">通知はまだありません。</p>
                <?php else : ?>
                    <?php foreach ($view_notifications as $view_notification) : ?>
                        <div class="notification-item">
                            <div class="user">
                                <img src="<?php echo buildImagePath($view_notification['user_image_name'], 'user'); ?>" alt="">
                            </div>
                            <div class="content">
                                <p><?php echo htmlspecialchars($view_notification['notification_message']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
    </div>
  </div>
  <!-- footerのJSの読み込み -->
  <?php include_once('../Views/common/foot.php');?>


</body>

</html>