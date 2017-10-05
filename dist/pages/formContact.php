<?php
    if(isset($_POST["submit"])){
    // Checking For Blank Fields..
        if($_POST["first_name"]==""||$_POST["last_name"]==""||$_POST["email"]==""||$_POST["commune"]==""||$_POST["textarea1"]==""){
            echo "Fill All Fields..";
        }else{
    // Check if the "Sender's Email" input field is filled out
            $email=$_POST['email'];
    // Sanitize E-mail Address
            $email =filter_var($email, FILTER_SANITIZE_EMAIL);
    // Validate E-mail Address
            $email= filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$email){
                echo "Invalid Sender's Email";
            }
            else{
                $first_name= $_POST['first_name'];
                $last_name= $_POST['last_name'];
                $commune = $_POST['commune'];
                $textarea1 = $_POST['textarea1'];
                $headers = 'From:'. $email . "\r\n"; // Sender's Email
    // Message lines should not exceed 70 characters (PHP rule), so wrap it
                $message = wordwrap($textarea1, 70);
    // Send Mail By PHP Mail Function
                mail("severinelab@gmail.com", $first_name,$last_name,$textarea1, $headers);
                echo "Your mail has been sent successfuly ! Thank you for your feedback";
            }
        }
    }
?>

<h2 class="center-align">Contactez nous</h2>
<form action="#" id="form" method="post" name="form">
    <!--first name/ second name -->
    <div class="row">
        <div class="input-field col s12">
            <input id="firstName" type="text" class="validate">
            <label for="firstName">Nom</label>
        </div>
        <div class="input-field col s12">
            <input id="lastName" type="text" class="validate">
            <label for="lastName">Prenom</label>
        </div>
    </div>

    <!--email -->
    <div class="row">
        <div class="input-field col s6">
            <input id="email" type="email" class="validate">
            <label for="email">Email</label>
        </div>
        <div class="input-field col s6">
            <input id="phone" type="number" class="validate">
            <label for="phone">Téléphone</label>
        </div>
    </div>

    <!--Choice of fonction/ Objet -->
    <div class="row">
        <!--<div class="col s6">
            <h4 class="center-align">Je suis...</h4>
            <form action="#">
                <p class="center-align">
                    <input name="groupe1" type="radio" id="maire"/>
                    <label for="maire">Elu</label>
                    <input name="groupe1" type="radio" id="partnaire"/>
                    <label for="partnaire">Partenaire</label>
                    <input name="groupe1" type="radio" id="autre"/>
                    <label for="autre">Autre</label>
                </p>
            </form>
        </div>
        <div class="col s6">
            <h4 class="center-align">Objet</h4>
            <form action="#">
                <p class="center-align">
                    <input name="groupe1" type="radio" id="inscription"/>
                    <label for="inscription">Inscription</label>
                    <input name="groupe1" type="radio" id="fiche"/>
                    <label for="fiche">Fiche</label>
                    <input name="groupe1" type="radio" id="renseignement"/>
                    <label for="renseignement">Demande de Renseignements</label>
                </p>
            </form>
        </div> -->
        <div class="col s6">
            <h4 class="center-align">Je suis...</h4>
            <select>
                <option value="" disabled selected>Choose your option</option>
                <option value="1">Maire</option>
                <option value="2">Partenaire</option>
                <option value="3">Autre</option>
            </select>
        </div>
        <div class="col s6">
             <h4 class="center-align">Objet</h4>
                 <select>
                     <option value="" disabled selected>Choose your option</option>
                     <option value="1">Inscription</option>
                     <option value="2">Fiche Projet</option>
                     <option value="3">Demande de Renseignement</option>
                 </select>
         </div>
    </div> <!--end class row-->

    <!--text area -->
    <div class="row">
        <div class="input-field col s12">
            <textarea id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">Votre message</label>
        </div>
    </div>
    <!--submit button -->
    <button data-target="verif" class="btn waves-effect waves-light btn modal-trigger" type="submit" name="action">Envoyer
        <i class="material-icons right">send</i>
    </button>
</form><!--end of contact form -->

    <!-- Modal Structure-->
    <div id="verif" class="modal">
        <div class="modal-content">
            <h4 class="center">Votre message a été transmis!</h4>
        </div>
    </div>


