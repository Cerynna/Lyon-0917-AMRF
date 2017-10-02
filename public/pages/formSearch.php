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

<div class="row">
    <form class="col s12">
        <div class="input-field col s12">
            <select multiple>
                <option value="" disabled selected>Choisir un thematique</option>
                <option value="1">Sociale</option>
                <option value="2">Sante</option>
                <option value="3">Education</option>
            </select>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">map</i>
                        <input type="text" id="autocomplete-input" class="autocomplete">
                        <label for="autocomplete-input">Departement</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="codep" type="number" class="validate">
                        <label for="codep">Code Postal</label>
                    </div>
                </div>
                <div class="row center-align">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Recherche
                        <i class="material-icons right">search</i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>