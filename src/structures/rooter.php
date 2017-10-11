<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "home";
}

switch ($page) {
    case 'amrf':
        $linkPage = "publicAmrf.php";
        $titlePage = "A Propos de l'AMRF";
        $container = true;
        break;
    case 'pageMaires' :
        $linkPage = "pageMaires.php";
        $titlePage = "Page maire";
        $container = true;
        break;
    case 'projet' :
        $linkPage = "ficheProjet.php";
        $titlePage = "Fiche Projet";
        $container = true;
        break;
    case 'confidentialite':
        $linkPage = "publicConfidential.php";
        $titlePage = "Confidentialité";
        $container = true;
        break;
    case 'espMaires':
        $linkPage = "espaceMaires.php";
        $titlePage = "Espace Maires";
        $container = true;
        break;
    case 'espPartenaires':
        $linkPage = "privatePartIndex.php";
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
        $linkPage = "publicFormContact.php";
        $titlePage = "contact";
        $container = true;
        break;
    case 'formFichePart':
        $linkPage = "privatePartFormFiche.php";
        $titlePage = "Formulaire Fiche Partenaire";
        $container = true;
        break;
    case 'search':
        $linkPage = "publicRechercheProjet.php";
        $titlePage = "Recherche";
        $container = true;
        break;

    case 'home':
        $linkPage = "publicHome.php";
        $titlePage = "Home";
        $container = true;
        break;
    case 'legales':
        $linkPage = "publicMentionsLegales.php";
        $titlePage = "Mention Légales";
        $container = true;
        break;

    case 'profil':
        $linkPage = "profil.php";
        $titlePage = "Profil";
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
        $linkPage = "privatePartProfil.php";
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
        $linkPage = "publicHome.php";
        $titlePage = "Home";
        $container = true;
        break;
}
?>