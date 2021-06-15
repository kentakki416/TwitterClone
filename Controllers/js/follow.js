/////////////////////////////////////
///フォロー用のJavaScript
////////////////////////////////////
$(function () {
    $('.js-follow').click(function () {
        const this_obj = $(this);
        const followed_user_id = $(this).data('followed-user-id');
        const follow_id = $(this).data('follow-id');

        if (follow_id) {
            // フォローを取り出し
            $.ajax({
                url: 'follow.php',
                type: 'POST',
                data: {
                    'follow_id': follow_id
                },
                timeout: 10000
            })
                //取り消し成功
                .done(() => {
                    // フォローボタンを白にする
                    this_obj.addClass('btn-reverse');
                    // フォローボタンの門本変更
                    this_obj.text('フォローする');
                    // フォローIDの解除
                    this_obj.data('follow-id', null);
                })
                // 取り消し失敗
                .fail((data) => {
                    alert('処理中にエラー発生');
                    console.log(data);
                });
        } else {
            // フォローする
            $.ajax({
                url: 'follow.php',
                type: 'POST',
                data: {
                    'followed_user_id': followed_user_id
                },
                timeout: 10000
            })
                //フォロー成功
                .done((data) => {
                    // フォローボタンを青にする
                    this_obj.removeClass('btn-reverse');
                    // フォローボタンの門本変更
                    this_obj.text('フォローを外す');
                    // フォローIDの解除
                    this_obj.data('follow-id', data['follow_id']);
                })
                // 取り消し失敗
                .fail((data) => {
                    alert('処理中にエラー発生');
                    console.log(data);
                });
        }
    })
});