<?php
// si l'utilisateur n'est pas connecté et n'a pas le idUserTypes 1 (admin) il est redirigé vers index.php
if(!isset($_SESSION['idUserTypes'])) {
    header('location:index.php');
        exit;
} else {
    if($_SESSION['idUserTypes'] == 2) {
        header('location:index.php');
        exit;
    }
}
$recipe = new recipe();

$recipesList = $recipe->getUncheckedRecipesList();