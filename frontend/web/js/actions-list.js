$(function () {
    $(document).on('click', '.fall-btn', function (e) {
        e.preventDefault();

        let $btn = $(this);

        $.ajax({
            url: '/apple/fall',
            type: 'get',
            data: {
                id: $btn.data('id')
            },
            success: function () {
                $.pjax.reload({container: '#apples-list'});
            }
        });
    });

    let eatAppleId;

    $(document).on('click', '.eat-btn', function () {
        eatAppleId = $(this).data('id');

        $('#eat-modal').modal('show');
    });

    $(document).on('click', '#confirm-eat-btn', function () {
        $.ajax({
            url: '/apple/eat',
            type: 'post',
            data: {
                id: eatAppleId,
                size: $('#apple-eat-size').val()
            },
            success: function () {
                $('#eat-modal').modal('hide');
                $.pjax.reload({container: '#apples-list'});
            }
        });
    });
});
