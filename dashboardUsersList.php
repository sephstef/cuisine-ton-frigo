<?php
session_start();
$title = 'Dashboard: liste des utilisateurs';
require_once 'models/database.php';
require_once 'models/user.php';
require_once 'controllers/dashboardUsersListController.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-5 mb-5">Liste des utilisateurs</h2>
            <table class="table table-primary table-striped">
                <thead>
                    <tr>
                        <th>Nom d'utilisateur</th>
                        <th>Mail</th>
                        <th>Suppression</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usersList as $user) { ?>
                        <tr>
                            <td><?= $user->login ?></td>
                            <td><?= $user->mail ?></td>
                            <td>
                                <!-- on passe les informations à la modale avec data-bs-login -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-login="<?= $user->login ?>" data-bs-target="#deleteUser">
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Supprimer l'utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer cet utilisateur?</p>
                <p id="targetName"></p>
                <form action="" method="POST">
                    <input type="hidden" id="targetHidden" name="hiddenLogin"> <!-- l'input hidden sert à cacher le login qui va servir à supprimer l'utilisateur. pour valider la suppression de l'utilisateur la modale contient un formulaire qui fait passer les données en post -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                <input type="submit" class="btn btn-danger" value="Oui">
            </div>
            </form>
        </div>
    </div>
</div>



<?php require_once 'includes/footer.php' ?>