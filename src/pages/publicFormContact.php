<div class="well col-md-6 col-md-offset-3">
	<div class="form-area">
		<form role="form">
			<br style="clear:both">
			<h3 style="margin-bottom: 25px; text-align: center;">Contactez nous</h3>
				<div class="form-group col-md-6">
					<input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
				</div>
				<div class="form-group col-md-6">
					<input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" required>
				</div>
				<div class="form-group col-md-6">
					<input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
				</div>
				<div class="form-group col-md-6">
					<input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone" required>
				</div>
			<div class="col-md-6">
				<label>Je suis...</label>
					<select class="form-control" id="subject" name="subject">
						<option selected value="na">Choisir un option</option>
						<option value="service">Maire</option>
						<option value="suggestions">Partenaire</option>
						<option value="product">Autre</option>
					</select>
			</div>
			<div class="col-md-6">
				<label>Objet</label>
					<select class="form-control" id="subject" name="subject">
						<option selected value="na">Choisir un option</option>
						<option value="service">Inscription</option>
						<option value="suggestions">Fiche Projet</option>
						<option value="product">Demande de Renseignement</option>
					</select>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="message">Votre message</label>
					<textarea class="form-control" type="textarea" id="message" placeholder="Message..." maxlength="340" rows="8"></textarea>
					<span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
				</div>
			</div>
			<button type="button" id="submit" name="submit" class="btn btn-primary pull-right">Envoyer
			</button>
		</form>
	</div><!--end of form area-->
</div><!--end of main well-->