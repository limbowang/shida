/**
 * Created by Limbo on 2014/11/25.
 */


var $elem = $('#background').find('img');
var height = $elem.height() - $(window).height();

var prev = -1;
var time = 0;
var currentIndex = 0;
var colorList = ['#ffffff', '#fde0dc', '#f9bdbb', '#f69988', '#f36c60', '#e84e40', '#e51c23', '#dd191d', '#d01716'];
var s = 0;
var range = 0;
var q = 0;

var handleOrientation = function (e) {
    e = e.originalEvent;
    var alpha = e.alpha;
    console.log(e);
    if (prev != -1) {
        var d = Math.abs(Math.floor(alpha - prev));
        if (d > 180)
            d = 360 - d;
        if (d > 5) {
            var curRange = Math.abs(Math.floor(alpha - s));
            if (curRange > 180) {
                curRange = 360 - curRange;
            }
            //elem.innerHTML += '<div>' + (curTime - time) + '</div>';
            if (range > curRange) {
                range = 0;
                prev = -1;
                s = alpha;
                //document.body.style.backgroundColor = colorList[currentIndex];
                var curTime = new Date().getTime();
                var dt = curTime - time;
                var deltaTime = q > dt ? q : dt;

                var left = 400, right = 600;

                if (deltaTime < left) {
                    deltaTime = left;
                } else if (deltaTime > right) {
                    deltaTime = right;
                }
                deltaTime -= left;
                //console.log(deltaTime);
                $elem.stop().animate({
                    top: -(right - left - deltaTime) / (right - left) * height
                }, 1100);

                time = curTime;
                q = dt;
            } else {
                range = curRange;
            }
        }
        prev = alpha;
    } else {
        time = new Date().getTime();
        s = prev = alpha;
    }
};

$(window).on('deviceorientation', handleOrientation);

$elem.on('touchstart', function(e) {
    e.preventDefault();
});