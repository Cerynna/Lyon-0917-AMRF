<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "home";
}

switch ($page) {

    case 'amrf':
        $linkPage = "amrf.php";
        $titlePage = "A Propos de l'AMRF";
        $container = true;
        break;
    case 'confidentialite':
        $linkPage = "confidentialite.php";
        $titlePage = "Confidentialité";
        $container = true;
        break;
    case 'espMaires':
        $linkPage = "espaceMaires.php";
        $titlePage = "Espace Maires";
        $container = true;
        break;
    case 'espPartenaires':
        $linkPage = "espacePartenaires.php";
        $titlePage = "Espace Partenaires";
        $container = true;
        break;
    case 'fichePartenaires':
        $linkPage = "fichePartenaire.php";
        $titlePage = "Fiches Partenaires";
        $container = true;
        break;
    case 'ficheProjet':
        $linkPage = "ficheProjet.php";
        $titlePage = "Fiches Projets";
        $container = true;
        break;
    case 'contact':
        $linkPage = "formContact.php";
        $titlePage = "contact";
        $container = true;
        break;
    case 'formFichePart':
        $linkPage = "formFichePartenaire.php";
        $titlePage = "Formulaire Fiche Partenaire";
        $container = true;
        break;
    case 'search':
        $linkPage = "formSearch.php";
        $titlePage = "Recherche";
        $container = true;
        break;
    case 'home':
        $linkPage = "home.php";
        $titlePage = "Home";
        $container = true;
        break;
    case 'legales':
        $linkPage = "legales.php";
        $titlePage = "Mention Légales";
        $container = true;
        break;
    case 'listePartenaire' :
        $linkPage = "listePartenaire.php";
        $titlePage = "Liste des Partenaires";
        $container = true;
        break;
    case 'profilMaire':
        $linkPage = "profilMaire.php";
        $titlePage = "Mon Profil";
        $container = true;
        break;
    case 'profilPartenaire':
        $linkPage = "profilPartenaire.php";
        $titlePage = "Profil Partenaire";
        $container = true;
        break;
    case 'exemple':
        $linkPage = "exemple.php";
        $titlePage = "Page Exemple CSS";
        $container = true;
        break;
	case 'adminGestion':
		$linkPage = "adminGestion.php";
		$titlePage = "Admin Gestion";
		$container = false;
		break;
    default:
        $linkPage = "home.php";
        $titlePage = "Home";
        $container = true;
        break;
}

?>