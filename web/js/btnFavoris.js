$('.btnFavoris').click(function () {
    if ($(this).hasClass('btnFavorisTest')) {
        $(this).removeClass('btnFavorisTest')
    } else {
        $(this).addClass('btnFavorisTest')
    }
});


