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


$("input.check-limit").click(function() {
    var bol = $("input.check-limit:checked").length >= 3;
    $("input.check-limit").not(":checked").attr("disabled",bol);
});

var last_valid_selection = null;

$('.select-limit').change(function(event) {

    if ($(this).val().length > 5) {

        $(this).val(last_valid_selection);
    } else {
        last_valid_selection = $(this).val();
    }
});


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

