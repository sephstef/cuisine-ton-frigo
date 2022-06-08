<?php
if (!isset($_SESSION['id'])) {
    header('location:index.php');
    exit;
}
$formErrors = [];
$user = new user();
$recipe = new recipe();
$user->id = $_SESSION['id'];

if (!empty($_POST['deleteLogin'])) {
    if ($_SESSION['login'] == $_POST['deleteLogin']) {
        $user->login = $_POST['deleteLogin'];
        if($user->deleteUserAccount()) {
            session_destroy();
            session_unset();
            header('location:index.php');
            exit;
        } else {
            $formErrors['db'] = ERROR_DB;
        }
    }
}


if (isset($_POST['login'])) {
    if (!empty($_POST['login'])) {
        if (preg_match($regex['login'], $_POST['login'])) {
            $user->login = $_POST['login'];
            if ($user->checkIfUserExists() > 0) {
                $formErrors['login'] = EXISTING_LOGIN;
            } else {
                if ($user->updateUserLogin()) {
                    $_SESSION['login'] = $_POST['login'];
                    $success = 'Votre nom d\'utilisateur a été modifié';
                } else {
                    $formErrors['db'] = ERROR_DB;
                }
            }
        } else {
            $formErrors['login'] = INVALID_LOGIN;
        }
    } else {
        $formErrors['login'] = EMPTY_LOGIN;
    }
}


if (isset($_POST['mail'])) {
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = $_POST['mail'];
            if ($user->updateUserMail()) {
                $success = 'Votre adresse mail a été modifiée';
            } else {
                $formErrors['db'] = ERROR_DB;
            }
        } else {
            $formErrors['mail'] = INVALID_MAIL;
        }
    } else {
        $formErrors['mail'] = EMPTY_MAIL;
    }
}

if (isset($_POST['password']) || isset($_POST['confirmPassword'])) {
    if (!isset($_POST['password']) || empty($_POST['password'])) {
        $formErrors['password'] = EMPTY_PASSWORD;
    }

    if (!isset($_POST['confirmPassword']) || empty($_POST['confirmPassword'])) {
        $formErrors['confirmPassword'] = EMPTY_PASSWORD;
    }

    if (!isset($formErrors['password']) && !isset($formErrors['confirmPassword'])) {
        if ($_POST['password'] === $_POST['confirmPassword']) {
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if ($user->updateUserPassword()) {
                $success = 'Votre mot de passe a été modifié';
            } else {
                $formErrors['db'] = ERROR_DB;
            }
        } else {
            $formErrors['password'] = $formErrors['confirmPassword'] = INVALID_PASSWORD;
        }
    }
}

if (isset($_POST['deleteRecipe'])) {
    $recipe->id = $_POST['deleteRecipe'];
    if ($recipe->checkIfRecipeExist() > 0) {
        $recipe->deleteRecipe();
        header('location:userProfile.php');
        exit;
    }
}

$userProfile = $user->getUserProfile();

$recipe->id_users = $_SESSION['id'];

if ($recipe->checkIfRecipeExistByUserId() > 0) {
    $userHaveRecipe = true;
    $recipesList = $recipe->getRecipesListByUser();
}
