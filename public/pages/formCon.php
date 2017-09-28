<?php


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="../css/contact.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<!--main container -->
<div class="container">
    <!--contact form -->
    <h1>Contact</h1>
    <div class="row">
        <form class="col s12">
            <!--first name/ second name -->
            <div class="row">
                <div class="input-field col s12">
                    <input id="first_name" type="text" class="validate">
                    <label for="first_name">Nom</label>
                </div>
                <div class="input-field col s12">
                    <input id="last_name" type="text" class="validate">
                    <label for="last_name">Prenom</label>
                </div>
            </div>

            <!--email -->
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>

            <!--commune/ CP -->
            <div class="row">
                <div class="input-field col s6">
                    <input id="commune" type="text" class="validate">
                    <label for="commune">Commune</label>
                </div>
                <div class="input-field col s6">
                    <input id="codep" type="number" class="validate">
                    <label for="codep">Code Postal</label>
                </div>
            </div>

            <!--Choice of fonction -->
            <div class="row">
                <h2>Fonction</h2>
                <form action="#">
                    <p class="test">
                        <input name="groupe1" type="radio" id="maire" />
                        <label for="maire">Maire</label>
                        <input name="groupe1" type="radio" id="partnaire" />
                        <label for="partnaire">Partenaire</label>
                        <input name="groupe1" type="radio" id="autre"  />
                        <label for="autre">Autre</label>
                    </p>
                </form>
            </div>

            <!--text area -->
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">textsms</i>
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Votre message</label>
                </div>
            </div>
        </form><!--end of contact form -->

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Modal Header</h4>
                <p>A bunch of text</p>
            </div>
        </div>

        <!--submit button -->
        <button data-target="modal1" class="btn waves-effect waves-light btn modal-trigger" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
        </button>

    </div><!--end of main row -->
</div><!--end of main container -->


    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    <!--message send confirmation -->
    <script>$(document).ready(function(){
            // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
            $('.modal').modal();
        });
    </script>
</body>
</html>