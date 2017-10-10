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
		break;
	case 'confidentialite':
		$linkPage = "confidentialite.php";
		$titlePage = "Confidentialité";
		break;
	case 'espMaires':
		$linkPage = "espaceMaires.php";
		$titlePage = "Espace Maires";
		break;
	case 'espPartenaires':
		$linkPage = "espacePartenaires.php";
		$titlePage = "Espace Partenaires";
		break;
	case 'fichePartenaires':
		$linkPage = "fichePartenaire.php";
		$titlePage = "Fiches Partenaires";
		break;
	case 'ficheProjet':
		$linkPage = "ficheProjet.php";
		$titlePage = "Fiches Projets";
		break;
	case 'contact':
		$linkPage = "formContact.php";
		$titlePage = "contact";
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
	case 'listePartenaire' :
		$linkPage = "listePartenaire.php";
		break;
	case 'profilMaire':
		$linkPage = "profilMaire.php";
		break;
	case 'profilPartenaire':
		$linkPage = "profilPartenaire.php";
		break;
	case 'planDuSite':
		$linkPage = "planDuSite.php";
		break;
	case 'exemple':
		$linkPage = "exemple.php";
		break;
	default:
		$linkPage = "home.php";
		break;
}
?>