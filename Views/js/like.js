/////////////////////////////////////
///いいね！用のJavaScript
////////////////////////////////////
$(function () {
    //いいね！がクリックされたとき
    $('.js-like').click(function () {
        // $(this)にはクリックされた要素の情報がオブジェクトで入っている
        const this_obj = $(this);
        const like_id = $(this).data('like-id');
        const like_count_obj = $(this).parent().find('.js-like-count');
        let like_count = Number(like_count_obj.html());

        if (like_id) {
            // いいね！取り消し
            like_count--;
            like_count_obj.html(like_count);
            this_obj.data('like-id', null);

            // いいね！ボタンの色をグレーにする
            $(this).find('img').attr('src', 'img/icon-heart.svg');
        } else {
            // いいね！が付与
            like_count++;
            like_count_obj.html(like_count);
            this_obj.data('like-id', true);
            // いいね！の色を青くする
            $(this).find('img').attr('src', 'img/icon-heart-twitterblue.svg');
        }
    })
})