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
            <input id="codep" type="text" class="validate">
            <label for="codep">Code Postal</label>
        </div>
    </div>

    <!--Choice of fonction -->
    <div class="row">
        <h2 class="center-align">Fonction</h2>
        <form action="#">
            <p class="center-align">
                <input name="groupe1" type="radio" id="maire"/>
                <label for="maire">Maire</label>
                <input name="groupe1" type="radio" id="partnaire"/>
                <label for="partnaire">Partenaire</label>
                <input name="groupe1" type="radio" id="autre"/>
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
    <!--submit button -->
    <button data-target="verif" class="btn waves-effect waves-light btn modal-trigger" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
    </button>
</form><!--end of contact form -->

    <!-- Modal Structure
    <div id="verif" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
    </div>-->


