<?php

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
// cet isset me sert à decouper mes vérifications
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
    // si il n'y a pas d'erreurs je modifie cette partie de la recette et affiche un message de succès
    if (count($formErrors) == 0) {
        $recipe->id = $_GET['id'];
        $recipe->updateRecipeByUser();
        $success = 'Recette modifiée avec succès. Elle sera disponible après vérification de la modération.';
    }
}

if (isset($_FILES['picture'])) {
    if ($_FILES['picture']['error'] == 0) {
        $pictureExtension = strtolower(pathinfo($_FILES['picture']['name'])['extension']);
        $authorizedExtensions = ['png', 'jpeg', 'jpg', 'gif'];

        if (in_array($pictureExtension, $authorizedExtensions)) {
            if (move_uploaded_file($_FILES['picture']['tmp_name'], 'assets/uploads/' . $_FILES['picture']['name'])) {
                chmod('assets/uploads/' . $_FILES['picture']['name'], 0644);
                $recipe->picture = 'assets/uploads/' . $_FILES['picture']['name'];
                $recipe->id = $_GET['id'];
                $recipe->updateRecipePicture();
                $success = 'Recette modifiée avec succès. Elle sera disponible après vérification de la modération.';
            } else {
                $formErrors['picture'] = 'Une erreur est survenue';
            }
        } else {
            $formErrors['picture'] = INVALID_PICTURE;
        }
    } else {
        $formErrors['picture'] = EMPTY_PICTURE;
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
    // ici comme je ne peux pas à la fois modifier et ajouter des étapes à ma recette je les supprime avant d'ajouter de nouveau les étapes
    if (count($formErrors) == 0) {

        $step->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $step->db->beginTransaction();
            $step->id_recipes = $recipe->id = $_GET['id'];
            $step->deleteSteps();
            foreach ($stepArray as $key => $value) {
                $step->step = $value;
                $step->number = $key += 1;
                $step->addStep();
            }
            $recipe->updateRecipeCheck();
            $success = 'Recette créée avec succès. Elle sera disponible après vérification de la modération.';
            $step->db->commit();
        } catch (PDOException $error) {
            $step->db->rollBack();
            die($error->getMessage());
        }
    }
}

// ici comme je ne peux pas à la fois modifier et ajouter des ustensiles à ma recette je les supprime avant d'ajouter de nouveau les ustensiles
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
            $kitchenTool->id_recipes = $recipe->id = $_GET['id'];
            $kitchenTool->deleteKitchenTools();
            foreach ($kitchenToolArray as $value) {
                $kitchenTool->kitchenTool = $value;
                $kitchenTool->addKitchenTool();
            }
            $recipe->updateRecipeCheck();
            $success = 'Recette modifiée avec succès. Elle sera disponible après vérification de la modération.';
            $kitchenTool->db->commit();
        } catch (PDOException $error) {
            $kitchenTool->db->rollBack();
            die($error->getMessage());
        }
    }
}
// ici comme je ne peux pas à la fois modifier et ajouter des ingrédients à ma recette je les supprime avant d'ajouter de nouveau les ingrédients
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
            $ingredient->id_recipes = $recipe->id = $_GET['id'];
            $ingredient->deleteIngredients();
            foreach ($ingredientArray as $value) {
                $ingredient->ingredient = $value['name'];
                $ingredient->quantity = $value['quantity'];
                $ingredient->id_massUnits = $value['massUnit'];
                $ingredient->addIngredient();
            }
            $recipe->updateRecipeCheck();
            $success = 'Recette modifiée avec succès. Elle sera disponible après vérification de la modération.';
            $ingredient->db->commit();
        } catch (PDOException $error) {
            $ingredient->db->rollBack();
            die($error->getMessage());
        }
    }
}

// ces méthodes me servent à afficher ma recette dans les inputs correspondants
$recipe->id = $_GET['id'];
$recipeDetails = $recipe->getRecipe();
$ingredient->id_recipes = $_GET['id'];
$ingredients = $ingredient->getIngredientsOfRecipe();
$kitchenTool->id_recipes = $_GET['id'];
$kitchenTools = $kitchenTool->getKitchenToolsOfRecipe();
$step->id_recipes = $_GET['id'];
$steps = $step->getStepsOfRecipe();

// si l'utilisateur n'est pas connecté et n'est pas l'auteur de la recette il est redirigé vers index.php
if (!isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
} else {
    if ($_SESSION['login'] != $recipeDetails->login) {
        header('location:index.php');
        exit;
    }
}