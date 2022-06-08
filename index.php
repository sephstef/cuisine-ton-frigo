<?php session_start(); ?>
<?php
$title = 'Accueil';
require_once 'models/database.php';
require_once 'models/user.php';
require_once 'models/recipe.php';
require_once 'controllers/indexController.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';

?>

<div class="container" id="presentation">
    <h2 class="text-center mt-5 mb-5">Notre concept.</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">1: Vérifier.</h5>
                    <p class="card-text">Il vous arrive souvent d'avoir des ingrédients inutilisés? Nous sommes là pour ça! <br />
                        Faites la liste de ce qu'il vous reste.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">2: Chercher.</h5>
                    <p class="card-text">Maintenant que vous avez votre liste il ne reste plus qu'à rentrer vos ingrédients dans notre barre de recherche situé juste en dessous.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">3: Choisir et Cuisiner.</h5>
                    <p class="card-text">Vous pouvez maintenant choisir la recette qui vous plaît et vous préparez à cuisiner. <br />
                        Bon appétit!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" id="search">
    <h2 class="text-center mt-5 mb-5">Commencez maintenant.</h2>
    <div class="row">
        <form action="#" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="ingrédient, ingrédient, ingrédient..." name="mainSearch" aria-label="ingrédient, ingrédient, ingrédient..." aria-describedby="mainSearch">
                <button class="btn btn-outline-secondary" type="submit" id="mainSearchButton"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    $count = 0;
                    foreach ($recipesList as $recipe) {
                    ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?= $recipe->picture ?>" class="card-img-top" alt="photo de recette">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $recipe->title ?></h5>
                                    <p class="card-text"><?= $recipe->description ?></p>
                                    <div class="text-center">
                                        <a href="recipeDetails.php?id=<?= $recipe->id ?>" class="btn btn-info stretched-link"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $count++;

                        if ($count % 3 == 0) { ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php }
                    }
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" id="lastRecipes">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center mt-5 mb-5">Derniers ajouts</h3>
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
                    <?php foreach ($tenLastRecipesList as $recipe) { ?>
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


<?php
require_once 'includes/footer.php';
?>