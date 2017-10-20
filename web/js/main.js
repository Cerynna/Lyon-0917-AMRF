$(document).ready(function () {


    //CAROUSSEL
    $('#myCarousel').carousel({
        interval: 1000
    });

    var clickEvent = false;
    $('#myCarousel').on('click', '.nav a', function () {
        clickEvent = true;
        $('.nav li').removeClass('active');
        $(this).parent().addClass('active');
    }).on('slid.bs.carousel', function (e) {
        if (!clickEvent) {
            var count = $('.nav').children().length - 1;
            var current = $('.nav li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if (count == id) {
                $('.nav li').first().addClass('active');
            }
        }
        clickEvent = false;
    });
    //Limit Checkbox
    var cb = document.querySelectorAll("[class=check-themat]");
    var i = 0,
        l = cb.length;
    for (; i < l; i++)
        cb[i].addEventListener("change", function () {
            if (document.querySelectorAll(":checked").length > 3)
                this.checked = false;
        }, false);
    //NavBar
    $("#navbar").sticky({topSpacing: 0, zIndex: 1000});


    //Modal de connection
    $('#formConnect').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });


});


$(window).on('scroll', function () {
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 20) {
        $('#logo').stop().animate({height: "40px", width: "80px"}, 50);
    }
    else {
        $('#logo').stop().animate({height: "100px", width: "200px"}, 50);
    }
});

function hover(idimg, img) {
    document.getElementById(idimg).setAttribute('src', img);
}
function unhover(idimg,img) {
    document.getElementById(idimg).setAttribute('src', img);
}
