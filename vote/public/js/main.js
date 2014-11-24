/**
 * Created by Limbo on 14-11-23.
 */

$(window).on('load', function() {
    var
        $voteForm = $('#vote-form'),
        $voteBtn = $('.btn-vote');
    $voteBtn.on('click', function(e) {
        e.preventDefault();
        var
            pid = $(this).data('id'),
            name = $(this).data('name');
        $voteForm.find('.chosen-player').html(pid + '&nbsp;' + name);
        $voteForm.find('input[name="pid"]').val(pid);
        $voteForm.find('input[name="username"]').val('');
        $voteForm.find('input[name="password"]').val('');
        $voteForm.find('.error').html('');
        $voteForm.show();
    });


    $voteForm
        .on('click', function(e) {
            e = e.originalEvent;
            if (e.target == e.currentTarget) {
                $(this).hide();
            }
        })
        .on('click', '.close', function() {
            $voteForm.hide();
        })
        .on('click', '.btn-close', function() {
            $voteForm.hide();
        })
        .on('submit', function(e) {
            e.preventDefault();
            $(this).find('.error').html('');
            var $form = $(this).find('form');
            var posting = $.post(
                $form.attr('action'),
                $form.serialize()
            );
            posting
                .done(function(data) {
                    if (data['result'] == 'error') {
                        $voteForm.find('.error').html(data['msg']);
                    } else {
                        window.location.reload();
                    }
                })
                .fail(function() {
                    $voteForm.find('.error').html('网络异常。请重试。');
                });
        });

    $('#switch-user').on('click', function(e) {
        e.preventDefault();
        $(this).remove();
        $voteForm.find('.form-current-info').remove();
        $voteForm.find('.auth-form').show();
    });
});