<h2>Recherche</h2>
<div class="search jumbotron">
	<div id="custom-search-input">
		<div class="input-group col-md-12">
			<input type="text" class="search-query form-control" placeholder="Recherche une fiche projet" />
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Recherche</button>
			</span>
		</div>
	</div>
</div><!--end jumbotron-->
<h2>Recherche Avancée</h2>
<div class="jumbotron">
	<h3 class="control-label text-center">Choisir un thematique</h3><br>
		<?php
			include "src/structures/thematique.php"
		?>
	<div class="row">
	<form>
		<div class="col-md-12">
		<h3 class="text-center">Mots-clefs</h3><br>
			<div class="form-group">
				<input type="text" max="5" class="motsCle form-control" id="motsCle">
			</div>
		</div>
	</form>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-1 text-center">
			<form>
				<label for="communes">Departement</label>
				<fieldset>
					<div class="form-group">
						<input type="text" class="form-control" name="communes" id="communes">
					</div>
				</fieldset>
			</form>
		</div>
		<div class="col-md-4 col-md-offset-2 form-group text-center">
			<label for="codep">Code Postal</label>
			<input class="form-control" id="codep" type="text" />
		</div>
		<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Recherche</button>
	</div>
</div><!--end jumbotron-->