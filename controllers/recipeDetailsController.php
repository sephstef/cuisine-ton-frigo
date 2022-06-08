<?php
$recipe = new recipe();
$ingredient = new ingredient();
$kitchenTool = new kitchenTool();
$step = new step();

$recipe->id = $_GET['id'];
$ingredient->id_recipes = $_GET['id'];
$kitchenTool->id_recipes = $_GET['id'];
$step->id_recipes = $_GET['id'];

if ($recipe->checkIfRecipeExist() > 0) {
    $recipeDetails = $recipe->getRecipeDetails();
    $ingredientsList = $ingredient->getIngredientsOfRecipe();
    $kitchenToolsList = $kitchenTool->getKitchenToolsOfRecipe();
    $stepsList = $step->getStepsOfRecipe();
} else {
    header('location:index.php');
    exit;
}