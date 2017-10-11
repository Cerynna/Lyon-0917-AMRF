<style>

    h2 {
        margin: auto;
    }
    p{
        margin: 20px 0px 0px 15px;
    }
    .pagination li.active {
        background-color: #004d40;
    }

</style>

<?php
$secteurs = [
    'Education', 'Santé', 'Service', 'Environement', 'Aménagement du territoire', 'Tourisme', 'Social', 'Economie', 'Culture', 'Numérique',
];
$alphabet = [
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
]; ?>
<!-- form serach--->
<section class="row">
    <h2 class="center-align">Annuaire des partenaires</h2>
    <div class="row">
        <p>Trier par lettres</p>
        <ul class="pagination">
            <!--<li class="active"><a href="#!">active</a></li>-->
            <?php foreach ($alphabet as $result): ?>
                <li class="waves-effect"><a href="#!"><?php echo $result ?></a></li>
            <?php endforeach; ?>

        </ul>
    </div>

    <div class="row">
        <div class="input-field col s6">
            <select multiple>

                <option value="" disabled selected>Trier par secteurs</option>
                <?php foreach ($secteurs as $result): ?>

                    <option value="1"><?php echo $result ?></option>
                <?php endforeach; ?>

            </select>
        </div>
    </div>

</section>

<!-- results -->
<section class="row">
    <ul class="collapsible container-fluid" data-collapsible="accordion">
        <!-- first result -->
        <li>
            <div class="collapsible-header">
                <img src="http://via.placeholder.com/100x100">
                <h3>nom du partenaire</h3>
                <span>En savoir plus</span>
            </div>
            <div class=" row collapsible-body">
                <div class="col s4 right">

                    <h4>Adresse :</h4>
                    <p>rue de l'avenue </br>
                        65432 Ville
                    </p>
                    <h4>contact :</h4>
                    <ul>
                        <li>Nom Prenom</li>
                        <li>mail</li>
                        <li>telephone</li>
                    </ul>
                    <h4>contact Local :</h4>
                    <ul>
                        <li>Nom Prenom</li>
                        <li>mail</li>
                        <li>telephone</li>
                    </ul>

                </div>
                <div class=" col s8 left">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem eaque eos est ex fuga impedit
                        magni odio pariatur repudiandae? Animi aperiam aut eius eos explicabo facere magnam repudiandae
                        sit, tempore.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur beatae ducimus
                        eos fugit, id iste iusto laborum, nemo nostrum obcaecati officia quae quaerat quibusdam quis
                        soluta temporibus, vel voluptate!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores autem doloremque ducimus ea
                        eum excepturi inventore itaque magnam maxime nihil quibusdam quis, tempore voluptatem? Ab at
                        deleniti distinctio earum sequi.</p>

                </div>
                <div class="row">
                    <div class=" col s8 left">
                        <p>Secteur activité / mots clefs</p>
                    </div>
                </div>
            </div>
        </li>


        <!-- second result -->

        <li>
            <div class="collapsible-header">
                <img src="http://via.placeholder.com/100x100">
                <h3>nom du partenaire</h3>
                <span>En savoir plus</span>
            </div>
            <div class=" row collapsible-body">
                <div class="col s4 right">

                    <h4>Adresse :</h4>
                    <p>rue de l'avenue </br>
                        65432 Ville
                    </p>
                    <h4>contact :</h4>
                    <ul>
                        <li>Nom Prenom</li>
                        <li>mail</li>
                        <li>telephone</li>
                    </ul>
                    <h4>contact Local :</h4>
                    <ul>
                        <li>Nom Prenom</li>
                        <li>mail</li>
                        <li>telephone</li>
                    </ul>

                </div>
                <div class=" col s8 left">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem eaque eos est ex fuga impedit
                        magni odio pariatur repudiandae? Animi aperiam aut eius eos explicabo facere magnam repudiandae
                        sit, tempore.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur beatae ducimus
                        eos fugit, id iste iusto laborum, nemo nostrum obcaecati officia quae quaerat quibusdam quis
                        soluta temporibus, vel voluptate!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores autem doloremque ducimus ea
                        eum excepturi inventore itaque magnam maxime nihil quibusdam quis, tempore voluptatem? Ab at
                        deleniti distinctio earum sequi.</p>

                </div>
                <div class="row">
                    <div class=" col s8 left">
                        <p>Secteur activité / mots clefs</p>
                    </div>
                </div>
            </div>
        </li>

        <!-- third result -->

        <li>
            <div class="collapsible-header">
                <img src="http://via.placeholder.com/100x100">
                <h3>nom du partenaire</h3>
                <span>En savoir plus</span>
            </div>
            <div class=" row collapsible-body">
                <div class="col s4 right">

                    <h4>Adresse :</h4>
                    <p>rue de l'avenue </br>
                        65432 Ville
                    </p>
                    <h4>contact :</h4>
                    <ul>
                        <li>Nom Prenom</li>
                        <li>mail</li>
                        <li>telephone</li>
                    </ul>
                    <h4>contact Local :</h4>
                    <ul>
                        <li>Nom Prenom</li>
                        <li>mail</li>
                        <li>telephone</li>
                    </ul>

                </div>
                <div class=" col s8 left">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem eaque eos est ex fuga impedit
                        magni odio pariatur repudiandae? Animi aperiam aut eius eos explicabo facere magnam repudiandae
                        sit, tempore.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur beatae ducimus
                        eos fugit, id iste iusto laborum, nemo nostrum obcaecati officia quae quaerat quibusdam quis
                        soluta temporibus, vel voluptate!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores autem doloremque ducimus ea
                        eum excepturi inventore itaque magnam maxime nihil quibusdam quis, tempore voluptatem? Ab at
                        deleniti distinctio earum sequi.</p>

                </div>
                <div class="row">
                    <div class=" col s8 left">
                        <p>Secteur activité / mots clefs</p>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>

<div class="row">
    <ul class="pagination">
        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
        <li class="active"><a href="#!">1</a></li>
        <li class="waves-effect"><a href="#!">2</a></li>
        <li class="waves-effect"><a href="#!">3</a></li>
        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
    </ul>
</div>




