<?php
session_start();
$title = 'Liste des recettes';
require_once 'models/database.php';
require_once 'models/recipe.php';
require_once 'controllers/recipesList.Controller.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-5 mb-5">Liste des recettes</h2>
            <?php $count = 0;
            foreach ($recipesList as $recipe) {
                if ($count % 2 == 0) { ?>
                    <div class="card mb-5">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= $recipe->picture ?>" class="img-fluid rounded-start" alt="photo de la recette">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $recipe->title ?></h5>
                                    <p class="card-text"><?= $recipe->description ?></p>
                                </div>
                                <div class="text-center">
                                    <a href="recipeDetails.php?id=<?= $recipe->id ?>" class="btn btn-info stretched-link"><i class="fas fa-plus-square"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $count++;
                } else {
                ?>
                    <div class="card mb-5">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $recipe->title ?></h5>
                                    <p class="card-text"><?= $recipe->description ?></p>
                                </div>
                                <div class="text-center">
                                    <a href="recipeDetails.php?id=<?= $recipe->id ?>" class="btn btn-info stretched-link"><i class="fas fa-plus-square"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="<?= $recipe->picture ?>" class="img-fluid rounded-start" alt="photo de la recette">
                            </div>
                        </div>
                    </div>
            <?php
                    $count++;
                }
            } ?>
        </div>
    </div>
</div>

















<?php require_once 'includes/footer.php' ?>