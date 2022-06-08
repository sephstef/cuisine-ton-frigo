<?php
// je démarre une session pour que quand toutes les vérifications soient faites l'utilisateur soit connecté sur le site
session_start();

/**
 * pour me connecter j'utilise l'ajax du coup je vérifie qu'il y a un paramètre ajax dans l'url 
 * je passe les informations depuis le js j'ai besoin des models et de ma config
 */
if (!empty($_GET['ajax'])) {
    require_once '../models/database.php';
    require_once '../models/user.php';
    require_once '../config.php';
    $formErrors =  [];  //j'initialise mon tableau formErrors
    $users = new user(); // j'instancie un objet de class user
    // je vérifie que mon $_POST contient des données
    if (count($_POST) > 0) {

           /**
         * si le post est vide j'attribue à formErrors login le message d'erreur (constante définie dans config.php)
         * je vérifie ensuite si le login existe dans la bdd avec le méthode checkIfUserExists
         * si le login n'existe pas j'attribue à formErrors login et password le message d'erreur (constante définie dans config.php)
         * en cas de mauvais mdp ou login il faut afficher le message d'erreur pour les 2 champs pour ne pas donner d'informations qui pourrait être détournées par un utilisateur malveillant
         */
        if (!empty($_POST['login'])) {
            $users->login = $_POST['login'];
            if ($users->checkIfUserExists() == 0) {
                $formErrors['login'] = $formErrors['password'] = INVALID_SIGNIN;
            }
        } else {
            $formErrors['login'] = EMPTY_LOGIN;
        }

        /**
         * je vérifie que le champ password n'est pas vide
         * si il n'y a pas d'erreur avec le login je stocke dans la variable hash le résultat de la méthode getHashByUser
         * j'utilise password_verify pour voir si le mdp rentré est le bon
         */
        if (!empty($_POST['password'])) {
            if (!isset($formErrors['login'])) {
                $hash = $users->getHashByUser();
                if (!password_verify($_POST['password'], $hash->password)) {
                    $formErrors['login'] = $formErrors['password'] = INVALID_SIGNIN;
                }
            }
        } else {
            $formErrors['password'] = EMPTY_PASSWORD;
        }

        // si mon tableau formErrors n'est pas vide je le renvoie sous forme de fichier json au js 
         // le js et le php peuvent tous les 2 interpréter le json
        if (count($formErrors) > 0) {
            echo json_encode($formErrors);
        }

        /**
         * si le tableau formErrors est vide je lance ma méthode pour chercher le type d'utilisateur (1 admin, 2 utilisateur)
         * je mets en place les id, login et type d'utilisateur dans $_SESSION
         * et je renvoie sous forme de fichier json le résultat au js
         */
        if (count($formErrors) == 0) {

            if ($users->getUserType()) {
                $_SESSION['id'] = $users->id;
                $_SESSION['login'] = $users->login;
                $_SESSION['idUserTypes'] = $users->idUserTypes;
                $success = 'Connexion réussie.';
                echo json_encode($success);
            } else {
                $formErrors['db'] = ERROR_DB;
                echo json_encode($formErrors);
            }
        }
    }
}
