<?php
$secteurs = [
    'Education ', 'Santé ', 'Service ', 'Environement ', 'Aménagement du territoire ', 'Tourisme ', 'Social ', 'Economie ', 'Culture ', 'Numérique ',
];
$alphabet = [
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
]; ?>
<!-- form serach--->
<section class="row ">
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

            <div class="checkbox">
                <?php foreach ($secteurs as $result): ?>
                <label>
                    <input type="checkbox"><?php echo $result ?>
                </label>
                <?php endforeach; ?>
            </div>

    </div>

</section>
<!-- results -->
<section class="row">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading row" role="tab" id="headingOne">
                <div class="col-xs-4">
                    <img src="http://via.placeholder.com/70x70">
                </div>
                <div class="col-xs-4">
                    <h3 class="panel-title">Nom du partenaire</h3>
                </div>
                <div class="col-xs-2 col-xs-offset-2 plus">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                       aria-expanded="true" aria-controls="collapseOne">
                        "En savoir Plus ..."
                    </a>
                </div>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body row ">
                    <div class=" col-xs-8">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem eaque eos est ex fuga
                            impedit
                            magni odio pariatur repudiandae? Animi aperiam aut eius eos explicabo facere magnam
                            repudiandae
                            sit, tempore.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur beatae
                            ducimus
                            eos fugit, id iste iusto laborum, nemo nostrum obcaecati officia quae quaerat quibusdam quis
                            soluta temporibus, vel voluptate!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores autem doloremque ducimus
                            ea
                            eum excepturi inventore itaque magnam maxime nihil quibusdam quis, tempore voluptatem? Ab at
                            deleniti distinctio earum sequi.</p>
                        <div class="row">
                            <p>secteurs</p>
                        </div>
                    </div>
                    <div class="col-xs-4">
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
                </div>
            </div>
        </div>

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




