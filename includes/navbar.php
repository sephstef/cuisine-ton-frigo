<?php
require_once 'login.php';
require_once 'signin.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><i class="fas fa-home"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php#search">Recherche par ingrédients</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Recettes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="addRecipe.php">Ajouter une recette</a></li>
                        <li><a class="dropdown-item" href="recipesList.php">Liste des recettes</a></li>
                        <li><a class="dropdown-item" href="index.php#lastRecipes">Derniers ajouts</a></li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['idUserTypes'])) { ?>
                    <?php if ($_SESSION['idUserTypes'] == 1) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">Dashboard</a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>

            <form class="d-flex me-3">
                <input class="form-control me-2" type="search" placeholder="Recherche par recette" aria-label="Recherche par recette">
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <?php if (!isset($_SESSION['login'])) { ?>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#signin">
                        inscription <small><i class="fas fa-sign-in-alt"></i></small>
                    </button>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#loginModal">
                        connexion <small><i class="fas fa-sign-in-alt"></i></small>
                    </button>
                </div>
            <?php } else { ?>
                <a class="btn btn-info me-1" href="userProfile.php">profil <i class="fas fa-user-alt"></i></a>
                <a class="btn btn-secondary" href="controllers/logoutController.php">déconnexion <small><i class="fas fa-sign-out-alt"></i></small></a>
            <?php } ?>
        </div>
    </div>
</nav>