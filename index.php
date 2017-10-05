<!doctype html>
<html lang="fr">
<head>
    <?php include "dist/structures/head.php"; ?>
</head>
<body>
<header>
    <?php include "dist/structures/header.php"; ?>
</header>
<?php include "dist/structures/navbar.php"; ?>
<section>
    <div class="container content z-depth-4">
        <div class="row">
            <div class="col s12">
<<<<<<< HEAD
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = "home";
                }

                switch ($page) {
                    case 'home':
                        $linkPage = "home.php";
                        break;
                    case 'amrf':
                        $linkPage = "amrf.php";
                        break;
                    case 'contact':
                        $linkPage = "formContact.php";
                        break;
                    case 'pageMaires' :
                        $linkPage = "pageMaires.php";
                      break;
                    case 'search':
                        $linkPage = "formSearch.php";
                        break;
                    case 'confidentialite':
                        $linkPage = "confidentialite.php";
                        break;
                    case 'legales':
                        $linkPage = "legales.php";
                        break;
                    case 'profil':
                        $linkPage = "profil.php";
                        break;
                    case 'projet':
                        $linkPage = "ficheprojet.php";
                        break;
                    default:
                        $linkPage = "home.php";
                        break;
                }

                include("public/pages/$linkPage");


                ?>
=======
                <?php include "dist/structures/rooter.php"; ?>
>>>>>>> beaabf7f01ed249ae99d5e84a927570f24f3f2af
            </div>
        </div>
    </div>
</section>
<footer class="page-footer teal darken-3">
    <?php include "dist/structures/footer.php"; ?>
</footer>
<<<<<<< HEAD
<div id="formConnect" class="modal modal-fixed-footer">
    <div class="modal-content">
        <div class="container">
            <h4>Connection</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="login" type="text" class="validate">
                    <label for="login">Login</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="mdp" type="password" class="validate">
                    <label for="last_name">Mot de passe</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 center-align">
                    <button class="btn waves-effect waves-light btn modal-trigger" type="submit"
                            name="action">Connection
                    </button>
                </div>
            </div>
        </div>
    </div>


  <!--Import jQuery before materialize.js-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="public/js/jquery.sticky.js"></script>
<script type="text/javascript">


    $(document).ready(function () {
        // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
        $('.modal').modal();
        $('.button-collapse').sideNav();
        $("#navbar").sticky({topSpacing: 0, zIndex:1000});
    });

    $(document).ready(function() {
        $('select').material_select();
        //multiple select items

        $('input.autocomplete').autocomplete({
            //auto complete for departements
            data: {
                "Ain": null,
                "Aisne": null,
                "Allier": null,
                "Alpes de Haute-Provence": null,
                "Alpes-Maritimes": null,
                "Ardeche": null,
                "Ardennes": null,
                "Ariege": null,
                "Aube": null,
                "Aude": null,
                "Aveyron": null,
                "Bas-Rhin": null,
                "Bouches du Rhone": null,
                "Calvados": null,
                "Cantal": null,
                "Charente": null,
                "Charente Maritime": null,
                "Cher": null,
                "Corrèze": null,
                "Corse du Sud": null,
                "Côte d'Or": null,
                "Côtes d'Armor": null,
                "Creuse": null,
                "Deux-Sèvres": null,
                "Dordogne": null,
                "Doubs": null,
                "Drôme": null,
                "Essonne": null,
                "Eure": null,
                "Eure-et-Loir": null,
                "Finistère": null,
                "Gard": null,
                "Gers": null,
                "Gironde": null,
                "Haut-Rhin": null,
                "Haute-Corse": null,
                "Haute-Garonne": null,
                "Haute-Loire": null,
                "Haute-Marne": null,
                "Haute-Saône": null,
                "Haute-Savoie": null,
                "Haute-Vienne": null,
                "Hautes-Alpes": null,
                "Hautes-Pyrénées": null,
                "Hauts-de-Seine": null,
                "Hérault": null,
                "Ille-et-Vilaine": null,
                "Indre": null,
                "Indre-et-Loire": null,
                "Isère": null,
                "Jura": null,
                "Landes": null,
                "Loir-et-Cher": null,
                "Loire": null,
                "Loire-Atlantique": null,
                "Loiret": null,
                "Lot": null,
                "Lot-et-Garonne": null,
                "Lozère": null,
                "Maine-et-Loire": null,
                "Manche": null,
                "Marne": null,
                "Mayenne": null,
                "Meurthe-et-Moselle": null,
                "Meuse": null,
                "Morbihan": null,
                "Moselle": null,
                "Nièvre": null,
                "Nord": null,
                "Oise": null,
                "Orne": null,
                "Paris": null,
                "Pas-de-Calais": null,
                "Puy-de-Dôme": null,
                "Pyrénées-Atlantiques": null,
                "Pyrénées-Orientales": null,
                "Rhône": null,
                "Saône-et-Loire": null,
                "Sarthe": null,
                "Savoie": null,
                "Seine-et-Marne": null,
                "Seine-Maritime": null,
                "Seine-St-Denis": null,
                "Somme": null,
                "Tarn": null,
                "Tarn-et-Garonne": null,
                "Territoire-de-Belfort": null,
                "Val-d'Oise": null,
                "Val-de-Marne": null,
                "Var": null,
                "Vaucluse": null,
                "Vendée": null,
                "Vienne": null,
                "Vosges": null,
                "Yonne": null,
                "Yvelines": null

            },
            limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
            onAutocomplete: function(val) {
                // Callback function when value is autocompleted.
            },
            minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.

            }); // end of autocomplete function
    }); //end of document.ready

    // mentions legales
    $(document).ready(function(){
        $('.collapsible').collapsible();
    });

</script>
=======
<?php include "dist/structures/connect.php"; ?>
<?php include "dist/structures/script.php"; ?>
>>>>>>> beaabf7f01ed249ae99d5e84a927570f24f3f2af
</body>
</html>