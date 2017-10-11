<h2>Mon profil (partenaire)</h2>
<div class="row">
    <div class="col s12 ">
        <form action="">
            <div class="input-field col s6">
                <input id="lastName" type="text" class="validate">
                <label for="lastName">Nom</label>
            </div>
            <div class="input-field col s6">
                <input id="firstName" type="text" class="validate">
                <label for="firstName">Prénom</label>
            </div>
            <div class="input-field col s6">
                <input id="societe" type="text" class="validate">
                <label for="societe">Societe</label>
            </div>

            <div class="input-field col s6">
                <input id="fonction" type="text" class="validate">
                <label for="fonction">Fonction</label>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col s12 ">
            <h3 class="center-align">Changer mon mot de passe</h3>

            <div class="input-field col s6">

            <label for="password">Nouveau mot de passe</label>
            <input id="password" type="password" class="validate" data-error="wrong"
                   data-success="right">
            </div>
                <div class="input-field col s6">

                <label for="password">Confirmation</label>
            <input id="password" type="password" class="validate" data-error="wrong"
                   data-success="right">
                </div>
        </div>
        <div class="row center-align">
        <p class="col s6">
            <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
            <label for="filled-in-box">J'accepte les conditions générales d'utilisation</label>
        </p>

            <button data-target="verif" class="btn waves-effect waves-light btn modal-trigger col s3" type="submit"
                    name="action">Valider
            </button>
        </div>
    </div>
</div>

