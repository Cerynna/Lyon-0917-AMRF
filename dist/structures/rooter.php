<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "home";
}

switch ($page) {

    case 'amrf':
        $linkPage = "amrf.php";
        break;
    case 'confidentialite':
        $linkPage = "confidentialite.php";
        break;
    case 'espMaires':
        $linkPage = "espaceMaires.php";
        break;
    case 'espPartenaires':
        $linkPage = "espacePartenaires.php";
        break;
    case 'fichePartenaires':
        $linkPage = "fichePartenaire.php";
        break;
    case 'FicheProjet':
        $linkPage = "ficheProjet.php";
        break;
    case 'contact':
        $linkPage = "formContact.php";
        break;
    case 'formFichePart':
        $linkPage = "formFichePartenaire.php";
        break;
    case 'search':
        $linkPage = "formSearch.php";
        break;
    case 'home':
        $linkPage = "home.php";
        break;
    case 'legales':
        $linkPage = "legales.php";
        break;
    case 'pageMaires' :
        $linkPage = "pageMaires.php";
        break;
    case 'listePartenaire' :
        $linkPage = "listePartenaire.php";
        break;
    case 'profil':
        $linkPage = "profil.php";
        break;
    case 'profilPartenaire':
        $linkPage = "profilPartenaire.php";
        break;
    case 'exemple':
        $linkPage = "exemple.php";
        break;
    default:
        $linkPage = "home.php";
        break;
}
include("dist/pages/$linkPage");
?>