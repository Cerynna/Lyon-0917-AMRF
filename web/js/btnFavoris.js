$(document).ready(function () {


    $('#addFavorite').click(function () {
        type = this.getAttribute('name').split('-');
        $("#addFavorite").addClass("hidden");
        $("#btnFavorisDel").removeClass("hidden");
        addFavorite(type);
    })
    $('#btnFavorisDel').click(function () {
        type = this.getAttribute('name').split('-');
        $("#btnFavorisDel").addClass("hidden");
        $("#addFavorite").removeClass("hidden");
        delFavorite(type);
    })



});

function addFavorite(type) {
    $.ajax({
        type: 'POST',
        url: '/addFavorite/' + type[0] + '/'+ type[1],
        error: function () {
            alert('votre favoris n\'a pas pu être ajouté');
            $("#btnFavorisDel").addClass("hidden");
            $("#addFavorite").removeClass("hidden");
        }
    });

}

function delFavorite(type) {
    $.ajax({
        type: 'POST',
        url: '/delFavorite/' + type[0] + '/' + type[1],
        error: function () {
            alert('votre favoris n\'a pas pu être supprimé');
            $("#btnFavorisDel").addClass("hidden");
            $("#addFavorite").removeClass("hidden");
        }
    });
}