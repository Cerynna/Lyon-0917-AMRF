

$(document).ready(function () {
//NavBar
    $("#navbar").sticky({topSpacing: 160, zIndex: 6});
    $("#laBar").sticky({topSpacing: 0, zIndex: 4});
    $("#sticky2").sticky({topSpacing: 20, zIndex: 6,widthFromWrapper: false, center: true});
    /*$("#sticky3").sticky({topSpacing: 20, zIndex: 6, center: false});*/

    //CAROUSSEL
    $('#myCarousel').carousel({
        interval: 3000
    });

    $("textarea").attr( "maxlength", 1200 );x

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



function showImg(idimg, img) {
    document.getElementById(idimg).setAttribute('src', img);
}
function hideImg(idimg,img) {
    document.getElementById(idimg).setAttribute('src', img);
}

