<h2 class="center-align">Recherche</h2>
<div class="row">
<nav>
    <div class="nav-wrapper">
        <form>
            <div class="input-field">
                <input id="search" type="search" required>
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
            </div>
        </form>
    </div>
</nav>
</div> <!--end of row-->
<!--Advanced search-->
<ul class="collapsible" data-collapsible="accordion">
    <li>
        <div class="collapsible-header"><i class="material-icons">arrow_drop_down</i>Recherche avancée</div>
            <div class="collapsible-body">
                <!--multiple choice option-->
            <div class="row">
                <form class="col s12" action="?page=#">
                    <div class="input-field col s12">
                        <select multiple>
                            <option value="" disabled selected>Choisir un thematique</option>
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
                    <!--auto complete form for departements-->
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">map</i>
                            <input type="text" id="autocomplete-input" class="autocomplete">
                            <label for="autocomplete-input">Departement</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="codep" type="number"  step="10" class="validate">
                            <label for="codep">Code Postal</label>
                        </div>
                    </div><!--end auto complete-->
                </form><!--end of form-->
            </div><!--end of main row-->
    </li>
</ul>
    <div class="row center-align">
        <button class="btn waves-effect waves-light" type="submit" name="action">Recherche
            <i class="material-icons right">search</i>
        </button>
    </div>