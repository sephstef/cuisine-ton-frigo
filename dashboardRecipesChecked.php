<?php
session_start();
$title = 'Dashboard: recettes validées';
require_once 'models/database.php';
require_once 'models/recipe.php';
require_once 'controllers/dashboardRecipesCheckedController.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-5 mb-5">Liste des recettes validées</h2>
            <table class="table table-primary table-striped">
                <thead>
                    <tr>
                        <th>Titre de la recette</th>
                        <th>Créateur</th>
                        <th>Date de création</th>
                        <th>Voir la recette</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recipesList as $recipe) { ?>
                        <tr>
                            <td><?= $recipe->title ?></td>
                            <td><?= $recipe->login ?></td>
                            <td><?= $recipe->publication ?></td>
                            <td><a class="btn btn-info" href="recipeDetails.php?id=<?= $recipe->recipeId ?>"><i class="far fa-eye"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php' ?>