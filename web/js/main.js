$(document).ready(function () {

    $("textarea").attr( "maxlength", 1200 );



//NavBar
    $("#navbar").sticky({topSpacing: 140, zIndex: 5});
    $("#laBar").sticky({topSpacing: 0, zIndex: 4});
    $("#barRecherche").sticky({topSpacing: 20, zIndex: 4});

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


function showImg(idimg, img) {
    document.getElementById(idimg).setAttribute('src', img);
}
function hideImg(idimg,img) {
    document.getElementById(idimg).setAttribute('src', img);
}

