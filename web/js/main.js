/*
$(window).on('scroll', function () {
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 20) {
        $('#header').stop().animate({height: "170"},5);

        $('#titleHeader').stop().fadeOut(50);
    }
    else {
        $('#header').stop().animate({height: "400"},5);

        $('#titleHeader').stop().fadeIn(50);
    }
});
*/

/*
$("input:checkbox").click(function() {

    var bol = $("input:checkbox:checked").length >= 3;
    $("input:checkbox").not(":checked").attr("disabled",bol);

});
*/



$(document).ready(function () {



    //Modal de connection
    $('#formConnect').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });

    $("textarea").attr("maxlength", 1200);

    //Swiper
    var swiper = new Swiper ('.swiper-container', {
        // Optional parameters
        loop: true,
        spaceBetween: 30,
        hashNavigation: {
            watchState: true
        },

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },

        // And if we need scrollbar
        scrollbar:{
            el: '.swiper-scrollbar'
        }
    });

    //CAROUSSEL
    $('#myCarousel').carousel({
        interval: 5000
    });


});

function showImg(idimg, img) {
    document.getElementById(idimg).setAttribute('src', img);
}

function hideImg(idimg, img) {
    document.getElementById(idimg).setAttribute('src', img);
}

