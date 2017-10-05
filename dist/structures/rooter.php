<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "home";
}

switch ($page) {
    case 'home':
        $linkPage = "home.php";
        break;
    case 'amrf':
        $linkPage = "amrf.php";
        break;
    case 'contact':
        $linkPage = "formContact.php";
        break;
    case 'pageMaires' :
        $linkPage = "pageMaires.php";
        break;
    case 'search':
        $linkPage = "formSearch.php";
        break;
    case 'confidentialite':
        $linkPage = "confidentialite.php";
        break;
    case 'legales':
        $linkPage = "legales.php";
        break;
    case 'profil':
        $linkPage = "profil.php";
        break;
    default:
        $linkPage = "home.php";
        break;
}
include("dist/pages/$linkPage");
?>