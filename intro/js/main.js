/**
 * Created by Limbo on 2014/11/17.
 */
var swipe = new Swipe(document.getElementById('slider'), {
    speed: 400,
    disableScroll: false,
    stopPropagation: false,
    continuous: false,
    callback: function (index, elem) {
    },
    transitionEnd: function (index, elem) {
    }
});

$(window).load(function () {
    $('.loading').remove();
});

(function () {
    if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
        var
            startX = 0,
            movoX = 0,
            isTouchEnabled = true,
            duration = 1000,
            $intro = $(".intro"),
            index = 1;


        var slideIn = function () {
            $('.current').each(function () {
                var $prev = null;
                var $next = null;
                if ($(this).hasClass('intro-img-left')) {
                    $prev = $(this).next('.intro-img-left.prev');
                    $next = $(this).prev('.intro-img-left.next');

                    $(this)
                        .animate({
                            opacity: 0,
                            left: -300,
                            top: -100,
                            rotation: 360
                        }, {
                            step: function (now, fx) {
                                if (fx.prop == 'opacity') {
                                    var transform = 'rotate(' + 360 * (1 - now) + 'deg)';
                                    $(this).css({
                                        '-webkit-transform': transform,
                                        '-moz-transform': transform,
                                        'transform': transform
                                    });

                                    var filter = 'brightness(' + (2 - now) / 2 + ')';
                                    $next.css({
                                        '-webkit-filter': filter,
                                        'filter': filter
                                    });
                                }
                            },
                            duration: duration
                        }, 'linear');

                    $prev.removeClass('prev');
                    $(this).removeClass('current').addClass('prev');
                    $next.removeClass('next').addClass('current');
                    $next.prev('.intro-img-left').addClass('next');
                } else if ($(this).hasClass('intro-img-right')) {
                    $prev = $(this).next('.intro-img-right.prev');
                    $next = $(this).prev('.intro-img-right.next');

                    $(this)
                        .animate({
                            opacity: 0,
                            right: -400,
                            top: 200
                        }, {
                            step: function (now, fx) {
                                if (fx.prop == 'opacity') {
                                    $(this).css('-webkit-transform', 'rotate(' + 360 * now + 'deg)');
                                    $(this).css('-moz-transform', 'rotate(' + 360 * now + 'deg)');
                                    $(this).css('transform', 'rotate(' + 360 * now + 'deg)');
                                    $next.css('-webkit-filter', 'brightness(' + (2 - now) / 2 + ')');
                                    $next.css('filter', 'brightness(' + (2 - now) / 2 + ')');
                                }
                            },
                            duration: duration
                        }, 'linear');

                    $prev.removeClass('prev');
                    $(this).removeClass('current').addClass('prev');
                    $next.removeClass('next').addClass('current');
                    $next.prev('.intro-img-right').addClass('next');
                } else if ($(this).hasClass('intro-word-item')) {
                    $next = $('.intro-word-item.next');

                    $(this)
                        .animate({
                            left: -20,
                            opacity: 0
                        }, duration);
                    $next
                        .css({
                            left: 40
                        })
                        .animate({
                            left: 20,
                            opacity: 1
                        }, duration);

                    $prev = $(this).prev('.intro-word-item.prev');
                    $next = $(this).next('.intro-word-item.next');
                    $prev.removeClass('prev');
                    $(this).removeClass('current').addClass('prev');
                    $next.removeClass('next').addClass('current');
                    $next.next('.intro-word-item').addClass('next');
                }
            });
        };

        var slideOut = function () {
            $('.current').each(function () {
                var $prev = null;
                var $next = null;
                if ($(this).hasClass('intro-img-left')) {
                    $prev = $(this).next('.intro-img-left.prev');
                    $next = $(this).prev('.intro-img-left.next');

                    $prev
                        .animate({
                            opacity: 1,
                            left: 0,
                            top: '15%'
                        }, {
                            step: function (now, fx) {
                                if (fx.prop == 'opacity') {
                                    $(this).css('-webkit-transform', 'rotate(' + 360 * (1 - now) + 'deg)');
                                    $(this).css('-moz-transform', 'rotate(' + 360 * (1 - now) + 'deg)');
                                    $(this).css('transform', 'rotate(' + 360 * (1 - now) + 'deg)');
                                    $next.css('-webkit-filter', 'brightness(' + (2 - now) / 2 + ')');
                                    $next.css('filter', 'brightness(' + (2 - now) / 2 + ')');
                                }
                            },
                            duration: duration
                        }, 'linear');

                    $next.removeClass('next');
                    $(this).removeClass('current').addClass('next');
                    $prev.removeClass('prev').addClass('current');
                    $prev.next('.intro-img-left').addClass('prev');
                } else if ($(this).hasClass('intro-img-right')) {
                    $prev = $(this).next('.intro-img-right.prev');
                    $next = $(this).prev('.intro-img-right.next');

                    $prev
                        .animate({
                            opacity: 1,
                            right: 0,
                            top: '24%'
                        }, {
                            step: function (now, fx) {
                                if (fx.prop == 'opacity') {
                                    $(this).css('-webkit-transform', 'rotate(' + 360 * now + 'deg)');
                                    $(this).css('-moz-transform', 'rotate(' + 360 * now + 'deg)');
                                    $(this).css('transform', 'rotate(' + 360 * now + 'deg)');
                                    $next.css('-webkit-filter', 'brightness(' + (2 - now) / 2 + ')');
                                    $next.css('filter', 'brightness(' + (2 - now) / 2 + ')');
                                }
                            },
                            duration: duration
                        }, 'linear');

                    $next.removeClass('next');
                    $(this).removeClass('current').addClass('next');
                    $prev.removeClass('prev').addClass('current');
                    $prev.next('.intro-img-right').addClass('prev');
                } else if ($(this).hasClass('intro-word-item')) {
                    $prev = $(this).prev('.intro-word-item.prev');
                    $next = $(this).next('.intro-word-item.next');
                    $(this)
                        .animate({
                            left: 40,
                            opacity: 0
                        }, duration);
                    $prev
                        .animate({
                            left: 20,
                            opacity: 1
                        }, duration);

                    $next.removeClass('next');
                    $(this).removeClass('current').addClass('next');
                    $prev.removeClass('prev').addClass('current');
                    $prev.prev('.intro-word-item').addClass('prev');
                }
            });
        };

        $intro
            .on('touchstart', function (e) {
                e.stopPropagation();
                var touch = e.originalEvent.touches[0];
                startX = touch.pageX;
            })
            .on('touchmove', function (e) {
                var touch = e.originalEvent.touches[0];
                movoX = touch.pageX;
            })
            .on('touchend', function (e) {
                if (isTouchEnabled) {
                    isTouchEnabled = false;

                    var deltaX = movoX - startX;
                    moveX = startX = 0;
                    if (deltaX < -20) {
                        if (index == 9) {
                            swipe.next();
                        } else {
                            slideIn();
                            index += 1
                        }

                    } else if (deltaX > 20) {
                        if (index == 1) {
                            swipe.prev();
                        } else {
                            slideOut();
                            index -= 1;
                        }
                    }
                    setTimeout(function () {
                        isTouchEnabled = true;
                    }, duration);
                }
            });
    }

}());
