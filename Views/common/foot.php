<script>
      document.addEventListener('DOMContentLoaded', function() {
        $('.js-popover').popover({
          //ポップオーバーを追加する要素を指定します。通常は必要ないが、インプットグループ
          // やボタングループ等の中でポップオーバーを使用する際に、親要素のスタイルがポップオーバーに影響を
          // 与える場合にcontainerに'body'を指定することでその問題を回避できる
          container: 'body'
        })
      }, false);
    </script>