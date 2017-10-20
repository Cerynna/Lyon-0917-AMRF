$(document).ready(function(){

    $("#navbar").sticky({topSpacing: 0, zIndex: 1000});





    $('#formConnect').on('shown.bs.modal', function () {
        $('#myInput').focus()
    })
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


