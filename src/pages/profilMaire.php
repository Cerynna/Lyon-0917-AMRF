<h2 class="center-align">Mon profil</h2>
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
			<div class="input-field col s12">
				<input id="address" type="text" class="validate">
				<label for="address">Adresse de la Mairie</label>
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">map</i>
				<input type="text" id="autocomplete-input" class="autocomplete">
				<label for="autocomplete-input">Departement</label>
			</div>
            <div class="input-field col s6">
                <input id="codep" type="number" class="validate">
                <label for="codep">Code Postal</label>
            </div>
            <div class="input-field col s6">
                <input disabled value="NOT EDITABLE" id="insee" type="number" class="validate">
                <label for="insee">Numéro INSEE</label>
            </div>
			<div class="input-field col s6">
				<input id="habitants" type="number" class="validate">
				<label for="habitants">Nombre d'habitants</label>
			</div>
            <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="tel" type="number" class="validate">
                <label for="tel">Téléphone</label>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                <input id="email" type="email" class="validate">
                <label for="email">Email</label>
            </div>
			<div class="input-field col s6">
				<input id="twitter" type="text" class="validate">
				<label for="twitter">Compte Twitter</label>
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
            <button data-target="verif" class="btn waves-effect waves-light btn modal-trigger " type="submit"
                    name="action">Valider
            </button>
        </div>
    </div>
</div>

