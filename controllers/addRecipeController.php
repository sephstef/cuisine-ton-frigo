<?php
// j'instancie les différents objets que je vais utiliser pour ajouter une recette
$type = new type();
$share = new share();
$massUnit = new massUnit();
$recipe = new recipe();
$step = new step();
$kitchenTool = new kitchenTool();
$category = new category();
$ingredient = new ingredient();
$category = new category();

// ces méthodes me servent à ajouter les valeurs de ma base de données dans les select
$categoriesList = $category->getCategories();
$typesList = $type->getTypeOfRecipes();
$sharesList = $share->getShareOfRecipes();
$massUnitsList = $massUnit->getMassUnitOfQuantity();
// le tableau formErrors me sert à stocker les éventuelles erreurs
$formErrors = [];
// si le tableau post contient des données je commence mes vérifications 
if (count($_POST) > 0) {
    //si $_POST['title'] n'est pas vide, je vérifie qu'il correspoond à ma regex avant d'attribuer sa valeur à $recipe->title
    if (!empty($_POST['title'])) {
        if (preg_match($regex['recipeSmallVarchar'], $_POST['title'])) {
            $recipe->title = $_POST['title'];
        } else {
            $formErrors['title'] = INVALID_TITLE;
        }
    } else {
        $formErrors['title'] = EMPTY_TITLE;
    }

    // je vérifie que post description n'est pas vide avant d'utiliser la fonction strip_tags qui me permet de supprimer les balises html et php pour ensuite ajouter son contenu à 
    //$recipe->description
    if (!empty($_POST['description'])) {
        $recipe->description = strip_tags($_POST['description']);
    } else {
        $formErrors['description'] = EMPTY_DESCRIPTION;
    }

     /**
     * Le tableau super global $_FILES se remplit dès que l'on envoie un fichier. Il crée alors une entrée ['nomDuFichier'] qui devient elle-même un tableau.
     * Ce nouveau tableau ($_FILES['nomDuFichier']) contient des informations très utiles comme le nom du fichier, sa taille et s'il y a eu une erreur lors de l'upload
     */
    if ($_FILES['picture']['error'] == 0) {
        //La fonction pathinfo renvoie un array contenant l'extension du fichier dans pictureExtension
        $pictureExtension = strtolower(pathinfo($_FILES['picture']['name'])['extension']);
        $authorizedExtensions = ['png', 'jpeg', 'jpg', 'gif'];
        // je vérifie que l'extension est bonne
        if (in_array($pictureExtension, $authorizedExtensions)) {
            //Si tout est bon, on accepte le fichier en appelant la fonction move_uploaded_file
            //Prend en paramètre le nom temporaire du fichier + le chemin du fichier définitif qui correspond au nom d'origine du fichier
            if (move_uploaded_file($_FILES['picture']['tmp_name'], 'assets/uploads/' . $_FILES['picture']['name'])) {
                //Lecture et écriture pour le propriétaire, lecture pour les autres
                chmod('assets/uploads/' . $_FILES['picture']['name'], 0644);
                $recipe->picture = 'assets/uploads/' . $_FILES['picture']['name'];
            } else {
                $formErrors['picture'] = 'Une erreur est survenue';
            }
        } else {
            $formErrors['picture'] = INVALID_PICTURE;
        }
    } else {
        $formErrors['picture'] = EMPTY_PICTURE;
    }

    // ici je vérifie que post n'est pas vide avant de vérifier si il existe dans ma base de données
    if (!empty($_POST['type'])) {
        $type->id = $_POST['type'];
        if ($type->checkIfTypeExist() > 0) {
            $recipe->id_types = $_POST['type'];
        } else {
            $formErrors['type'] = INVALID_SELECT;
        }
    } else {
        $formErrors['type'] = INVALID_SELECT;
    }

    // ici je vérifie que post n'est pas vide avant de vérifier si il existe dans ma base de données
    if (!empty($_POST['category'])) {
        $category->id = $_POST['category'];
        if ($category->checkIfCategoryExist() > 0) {
            $recipe->id_categories = $_POST['category'];
        } else {
            $formErrors['category'] = INVALID_SELECT;
        }
    } else {
        $formErrors['category'] = INVALID_SELECT;
    }

    // je vérifie que le post n'est pas vide et qu'il correspond à ma regex
    if (!empty($_POST['shareNumber'])) {
        if (preg_match($regex['recipeNumber'], $_POST['shareNumber'])) {
            $recipe->shareNumber = $_POST['shareNumber'];
        } else {
            $formErrors['shareNumber'] = INVALID_SHARENUMBER;
        }
    } else {
        $formErrors['shareNumber'] = EMPTY_SHARENUMBER;
    }

    // je vérifie que le post n'est pas vide et qu'il correspond à ma regex
    if (!empty($_POST['share'])) {
        $share->id = $_POST['share'];
        if ($share->checkIfShareExist() > 0) {
            $recipe->id_proportion = $_POST['share'];
        } else {
            $formErrors['share'] = INVALID_SELECT;
        }
    } else {
        $formErrors['share'] = INVALID_SELECT;
    }

    // je vérifie que le post n'est pas vide et qu'il correspond à ma regex
    if (!empty($_POST['difficulty'])) {
        if (preg_match($regex['difficultyAndCost'], $_POST['difficulty'])) {
            $recipe->difficulty = $_POST['difficulty'];
        } else {
            $formErrors['difficulty'] = INVALID_SELECT;
        }
    } else {
        $formErrors['difficulty'] = INVALID_SELECT;
    }

    // je vérifie que le post n'est pas vide et qu'il correspond à ma regex
    if (!empty($_POST['cost'])) {
        if (preg_match($regex['difficultyAndCost'], $_POST['cost'])) {
            $recipe->cost = $_POST['cost'];
        } else {
            $formErrors['cost'] = INVALID_SELECT;
        }
    } else {
        $formErrors['cost'] = INVALID_SELECT;
    }

    // je vérifie que le post n'est pas vide et qu'il correspond à ma regex
    if (!empty($_POST['preparationTime'])) {
        if (preg_match($regex['time'], $_POST['preparationTime'])) {
            $recipe->preparationTime = $_POST['preparationTime'];
        } else {
            $formErrors['preparationTime'] = INVALID_TIME;
        }
    } else {
        $formErrors['preparationTime'] = EMPTY_PREPARATIONTIME;
    }

    // je vérifie que le post n'est pas vide et qu'il correspond à ma regex
    if (!empty($_POST['cookingTime'])) {
        if (preg_match($regex['time'], $_POST['cookingTime'])) {
            $recipe->cookingTime = $_POST['cookingTime'];
        } else {
            $formErrors['cookingTime'] = INVALID_TIME;
        }
    } else {
        $formErrors['cookingTime'] = EMPTY_COOKINGTIME;
    }

    // ces deux variables vont me servir pour l'affichage des erreurs pour les post step et kitchenTool
    $stepKey = 0;
    $kitchenToolKey = 0;

    // j'utilise une boucle foreach pour stocker dans un tableau $stepArray les étapes de ma recette et strip_tags pour supprimer les balises html et php
    // à chaque tour de boucle j'incrémente ma variable $stepKey. Si un input est vide cela permet d'afficher l'erreurs à l'input correspondant
    foreach ($_POST['step'] as $stepValue) {
        if (!empty($stepValue)) {
            $stepArray[] = strip_tags($stepValue);
        } else {
            $formErrors['step'][$stepKey] = EMPTY_STEP;
        }
        $stepKey++;
    }


    // j'utilise une boucle foreach pour stocker dans un tableau $kitchenToolArray les étapes de ma recette et strip_tags pour supprimer les balises html et php
    // à chaque tour de boucle j'incrémente ma variable $kitchenToolKey. Si un input est vide cela permet d'afficher l'erreurs à l'input correspondant
    foreach ($_POST['kitchenTool'] as $kitchenToolValue) {
        if (!empty($kitchenToolValue)) {
            $kitchenToolArray[] = strip_tags($kitchenToolValue);
        } else {
            $formErrors['kitchenTool'][$kitchenToolKey] = EMPTY_KITCHENTOOL;
        }
        $kitchenToolKey++;
    }

    // si tout ce passe bien je stocke dans $ingredientArray la valeur de l'ingredient en me servant de $key et de name, quantity, massUnit
    // comme ça par la suite pendant l'ajout je peux resortir les valeurs correspondantes
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

    // si le tableau $formErrors est vide je commence ma transaction
    if (count($formErrors) == 0) {
        // attribution à $recipe->id_users l'id de l'utilisateur stocké dans la session
        $recipe->id_users = $_SESSION['id'];

        //ici on transforme les erreurs en exceptions pour pouvoir les attraper avec le catch
        $recipe->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            // je commence la transaction
            $recipe->db->beginTransaction();
            // j'ajoute la première partie de ma recette
            $recipe->addRecipe();
            // comme je ne peux pas connaître à l'avance l'id de la recette je me sers de lastInsertId pour le récuperer
            $step->id_recipes = $kitchenTool->id_recipes = $ingredient->id_recipes = $recipe->db->lastInsertId();
            // cette boucle me sert à ajouter les différentes étapes de ma recette ainsi que le numéro d'étape
            foreach ($stepArray as $key => $value) {
                $step->step = $value;
                $step->number = $key += 1;
                $step->addStep();
            }
            // cette boucle me sert à ajouter les différent ustensile
            foreach ($kitchenToolArray as $value) {
                $kitchenTool->kitchenTool = $value;
                $kitchenTool->addKitchenTool();
            }
            // cette boucle ajoute les ingrédients, quantités et unités de masse correspondantes
            foreach ($ingredientArray as $value) {
                $ingredient->ingredient = $value['name'];
                $ingredient->quantity = $value['quantity'];
                $ingredient->id_massUnits = $value['massUnit'];
                $ingredient->addIngredient();
            }
            // si tout c'est bien passé on valide l'inscription des données dans la base de données
            $recipe->db->commit();
            // cette variable me sert à ajouter un message de succès
            $success = 'Recette créée avec succès. Elle sera disponible après vérification de la modération.';
            // si le catch attrape une exception on annule la transaction ce qui permet de ne pas avoir qu'une partie de ma recette dans la bdd
        } catch (PDOException $error) {
            $recipe->db->rollBack();
            die($error->getMessage());
        }
    }
}
