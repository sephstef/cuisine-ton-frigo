<?php

/**
 * pour me connecter j'utilise l'ajax du coup je vérifie qu'il y a un paramètre ajax dans l'url 
 * je passe les informations depuis le js j'ai besoin des models et de ma config
 */
if(!empty($_GET['ajax'])) {         
    require_once '../models/database.php';
    require_once '../models/user.php';
    require_once '../config.php';
    $formErrors =  [];  //j'initialise mon tableau formErrors
    $users = new user(); // j'instancie un objet de class user
    // je vérifie que mon $_POST contient des données
    if (count($_POST) > 0) {
    
        /**
         * si mon post login n'est pas vide je vérifie qu'il correspond à ma regex avec preg_match
         * si le post est vide j'attribue à formErrors login le message d'erreur (constante définie dans config.php)
         * si ça ne correspond pas j'attribue à formErrors login le message d'erreur (constante définie dans config.php)
         * si c'est bon j'attibue au login de mon objet user le post login
         * je vérifie ensuite si le login existe dans la bdd avec le méthode checkIfUserExists
         * s'il existe déja j'attribue à formErrors login le message d'erreur (constante définie dans config.php)
         */
        if (!empty($_POST['login'])) {
            if (preg_match($regex['login'], $_POST['login'])) {
                $users->login = $_POST['login'];
                if ($users->checkIfUserExists() > 0) {
                    $formErrors['login'] = EXISTING_LOGIN;
                }
            } else {
                $formErrors['login'] = INVALID_LOGIN;
            }
        } else {
            $formErrors['login'] = EMPTY_LOGIN;
        }
    
        /**
         * si mon post mail n'est pas vide
         * si le post est vide j'attribue à formErrors mail le message d'erreur (constante définie dans config.php)
         * si ça ne correspond pas j'attribue à formErrors mail le message d'erreur (constante définie dans config.php)
         * je vérifie que mon mail est bon avec filter_var FILTER_VALIDATE_EMAIL
         * si c'est bon j'attibue au mail de mon objet user le post mail
         */
        if (!empty($_POST['mail'])) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $users->mail = $_POST['mail'];
            } else {
                $formErrors['mail'] = INVALID_MAIL;
            }
        } else {
            $formErrors['mail'] = EMPTY_MAIL;
        }
        
        // je vérifie que le champ password n'est pas vide sinon j'affiche un message d'erreur
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            $formErrors['password'] = EMPTY_PASSWORD;
        }
    
        // je vérifie que le champ confirmPassword n'est pas vide sinon j'affiche un message d'erreur
        if (!isset($_POST['confirmPassword']) || empty($_POST['confirmPassword'])) {
            $formErrors['confirmPassword'] = EMPTY_PASSWORD;
        }
    
        /**
         * si les champs de mot de passe sont remplis je vérifie qu'ils sont identiques
         * si oui j'attribue à password de mon objet user le hash du mot de passe 
         * le hash sert à ce que le mot de passe ne soit pas affiché en clair dans ma bdd
         */
        if (!isset($formErrors['password']) && !isset($formErrors['confirmPassword'])) {
            if ($_POST['password'] === $_POST['confirmPassword']) {
                $users->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            } else {
                $formErrors['password'] = $formErrors['confirmPassword'] = INVALID_PASSWORD;
            }
        }
         // si mon tableau formErrors n'est pas vide je le renvoie sous forme de fichier json au js 
         // le js et le php peuvent tous les 2 interpréter le json 
        if(count($formErrors) > 0 ) {
            echo json_encode($formErrors);
        }

        /**
         * si le tableau formErrors est vide je lance ma méthode pour ajouter un utilisateur
         * et je renvoie sous forme de fichier json le résultat au js
         */
        if (count($formErrors) == 0) {
            if ($users->addUser()) {
                $success = 'Votre compte a bien été créé';
                echo json_encode($success);
            } else {
                $formErrors['db'] = ERROR_DB;
                echo json_encode($formErrors);
            }
        }
    }
}
