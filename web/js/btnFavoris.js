$(document).ready(function () {


    $('.addFavorite').click(function () {
        console.log('qdghb');
        type = this.getAttribute('name').split('-');
        $(".btn-show-" + type[1]).addClass("hidden");
        $(".btn-hide-" + type[1]).removeClass("hidden");
        addFavorite(type);
    });
    $('.delFavorite').click(function () {
        type = this.getAttribute('name').split('-');
        $(".btn-show-" + type[1]).removeClass("hidden");
        $(".btn-hide-" + type[1]).addClass("hidden");
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