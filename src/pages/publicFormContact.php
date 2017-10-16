<h2>Contactez nous</h2>
<div class="jumbotron">
	<form role="form">
		<div class="row">
			<br style="clear:both">
			<div class="form-group col-md-6">
				<label>Nom</label>
				<input type="text" class="form-control" id="nom" name="nom" required>
			</div>
			<div class="form-group col-md-6">
				<label>Prenom</label>
				<input type="text" class="form-control" id="prenom" name="prenom" required>
			</div>
			<div class="form-group col-md-6">
				<label>Email</label>
				<input type="email" class="form-control" id="email" name="email" required>
			</div>
			<div class="form-group col-md-6">
				<label>Téléphone</label>
				<input type="text" class="form-control" id="phone" name="phone" required>
			</div>
			<div class="col-md-6">
				<label>Je suis...</label>
				<select class="form-control" id="subject" name="subject">
					<option selected value="na">Choisir une option</option>
					<option value="service">Maire</option>
					<option value="suggestions">Partenaire</option>
					<option value="product">Autre</option>
				</select>
			</div>
			<div class="col-md-6">
				<label>Objet</label>
				<select class="form-control" id="subject" name="subject">
					<option selected value="na">Choisir une option</option>
					<option value="service">Inscription</option>
					<option value="suggestions">Fiche Projet</option>
					<option value="product">Demande de Renseignement</option>
				</select>
			</div>
		</div>
		<br>
	<div class="row">
			<div class="form-group">
				<textarea class="form-control" type="textarea" id="message" placeholder="Message..." maxlength="1200" rows="10"></textarea>
			</div>
		</div>
	<button type="button" id="submit" name="submit" class="btn btn-primary pull-right">Envoyer
		</button>
	</form>
</div><!--end of main well-->