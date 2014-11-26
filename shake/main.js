/**
 * Created by Limbo on 2014/11/25.
 */


var $elem = $('#background');
var height = $elem.height() - $(window).height();

var prev = -1;
var time = 0;
var currentIndex = 0;
var colorList = ['#ffffff', '#fde0dc', '#f9bdbb', '#f69988', '#f36c60', '#e84e40', '#e51c23', '#dd191d', '#d01716'];
var s = 0;
var range = 0;
var q = 0;

var handleOritation = function (e) {
    var alpha = e.alpha;
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

                if (deltaTime < 200) {
                    deltaTime = 200;
                } else if (deltaTime > 800) {
                    deltaTime = 800;
                }
                deltaTime -= 200;
                //console.log(deltaTime);
                $elem.stop().animate({
                    top: -(600 - deltaTime) / 600 * height
                }, 1500);

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

var handleMotion = function (e) {
    var delta = Math.abs(Math.floor(e.rotationRate.gamma));

    if (prev != -1) {
        if (delta  <= 2) {
            var curTime = new Date().getTime();
            var deltaTime = curTime - time;
            time = curTime;
            if (deltaTime > 52) {
                elem.innerHTML += '<div>' + deltaTime + '</div>';
            }
        }
    } else {
        prev = delta;
        time = new Date().getTime();
    }
};

window.onload = function () {
    window.addEventListener('deviceorientation', handleOritation, true);
};