<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "publicHome";
}

switch ($page) {
    case 'Amrf':
        $linkPage = "publicAmrf.php";
        $titlePage = "A propos de l'AMRF";
        $container = true;
        break;
    case 'FormContact':
        $linkPage = "publicFormContact.php";
        $titlePage = "Contact";
        $container = true;
        break;
    case 'MentionsLegales':
        $linkPage = "publicMentionsLegales.php";
        $titlePage = "Mentions légales";
        $container = true;
        break;
    case 'Home':
        $linkPage = "publicHome.php";
        $titlePage = "Accueil";
        $container = true;
        break;
    case 'Confidential':
        $linkPage = "publicConfidential.php";
        $titlePage = "Confidetialité";
        $container = true;
        break;
    case 'PlanSite':
        $linkPage = "publicPlanSite.php";
        $titlePage = "Plan du site";
        $container = true;
        break;
    case 'MairesIndex':
        $linkPage = "privateMairesIndex.php";
        $titlePage = "Mon espace Maire";
        $container = true;
        break;
    case 'MairesProfile':
        $linkPage = "privateMairesProfil.php";
        $titlePage = "Mon compte";
        $container = true;
        break;
    case 'MairesFormProjet':
        $linkPage = "privateMairesFormProjet.php";
        $titlePage = "Création de projets";
        $container = true;
        break;
    case 'MairesProjets':
        $linkPage = "privateMairesProjets.php";
        $titlePage = "Mes projets";
        $container = true;
        break;
    case 'PartIndex':
        $linkPage = "privatePartIndex.php";
        $titlePage = "Mon espace Partenaire";
        $container = true;
        break;
    case 'PartProfil':
        $linkPage = "privatePartProfil.php";
        $titlePage = "Mon compte";
        $container = true;
        break;
    case 'PartFormFiche':
        $linkPage = "privatePartFormFiche.php";
        $titlePage = "Créer ma fiche";
        $container = true;
        break;
    case 'PartListe':
        $linkPage = "privatePartListe.php";
        $titlePage = "Trouver des partenaires";
        $container = true;
        break;
    case 'AdminIndex':
        $linkPage = "privateAdminIndex.php";
        $titlePage = "Mon espace Administrateur";
        $container = true;
        break;
    case 'AdminGestionAccueil':
        $linkPage = "privateAdminGestionAccueil.php";
        $titlePage = "Gérer la page d'accueil";
        $container = true;
        break;
    case 'AdminProjets':
        $linkPage = "privateAdminProjets.php";
        $titlePage = "Gérer les fiches projets";
        $container = true;
        break;
    case 'AdminUsers':
        $linkPage = "privateAdminUsers.php";
        $titlePage = "Gérer les Utilisateurs";
        $container = true;
        break;
    case 'AdminStat':
        $linkPage = "privateAdminStat.php";
        $titlePage = "consulter les statistiques";
        $container = true;
        break;
    case 'RechercheProjet':
        $linkPage = "privateRechecheProjet.php";
        $titlePage = "Chercher des projets";
        $container = true;
        break;
    case 'Favoris':
        $linkPage = "privateFavoris.php";
        $titlePage = "consulter mes favoris";
        $container = true;
        break;
    case 'Projets':
        $linkPage = "privateProjets.php";
        $titlePage = "consulter une fiche projets";
        $container = true;
        break;
}
?>