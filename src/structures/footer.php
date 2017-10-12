<div class="bck">
<div class="container">
    <div class="bck-footer">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <a href="#header">
                    <img class="footer-logo" src="dist/img/AMRF.png">
                </a>
            </div>
            <div class="col-lg-10 col-md-10">
                <p>
                    Depuis 1971, l'Association des Maires Ruraux de France (AMRF) fédère, informe et représente
                    près de 10000 maires de communes rurales pour défendre et promouvoir les enjeux spécifiques
                    de la ruralité.
                    Réseau convivial et solidaire d'associations départementales - en toute indépendance des
                    pouvoirs et partis politiques - l'AMRF est un représentant incontournable du monde rural auprès
                    des pouvoirs publics et des grands opérateurs nationaux.
                </p>
            </div>
        </div>
    </div>
    <div class="bck-footer space-bottom">
    <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4">
                    <ul>
                        <li><a class="" href="?page=Confidential">Déclaration de confidentialité</a>
                        </li>
                        <li><a class="" href="?page=MentionsLegales">Conditions d'utilisation</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul>
                        <li><a class="" href="http://www.amrf.fr" target="_blank">www.amrf.fr</a></li>
                        <li><a class="" href="#!">Questionnaire de satisfaction</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul>
                        <li><a class="" href="?page=PlanSite">Plan du Site</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 center">
            <?php
            $dir = "dist/img/partnaires/";
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    //  echo "lol";
                    while (($file = readdir($dh)) !== false) {
                        // echo "lol";
                        if ($file != '.' && $file != '..' && $file != '.git' && $file != '.idea') {
                            if (filetype($dir . $file) === "file") {

                                ?>
                                <img class="partlogo" src="<?php echo $dir . $file; ?>">

                                <?php
                            }
                        }
                    }
                    closedir($dh);
                }
            }

            ?>
        </div>
    </div>
</div>
<div class="bck-copy">
    <div class="col m12">© 2014 Copyright Text</div>
</div>
