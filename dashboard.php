<?php session_start(); ?>
<?php
$title = 'Dashboard';
require_once 'models/database.php';
require_once 'models/user.php';
require_once 'controllers/dashboardController.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>
<div class="container">
    <h2 class="text-center mt-5 mb-5">Dashboard</h2>
    <div class="row row-cols-1 row-cols-md-3 mb-3 g-4">
        <div class="col">
            <div class="card">
                <img src="assets/img/usericon.png" class="card-img-top" alt="image liste des utilisateurs">
                <div class="card-body">
                    <h5 class="card-title text-center">Liste des utilisateurs</h5>
                    <a href="dashboardUsersList.php" class="stretched-link btn btn-info">Voir la liste</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="assets/img/checkicon.png" class="card-img-top" alt="image liste de recettes non validées">
                <div class="card-body">
                    <h5 class="card-title text-center">Recettes à valider</h5>
                    <a href="dashboardRecipesUnchecked.php" class="stretched-link btn btn-info">Voir la liste</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="assets/img/bookicon.png" class="card-img-top" alt="image recettes validées">
                <div class="card-body">
                    <h5 class="card-title text-center">Listes des recettes validées</h5>
                    <a href="dashboardRecipesChecked.php" class="stretched-link btn btn-info">Voir la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>









<?php
require_once 'includes/footer.php';
