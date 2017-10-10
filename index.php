<?php include "src/structures/rooter.php"; ?>
<!doctype html>
<html lang="fr">
<head>
    <title>Wiki des Maires - <?php if (isset($titlePage)) {echo $titlePage;} ?></title>
    <?php include "src/structures/head.php"; ?>
</head>
<body>
<header>
    <?php include "src/structures/header.php"; ?>
</header>
<?php include "src/structures/navbar.php"; ?>
<div class="body">
<section>
    <?php echo ($container == true ? "<div class=\"container\">" : "");  ?>

    <div class="content z-depth-4">
        <div class="row">
            <div class="col s12">
                <?php include("src/pages/$linkPage"); ?>
            </div>
        </div>
    </div>
    <?php echo ($container == true ? "</div>" : "");  ?>
</section>

<footer class="page-footer teal darken-3">
    <?php include "src/structures/footer.php"; ?>
</footer>
</div>
<?php include "src/structures/connect.php"; ?>
<?php include "src/structures/script.php"; ?>
</body>
</html>