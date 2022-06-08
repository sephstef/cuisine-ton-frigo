<?php
// si l'utilisateur n'est pas connecté et n'a pas le idUserTypes 1 (admin) il est redirigé vers index.php
if (!isset($_SESSION['idUserTypes'])) {
    header('location:index.php');
    exit;
} else {
    if ($_SESSION['idUserTypes'] == 2) {
        header('location:index.php');
        exit;
    }
}

$recipe = new recipe();
$type = new type();
$share = new share();
$step = new step();
$massUnit = new massUnit();
$ingredient = new ingredient();
$kitchenTool = new kitchenTool();
$category = new category();
$categoriesList = $category->getCategories();
$typesList = $type->getTypeOfRecipes();
$sharesList = $share->getShareOfRecipes();
$massUnitsList = $massUnit->getMassUnitOfQuantity();

$formErrors = [];


if (isset($_POST['updateRecipe'])) {
    if (!empty($_POST['title'])) {
        if (preg_match($regex['recipeSmallVarchar'], $_POST['title'])) {
            $recipe->title = $_POST['title'];
        } else {
            $formErrors['title'] = INVALID_TITLE;
        }
    } else {
        $formErrors['title'] = EMPTY_TITLE;
    }

    if (!empty($_POST['description'])) {
        $recipe->description = strip_tags($_POST['description']);
    } else {
        $formErrors['description'] = EMPTY_DESCRIPTION;
    }

    if (!empty($_POST['type'])) {
        $type->id = $_POST['type'];
        if ($type->checkIfTypeExist() > 0) {
            $recipe->id_types = $_POST['type'];
        } else {
            $formErrors['type'] = INVALID_SELECT;
        }
    }

    if (!empty($_POST['category'])) {
        $category->id = $_POST['category'];
        if ($category->checkIfCategoryExist() > 0) {
            $recipe->id_categories = $_POST['category'];
        } else {
            $formErrors['category'] = INVALID_SELECT;
        }
    }

    if (!empty($_POST['shareNumber'])) {
        if (preg_match($regex['recipeNumber'], $_POST['shareNumber'])) {
            $recipe->shareNumber = $_POST['shareNumber'];
        } else {
            $formErrors['shareNumber'] = INVALID_SHARENUMBER;
        }
    } else {
        $formErrors['shareNumber'] = EMPTY_SHARENUMBER;
    }

    if (!empty($_POST['share'])) {
        $share->id = $_POST['share'];
        if ($share->checkIfShareExist() > 0) {
            $recipe->id_proportion = $_POST['share'];
        } else {
            $formErrors['share'] = INVALID_SELECT;
        }
    }

    if (!empty($_POST['difficulty'])) {
        if (preg_match($regex['difficultyAndCost'], $_POST['difficulty'])) {
            $recipe->difficulty = $_POST['difficulty'];
        } else {
            $formErrors['difficulty'] = INVALID_SELECT;
        }
    }

    if (!empty($_POST['cost'])) {
        if (preg_match($regex['difficultyAndCost'], $_POST['cost'])) {
            $recipe->cost = $_POST['cost'];
        } else {
            $formErrors['cost'] = INVALID_SELECT;
        }
    }

    if (!empty($_POST['preparationTime'])) {
        if (preg_match($regex['time'], $_POST['preparationTime'])) {
            $recipe->preparationTime = $_POST['preparationTime'];
        } else {
            $formErrors['preparationTime'] = INVALID_TIME;
        }
        
    } else {
        $formErrors['preparationTime'] = EMPTY_PREPARATIONTIME;
    }

    if (!empty($_POST['cookingTime'])) {
        if (preg_match($regex['time'], $_POST['cookingTime'])) {
            $recipe->cookingTime = $_POST['cookingTime'];
        } else {
            $formErrors['cookingTime'] = INVALID_TIME;
        }
    } else {
        $formErrors['cookingTime'] = EMPTY_COOKINGTIME;
    }

    if (count($formErrors) == 0) {
        $recipe->id = $_GET['id'];
        $recipe->updateRecipeByAdmin();
    }
}
if (isset($_POST['defaultPicture'])) {
    $recipe->id = $_POST['defaultPicture'];
    if ($recipe->checkIfRecipeExist() > 0) {
        $recipe->picture = 'assets/img/header.jpg';
        $recipe->updateRecipePictureByDefault();
    }
}



if (isset($_POST['updateStep'])) {
    $stepKey = 0;
    foreach ($_POST['step'] as $stepValue) {
        if (!empty($stepValue)) {
            $stepArray[] = strip_tags($stepValue);
        } else {
            $formErrors['step'][$stepKey] = EMPTY_STEP;
        }
        $stepKey++;
    }
    if (count($formErrors) == 0) {
        $step->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $step->db->beginTransaction();
            $step->id_recipes = $_GET['id'];
            $step->deleteSteps();
            foreach ($stepArray as $key => $value) {
                $step->step = $value;
                $step->number = $key += 1;
                $step->addStep();
            }
            $step->db->commit();
        } catch (PDOException $error) {
            $step->db->rollBack();
            die($error->getMessage());
        }
    }
}

if (isset($_POST['updateKitchenTool'])) {
    $kitchenToolKey = 0;
    foreach ($_POST['kitchenTool'] as $kitchenToolValue) {
        if (!empty($kitchenToolValue)) {
            $kitchenToolArray[] = strip_tags($kitchenToolValue);
        } else {
            $formErrors['kitchenTool'][$kitchenToolKey] = EMPTY_KITCHENTOOL;
        }
        $kitchenToolKey++;
    }
    if (count($formErrors) == 0) {
        $kitchenTool->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $kitchenTool->db->beginTransaction();
            $kitchenTool->id_recipes = $_GET['id'];
            $kitchenTool->deleteKitchenTools();
            foreach ($kitchenToolArray as $value) {
                $kitchenTool->kitchenTool = $value;
                $kitchenTool->addKitchenTool();
            }
            $kitchenTool->db->commit();
        } catch (PDOException $error) {
            $kitchenTool->db->rollBack();
            die($error->getMessage());
        }
    }
}

if (isset($_POST['updateIngredient'])) {
    foreach ($_POST['ingredient'] as $key => $ingredientValue) {
        if (!empty($ingredientValue)) {
            if (preg_match($regex['recipeSmallVarchar'], $ingredientValue)) {
                $ingredientArray[$key]['name'] = $ingredientValue;
            } else {
                $formErrors['ingredient'][$key] = INVALID_INGREDIENT;
            }
        } else {
            $formErrors['ingredient'][$key] = EMPTY_INGREDIENT;
        }

        if (!empty($_POST['quantity'][$key])) {
            if (preg_match($regex['recipeNumber'], $_POST['quantity'][$key])) {
                $ingredientArray[$key]['quantity'] = $_POST['quantity'][$key];
            } else {
                $formErrors['quantity'][$key] = INVALID_QUANTITY;
            }
        } else {
            $formErrors['quantity'][$key] = EMPTY_QUANTITY;
        }

        foreach ($_POST['massUnit'] as $massUnitValue) {
            $massUnit->id = $_POST['massUnit'][$key];
            if ($massUnit->checkIfMassUnitExist() > 0) {
                $ingredientArray[$key]['massUnit'] = $_POST['massUnit'][$key];
            } else {
                $formErrors['massUnit'][$key] = INVALID_SELECT;
            }
        }
    }
    if (count($formErrors) == 0) {
        $ingredient->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $ingredient->db->beginTransaction();
            $ingredient->id_recipes = $_GET['id'];
            $ingredient->deleteIngredients();
            foreach ($ingredientArray as $value) {
                $ingredient->ingredient = $value['name'];
                $ingredient->quantity = $value['quantity'];
                $ingredient->id_massUnits = $value['massUnit'];
                $ingredient->addIngredient();
            }
            $ingredient->db->commit();
        } catch (PDOException $error) {
            $ingredient->db->rollBack();
            die($error->getMessage());
        }
    }
}

if (isset($_POST['deleteRecipe'])) {
    $recipe->id = $_POST['deleteRecipe'];
    if ($recipe->checkIfRecipeExist() > 0) {
        $recipe->deleteRecipe();
        header('location:dashboardRecipesUnchecked.php');
        exit;
    }
}

if (isset($_POST['validateRecipe'])) {
    $recipe->id = $_POST['validateRecipe'];
    if ($recipe->checkIfRecipeExist() > 0) {
        $recipe->recipeCheck = 1;
        $recipe->validateRecipe();
        header('location:recipeDetails.php?id=' . $_GET['id']);
        exit;
    }
}

$recipe->id = $_GET['id'];
$recipeDetails = $recipe->getRecipe();
$ingredient->id_recipes = $_GET['id'];
$ingredients = $ingredient->getIngredientsOfRecipe();
$kitchenTool->id_recipes = $_GET['id'];
$kitchenTools = $kitchenTool->getKitchenToolsOfRecipe();
$step->id_recipes = $_GET['id'];
$steps = $step->getStepsOfRecipe();
