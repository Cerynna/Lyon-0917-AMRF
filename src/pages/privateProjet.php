<style>
/* nom du projet */
h2 {
    color: #3c763d;
}

/* position des thématiques*/
.theme-city span
{
    font-size: 1vw;
}

.panel-default
{
    margin-top: 30px;
}
.main-theme {
    padding-left : 15px;
}
.second-theme {
    padding-left: 15px;
    margin-top: 20px;
}

/* blocs Commune + contact Mairie */
#cityName, #contact {
    margin-top: 50px;
}

#cityName .collapsed {
    margin-right: 70px;
}

#headingList {
    background-color: #3c763d;
    color: white;
    font-weight: bolder;
    font-size: 2em;
}

#headingList a {
    font-size: 1.5em;
}

/* petits blocs année et budget */
.year-budget {
    padding-left: 15px;
    margin-top: 80px;
}

.year-budget h3 {
    font-size: .6em;
}

/* gestion des photos */
img {
    border:1px solid black;
}

.thumb {
    position:relative;
    top:0;
    left:0;
}

.thumb a {
    margin:0;
    text-decoration:none;
}

.thumb a .grand {
    display:block;
    position:absolute;
    width:0;
}

.thumb a:hover .grand, .thumb a:focus .grand {
    position:absolute;
    top:80px;
    left:0;
    width:300px;
    height:225px;
}

/* éléments de description du projet */
.description-title {
    margin: 30px 20px 10px 10px;
    color: #3c763d;
}
.description-body {
    margin: 10px 20px 10px 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #3c763d;
}

</style>

<div class="row">
    <h2>Partenariat Application Mobile Court-voiturage</h2> <!-- insertion php-->
    <div class="theme-city">
        <div class="col-md-8">
            <div class="label">
                <div class="main-theme text-left">
                    <span class="label label-default">Mobilité</span>
                    <span class="label label-default">Numérique</span>
                    <span class="label label-default">Aménagement du territoire</span>
                </div>
                <div class="second-theme text-left">
                    <span class="label label-warning">covoiturage</span>
                    <span class="label label-warning">court-voiturage</span>
                    <span class="label label-warning">transports</span>
                    <span class="label label-warning">voiture</span>
                    <span class="label label-warning">lien</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default" id="cityName">
                    <div class="panel-heading" role="tab" id="headingList">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Commune : SAINT JEAN PIED DE PORT
                                <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <ul class="list-group">
                            <li class="list-group-item">Département : Essone</li>
                            <li class="list-group-item">CodePostal : 91xxx</li>
                            <li class="list-group-item">Population : 2000</li>
                            <li class="list-group-item">Code INSEE : 91411</li>
                        </ul>
                    </div>
                </div>
            </div>
             <div class="col-md-5">
                 <div class="panel panel-default" id="contact">
                    <div class="panel-heading" role="tab" id="headingList">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Contact Mairie
                                <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <ul class="list-group">
                            <li class="list-group-item">Nom du Maire : Yvan LUBRANESKI</li>
                            <li class="list-group-item">Tél Mairie : 160120799</li>
                            <li class="list-group-item">Tél mobile : @LesMolieres91</li>
                            <li class="list-group-item">Email</li>
                            <li href="#" class="list-group-item">Site internet : http://www.lesmolieres.fr</li>
                        </ul>
                    </div>
                 </div>
             </div>
        </div>
        <div class="col-md-4">
            <div class="thumb">
                <a href="#">
                    <img src="100_" alt="miniature AMRF" />
                    <img src="300_AMRF.jpg" alt="Inachis-io" class="grand" />
                </a>
                <a href="#">
                    <img src="100_https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjkLwGHiU6GsMV5mKk39WJJhYi8ITViZhTTMV4DUMMZN8D-u7y" alt="miniature Machaon" />
                    <img src="300_https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjkLwGHiU6GsMV5mKk39WJJhYi8ITViZhTTMV4DUMMZN8D-u7y" alt="Machaon" class="grand"  />
                </a>

                <a href="#">
                    <img src="100_https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcdLcHOukp_RmzskNHx3UfqVn3vQ5XLYzPo-QDjRHJNLVXdjhIEA" alt="miniature Polyommatus-icarus" />
                    <img src="300_https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcdLcHOukp_RmzskNHx3UfqVn3vQ5XLYzPo-QDjRHJNLVXdjhIEA" alt="Polyommatus-Icarus" class="grand"  />
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="year-budget">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading" id="headingList">
                    <h3 class="panel-title">Année de réalisation</h3>
                </div>
                <div class="panel-body">
                        2017
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading" id="headingList">
                    <h3 class="panel-title">Durée de réalisation</h3>
                </div>
                <div class="panel-body">
                        2017-2020
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading" id="headingList">
                    <h3 class="panel-title">Coût global</h3>
                </div>
                <div class="panel-body">
                        2000 €
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading" id="headingList">
                    <h3 class="panel-title">Cofinancements</h3>
                </div>
                <div class="panel-body">
                        non
                </div>
            </div>
        </div>
    </div>
</div>


<div class="description-title">
    <h3>Description du projet</h3>
</div>
<div class="description-body">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</div>
<div class="description-title">
    <h3>Objectifs</h3>
</div>
<div class="description-body">
        Le maillage en transports collectifs étant faible, il y a un intérêt majeur à étudier des modes de transports collectifs nouveaux et complémentaires.
        Transformer le véhicule particulier en un mode nouveau de transport collectif
</div>
<div class="description-title">
    <h3>Partenaires mobilisés</h3>
</div>
<div class="description-body">
        Parc Naturel Régional de la Haute Vallée de Chevreuse
</div>
<div class="description-title">
    <h3>Résultats obtenus</h3>
</div>
<div class="description-body">
        En 4 mois, 80 inscrits sur la commune et déjà une quinzaine d'utilisateurs réguliers.
</div>
<div class="description-title">
    <h3>Difficultés rencontrées</h3>
</div>
<div class="description-body">
        Une masse critique d'utilisateurs est nécessaire pour que l'application propose à l'usager un grand nombre de choix. Le démarrage est donc long. Nous avons cependant bénéficié d'un partenariat entre l'application mobile et le Département au moment du lancement dans notre commune.
</div>
<div class="description-title">
    <h3>Conseils</h3>
</div>
<div class="description-body">
        Voir les expériences alentours, choisir une application qui est utilisée dans des territoires voisins et/ou travailler un partenariat avec son EPCI, Parc Naturel, Syndicat de transports ou toute autre organisation publique pertinente.
        Avoir un plan de communication articulé dans le temps et très visible
</div>

<div class="panel panel-default">
    <div class="panel-heading" id="headingList">
        Pour plus d'informations
    </div>
    <ul class="list-group">
        <li class="list-group-item">Personne en charge du projet : Yvan LUBRANESKI - Frédéric FABRE</li>
        <li class="list-group-item">Fonction : Maire et 1er Adjoint</li>
        <li class="list-group-item">Email : lubraneski@gmail.com</li>
        <li class="list-group-item">Téléphone : 686279986</li>
        <li class="list-group-item">YouTube : </li>
        <li class="list-group-item">Documents complémentaires : </li>
    </ul>
</div>