<h2 class="center-align">Déposez une fiche projet</h2>

<form action="#" id="form" method="post" name="form">

	<h5>Projet</h5>

	<div class="row">
		<div class="input-field col s12">
			<input id="projectName" type="text" class="validate">
			<label for="projectName">Nom du Projet</label>
		</div>

		<div class="input-field col s6">
			<select multiple>
				<option value="" disabled selected>Choisir une thématique</option>
				<option value="1">AMENAGEMENT DU TERRITOIRE</option>
				<option value="2">CULTURE</option>
				<option value="3">DEMOCRATIE LOCALE</option>
				<option value="4">EDUCATION</option>
				<option value="5">ECONOMIE</option>
				<option value="6">ENVIRONNEMENT</option>
				<option value="7">EUA ET ASSAINISSEMENT</option>
				<option value="8">MOBILITE</option>
				<option value="9">NUMERIQUE</option>
				<option value="10">RELATIONS INTERNATIONALES</option>
				<option value="11">SANTE</option>
				<option value="12">SOCIAL</option>
				<option value="13">SERVICES DE PROXIMITE</option>
				<option value="14">TOURISME</option>
			</select>
		</div>

		<div class="input-field col s6">
			<p>Mots-Clés</p>
			<form action="#">
				<p>
					<input type="checkbox" id="MotsCles"/>
					<label for="ecole">école</label>
				</p>
				<p>
					<input type="checkbox" id=""/>
					<label for="">périscolaire</label>
				</p>
				<p>
					<input type="checkbox" id=""/>
					<label for="">formation</label>
				</p>
				<p>
					<input type="checkbox" id=""/>
					<label for="">crêche</label>
				</p>
				<p>
					<input type="checkbox" id=""/>
					<label for="">restauration scolaire</label>
				</p>
			</form>
		</div>

		<div class="input-field col s12">
			<textarea id="description" type="text" class="materialize-textarea validate"></textarea>
			<label for="description">Description</label>
		</div>


		<div class="input-field col s12">
			<input id="objectif" type="text" class="validate">
			<label for="objectif">Objectifs</label>
		</div>

		<div class="input-field col s6">
			<input id="year" type="text" class="validate">
			<label for="year">Année de réalisation</label>
		</div>

		<div class="input-field col s6">
			<input id="time" type="text" class="validate">
			<label for="time">Durée de réalisation</label>
		</div>

		<div class="input-field col s6">
			<input id="cost" type="text" class="validate">
			<label for="cost">Coût global</label>
		</div>

		<div class="input-field col s6">
			<input id="dollars" type="text" class="validate">
			<label for="dollars">Financements</label>
		</div>

		<div class="input-field col s6">
			<input id="partenaires" type="text" class="validate">
			<label for="partenaires">Partenaires mobilisés</label>
		</div>

		<div class="input-field col s12">
			<textarea id="results" type="text" class="materialize-textarea validate"></textarea>
			<label for="results">Résultats Obtenus</label>
		</div>

		<div class="input-field col s12">
			<textarea id="difficults" type="text" class="materialize-textarea validate"></textarea>
			<label for="difficults">Difficultés rencontrées</label>
		</div>

		<div class="input-field col s12">
			<textarea id="difficults" type="text" class="materialize-textarea validate"></textarea>
			<label for="difficults">Conseils</label>
		</div>

		<div class="input-field col s6">
			<input id="responsable" type="text" class="validate">
			<label for="responsable">Personne en charge du Projet</label>
		</div>

		<div class="input-field col s6">
			<input id="fonction" type="text" class="validate">
			<label for="fonction">Fonction</label>
		</div>

		<!--email/phone -->
		<div class="input-field col s6">
			<input id="email" type="email" class="validate">
			<label for="email">Email</label>
		</div>

		<div class="input-field col s6">
			<input id="tel" type="tel" class="validate">
			<label for="tel">Téléphone</label>
		</div>

	</div>

	<form action="#">
		<div class="file-field input-field">
			<div class="btn">
				<span>File</span>
				<input type="file" multiple>
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text" placeholder="Upload one or more files">
			</div>
		</div>
	</form>