/////////////////////////////////////
///いいね！用のJavaScript
////////////////////////////////////
$(function () {
    //いいね！がクリックされたとき
    $('.js-like').click(function () {
        // $(this)にはクリックされた要素の情報がオブジェクトで入っている
        const this_obj = $(this);
        const tweet_id = $(this).data('tweet-id');
        //data()でHTMLのdata属性を所得（引数なしだとすべてのdata属性を、引数ありは指定したdata属性を）、設定（引数に（属性名、値）で指定する）、変更（設定方法と同じ）ができる。
        const like_id = $(this).data('like-id');
        // .parent()で要素の親要素を取得する,.findは要素の子要素の中から該当する子要素を取得する。
        const like_count_obj = $(this).parent().find('.js-like-count');
        // .html()で要素の取得（引数なし）、追加（引数は文字列など）、書き換え（すでに配置されているＨＴＭＬはその要素の中身すべて上書きされる）を行う
        let like_count = Number(like_count_obj.html());

        if (like_id) {
            // いいね！取り消し
            $.ajax({
                url: 'like.php',
                type: 'POST',
                data: {
                    'like_id': like_id
                },
                timeout: 10000
            })
                // 取り消し成功時
                .done(() => {
                    like_count--;
                    like_count_obj.html(like_count);
                    this_obj.data('like-id', null);

                    // いいね！ボタンの色をグレーにする
                    $(this).find('img').attr('src', 'img/icon-heart.svg');

                })
                .fail((data) => {
                    alert('処理中にエラーが発生しました');
                    console.log(data);
                })

        } else {
            // いいね！が付与
            $.ajax({
                url: 'like.php',
                type: 'POST',
                data: {
                    'tweet_id': tweet_id
                },
                timeout: 10000
            })
                .done((data) => {
                    like_count++;
                    like_count_obj.html(like_count);
                    this_obj.data('like-id', data['like_id']);
                    // いいね！の色を青くする
                    //attrは任意の要素の任意の属性に対して値を設定/取得できる。
                    $(this).find('img').attr('src', 'img/icon-heart-twitterblue.svg');
                })
                .fail((data) => {
                    alert('処理中にエラーが発生しました');
                    console.log(data);
                })



        }
    })
})