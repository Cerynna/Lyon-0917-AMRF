$(document).ready(function(){
    $("#navbar").sticky({topSpacing: 0, zIndex: 1000});

    $('#characterLeft').text('340 caractères restants');
    $('#message').keydown(function () {
        var max = 340;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('Vous avez atteint la limite');
            $('#characterLeft').addClass('red');
            $('#btnSubmit').addClass('disabled');
        }
        else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' caractères restants');
            $('#btnSubmit').removeClass('disabled');
            $('#characterLeft').removeClass('red');
        }
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
