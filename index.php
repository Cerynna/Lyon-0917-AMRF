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
                <li><a href="?page=home">Acceuil</a></li>
                <li><a href="#">AMRF</a></li>
                <li><a href="?page=contact">Contact</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="#">Acceuil</a></li>
                <li><a href="#">AMRF</a></li>
                <li><a href="#">Contact</a></li>
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
                    case 'monEspace':
                        $linkPage = "monEspace.php";
                        break;
                    case 'contact':
                        $linkPage = "formContact.php";
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
                    <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
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
</body>
</html>
