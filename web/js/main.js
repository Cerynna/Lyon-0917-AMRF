$(document).ready(function () {
    $("#navbar").sticky({topSpacing: 0, zIndex: 1000});

// slider HomePage
    var $slide = $('.slide'),
        $slideGroup = $('.slide-group'),
        $bullet = $('.bullet');


    var slidesTotal = ($slide.length - 1),
        current = 0,
        isAutoSliding = true;

    $bullet.first().addClass('current');

    var clickSlide = function () {
        //stop auto sliding
        window.clearInterval(autoSlide);
        isAutoSliding = false;

        var slideIndex = $bullet.index($(this));

        updateIndex(slideIndex);
    };

    var updateIndex = function (currentSlide) {
        if (isAutoSliding) {
            if (current === slidesTotal) {
                current = 0;
            } else {
                current++;
            }
        } else {
            current = currentSlide;
        }

        $bullet.removeClass('current');
        $bullet.eq(current).addClass('current');

        transition(current);
    };

    var transition = function (slidePosition) {
        $slideGroup.animate({
            'top': '-' + slidePosition + '00%'
        });
    };

    $bullet.on('click', clickSlide);

    var autoSlide = window.setInterval(updateIndex, 5000);
});  // end slider Homepage

$('#formConnect').on('shown.bs.modal', function () {
    $('#myInput').focus()

});


$(window).on('scroll', function () {
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 20) {
        $('#logo').stop().animate({height: "40px", width: "80px"},50);
    }
    else {
        $('#logo').stop().animate({height: "100px", width: "200px"},50);
    }
});