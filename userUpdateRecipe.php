<?php
session_start();
$title = 'Modification de la recette';
require_once 'models/database.php';
require_once 'models/recipe.php';
require_once 'models/types.php';
require_once 'models/category.php';
require_once 'models/proportion.php';
require_once 'models/ingredient.php';
require_once 'models/massUnits.php';
require_once 'models/kitchenTool.php';
require_once 'models/steps.php';
require_once 'config.php';
require_once 'controllers/userUpdateRecipeController.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if (isset($success)) { ?>
                <div class="alert alert-success text-center" role="alert"><?= $success ?></div>
            <?php } ?>
            <h2 class="text-center mb-5 mt-5">Modification de la recette</h2>
            <form action="" method="POST">
                <div class="row mb-3">
                    <div class="col-md-4 col-12">
                        <img src="<?= $recipeDetails->picture ?>" class="img-fluid" alt="photo de la recette">
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control <?= !empty($formErrors['title']) ? 'is-invalid' : ''; ?>" id="title" name="title" value="<?= $recipeDetails->title ?>" />
                            <small class="invalid-feedback"><?= @$formErrors['title']; ?></small>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control <?= !empty($formErrors['description']) ? 'is-invalid' : ''; ?>" name="description" id="description"><?= $recipeDetails->description ?></textarea>
                            <small class="invalid-feedback"><?= @$formErrors['description']; ?></small>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="type">Type de recette</label>
                    <select class="form-select <?= !empty($formErrors['type']) ? 'is-invalid' : ''; ?>" id="type" name="type">
                        <?php
                        foreach ($typesList as $type) { ?>
                            <option <?= $recipeDetails->id_types == $type->id ? 'selected' : '' ?> value="<?= $type->id ?>"><?= $type->type ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <small class="invalid-feedback"><?= @$formErrors['type']; ?></small>
                </div>
                <div class="form-group mb-3">
                    <label for="type">Categories</label>
                    <select class="form-select <?= !empty($formErrors['category']) ? 'is-invalid' : ''; ?>" id="category" name="category">
                        <?php
                        foreach ($categoriesList as $category) { ?>
                            <option <?= $recipeDetails->id_categories == $category->id ? 'selected' : '' ?> value="<?= $category->id ?>"><?= $category->category ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <small class="invalid-feedback"><?= @$formErrors['category']; ?></small>
                </div>
                <div class="mb-3">
                    <label for="shareNumber" class="form-label">Nombre de part</label>
                    <input type="number" class="form-control <?= !empty($formErrors['shareNumber']) ? 'is-invalid' : ''; ?>" name="shareNumber" id="shareNumber" value="<?= $recipeDetails->shareNumber ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['shareNumber']; ?></small>
                </div>
                <div class="form-group mb-3">
                    <label for="share">Personne ou portion</label>
                    <select class="form-select" id="share <?= !empty($formErrors['share']) ? 'is-invalid' : ''; ?>" name="share">
                        <?php
                        foreach ($sharesList as $share) { ?>
                            <option <?= $recipeDetails->id_proportion == $share->id ? 'selected' : '' ?> value="<?= $share->id ?>"><?= $share->share ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <small class="invalid-feedback"><?= @$formErrors['share']; ?></small>
                </div>
                <div class="form-group mb-3">
                    <label for="difficulty">Difficult?? (de 1 ?? 5)</label>
                    <select class="form-select <?= !empty($formErrors['difficulty']) ? 'is-invalid' : ''; ?>" id="difficulty" name="difficulty">
                        <option <?= $recipeDetails->difficulty == 1 ? 'selected' : '' ?> value="1">1</option>
                        <option <?= $recipeDetails->difficulty == 2 ? 'selected' : '' ?> value="2">2</option>
                        <option <?= $recipeDetails->difficulty == 3 ? 'selected' : '' ?> value="3">3</option>
                        <option <?= $recipeDetails->difficulty == 4 ? 'selected' : '' ?> value="4">4</option>
                        <option <?= $recipeDetails->difficulty == 5 ? 'selected' : '' ?> value="5">5</option>
                    </select>
                    <small class="invalid-feedback"><?= @$formErrors['difficulty']; ?></small>
                </div>
                <div class="form-group mb-3">
                    <label for="cost">Co??t (de 1 ?? 5)</label>
                    <select class="form-select <?= !empty($formErrors['cost']) ? 'is-invalid' : ''; ?>" id="cost" name="cost">
                        <option <?= $recipeDetails->cost == 1 ? 'selected' : '' ?> value="1">1</option>
                        <option <?= $recipeDetails->cost == 2 ? 'selected' : '' ?> value="2">2</option>
                        <option <?= $recipeDetails->cost == 3 ? 'selected' : '' ?> value="3">3</option>
                        <option <?= $recipeDetails->cost == 4 ? 'selected' : '' ?> value="4">4</option>
                        <option <?= $recipeDetails->cost == 5 ? 'selected' : '' ?> value="5">5</option>
                    </select>
                    <small class="invalid-feedback"><?= @$formErrors['cost']; ?></small>
                </div>
                <div class="mb-3">
                    <label for="preparationTime" class="form-label">Temps de pr??paration</label>
                    <input type="time" class="form-control <?= !empty($formErrors['preparationTime']) ? 'is-invalid' : ''; ?>" name="preparationTime" id="preparationTime" value="<?= $recipeDetails->preparationTime ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['preparationTime']; ?></small>
                </div>
                <div class="mb-3">
                    <label for="cookingTime" class="form-label">Temps de cuisson</label>
                    <input type="time" class="form-control <?= !empty($formErrors['cookingTime']) ? 'is-invalid' : ''; ?>" name="cookingTime" id="cookingTime" value="<?= $recipeDetails->cookingTime ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['cookingTime']; ?></small>
                </div>
                <input class="btn btn-primary" type="submit" value="Modifier" name="updateRecipe">
            </form>
            <form action="" enctype="multipart/form-data" method="POST">
                <div class="mb-3">
                    <label for="picture" class="form-label">Photo</label>
                    <input type="file" class="form-control <?= !empty($formErrors['picture']) ? 'is-invalid' : ''; ?>" name="picture" id="picture" />
                    <small class="invalid-feedback"><?= @$formErrors['picture']; ?></small>
                </div>
                <input type="submit" class="btn btn-primary" value="Modifier la photo">
            </form>
            <form action="" method="POST">
                <div id="ingredientTarget">
                    <?php
                    if (!empty($_POST['ingredient'])) {
                        foreach ($_POST['ingredient'] as $key => $postIngredient) {
                    ?>
                            <div class="mb-3">
                                <label for="ingredient" class="form-label">Ingr??dient</label>
                                <input type="text" class="form-control <?= !empty($formErrors['ingredient'][$key]) ? 'is-invalid' : ''; ?>" name="ingredient[]" id="ingredient" value="<?= $postIngredient ?>" />
                                <small class="invalid-feedback"><?= @$formErrors['ingredient'][$key]; ?></small>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Quantit??</span>
                                <input type="number" class="form-control <?= !empty($formErrors['quantity'][$key]) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity[]" value="<?= $_POST['quantity'][$key] ?>" />
                                <small class="invalid-feedback"><?= @$formErrors['quantity'][$key] ?></small>
                                <span class="input-group-text">Unit??</span>
                                <select class="form-select <?= !empty($formErrors['massUnit'][$key]) ? 'is-invalid' : ''; ?>" name="massUnit[]" id="massUnit">
                                    <?php
                                    foreach ($massUnitsList as $massUnit) { ?>
                                        <option value="<?= $massUnit->id ?>" <?= $_POST['massUnit'][$key] != $massUnit->id ?: 'selected' ?>><?= $massUnit->massUnit ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <small class="invalid-feedback"><?= @$formErrors['massUnit'][$key] ?></small>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <?php foreach ($ingredients as $key => $ingredient) { ?>
                            <div class="mb-3">
                                <label for="ingredient" class="form-label">Ingr??dient</label>
                                <input type="text" class="form-control <?= !empty($formErrors['ingredient'][$key]) ? 'is-invalid' : ''; ?>" name="ingredient[<?= $key ?>]" id="ingredient" value="<?= $ingredient->ingredient ?>" />
                                <small class="invalid-feedback"><?= @$formErrors['ingredient'][$key]; ?></small>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Quantit??</span>
                                <input type="number" class="form-control <?= !empty($formErrors['quantity'][$key]) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity[<?= $key ?>]" value="<?= $ingredient->quantity ?>" />
                                <small class="invalid-feedback"><?= @$formErrors['quantity'][$key]; ?></small>
                                <span class="input-group-text">Unit??</span>
                                <select class="form-select <?= !empty($formErrors['massUnit'][$key]) ? 'is-invalid' : ''; ?>" name="massUnit[]" id="massUnit">
                                    <?php
                                    foreach ($massUnitsList as $massUnit) { ?>
                                        <option <?= $ingredient->id_massUnits == $massUnit->id ? 'selected' : '' ?> value="<?= $massUnit->id ?>"><?= $massUnit->massUnit ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <small class="invalid-feedback"><?= @$formErrors['massUnit'][$key]; ?></small>
                            </div>
                    <?php }
                    } ?>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-info" id="addIngredient"><i class="fas fa-plus-square"></i></button>
                </div>
                <input class="btn btn-primary" type="submit" name="updateIngredient" value="Modifier">
            </form>
            <form action="" method="POST">
                <div id="kitchenToolGroup">
                    <?php if (isset($_POST['kitchenTool'])) {
                        foreach ($_POST['kitchenTool'] as $key => $value) { ?>
                            <div class="mb-3">
                                <label for="kitchenTool" id="kitchenToolLabel" class="form-label">Ustensile de cuisine</label>
                                <input type="text" class="form-control <?= !empty($formErrors['kitchenTool'][$key]) ? 'is-invalid' : ''; ?>" name="kitchenTool[<?= $key ?>]" id="kitchenTool" value="<?= $value ?>" />
                                <small class="invalid-feedback"><?= @$formErrors['kitchenTool'][$key]; ?></small>
                            </div>
                        <?php }
                    } else { ?>
                        <?php foreach ($kitchenTools as $key => $kitchenTool) { ?>
                            <div class="mb-3" id="kitchenToolInput">
                                <label for="kitchenTool" id="kitchenToolLabel" class="form-label">Ustensile de cuisine</label>
                                <input type="text" class="form-control <?= !empty($formErrors['kitchenTool'][$key]) ? 'is-invalid' : ''; ?>" name="kitchenTool[<?= $key ?>]" id="kitchenTool" value="<?= $kitchenTool->kitchenTool ?>" />
                                <small class="invalid-feedback"><?= @$formErrors['kitchenTool'][$key]; ?></small>
                            </div>
                    <?php }
                    } ?>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-info" id="addKitchenTool"><i class="fas fa-plus-square"></i></button>
                </div>
                <input class="btn btn-primary" type="submit" name="updateKitchenTool" value="Modifier">
            </form>
            <form action="" method="POST">
                <div id="stepTarget">
                    <?php if (!empty($_POST['step'])) {
                        foreach ($_POST['step'] as $key => $value) { ?>
                            <div class="mb-3" id="stepInput">
                                <label for="step" class="form-label">??tape de la recette</label>
                                <textarea class="form-control <?= !empty($formErrors['step'][$key]) ? 'is-invalid' : ''; ?>" name="step[<?= $key ?>]" id="step"><?= $value ?></textarea>
                                <small class="invalid-feedback"><?= @$formErrors['step'][$key]; ?></small>
                            </div>
                        <?php }
                    } else { ?>
                        <?php foreach ($steps as $key => $step) { ?>
                            <div class="mb-3" id="stepInput">
                                <label for="step" class="form-label"><span id="count"><?= $step->number ?></span> ??tape de la recette</label>
                                <textarea class="form-control <?= !empty($formErrors['step'][$key]) ? 'is-invalid' : ''; ?>" name="step[<?= $key ?>]" id="step"><?= $step->step ?></textarea>
                                <small class="invalid-feedback"><?= @$formErrors['step'][$key]; ?></small>
                            </div>
                    <?php }
                    } ?>
                </div>
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-info" id="addStep"><i class="fas fa-plus-square"></i></button>
                </div>
                <input class="btn btn-primary" type="submit" name="updateStep" value="Modifier">
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php' ?>