<!doctype html>
<html lang="fr">
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="public/css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="public/css/style.css" media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<header>
    <div id="header">
        <div class="connect"><a class="waves-effect waves-light btn modal-trigger teal darken-3" href="#formConnect">Connection</a>
        </div>
        <h1>Le Wiki des Maires</h1>
    </div>

</header>
<div id="navbar">
    <nav class="teal darken-3">
        <div class="nav-wrapper container">
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="?page=home">Accueil</a></li>
                <li><a href="?page=amrf">AMRF</a></li>
                <li><a href="?page=contact">Contact</a></li>
                <li><a href="?page=search">Recherche</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="?page=home">Accueil</a></li>
                <li><a href="#">AMRF</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="?page=search">Recherche</a></li>
            </ul>
        </div>
    </nav>

</div>
<section>
    <div class="container content z-depth-4">
        <div class="row">
            <div class="col s12">
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
                    default:
                        $linkPage = "home.php";
                        break;
                }

                include("public/pages/$linkPage");


                ?>
            </div>
        </div>
    </div>
</section>
<footer class="page-footer teal darken-3">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer
                    content.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="?page=confidentialite">Déclaration de confidentialité</a></li>
                    <li><a class="grey-text text-lighten-3" href="?page=legales">Conditions d'utilisation</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
</footer>
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
            $("#navbar").sticky({topSpacing: 0, zIndex: 1000});
        });
    </script>
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
</body>
</html>