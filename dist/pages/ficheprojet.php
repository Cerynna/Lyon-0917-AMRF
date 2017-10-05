<h2 class="center-align">Déposez une fiche projet</h2>

<form action="#" id="form" method="post" name="form">


    <!--commune-->
    <h5>Commune</h5>

    <div class="row">
        <div class="input-field col s6">
            <input id="commune" type="text" class="validate">
            <label for="commune">Commune</label>
        </div>

        <div class="input-field col s6">
            <input id="codeInsee" type="text" class="validate">
            <label for="codeInsee">Code INSEE</label>
        </div>
    </div>

    <div class="row">

            <div class="input-field col s6">
                <input id="population" type="text" class="validate">
                <label for="population">Population</label>
            </div>

            <div class="input-field col s6">
                <input id="cp" type="text" class="validate">
                <label for="cp">Département</label>
            </div>
    </div>


        <!--first name/ tel/mobile -->
        <div class="row">
            <div class="input-field col s12">
                <input id="firstName" type="text" class="validate">
                <label for="firstName">Nom du maire</label>
            </div>
            <div class="input-field col s6">
                <input id="tel" type="tel" class="validate">
                <label for="tel">Téléphone</label>
            </div>
            <div class="input-field col s6">
                <input id="tel" type="tel" class="validate">
                <label for="tel">Téléphone Portable</label>
            </div>
        </div>


        <!--projet-->

        <h5>Projet</h5>

        <div class="row">
            <div class="input-field col s12">
                <input id="projectName" type="text" class="validate">
                <label for="projectName">Nom du Projet</label>
            </div>

            <div class="input-field col s6">
                <input id="theme" type="text" class="validate">
                <label for="theme">Thématique de l'initiative</label>
            </div>

            <div class="input-field col s6">
                <input id="keyword" type="text" class="validate">
                <label for="keyword">Mots-Clés</label>
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

