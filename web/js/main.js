$(document).ready(function () {

    $("textarea").attr( "maxlength", 1200 );



//NavBar
    $("#navbar").sticky({topSpacing: 0, zIndex: 4});

    //CAROUSSEL
    $('#myCarousel').carousel({
        interval: 3000
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



    //Modal de connection
    $('#formConnect').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });


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

function showImg(idimg, img) {
    document.getElementById(idimg).setAttribute('src', img);
}
function hideImg(idimg,img) {
    document.getElementById(idimg).setAttribute('src', img);
}

