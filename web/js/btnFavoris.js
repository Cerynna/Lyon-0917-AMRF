$('.btnFavoris').click(function () {
    if ($('#btnFavoris').hasClass('hidden')) {
        $('#btnFavoris').removeClass('hidden')
        $('#btnFavorisSelect').addClass('hidden')
    } else {
        $('#btnFavorisSelect').removeClass('hidden')
        $('#btnFavoris').addClass('hidden')
    }
});


