<?php
session_start();
$title = 'Détails de la recette';
require_once 'models/database.php';
require_once 'models/recipe.php';
require_once 'models/ingredient.php';
require_once 'models/kitchenTool.php';
require_once 'models/steps.php';
require_once 'controllers/recipeDetailsController.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-5 mb-5"><?= $recipeDetails->title ?></h2>
            <div class="row">
                <div class="col-md-5 col-12">
                    <img src="<?= $recipeDetails->picture ?>" class="img-fluid" alt="photo de la recette">
                </div>
                <div class="col-md-7 col-12">
                    <h3 class="text-center mb-3">Description</h3>
                    <p class="mb-3"><?= $recipeDetails->description ?></p>
                    <p>Recette prévue pour <?= $recipeDetails->shareNumber . ' ' . $recipeDetails->share ?></p>
                    <div class="row">
                        <div class="col-6">
                            <p>Type: <?= $recipeDetails->type ?></p>
                            <p>Temps de préparation: <?= $recipeDetails->preparationTime ?></p>
                            <p>Difficulté: <?= $recipeDetails->difficulty ?>/5</p>
                        </div>
                        <div class="col-6">
                            <p>Catégorie: <?= $recipeDetails->category ?></p>
                            <p>Temps de cuisson: <?= $recipeDetails->cookingTime ?></p>
                            <p>Coût: <?= $recipeDetails->cost ?>/5</p>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="text-center mb-5 mt-5">Détails de la recette</h2>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="text-center">
                        <h3>Liste des ingrédients</h3>
                        <img src="assets/img/carroticon.png" alt="Icône d'ingrédient" class="img-fluid recipeIcon">
                    </div>
                    <ul class="list-group">
                        <?php foreach ($ingredientsList as $ingredient) { ?>
                            <li class="list-group-item list-group-item-primary"><?= $ingredient->ingredient . ' ' . $ingredient->quantity . ' ' . $ingredient->massUnit ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-md-6 col-12">
                    <div class="text-center">
                        <h3>Liste des ustensiles de cuisine</h3>
                        <img src="assets/img/toolicon.png" alt="Icône d'ustensile de cuisine" class="img-fluid recipeIcon">
                    </div>
                    <?php foreach ($kitchenToolsList as $kitchenTool) { ?>
                        <li class="list-group-item list-group-item-primary"><?= $kitchenTool->kitchenTool ?></li>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center mb-5 mt-5">Description étape par étape</h3>
                    <?php foreach ($stepsList as $step) { ?>
                        <div class="card mb-1">
                            <div class="card-body">
                                <h5 class="card-title">Étape <?= $step->number ?></h5>
                                <p class="card-text"><?= $step->step ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <p class="text-center">Recette créée par <?= $recipeDetails->login ?></p>
        </div>
    </div>
</div>




<?php require_once 'includes/footer.php'; ?>