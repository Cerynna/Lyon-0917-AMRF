
<!doctype html>
<html lang="fr">
<head>
    <title>Wiki des Maires - <?php if (isset($titlePage)) {echo $titlePage;} ?></title>
    <?php include "src/structures/head.html.twig"; ?>
</head>
<body>
<header>
    <?php include "src/structures/header.html.twig"; ?>
</header>
<?php include "src/structures/navbar.html.twig"; ?>
<div class="body">
<section>
    <?php echo ($container == true ? "<div class=\"container\">" : "<div class=\"container-fluid\">");  ?>
    <div class="content z-depth-4">
                <?php include("src/pages/$linkPage"); ?>
    </div>
    <?php echo ($container == true ? "</div>" : "");  ?>
</section>
</div>
<footer class="page-footer teal darken-3">
    <?php include "src/structures/footer.html.twig"; ?>
</footer>

<?php include "src/structures/modalConnect.html.twig"; ?>
<?php include "src/structures/script.html.twig"; ?>
</body>
</html>