<?php session_start(); ?>
<?php
$title = 'Profil';
require_once 'models/database.php';
require_once 'models/user.php';
require_once 'models/recipe.php';
require_once 'config.php';
require_once 'controllers/userProfileController.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>
<div class="container">
    <div class="row ">
        <h2 class="text-center mt-5 mb-5">Votre profil</h2>
        <div class="col-md-8 col-12">
            <?php if (isset($formErrors['db'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $formErrors['db'] ?>
                </div>
            <?php } else { ?>
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <table class="table table-responsive table-primary table-striped">
                <tr>
                    <td>Nom d'utilisateur</td>
                    <td><?= $userProfile->login ?></td>
                    <td><button class="btn btn-primary" id="updateLoginButton"><i class="fas fa-pen"></i></button></td>
                </tr>
                <tr>
                    <td>Adresse mail</td>
                    <td><?= $userProfile->mail ?></td>
                    <td><button class="btn btn-primary" id="updateMailButton"><i class="fas fa-pen"></i></button></td>
                </tr>
                <tr>
                    <td>Modifier votre mot de passe</td>
                    <td></td>
                    <td><button class="btn btn-primary" id="updatePasswordButton"><i class="fas fa-pen"></i></button></td>
                </tr>
                <tr>
                    <td>Supprimer votre profil</td>
                    <td></td>
                    <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccount"><i class="fas fa-trash"></i></button></td>
                </tr>
            </table>
            <form action="userProfile.php" method="POST" id="updateLogin" class="invisibleForm">
                <div class="mb-3">
                    <label for="login" class="form-label">Modifier le nom d'utilisateur</label>
                    <input type="text" class="form-control <?= !isset($formErrors['login']) ?: 'is-invalid' ?>" id="login" placeholder="ex: jdupont" name="login" value="<?= @$_POST['login'] ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['login'] ?></small>
                </div>
                <input type="submit" class="btn btn-info" value="Envoyer">
            </form>
            <form action="userProfile.php" method="POST" id="updateMail" class="invisibleForm">
                <div class="mb-3">
                    <label for="mail" class="form-label">Modifier le mail</label>
                    <input type="email" class="form-control <?= !isset($formErrors['mail']) ?: 'is-invalid' ?>" id="mail" placeholder="ex: jdupont" name="mail" value="<?= @$_POST['mail'] ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['mail'] ?></small>
                </div>
                <input type="submit" class="btn btn-info" value="Envoyer">
            </form>
            <form action="userProfile.php" method="POST" id="updatePassword" class="invisibleForm">
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control <?= !isset($formErrors['password']) ?: 'is-invalid' ?>" id="password" placeholder="********" name="password" value="<?= @$_POST['password'] ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['password'] ?></small>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmation mot de passe</label>
                    <input type="password" class="form-control <?= !isset($formErrors['confirmPassword']) ?: 'is-invalid' ?>" id="confirmPassword" placeholder="********" name="confirmPassword" value="<?= @$_POST['confirmPassword'] ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['confirmPassword'] ?></small>
                </div>
                <input type="submit" class="btn btn-info" value="Envoyer">
            </form>
            <?php if (isset($userHaveRecipe)) {
                if ($userHaveRecipe = true) { ?>
                    <h2 class="text-center mb-5 mt-5">Liste des recettes</h2>
                    <table class="table table-primary table-striped">
                        <thead>
                            <tr>
                                <th>Titre de la recette</th>
                                <th>Date de création</th>
                                <th>Verifier la recette</th>
                                <th>Supprimer la recette</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recipesList as $recipe) { ?>
                                <tr>
                                    <td><?= $recipe->title ?></td>
                                    <td><?= $recipe->publication ?></td>
                                    <td><a class="btn btn-primary" href="userUpdateRecipe.php?id=<?= $recipe->recipeId ?>">Modifier</a></td>
                                    <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRecipe">Supprimer</button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
            <?php }
            } ?>
        </div>
        <div class="col-md-4 col-12">
            <svg class="animated" id="freepik_stories-chef" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                <style>
                    svg#freepik_stories-chef:not(.animated) .animable {
                        opacity: 0;
                    }

                    svg#freepik_stories-chef.animated #freepik--background-complete--inject-38 {
                        animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideRight;
                        animation-delay: 0s;
                    }

                    svg#freepik_stories-chef.animated #freepik--Table--inject-38 {
                        animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                        animation-delay: 0s;
                    }

                    svg#freepik_stories-chef.animated #freepik--Character--inject-38 {
                        animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideUp, 1.5s Infinite linear shake;
                        animation-delay: 0s, 1s;
                    }

                    svg#freepik_stories-chef.animated #freepik--Shelves--inject-38 {
                        animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideDown;
                        animation-delay: 0s;
                    }

                    svg#freepik_stories-chef.animated #freepik--kitchen-tools--inject-38 {
                        animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedRight;
                        animation-delay: 0s;
                    }

                    svg#freepik_stories-chef.animated #freepik--Food--inject-38 {
                        animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideDown;
                        animation-delay: 0s;
                    }

                    @keyframes slideRight {
                        0% {
                            opacity: 0;
                            transform: translateX(30px);
                        }

                        100% {
                            opacity: 1;
                            transform: translateX(0);
                        }
                    }

                    @keyframes fadeIn {
                        0% {
                            opacity: 0;
                        }

                        100% {
                            opacity: 1;
                        }
                    }

                    @keyframes slideUp {
                        0% {
                            opacity: 0;
                            transform: translateY(30px);
                        }

                        100% {
                            opacity: 1;
                            transform: inherit;
                        }
                    }

                    @keyframes shake {

                        10%,
                        90% {
                            transform: translate3d(-1px, 0, 0);
                        }

                        20%,
                        80% {
                            transform: translate3d(2px, 0, 0);
                        }

                        30%,
                        50%,
                        70% {
                            transform: translate3d(-4px, 0, 0);
                        }

                        40%,
                        60% {
                            transform: translate3d(4px, 0, 0);
                        }
                    }

                    @keyframes slideDown {
                        0% {
                            opacity: 0;
                            transform: translateY(-30px);
                        }

                        100% {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    @keyframes lightSpeedRight {
                        from {
                            transform: translate3d(50%, 0, 0) skewX(-20deg);
                            opacity: 0;
                        }

                        60% {
                            transform: skewX(10deg);
                            opacity: 1;
                        }

                        80% {
                            transform: skewX(-2deg);
                        }

                        to {
                            opacity: 1;
                            transform: translate3d(0, 0, 0);
                        }
                    }
                </style>
                <g id="freepik--background-complete--inject-38" style="transform-origin: 250.515px 246.78px 0px;" class="animable">
                    <circle cx="77.71" cy="345.96" r="15.31" style="fill: rgb(224, 224, 224); transform-origin: 77.71px 345.96px 0px;" id="eloy9gjsi1bm9" class="animable"></circle>
                    <g id="el61fhac3qte">
                        <circle cx="107.58" cy="345.7" r="15.31" style="fill: rgb(235, 235, 235); transform-origin: 107.58px 345.7px 0px; transform: rotate(-45deg);" class="animable" id="elu1ijg15mzo"></circle>
                    </g>
                    <g id="eliaitx62sw7a">
                        <circle cx="47.84" cy="345.7" r="15.31" style="fill: rgb(235, 235, 235); transform-origin: 47.84px 345.7px 0px; transform: rotate(-45deg);" class="animable" id="elbs2z04o5bsf"></circle>
                    </g>
                    <path d="M27.5,349h100s-1,41.23-27.87,46.27L99.2,404h-45v-8.91S27.5,388.29,27.5,349Z" style="fill: rgb(224, 224, 224); transform-origin: 77.5px 376.5px 0px;" id="el0xeft29kcqeh" class="animable"></path>
                    <path d="M99.62,395.27c0,.15-10.21.26-22.8.26s-22.8-.11-22.8-.26,10.21-.26,22.8-.26S99.62,395.13,99.62,395.27Z" style="fill: rgb(255, 255, 255); transform-origin: 76.8203px 395.271px 0px;" id="el8xxghjl3y0e" class="animable"></path>
                    <path d="M123.62,370.24s-.22,0-.64.08l-1.89.16a25.1,25.1,0,0,1-7.26-.35,14.7,14.7,0,0,1-4.89-1.95,11.17,11.17,0,0,1-4.14-4.67,8.22,8.22,0,0,1-.7-3.45,6.12,6.12,0,0,1,1.26-3.52,4.34,4.34,0,0,1,1.56-1.25,3.84,3.84,0,0,1,2-.27,4.88,4.88,0,0,1,3.35,2.46,6.48,6.48,0,0,1,.58,4.34,12.55,12.55,0,0,1-1.72,4.24,15.07,15.07,0,0,1-7.45,6A14.41,14.41,0,0,1,93.5,372a15,15,0,0,1-4.64-2.83,10.28,10.28,0,0,1-3.15-4.61,5.15,5.15,0,0,1,0-2.91,3.89,3.89,0,0,1,1.84-2.33,4.77,4.77,0,0,1,5.56,1.26,10.46,10.46,0,0,1,2.33,5.51,16.87,16.87,0,0,1-.18,6.09,17.89,17.89,0,0,1-6.47,10.48,16.19,16.19,0,0,1-5.74,2.81,18.28,18.28,0,0,1-6.47.43,17.14,17.14,0,0,1-11.23-5.81,12.13,12.13,0,0,1-2.75-5.68,8.17,8.17,0,0,1,1.28-6.05,6.17,6.17,0,0,1,5.27-2.91,5.83,5.83,0,0,1,4.92,3.27,4.35,4.35,0,0,1,.2,3,5.76,5.76,0,0,1-1.58,2.53,11.45,11.45,0,0,1-5.07,2.66,20.85,20.85,0,0,1-19.88-5,11.38,11.38,0,0,1-2.7-4.14,8.14,8.14,0,0,1-.27-4.75,6.7,6.7,0,0,1,2.46-3.86,5.8,5.8,0,0,1,4.24-1,5.64,5.64,0,0,1,3.65,2,6.05,6.05,0,0,1,1.35,3.72,5.9,5.9,0,0,1-1.17,3.55,8.78,8.78,0,0,1-2.63,2.33A20.81,20.81,0,0,1,46.81,372a37.32,37.32,0,0,1-5.19.86,36.14,36.14,0,0,1-7.28,0c-1.65-.19-2.51-.38-2.51-.38s.22,0,.65.07,1.05.13,1.87.2a38.12,38.12,0,0,0,7.25-.05,38.88,38.88,0,0,0,5.15-.9,20.33,20.33,0,0,0,5.77-2.22,8.52,8.52,0,0,0,2.54-2.26,5.58,5.58,0,0,0,1.09-3.36,5.77,5.77,0,0,0-1.29-3.51,5.34,5.34,0,0,0-3.43-1.87,5.5,5.5,0,0,0-4,1,6.37,6.37,0,0,0-2.29,3.64,7.7,7.7,0,0,0,.27,4.52,11.1,11.1,0,0,0,2.61,4,20.47,20.47,0,0,0,19.46,4.81,11,11,0,0,0,4.85-2.55,5.31,5.31,0,0,0,1.45-2.31,3.87,3.87,0,0,0-.19-2.68,5.29,5.29,0,0,0-4.48-3,4.91,4.91,0,0,0-2.73.7,6.44,6.44,0,0,0-2.1,2,7.66,7.66,0,0,0-1.19,5.68,11.7,11.7,0,0,0,2.64,5.43,16.64,16.64,0,0,0,10.89,5.63,17.9,17.9,0,0,0,6.28-.42,15.87,15.87,0,0,0,5.56-2.73A17.37,17.37,0,0,0,94.77,372a16.34,16.34,0,0,0,.18-5.91,10.13,10.13,0,0,0-2.19-5.25,4.29,4.29,0,0,0-5-1.17,3.38,3.38,0,0,0-1.6,2,4.65,4.65,0,0,0,0,2.64,10,10,0,0,0,3,4.4,14.82,14.82,0,0,0,4.5,2.74,14,14,0,0,0,9.9.14,14.76,14.76,0,0,0,7.26-5.83,12,12,0,0,0,1.68-4.09,6.14,6.14,0,0,0-.52-4.09,4.5,4.5,0,0,0-3.08-2.29,3.42,3.42,0,0,0-1.85.23,4.12,4.12,0,0,0-1.44,1.14,5.76,5.76,0,0,0-1.21,3.33,7.84,7.84,0,0,0,.65,3.32,10.91,10.91,0,0,0,4,4.58,14.21,14.21,0,0,0,4.8,2,25.87,25.87,0,0,0,7.21.45l1.88-.11C123.4,370.24,123.62,370.24,123.62,370.24Z" style="fill: rgb(255, 255, 255); transform-origin: 77.7246px 370.502px 0px;" id="elsyobyp86gpo" class="animable"></path>
                    <path d="M424.42,172.52c-.39,1.31-7.05,11.81-16.66,15.38s-16.75,7.52-14.08,12.22,14.47,2.14,14.47,2.14-23.95,26-1.4,40.91C434.24,261.32,463,196.38,463,196.38Z" style="fill: rgb(235, 235, 235); transform-origin: 428.057px 209.445px 0px;" id="elzq1yfdwzq89" class="animable"></path>
                    <path d="M458.44,205.29c-.07.12-9.13-5.28-20.24-12.06s-20.05-12.39-20-12.51,9.14,5.28,20.24,12.06S458.52,205.17,458.44,205.29Z" style="fill: rgb(224, 224, 224); transform-origin: 438.32px 193.006px 0px;" id="elya0atoh4gzn" class="animable"></path>
                    <path d="M454.19,213.08c-.08.12-9.87-5.63-21.87-12.83s-21.67-13.16-21.6-13.28,9.87,5.62,21.87,12.83S454.26,213,454.19,213.08Z" style="fill: rgb(224, 224, 224); transform-origin: 432.455px 200.023px 0px;" id="el1d5l5lssdez" class="animable"></path>
                    <path d="M449.05,220.46c-.07.12-11.07-6.35-24.55-14.45s-24.36-14.77-24.29-14.89,11.07,6.34,24.56,14.44S449.12,220.33,449.05,220.46Z" style="fill: rgb(224, 224, 224); transform-origin: 424.631px 205.791px 0px;" id="elaklt17vg329" class="animable"></path>
                    <path d="M442.64,229.59c-.08.12-8.6-5.08-19-11.61s-18.83-11.92-18.75-12,8.59,5.08,19,11.61S442.71,229.47,442.64,229.59Z" style="fill: rgb(224, 224, 224); transform-origin: 423.766px 217.787px 0px;" id="elrfz5zhka3yn" class="animable"></path>
                    <path d="M435.1,238.4c-.08.12-8-5-17.72-11.43S399.87,215.22,400,215.1s8,5,17.72,11.44S435.18,238.28,435.1,238.4Z" style="fill: rgb(224, 224, 224); transform-origin: 417.551px 226.75px 0px;" id="eljp4smgkvpb" class="animable"></path>
                    <path d="M425.48,244.52a6.67,6.67,0,0,1-1.2-.56c-.76-.4-1.84-1-3.17-1.74-2.66-1.49-6.28-3.64-10.2-6.15s-7.39-4.91-9.86-6.7c-1.23-.9-2.22-1.64-2.89-2.16a6,6,0,0,1-1-.86,6.71,6.71,0,0,1,1.13.69l3,2c2.52,1.71,6,4.06,9.93,6.57s7.5,4.7,10.11,6.28l3.08,1.87A7,7,0,0,1,425.48,244.52Z" style="fill: rgb(224, 224, 224); transform-origin: 411.32px 235.436px 0px;" id="elka4axhedupi" class="animable"></path>
                    <path d="M402.93,202.86a16.36,16.36,0,0,1-5.31-2.44,16.15,16.15,0,0,1-4.45-3.78c.1-.12,2,1.64,4.73,3.34S403,202.71,402.93,202.86Z" style="fill: rgb(224, 224, 224); transform-origin: 398.051px 199.746px 0px;" id="elbpvptv5hpaq" class="animable"></path>
                    <path d="M461.18,195a2.31,2.31,0,0,1-.34.57l-1.07,1.55c-.93,1.35-2.31,3.28-4,5.64-3.45,4.74-8.32,11.21-13.88,18.21s-10.77,13.21-14.6,17.65c-1.91,2.22-3.48,4-4.58,5.21-.52.57-.94,1-1.27,1.39a3.19,3.19,0,0,1-.47.47,3.1,3.1,0,0,1,.39-.53l1.2-1.46L427,238.4c3.76-4.49,8.91-10.74,14.47-17.73s10.47-13.43,14-18.11l4.18-5.54,1.14-1.49A4.21,4.21,0,0,1,461.18,195Z" style="fill: rgb(224, 224, 224); transform-origin: 441.074px 220.346px 0px;" id="el3xmwx0ssexy" class="animable"></path>
                    <path d="M453.39,189.47c.11.09-9.44,12.55-21.33,27.83s-21.62,27.6-21.74,27.51,9.44-12.54,21.33-27.83S453.28,189.38,453.39,189.47Z" style="fill: rgb(224, 224, 224); transform-origin: 431.855px 217.139px 0px;" id="elh6lro6kz5ec" class="animable"></path>
                    <path d="M442.52,183.31a3.9,3.9,0,0,1-.31.62l-1,1.72c-.86,1.49-2.16,3.62-3.83,6.2-3.34,5.17-8.3,12.08-14.15,19.43s-11.38,13.8-15.37,18.48l-4.75,5.51-1.32,1.49a3.9,3.9,0,0,1-.48.49,4.94,4.94,0,0,1,.4-.56l1.24-1.55,4.63-5.62c3.92-4.74,9.4-11.23,15.24-18.57s10.84-14.2,14.25-19.31c1.71-2.55,3.05-4.64,4-6.1l1.06-1.67A3,3,0,0,1,442.52,183.31Z" style="fill: rgb(224, 224, 224); transform-origin: 421.914px 210.279px 0px;" id="elyp30b5vnw6" class="animable"></path>
                    <path d="M433.6,178.2c.11.09-8,10.86-18.18,24.06S397,226.09,396.83,226s8-10.86,18.18-24.07S433.48,178.11,433.6,178.2Z" style="fill: rgb(224, 224, 224); transform-origin: 415.213px 202.1px 0px;" id="el9yx6qjtmg5e" class="animable"></path>
                    <path d="M426.89,173.83a10.71,10.71,0,0,1-.86,1.44c-.28.45-.65,1-1.1,1.62s-.95,1.34-1.57,2.08a57,57,0,0,1-4.53,5,57.39,57.39,0,0,1-13.34,9.8,56.77,56.77,0,0,1-6.16,2.81c-.89.37-1.73.62-2.45.87a19.24,19.24,0,0,1-1.88.57,11.67,11.67,0,0,1-1.63.39,9.54,9.54,0,0,1,1.57-.58c.51-.17,1.13-.37,1.84-.65s1.54-.55,2.41-.94a65,65,0,0,0,6.07-2.89,66.82,66.82,0,0,0,6.95-4.42,65.82,65.82,0,0,0,6.29-5.31,60.1,60.1,0,0,0,4.57-4.93c.64-.72,1.15-1.42,1.62-2s.87-1.13,1.18-1.57A9.27,9.27,0,0,1,426.89,173.83Z" style="fill: rgb(224, 224, 224); transform-origin: 410.131px 186.119px 0px;" id="el8gt54egxytd" class="animable"></path>
                    <rect x="345.66" y="159.48" width="127.87" height="13.5" style="fill: rgb(224, 224, 224); transform-origin: 409.595px 166.23px 0px;" id="el14f46152olkm" class="animable"></rect>
                    <path d="M386.2,172.52c-.39,1.31-7.05,11.81-16.66,15.38s-16.75,7.52-14.08,12.22,14.47,2.14,14.47,2.14-23.95,26-1.4,40.91c27.49,18.15,56.22-46.79,56.22-46.79Z" style="fill: rgb(245, 245, 245); transform-origin: 389.822px 209.445px 0px;" id="elv75d3ea2w5j" class="animable"></path>
                    <path d="M420.22,205.29c-.07.12-9.13-5.28-20.24-12.06s-20.05-12.39-20-12.51,9.14,5.28,20.24,12.06S420.3,205.17,420.22,205.29Z" style="fill: rgb(224, 224, 224); transform-origin: 400.1px 193.006px 0px;" id="elf02i7lgju6h" class="animable"></path>
                    <path d="M416,213.08c-.08.12-9.87-5.63-21.87-12.83S372.43,187.09,372.5,187s9.87,5.62,21.87,12.83S416,213,416,213.08Z" style="fill: rgb(224, 224, 224); transform-origin: 394.25px 200.039px 0px;" id="ele6co73isszf" class="animable"></path>
                    <path d="M410.83,220.46c-.07.12-11.07-6.35-24.55-14.45S361.92,191.24,362,191.12s11.07,6.34,24.56,14.44S410.9,220.33,410.83,220.46Z" style="fill: rgb(224, 224, 224); transform-origin: 386.414px 205.791px 0px;" id="eluejxb8nt9sj" class="animable"></path>
                    <path d="M404.42,229.59c-.08.12-8.6-5.08-19-11.61s-18.83-11.92-18.75-12,8.59,5.08,19,11.61S404.49,229.47,404.42,229.59Z" style="fill: rgb(224, 224, 224); transform-origin: 385.547px 217.787px 0px;" id="elfzk7jhu9dkh" class="animable"></path>
                    <path d="M396.88,238.4c-.08.12-8-5-17.72-11.43s-17.51-11.75-17.43-11.87,8,5,17.72,11.44S397,238.28,396.88,238.4Z" style="fill: rgb(224, 224, 224); transform-origin: 379.305px 226.75px 0px;" id="elpjmj1azlf4n" class="animable"></path>
                    <path d="M387.26,244.52a6.67,6.67,0,0,1-1.2-.56c-.76-.4-1.84-1-3.17-1.74-2.66-1.49-6.28-3.64-10.2-6.15s-7.39-4.91-9.86-6.7c-1.23-.9-2.22-1.64-2.89-2.16a6,6,0,0,1-1-.86,6.71,6.71,0,0,1,1.13.69l3,2c2.52,1.71,6,4.06,9.93,6.57s7.5,4.7,10.1,6.28l3.09,1.87A7,7,0,0,1,387.26,244.52Z" style="fill: rgb(224, 224, 224); transform-origin: 373.102px 235.436px 0px;" id="el6e19qjbmq6g" class="animable"></path>
                    <path d="M364.71,202.86a16.36,16.36,0,0,1-5.31-2.44,16.15,16.15,0,0,1-4.45-3.78c.1-.12,2,1.64,4.73,3.34S364.77,202.71,364.71,202.86Z" style="fill: rgb(224, 224, 224); transform-origin: 359.83px 199.746px 0px;" id="eld6allbyzvf8" class="animable"></path>
                    <path d="M423,195a2.31,2.31,0,0,1-.34.57l-1.07,1.55c-.93,1.35-2.31,3.28-4,5.64-3.45,4.74-8.32,11.21-13.88,18.21S392.86,234.2,389,238.64c-1.91,2.22-3.48,4-4.58,5.21-.52.57-.94,1-1.27,1.39a3.19,3.19,0,0,1-.47.47,3.1,3.1,0,0,1,.39-.53l1.2-1.46,4.45-5.32c3.76-4.49,8.91-10.74,14.47-17.73s10.47-13.43,14-18.11l4.18-5.54,1.14-1.49A4.21,4.21,0,0,1,423,195Z" style="fill: rgb(224, 224, 224); transform-origin: 402.84px 220.355px 0px;" id="elqw5nuern1bm" class="animable"></path>
                    <path d="M415.17,189.47c.11.09-9.44,12.55-21.33,27.83s-21.62,27.6-21.74,27.51,9.44-12.54,21.33-27.83S415.06,189.38,415.17,189.47Z" style="fill: rgb(224, 224, 224); transform-origin: 393.637px 217.139px 0px;" id="elut0nncy6rfa" class="animable"></path>
                    <path d="M404.3,183.31a3.9,3.9,0,0,1-.31.62l-1,1.72c-.86,1.49-2.16,3.62-3.83,6.2-3.34,5.17-8.3,12.08-14.15,19.43s-11.38,13.8-15.37,18.48l-4.75,5.51-1.32,1.49a3.9,3.9,0,0,1-.48.49,3.68,3.68,0,0,1,.4-.56l1.24-1.55,4.63-5.62c3.92-4.74,9.4-11.23,15.24-18.57s10.84-14.2,14.25-19.31c1.71-2.55,3.05-4.64,4-6.1.43-.69.79-1.24,1.06-1.67A3,3,0,0,1,404.3,183.31Z" style="fill: rgb(224, 224, 224); transform-origin: 383.695px 210.279px 0px;" id="el63nkyr56qpc" class="animable"></path>
                    <path d="M395.38,178.2c.11.09-8,10.86-18.18,24.06S358.73,226.09,358.61,226s8-10.86,18.18-24.07S395.26,178.11,395.38,178.2Z" style="fill: rgb(224, 224, 224); transform-origin: 376.994px 202.1px 0px;" id="el9kenhy0wvg" class="animable"></path>
                    <path d="M388.67,173.83a10.71,10.71,0,0,1-.86,1.44c-.28.45-.65,1-1.1,1.62s-.95,1.34-1.57,2.08a57,57,0,0,1-4.53,5,57.39,57.39,0,0,1-13.34,9.8,57.65,57.65,0,0,1-6.16,2.81c-.89.37-1.73.62-2.45.87a19.24,19.24,0,0,1-1.88.57,11.67,11.67,0,0,1-1.63.39,9.54,9.54,0,0,1,1.57-.58c.51-.17,1.13-.37,1.84-.65s1.54-.55,2.41-.94a65,65,0,0,0,6.07-2.89A66.82,66.82,0,0,0,374,189a65.82,65.82,0,0,0,6.29-5.31,60.1,60.1,0,0,0,4.57-4.93c.64-.72,1.15-1.42,1.62-2s.86-1.13,1.17-1.57A9.68,9.68,0,0,1,388.67,173.83Z" style="fill: rgb(224, 224, 224); transform-origin: 371.91px 186.119px 0px;" id="elnhbtrggs43o" class="animable"></path>
                    <rect x="405.58" y="91.92" width="8.18" height="8.18" style="fill: rgb(224, 224, 224); transform-origin: 409.67px 96.01px 0px;" id="elq2aef8phka" class="animable"></rect>
                    <rect x="371.75" y="110.98" width="76.22" height="48.1" style="fill: rgb(245, 245, 245); transform-origin: 409.86px 135.03px 0px;" id="elzqxlxtxtph" class="animable"></rect>
                    <path d="M371.75,111s11.67-12.19,40.93-11.7S448,111,448,111Z" style="fill: rgb(245, 245, 245); transform-origin: 409.875px 105.143px 0px;" id="elrubi93h7t58" class="animable"></path>
                    <path d="M447.68,111.77c0,.14-17.14.26-38.27.26s-38.27-.12-38.27-.26,17.13-.27,38.27-.27S447.68,111.62,447.68,111.77Z" style="fill: rgb(224, 224, 224); transform-origin: 409.41px 111.766px 0px;" id="elt8368wr0gd" class="animable"></path>
                    <path d="M447.68,111.77h17.22a2.76,2.76,0,0,1,2.76,2.76v1.06a2.76,2.76,0,0,1-2.76,2.76H447.68a0,0,0,0,1,0,0v-6.59A0,0,0,0,1,447.68,111.77Z" style="fill: rgb(224, 224, 224); transform-origin: 457.67px 115.057px 0px;" id="elu0u39hw0kij" class="animable"></path>
                    <g id="el00c0i1qzzap2h">
                        <path d="M352.06,111.77h17.22a2.76,2.76,0,0,1,2.76,2.76v1.06a2.76,2.76,0,0,1-2.76,2.76H352.06a0,0,0,0,1,0,0v-6.59a0,0,0,0,1,0,0Z" style="fill: rgb(224, 224, 224); transform-origin: 362.049px 115.057px 0px; transform: rotate(-180deg);" class="animable" id="elbco7246mxhh"></path>
                    </g>
                    <rect x="399.55" y="89.56" width="20.63" height="4.72" rx="1.98" style="fill: rgb(224, 224, 224); transform-origin: 409.865px 91.92px 0px;" id="elamtl0x3vl4k" class="animable"></rect>
                </g>
                <g id="freepik--Table--inject-38" style="transform-origin: 250px 403.771px 0px;" class="animable">
                    <path d="M470.5,403.77c0,.14-98.73.26-220.49.26s-220.51-.12-220.51-.26,98.71-.26,220.51-.26S470.5,403.63,470.5,403.77Z" style="fill: rgb(38, 50, 56); transform-origin: 250px 403.771px 0px;" id="elcmo76ah4l6r" class="animable"></path>
                </g>
                <g id="freepik--Character--inject-38" style="transform-origin: 249.998px 267.98px 0px;" class="animable">
                    <path d="M323.92,257.56c-.4,1.71-8.91,79.19-8.91,79.19l-7.7,10.95-2.09,16.76,16,39.57H202.84s-1.87-20.91-1.71-26.5,3-26.1,3-26.1l-.27-20.83-4.48-90.79,40.1-12.94c24.23-4.17,59.89,14,59.89,14Z" style="fill: #941B0B; transform-origin: 261.65px 315.141px 0px;" id="elcdawqk2nti" class="animable"></path>
                    <path d="M308.54,199.81c5.27-.33,9.31-4.73,12.21-9.14,2.72-4.12,5-8.74,5.06-13.67,0-4.28-1.68-8.36-3.36-12.3s-3.49-8.16-6.2-11.63-6.55-6.29-10.93-6.83" style="fill: rgb(38, 50, 56); transform-origin: 315.564px 173.023px 0px;" id="el31f9nnv7y8r" class="animable"></path>
                    <path d="M246.94,220.46l.06-1.31,3.09-75.65,1.71-4.29L289.64,134a21.78,21.78,0,0,1,23.46,21c.48,13.77.54,30.6-1.38,40.81C307.88,216.29,292,218.48,292,218.48s-.27,5.37-.57,13.14c-.22,5.86-5.4,22.77-11.27,22.94-2.52.07-9.4-2.12-12.68-2.6C246.79,248.94,246.94,220.46,246.94,220.46Z" style="fill: rgb(255, 190, 157); transform-origin: 280.162px 194.246px 0px;" id="ellwhrpj54b0c" class="animable"></path>
                    <path d="M306.11,166.94a2.64,2.64,0,0,1-2.62,2.6,2.53,2.53,0,0,1-2.66-2.46,2.64,2.64,0,0,1,2.62-2.6A2.53,2.53,0,0,1,306.11,166.94Z" style="fill: rgb(38, 50, 56); transform-origin: 303.469px 167.01px 0px;" id="el21wrpfuelu5" class="animable"></path>
                    <path d="M309.21,163.59c-.34.34-2.3-1.2-5.15-1.27s-5,1.29-5.27.93c-.15-.15.2-.77,1.13-1.4a7.21,7.21,0,0,1,4.23-1.18,7,7,0,0,1,4.09,1.44C309.09,162.81,309.37,163.44,309.21,163.59Z" style="fill: rgb(38, 50, 56); transform-origin: 304.006px 162.154px 0px;" id="el3x159ewopg7" class="animable"></path>
                    <path d="M278.26,166.67a2.64,2.64,0,0,1-2.62,2.6,2.53,2.53,0,0,1-2.66-2.46,2.64,2.64,0,0,1,2.62-2.6A2.53,2.53,0,0,1,278.26,166.67Z" style="fill: rgb(38, 50, 56); transform-origin: 275.621px 166.74px 0px;" id="elp95ewz78gl" class="animable"></path>
                    <path d="M281.22,163.35c-.34.34-2.31-1.2-5.15-1.27s-5,1.29-5.27.93c-.15-.15.2-.77,1.13-1.4a7.19,7.19,0,0,1,4.23-1.18,7,7,0,0,1,4.09,1.44C281.1,162.57,281.38,163.2,281.22,163.35Z" style="fill: rgb(38, 50, 56); transform-origin: 276.014px 161.914px 0px;" id="el077q5yopvtsd" class="animable"></path>
                    <path d="M291,184.74c0-.16,1.77-.42,4.65-.7.73-.06,1.42-.19,1.56-.68a3.76,3.76,0,0,0-.43-2.17l-2-5.59c-2.76-8-4.75-14.5-4.42-14.61s2.82,6.26,5.59,14.22c.66,2,1.3,3.83,1.9,5.62a4.19,4.19,0,0,1,.3,2.87,1.83,1.83,0,0,1-1.22,1,4.8,4.8,0,0,1-1.24.13C292.76,184.94,291,184.9,291,184.74Z" style="fill: rgb(38, 50, 56); transform-origin: 294.301px 172.939px 0px;" id="el8hrodm3sexp" class="animable"></path>
                    <path d="M292,218.48a52.52,52.52,0,0,1-27.42-8.13s6.31,14.35,27,13Z" style="fill: rgb(235, 153, 110); transform-origin: 278.289px 216.896px 0px;" id="el2t05ovok0qh" class="animable"></path>
                    <path d="M289.57,191.57a5.12,5.12,0,0,0-4.54-2,4.72,4.72,0,0,0-3.29,1.64,3,3,0,0,0-.31,3.39,3.43,3.43,0,0,0,3.7,1,10.69,10.69,0,0,0,3.7-2.07,3.08,3.08,0,0,0,.83-.82.94.94,0,0,0,0-1.06" style="fill: rgb(235, 153, 110); transform-origin: 285.436px 192.668px 0px;" id="elh4j1zb0p3p" class="animable"></path>
                    <path d="M282.53,186.48c.47,0,.39,3.07,3,5.34s5.88,2,5.9,2.45c0,.19-.75.58-2.15.58a7.66,7.66,0,0,1-4.92-1.87,6.68,6.68,0,0,1-2.29-4.47C282,187.21,282.32,186.46,282.53,186.48Z" style="fill: rgb(38, 50, 56); transform-origin: 286.744px 190.666px 0px;" id="el5quraykiis4" class="animable"></path>
                    <path d="M282.26,152.22c-.3.76-3.13.32-6.48.63s-6.08,1.14-6.5.44c-.19-.34.3-1,1.41-1.77a11.33,11.33,0,0,1,9.89-.82C281.79,151.23,282.39,151.85,282.26,152.22Z" style="fill: rgb(38, 50, 56); transform-origin: 275.76px 151.746px 0px;" id="elc4f6gvlrasr" class="animable"></path>
                    <path d="M308.39,155.32c-.52.64-2.46-.09-4.82-.18s-4.37.31-4.81-.38c-.19-.33.14-1,1-1.56a7,7,0,0,1,7.76.45C308.36,154.34,308.62,155,308.39,155.32Z" style="fill: rgb(38, 50, 56); transform-origin: 303.588px 153.91px 0px;" id="eldac7lz7qtmw" class="animable"></path>
                    <path d="M246.74,166.62a38,38,0,0,0-10.39,9.4c-3.28,4.11-5.41,9.43-4.59,14.63,1.13,7.21,7.38,12.33,13.19,16.75,3.34.48,5.83-3.21,6.35-6.55s.06-6.95,1.64-9.94c1.42-2.68,4.22-4.32,6.09-6.71,3.48-4.44,3.25-10.69,2.4-16.27s0-14,7.17-22C268.6,146,251.16,152.81,246.74,166.62Z" style="fill: rgb(38, 50, 56); transform-origin: 250.094px 176.686px 0px;" id="el89wlezjc65t" class="animable"></path>
                    <path d="M240.56,185.19c3-4.33,2.24-10.68-1.23-14.69s-9.07-5.75-14.35-5.3c-3.84.33-7.73,1.84-10.21,4.79s-3.23,7.5-1.17,10.76c1.14,1.8,3.12,3.5,2.67,5.59s-2.82,2.76-4.5,3.94a8.61,8.61,0,0,0-3,9.6,10.72,10.72,0,0,0,7.77,6.77,14.27,14.27,0,0,0,10.34-1.86c0,3.21,3.45,5.66,6.64,5.39s5.9-2.6,7.61-5.31a23.25,23.25,0,0,0,3.14-13,69.3,69.3,0,0,0-2.07-13.4" style="fill: rgb(38, 50, 56); transform-origin: 226.316px 187.664px 0px;" id="elwhehafo9y7g" class="animable"></path>
                    <path d="M245.84,208.38a2.08,2.08,0,0,1-.47-.3l-1.3-.94c-1.11-.83-2.72-2-4.59-3.68a33.34,33.34,0,0,1-5.85-6.5,19.72,19.72,0,0,1-3.43-10.11,13.92,13.92,0,0,1,.87-5.52,13.69,13.69,0,0,1,2.8-4.4,40,40,0,0,1,6.88-5.39A42.16,42.16,0,0,0,245.4,168c.51-.47.89-.85,1.14-1.12a2.54,2.54,0,0,1,.4-.38s-.1.17-.33.45a11.19,11.19,0,0,1-1.07,1.19,35.66,35.66,0,0,1-4.58,3.71,42,42,0,0,0-6.74,5.42,13.12,13.12,0,0,0-2.67,4.25,13.6,13.6,0,0,0-.83,5.32A19.49,19.49,0,0,0,234,196.7a34.39,34.39,0,0,0,5.7,6.49c1.83,1.66,3.4,2.91,4.47,3.79l1.23,1A2.77,2.77,0,0,1,245.84,208.38Z" style="fill: rgb(69, 90, 100); transform-origin: 238.563px 187.439px 0px;" id="elgu5ts7yatx5" class="animable"></path>
                    <path d="M231.14,182.28c-.09.05-.61-1.06-1.93-2.46a12.63,12.63,0,0,0-13.68-3.35c-1.81.64-2.79,1.37-2.84,1.29s.2-.23.65-.55a11.26,11.26,0,0,1,2.06-1.09,12.36,12.36,0,0,1,14.09,3.45,10.56,10.56,0,0,1,1.32,1.92A2.48,2.48,0,0,1,231.14,182.28Z" style="fill: rgb(69, 90, 100); transform-origin: 221.912px 178.744px 0px;" id="ela59zvw2oep" class="animable"></path>
                    <path d="M215.09,187.76c-.06,0,.31-1,1.66-1.84a7.2,7.2,0,0,1,2.56-.92,17.35,17.35,0,0,1,3.29-.19,23,23,0,0,1,5.88.93,7.76,7.76,0,0,1,2.28.92,22.22,22.22,0,0,1-2.38-.57,29.36,29.36,0,0,0-5.8-.76,11.34,11.34,0,0,0-5.65.91A7.72,7.72,0,0,0,215.09,187.76Z" style="fill: rgb(69, 90, 100); transform-origin: 222.922px 186.279px 0px;" id="elnfc23uwfi4m" class="animable"></path>
                    <path d="M211.65,204.1c0-.09,1.43-.06,3.68-.5a21.5,21.5,0,0,0,8.13-3.42,21.76,21.76,0,0,0,6-6.46c1.18-1.95,1.65-3.31,1.74-3.27a3.73,3.73,0,0,1-.27,1,18,18,0,0,1-1.15,2.49A20.05,20.05,0,0,1,215.39,204a17.47,17.47,0,0,1-2.73.21A2.92,2.92,0,0,1,211.65,204.1Z" style="fill: rgb(69, 90, 100); transform-origin: 221.424px 197.334px 0px;" id="el3s4510xt4p5" class="animable"></path>
                    <path d="M232.14,182c0-.05.61.54,1.87,1.23a11.44,11.44,0,0,0,5.86,1.28,13.57,13.57,0,0,0,4.08-.78,15.1,15.1,0,0,0,4.16-2.37,24.42,24.42,0,0,0,6.58-8.75,90,90,0,0,0,3.8-10.45,60.08,60.08,0,0,1,3.32-8.52,25.88,25.88,0,0,1,3.33-5.19c.47-.55.86-1,1.14-1.23a3.08,3.08,0,0,1,.44-.38s-.54.6-1.42,1.74a28.52,28.52,0,0,0-3.16,5.22,62.85,62.85,0,0,0-3.19,8.51,84.54,84.54,0,0,1-3.79,10.52,24.36,24.36,0,0,1-6.76,8.91,15.22,15.22,0,0,1-4.3,2.39,13.54,13.54,0,0,1-4.22.75,11.19,11.19,0,0,1-6-1.48,5,5,0,0,1-.81-.54,4,4,0,0,1-.55-.45A3,3,0,0,1,232.14,182Z" style="fill: rgb(69, 90, 100); transform-origin: 249.43px 165.863px 0px;" id="ela9xq5sr2yu4" class="animable"></path>
                    <path d="M261.49,163.42c.05,0-.36.6-.82,1.77a17.65,17.65,0,0,0-1,5.19,43.33,43.33,0,0,1-.89,7.92,16.57,16.57,0,0,1-5.24,8.19,15.87,15.87,0,0,1-8.93,3.85,16.82,16.82,0,0,1-7.87-1.21,15.87,15.87,0,0,1-4.56-2.84,10.72,10.72,0,0,1-1-1,2.26,2.26,0,0,1-.32-.4c.05,0,.5.5,1.48,1.28a16.59,16.59,0,0,0,4.57,2.66,16.77,16.77,0,0,0,7.69,1.07,15.51,15.51,0,0,0,8.63-3.77,16.25,16.25,0,0,0,5.12-7.92,45.76,45.76,0,0,0,1-7.82,16.84,16.84,0,0,1,1.18-5.24,9.65,9.65,0,0,1,.7-1.29A2.22,2.22,0,0,1,261.49,163.42Z" style="fill: rgb(69, 90, 100); transform-origin: 246.176px 176.912px 0px;" id="elkmv0ha131b" class="animable"></path>
                    <path d="M320.75,189.33s.34-.31.87-.92a9.24,9.24,0,0,0,1.75-2.94,12,12,0,0,0,.71-5,16.3,16.3,0,0,0-1.71-6c-2-4-4.7-7.07-6.49-9.41a26.18,26.18,0,0,1-1.94-2.92,5.18,5.18,0,0,1-.56-1.16,6.58,6.58,0,0,1,.73,1.06c.45.68,1.14,1.65,2.06,2.79,1.84,2.27,4.65,5.32,6.67,9.41a16.17,16.17,0,0,1,1.72,6.16,11.93,11.93,0,0,1-.84,5.16,8.85,8.85,0,0,1-2,2.94,6.44,6.44,0,0,1-.73.61C320.86,189.29,320.76,189.35,320.75,189.33Z" style="fill: rgb(69, 90, 100); transform-origin: 318.979px 175.156px 0px;" id="eld6e1q5uawy" class="animable"></path>
                    <path d="M317.79,195.19a15.06,15.06,0,0,0,2.47-3.58,11.33,11.33,0,0,0,1-4.56,14.17,14.17,0,0,0-1.16-5.61,49,49,0,0,0-2.7-5.18c-.87-1.58-1.62-3-2.23-4.25s-1.07-2.22-1.37-2.92a4.62,4.62,0,0,1-.41-1.12,6.39,6.39,0,0,1,.59,1l1.52,2.84c.65,1.2,1.43,2.62,2.32,4.19a43.42,43.42,0,0,1,2.76,5.21,14.22,14.22,0,0,1,1.16,5.82,11.54,11.54,0,0,1-1.13,4.71,10.29,10.29,0,0,1-1.89,2.66,8.23,8.23,0,0,1-.66.59C317.89,195.14,317.8,195.2,317.79,195.19Z" style="fill: rgb(69, 90, 100); transform-origin: 317.564px 181.58px 0px;" id="elg2lu9hwz8f" class="animable"></path>
                    <path d="M245.76,169.27c6.85-11.69,16.43-22.56,29.61-25.71a48.52,48.52,0,0,1,38,6.37V126.88l-16.45-53.1L284.11,67,253.83,84.32,246,148.19Z" style="fill: #941B0B; transform-origin: 279.566px 118.135px 0px;" id="elljozj0kg218" class="animable"></path>
                    <g id="elm66s6s3fr9q">
                        <g style="opacity: 0.7; transform-origin: 279.566px 118.135px 0px;" class="animable" id="el62b9vuvsgo5">
                            <path d="M245.76,169.27c6.85-11.69,16.43-22.56,29.61-25.71a48.52,48.52,0,0,1,38,6.37V126.88l-16.45-53.1L284.11,67,253.83,84.32,246,148.19Z" style="fill: rgb(255, 255, 255); transform-origin: 279.566px 118.135px 0px;" id="elfobxmpprca6" class="animable"></path>
                        </g>
                    </g>
                    <path d="M312.74,127.72a4,4,0,0,1-.73-.34c-.47-.23-1.13-.63-2-1a44,44,0,0,0-7.86-2.94,51.3,51.3,0,0,0-12.3-1.77,61.68,61.68,0,0,0-7.35.27,37.16,37.16,0,0,0-7.73,1.41,52.14,52.14,0,0,0-13.58,6.8,47.21,47.21,0,0,0-9.23,8.29,37.1,37.1,0,0,0-4.65,7c-.38.87-.69,1.56-.93,2.08a3.76,3.76,0,0,1-.35.72,4.15,4.15,0,0,1,.26-.75c.19-.49.45-1.22.84-2.14a35.07,35.07,0,0,1,4.54-7.13,46.89,46.89,0,0,1,9.25-8.45,51.58,51.58,0,0,1,13.7-6.9,37.88,37.88,0,0,1,7.84-1.42,60.26,60.26,0,0,1,7.4-.24,50.56,50.56,0,0,1,12.39,1.89,41,41,0,0,1,7.85,3.12c.9.43,1.55.86,2,1.12A4.77,4.77,0,0,1,312.74,127.72Z" style="fill: rgb(38, 50, 56); transform-origin: 279.385px 134.711px 0px;" id="eljta4j1p4lr" class="animable"></path>
                    <path d="M292.73,121.55c-.14,0-2.29-12.11-4.79-27.1s-4.42-27.16-4.28-27.18,2.29,12.11,4.79,27.1S292.87,121.53,292.73,121.55Z" style="fill: rgb(38, 50, 56); transform-origin: 288.195px 94.4102px 0px;" id="elpxpv4i30zgd" class="animable"></path>
                    <path d="M272.66,123.74c-.14,0,.08-11.51.51-25.71s.88-25.7,1-25.7-.09,11.52-.51,25.72S272.81,123.75,272.66,123.74Z" style="fill: rgb(38, 50, 56); transform-origin: 273.41px 98.0332px 0px;" id="eloronu6xv2m" class="animable"></path>
                    <path d="M255.58,133.31a2.11,2.11,0,0,1,0-.55c0-.42,0-.94.06-1.57.07-1.36.2-3.34.39-5.77.38-4.86,1-11.58,2-19s2-14,2.79-18.86c.42-2.41.78-4.35,1.06-5.69.13-.62.24-1.12.32-1.53a1.91,1.91,0,0,1,.15-.53,2.28,2.28,0,0,1,0,.55c-.07.41-.14.92-.23,1.55-.22,1.42-.53,3.35-.89,5.71-.75,4.82-1.71,11.49-2.64,18.87s-1.65,14.08-2.12,18.93c-.23,2.38-.42,4.32-.55,5.75-.07.64-.12,1.15-.17,1.57A2.05,2.05,0,0,1,255.58,133.31Z" style="fill: rgb(38, 50, 56); transform-origin: 258.965px 106.559px 0px;" id="elaisjydl5chq" class="animable"></path>
                    <path d="M295.65,125.44a11,11,0,0,1,0,2.32c-.12,1.62-.26,3.49-.41,5.56s-.3,3.94-.42,5.56a10.8,10.8,0,0,1-.29,2.3,9.53,9.53,0,0,1-.08-2.32c0-1.43.11-3.4.27-5.58s.37-4.14.56-5.56A10,10,0,0,1,295.65,125.44Z" style="fill: rgb(38, 50, 56); transform-origin: 295.063px 133.311px 0px;" id="el1ko5z6m2r4n" class="animable"></path>
                    <path d="M200.22,352.85c-1.26-1.84-4.65-3.48-6.87-3.72-7.68-.84-14.68,2.47-20.74,7.27l-1.19,2.17c-3.26,2.54-6.66,5.44-7.67,9.45a58.94,58.94,0,0,0-1.39,12.72,9.33,9.33,0,0,0,2.59,6.07,8.34,8.34,0,0,0,5.62,2.73,20.46,20.46,0,0,0,11.71-2.62,32.33,32.33,0,0,0,9.18-7.9,45,45,0,0,0,9.36-20C201.22,357,201.42,354.62,200.22,352.85Z" style="fill: #941B0B; transform-origin: 181.744px 369.301px 0px;" id="eljxus4rtl8bc" class="animable"></path>
                    <g id="elxdcws1oz33h">
                        <g style="opacity: 0.4; transform-origin: 181.744px 369.301px 0px;" class="animable" id="el8qw3ieqywl2">
                            <path d="M200.22,352.85c-1.26-1.84-4.65-3.48-6.87-3.72-7.68-.84-14.68,2.47-20.74,7.27l-1.19,2.17c-3.26,2.54-6.66,5.44-7.67,9.45a58.94,58.94,0,0,0-1.39,12.72,9.33,9.33,0,0,0,2.59,6.07,8.34,8.34,0,0,0,5.62,2.73,20.46,20.46,0,0,0,11.71-2.62,32.33,32.33,0,0,0,9.18-7.9,45,45,0,0,0,9.36-20C201.22,357,201.42,354.62,200.22,352.85Z" id="elhi0lztbdxlt" style="transform-origin: 181.744px 369.301px 0px;" class="animable"></path>
                        </g>
                    </g>
                    <path d="M199.39,239.81c-1.21.4-61.14,85.34-62.75,91s-10.38,19.11,2,31.74a247.52,247.52,0,0,0,24.5,21.73c-2.78-21.41,18.29-38.67,33-34.19l-11.25-7.63,25.71-34.15" style="fill: #941B0B; transform-origin: 171.363px 312.045px 0px;" id="elyng0djg05sp" class="animable"></path>
                    <path d="M323.92,257.56s9.43,11.79,11.78,19.42c2,6.52,12.7,36.69,12.7,36.69l19.47,48.25s-3,4.26-3.67,7.87c-.28,1.44-2.75,23.61-8.65,33l-31.23-14-3.94-27.95L315,336.75l5.56-64.85Z" style="fill: #941B0B; transform-origin: 341.436px 330.174px 0px;" id="el2zqnlvp69ks" class="animable"></path>
                    <path d="M236.27,227.55s8-7.38,10.22-8.42c0,0,2.54,8.67,10,12.77s12.27,8.52,12.27,9.11v10.75S238.19,243.41,236.27,227.55Z" style="fill: #941B0B; transform-origin: 252.516px 235.445px 0px;" id="elv16gbiytfo9" class="animable"></path>
                    <path d="M241.38,282.24l59.4-3.59L298,244.72,295.45,239l-4-7.22a11.42,11.42,0,0,1-2.81,6.59,22.64,22.64,0,0,1-12.07,6.38l-1.17,7L245.3,239.32s-3.92,41-3.92,41.94" style="fill: #941B0B; transform-origin: 271.08px 257.01px 0px;" id="elvw7bk0kydtf" class="animable"></path>
                    <path d="M276.55,244.72a2.27,2.27,0,0,1,0,.46c-.05.33-.12.78-.2,1.35q-.29,1.83-.82,5.25v.09h-.1l-24.43.75-4,.11-2.09.06a6.44,6.44,0,0,0-2,.26,4.59,4.59,0,0,0-2.83,2.84,5.36,5.36,0,0,0-.23,2.13c0,.76,0,1.52,0,2.28.13,6.12.27,12.6.41,19.3.46,18.78.75,35.79.66,48.1,0,6.16-.1,11.14-.18,14.58-.05,1.69-.08,3-.11,4,0,.43,0,.77,0,1a1.6,1.6,0,0,1,0,.35,1.35,1.35,0,0,1,0-.35c0-.26,0-.6,0-1,0-.94,0-2.27,0-4,0-3.47,0-8.44,0-14.57,0-12.31-.35-29.31-.81-48.09-.13-6.7-.26-13.18-.39-19.3l0-2.28a6,6,0,0,1,.27-2.29,5.06,5.06,0,0,1,3.13-3.14,6.84,6.84,0,0,1,2.17-.27l2.08-.05,4-.1,24.44-.54-.11.1q.6-3.41.92-5.23l.26-1.34A3.3,3.3,0,0,1,276.55,244.72Z" style="fill: rgb(38, 50, 56); transform-origin: 258.002px 296.174px 0px;" id="elggvfhavo65q" class="animable"></path>
                    <circle cx="246.75" cy="264.86" r="2.54" style="fill: rgb(38, 50, 56); transform-origin: 246.75px 264.86px 0px;" id="eljrt4bk1gzfl" class="animable"></circle>
                    <path d="M261,262.13c0,.16-2.86.53-6.34,1.34s-6.23,1.73-6.28,1.59a23,23,0,0,1,6.16-2.1A23.78,23.78,0,0,1,261,262.13Z" style="fill: rgb(38, 50, 56); transform-origin: 254.689px 263.602px 0px;" id="eleocymmm9uj" class="animable"></path>
                    <path d="M256.69,267.18a41.93,41.93,0,0,1-4.44-.93,40.8,40.8,0,0,1-4.44-.93,20,20,0,0,1,8.88,1.86Z" style="fill: rgb(38, 50, 56); transform-origin: 252.25px 266.248px 0px;" id="ellw6ybsm5a9l" class="animable"></path>
                    <circle cx="246.75" cy="293.58" r="2.54" style="fill: rgb(38, 50, 56); transform-origin: 246.75px 293.58px 0px;" id="elm2176up4p4" class="animable"></circle>
                    <path d="M261,290.86c0,.15-2.86.52-6.34,1.33s-6.23,1.73-6.28,1.59a22.76,22.76,0,0,1,6.16-2.09A23.32,23.32,0,0,1,261,290.86Z" style="fill: rgb(38, 50, 56); transform-origin: 254.689px 292.328px 0px;" id="elzrw9f4ny4n" class="animable"></path>
                    <path d="M256.69,295.9a41.93,41.93,0,0,1-4.44-.93,40.8,40.8,0,0,1-4.44-.93,20,20,0,0,1,8.88,1.86Z" style="fill: rgb(38, 50, 56); transform-origin: 252.25px 294.967px 0px;" id="elqgyaxoe8d6t" class="animable"></path>
                    <circle cx="246.75" cy="322.31" r="2.54" style="fill: rgb(38, 50, 56); transform-origin: 246.75px 322.31px 0px;" id="elxukag5317wc" class="animable"></circle>
                    <path d="M261,319.58c0,.15-2.86.52-6.34,1.33s-6.23,1.73-6.28,1.59a22.76,22.76,0,0,1,6.16-2.09A23.32,23.32,0,0,1,261,319.58Z" style="fill: rgb(38, 50, 56); transform-origin: 254.689px 321.047px 0px;" id="elb562lnnb7m" class="animable"></path>
                    <path d="M256.69,324.62a41.93,41.93,0,0,1-4.44-.93,40.8,40.8,0,0,1-4.44-.93,13.52,13.52,0,0,1,4.55.42A13.25,13.25,0,0,1,256.69,324.62Z" style="fill: rgb(38, 50, 56); transform-origin: 252.25px 323.67px 0px;" id="elja7whqw9pc8" class="animable"></path>
                    <path d="M207,316a3.46,3.46,0,0,1,.14-.73c.12-.52.29-1.2.5-2.05.44-1.79,1.1-4.36,1.85-7.55s1.58-7,2.23-11.3a78.07,78.07,0,0,0,.92-14,51.67,51.67,0,0,0-2.38-13.81,40.26,40.26,0,0,0-4.94-10.31,33.29,33.29,0,0,0-5-5.88c-.64-.65-1.23-1.06-1.58-1.39a3.29,3.29,0,0,1-.54-.51,4.86,4.86,0,0,1,.6.42c.38.31,1,.7,1.66,1.33a31.6,31.6,0,0,1,5.17,5.82,40.09,40.09,0,0,1,5.1,10.37,51.37,51.37,0,0,1,2.44,13.94,75.14,75.14,0,0,1-1,14.12c-.67,4.3-1.55,8.12-2.34,11.31s-1.51,5.75-2,7.52c-.24.84-.44,1.52-.59,2A5.34,5.34,0,0,1,207,316Z" style="fill: rgb(38, 50, 56); transform-origin: 205.695px 282.234px 0px;" id="el8n97dprr9e7" class="animable"></path>
                    <path d="M206,315.14a8,8,0,0,1-.34-1.33c-.19-.86-.41-2.12-.64-3.69a80.37,80.37,0,0,1-.79-12.33,79.46,79.46,0,0,1,1.14-12.31c.27-1.55.53-2.81.75-3.66a6.82,6.82,0,0,1,.38-1.33,7.43,7.43,0,0,1-.18,1.37c-.16.86-.36,2.12-.58,3.68a95.22,95.22,0,0,0-1,12.26,96.56,96.56,0,0,0,.64,12.27c.18,1.57.34,2.83.47,3.7A6.08,6.08,0,0,1,206,315.14Z" style="fill: rgb(38, 50, 56); transform-origin: 205.361px 297.814px 0px;" id="eljch2yrdyiyn" class="animable"></path>
                    <path d="M149.15,341.2a11,11,0,0,1,1.55-.39,21.57,21.57,0,0,0,4-1.62c1.63-.84,3.48-2,5.59-3.27a22.28,22.28,0,0,1,7.38-3.07,12.55,12.55,0,0,1,7.86,1.29,24.26,24.26,0,0,1,5.3,3.82,33.24,33.24,0,0,1,3,3.18,9,9,0,0,1,1,1.29,11.62,11.62,0,0,1-1.12-1.15,42.76,42.76,0,0,0-3.12-3,25.41,25.41,0,0,0-5.27-3.67,12.19,12.19,0,0,0-7.56-1.2,22.2,22.2,0,0,0-7.23,3c-2.11,1.22-4,2.37-5.67,3.18a18.49,18.49,0,0,1-4.14,1.48,10.91,10.91,0,0,1-1.19.18A1.59,1.59,0,0,1,149.15,341.2Z" style="fill: rgb(38, 50, 56); transform-origin: 166.988px 337.559px 0px;" id="el9rttba14tli" class="animable"></path>
                    <path d="M169.86,320.39a3.89,3.89,0,0,1,.95.37,7,7,0,0,1,1.07.53,15.85,15.85,0,0,1,1.36.82,22.16,22.16,0,0,1,3.23,2.58,23.26,23.26,0,0,1,5.57,8.38,22,22,0,0,1,1.13,4,15.29,15.29,0,0,1,.23,1.57,9.22,9.22,0,0,1,.08,1.19,3.37,3.37,0,0,1,0,1c-.1,0-.14-1.45-.64-3.71a25,25,0,0,0-1.21-3.87,28.4,28.4,0,0,0-2.33-4.38,26.9,26.9,0,0,0-3.14-3.83,24.58,24.58,0,0,0-3.1-2.62C171.14,321.07,169.82,320.48,169.86,320.39Z" style="fill: rgb(38, 50, 56); transform-origin: 176.689px 330.609px 0px;" id="el8xyi2vk9qyn" class="animable"></path>
                    <g id="elayi8fdq0p0q">
                        <g style="opacity: 0.4; transform-origin: 165.27px 333.482px 0px;" class="animable" id="eloe1j2qna8qq">
                            <path d="M183,339.58A24.45,24.45,0,0,0,162,325a7.3,7.3,0,0,0-3.56.55,3.1,3.1,0,0,0-1.82,2.9,8.86,8.86,0,0,1,.28,1.75c-.15,1.33-1.8,1.81-3.09,2.18a13,13,0,0,0-6.43,4.19c-.87,1-1.57,2.61-.74,3.69.69.88,2,.88,3.11.68,4.12-.72,7.79-2.94,11.55-4.76s8-3.29,12.08-2.37c4.51,1,7.86,4.7,10.89,8.19" id="eldewqgfhle5a" style="transform-origin: 165.27px 333.482px 0px;" class="animable"></path>
                        </g>
                    </g>
                    <path d="M315,336.75a3.34,3.34,0,0,1-.37.44l-1.15,1.18c-.49.51-1.11,1.12-1.86,1.8s-1.58,1.49-2.56,2.3a88.49,88.49,0,0,1-7.09,5.46,88.26,88.26,0,0,1-19.41,10.15c-3.17,1.16-6.07,2.07-8.54,2.7-1.23.34-2.36.57-3.35.79s-1.84.39-2.55.5l-1.61.26a2.06,2.06,0,0,1-.57.06,2.11,2.11,0,0,1,.55-.16l1.6-.36c.69-.14,1.54-.33,2.52-.58s2.1-.5,3.31-.87c2.45-.67,5.33-1.61,8.47-2.79a93,93,0,0,0,19.3-10.09c2.77-1.9,5.18-3.73,7.13-5.36,1-.78,1.84-1.56,2.6-2.22s1.41-1.25,1.92-1.74l1.21-1.11A2.47,2.47,0,0,1,315,336.75Z" style="fill: rgb(38, 50, 56); transform-origin: 290.471px 349.57px 0px;" id="elyfldgeb0n" class="animable"></path>
                    <path d="M324.32,271a3.38,3.38,0,0,1-.07.67c-.07.49-.17,1.13-.29,1.92l-1.1,7c-.92,5.93-2.13,14.15-3.37,23.23s-2.32,17.27-3.13,23.28l-.94,7.05c-.12.79-.21,1.43-.28,1.92a3.42,3.42,0,0,1-.13.66,2.91,2.91,0,0,1,0-.68q.06-.74.18-1.92c.19-1.74.45-4.14.78-7.08.69-6,1.72-14.21,3-23.3s2.51-17.3,3.52-23.22c.52-3,.94-5.36,1.28-7,.15-.78.28-1.41.38-1.9A2.62,2.62,0,0,1,324.32,271Z" style="fill: rgb(38, 50, 56); transform-origin: 319.656px 303.865px 0px;" id="elgn8vqqfsyd4" class="animable"></path>
                    <path d="M290.48,369.86a4.28,4.28,0,0,1,.54-1c.38-.59.94-1.44,1.65-2.49,1.43-2.08,3.46-4.92,5.79-8s4.53-5.78,6.17-7.7c.81-1,1.48-1.73,2-2.26s.75-.8.78-.77a4.79,4.79,0,0,1-.62.9L304.91,351c-1.55,2-3.7,4.72-6,7.78s-4.4,5.86-5.9,7.89L291.19,369A4.53,4.53,0,0,1,290.48,369.86Z" style="fill: rgb(38, 50, 56); transform-origin: 298.945px 358.748px 0px;" id="el1bmf4796dle" class="animable"></path>
                    <path d="M354.85,349a13.91,13.91,0,0,1-1.6-.66c-1-.44-2.5-1.07-4.37-1.72a43,43,0,0,0-15.17-2.55,12,12,0,0,0-4.23.87,10.86,10.86,0,0,0-3.33,2.25A17.37,17.37,0,0,0,322.4,353a46.45,46.45,0,0,0-1.58,4.43,11.42,11.42,0,0,1-.57,1.64,11.89,11.89,0,0,1,.37-1.7,39.53,39.53,0,0,1,1.44-4.51,17.22,17.22,0,0,1,3.76-5.94,11.21,11.21,0,0,1,3.46-2.38,12.44,12.44,0,0,1,4.4-.92A40.66,40.66,0,0,1,349,346.31a43.62,43.62,0,0,1,4.34,1.89c.5.24.88.46,1.14.6A1.53,1.53,0,0,1,354.85,349Z" style="fill: rgb(38, 50, 56); transform-origin: 337.551px 351.342px 0px;" id="ellx33texliog" class="animable"></path>
                    <path d="M347.37,333.34c0,.11-1.57.06-4,.49a26.15,26.15,0,0,0-4.24,1.12,26.49,26.49,0,0,0-9.1,5.57,25.8,25.8,0,0,0-2.93,3.27c-1.5,2-2.17,3.42-2.27,3.37a4.66,4.66,0,0,1,.43-1,10.54,10.54,0,0,1,.62-1.14,16.72,16.72,0,0,1,.92-1.44,24.2,24.2,0,0,1,2.9-3.4,24.75,24.75,0,0,1,9.27-5.67,23.6,23.6,0,0,1,4.34-1c.63-.11,1.21-.13,1.71-.17a11.85,11.85,0,0,1,1.29,0A5.09,5.09,0,0,1,347.37,333.34Z" style="fill: rgb(38, 50, 56); transform-origin: 336.1px 340.236px 0px;" id="el3se3yqjrfq" class="animable"></path>
                    <path d="M355.41,396.71A19.72,19.72,0,0,0,344,381.63c-4.77-2.13-11.35-2.62-15.88,0s-10.59,9.06-9.36,14.13l10.39,17.45a16.53,16.53,0,0,0,18.53.59A18,18,0,0,0,355.41,396.71Z" style="fill: #941B0B; transform-origin: 337.074px 398.1px 0px;" id="elfgoaipc0w4l" class="animable"></path>
                    <g id="eldddbjq4r0ga">
                        <g style="opacity: 0.4; transform-origin: 337.074px 398.1px 0px;" class="animable" id="ele2qvwcw6zm">
                            <path d="M355.41,396.71A19.72,19.72,0,0,0,344,381.63c-4.77-2.13-11.35-2.62-15.88,0s-10.59,9.06-9.36,14.13l10.39,17.45a16.53,16.53,0,0,0,18.53.59A18,18,0,0,0,355.41,396.71Z" id="elvteds71qko" style="transform-origin: 337.074px 398.1px 0px;" class="animable"></path>
                        </g>
                    </g>
                    <path d="M352.17,409.43s.37-.7,1-1.94a20.28,20.28,0,0,0,1.79-5.66,18.22,18.22,0,0,0-.76-8.69,21.11,21.11,0,0,0-1-2.35,19.76,19.76,0,0,0-1.35-2.28,18.81,18.81,0,0,0-8.49-6.95,19.36,19.36,0,0,0-13.71,0,20.81,20.81,0,0,0-5.24,2.79c-1.13.85-1.71,1.38-1.75,1.34a3.22,3.22,0,0,1,.4-.41,13.13,13.13,0,0,1,1.22-1.09,19.53,19.53,0,0,1,5.24-3,19.41,19.41,0,0,1,14-.09,18.78,18.78,0,0,1,4.91,2.9,19.56,19.56,0,0,1,3.83,4.23,22.41,22.41,0,0,1,1.37,2.35,20.27,20.27,0,0,1,1,2.42,18.11,18.11,0,0,1,.67,8.9,18.85,18.85,0,0,1-2,5.69c-.34.62-.67,1.08-.87,1.39A1.87,1.87,0,0,1,352.17,409.43Z" style="fill: rgb(38, 50, 56); transform-origin: 339.117px 394.635px 0px;" id="elwh9fpi1q4dr" class="animable"></path>
                    <path d="M323.6,384.89c-.15,0-1.36-6.82-2.72-15.29s-2.34-15.35-2.2-15.38,1.36,6.83,2.72,15.3S323.74,384.87,323.6,384.89Z" style="fill: rgb(38, 50, 56); transform-origin: 321.141px 369.555px 0px;" id="eleo72uhgk11v" class="animable"></path>
                    <g id="elm2mhml57vt9">
                        <g style="opacity: 0.4; transform-origin: 333.559px 356.846px 0px;" class="animable" id="elthymzthfyde">
                            <path d="M316.82,344.92l5.31-.37A24.43,24.43,0,0,1,337.46,334a9.49,9.49,0,0,1,4.43-.09,4.32,4.32,0,0,1,3.14,2.89,2.86,2.86,0,0,1-2,3.46,11,11,0,0,1,6.94,5.51c.3.57.52,1.35.07,1.81a1.65,1.65,0,0,1-1.2.32c-2.45,0-4.88-.55-7.33-.66a11,11,0,0,0-7,1.65c-2,1.43-3.08,3.76-4,6A122,122,0,0,0,323.07,380c-1.23-4.87-1.34-10-2.23-14.62-1.27-6.55-2.5-13.25-4-20.44" id="el0vilmjobe0b" style="transform-origin: 333.559px 356.846px 0px;" class="animable"></path>
                        </g>
                    </g>
                    <g id="elx58jl6ptl6j">
                        <g style="opacity: 0.4; transform-origin: 231.736px 365.418px 0px;" class="animable" id="el1o1c4trja8x">
                            <path d="M201.65,389.08c6.61,7.05,15.53,10.35,25.08,11.91s19.3,1,29,.46c2.38-.14,5.2-.55,6.24-2.7.74-1.53.23-3.34-.36-4.92-4.26-11.27-12.68-20.38-20.91-29.17-3-3.22-6.22-6.56-10.43-7.86-4.63-1.42-9.89-.17-14.28-2.21-5.28-2.45-7.43-8.67-9.06-14.26l-3.36-11.5c.74,12.53.61,22.6.61,22.6s-3.46,23.16-3,28.41S201.65,389.08,201.65,389.08Z" id="el3zbe8q9ut42" style="transform-origin: 231.736px 365.418px 0px;" class="animable"></path>
                        </g>
                    </g>
                    <path d="M267.48,246.12a6.06,6.06,0,0,1-1.31-.29c-.84-.21-2-.58-3.5-1.1a57.2,57.2,0,0,1-10.88-5.26,57.89,57.89,0,0,1-9.55-7.42c-1.11-1.08-2-2-2.53-2.65a5.74,5.74,0,0,1-.84-1.05,8,8,0,0,1,1,.91c.6.62,1.5,1.48,2.64,2.52a64.64,64.64,0,0,0,20.3,12.61c1.43.56,2.61,1,3.43,1.25A7.62,7.62,0,0,1,267.48,246.12Z" style="fill: rgb(38, 50, 56); transform-origin: 253.176px 237.236px 0px;" id="el6ljdcleoidp" class="animable"></path>
                    <path d="M295.36,240.57a2.39,2.39,0,0,1-.38.74,15,15,0,0,1-1.29,1.86,23.47,23.47,0,0,1-12.35,8,14.9,14.9,0,0,1-2.22.43,2.63,2.63,0,0,1-.83.05c0-.09,1.15-.28,2.95-.83a27.17,27.17,0,0,0,6.64-3.11,26.81,26.81,0,0,0,5.52-4.81C294.64,241.51,295.28,240.52,295.36,240.57Z" style="fill: rgb(38, 50, 56); transform-origin: 286.824px 246.115px 0px;" id="eltfzzov1fe" class="animable"></path>
                    <path d="M300,246.74a17.46,17.46,0,0,1-8.15,9.11,57.9,57.9,0,0,0,4.51-4.17A58.62,58.62,0,0,0,300,246.74Z" style="fill: rgb(38, 50, 56); transform-origin: 295.926px 251.295px 0px;" id="el7phlp0a1ksg" class="animable"></path>
                    <path d="M247.54,365.65l.62-.13c2.22-.43,9.58-1.77,10.77-.58,1.39,1.4,11.36,11.19,11.36,11.19s-1.92,3.15-8.22,0S247.54,365.65,247.54,365.65Z" style="fill: rgb(255, 190, 157); transform-origin: 258.914px 370.996px 0px;" id="eloqw3e8bfxa9" class="animable"></path>
                    <path d="M233.4,345.76h0a5.06,5.06,0,0,1,6.88,1.22l30.39,40.31L262.88,393l-30.69-39.92A5.06,5.06,0,0,1,233.4,345.76Z" style="fill: rgb(38, 50, 56); transform-origin: 250.902px 368.957px 0px;" id="eltduujk2ldr8" class="animable"></path>
                    <path d="M163.91,372.75S200,378.61,205,379s18.69,14.91,22.66,16.3,14.72,1.19,14.72,1.19,19.48,1,20.08,0,1.79-.8,0-4.58a38.17,38.17,0,0,0-4-6.56s5,6.16,6.37,6.36,4.37.56,4.17-2.1-5.37-13.6-5.37-13.6-2.18-5.11-6.16-6.24-21.28-9.47-21.28-9.47H217.69l-21.58-10.26s-13.06-4.2-25.49,9.51a26.82,26.82,0,0,0-5.41,9.37Z" style="fill: rgb(255, 190, 157); transform-origin: 216.459px 373.184px 0px;" id="eltv4jxrlpxi" class="animable"></path>
                    <path d="M267.1,384.25a4.53,4.53,0,0,1-.54-1.05c-.35-.8-.78-1.78-1.28-2.94s-1.17-2.76-1.85-4.38a9.43,9.43,0,0,0-3.15-4.6,14.56,14.56,0,0,0-2.59-1.42l-2.55-1.14c-1.64-.72-3.12-1.34-4.36-1.86l-3-1.23a5.6,5.6,0,0,1-1.06-.5,5.58,5.58,0,0,1,1.14.31c.71.24,1.75.6,3,1.07s2.77,1.07,4.42,1.77l2.57,1.12a13.9,13.9,0,0,1,2.69,1.46,9.75,9.75,0,0,1,3.29,4.86c.65,1.63,1.23,3.12,1.74,4.41s.82,2.18,1.13,3A5.76,5.76,0,0,1,267.1,384.25Z" style="fill: rgb(235, 153, 110); transform-origin: 256.91px 374.689px 0px;" id="elcqlijf99q2o" class="animable"></path>
                    <path d="M249,374.23a9.57,9.57,0,0,1,1.91,1.48,40.61,40.61,0,0,1,4,4.19,39.67,39.67,0,0,1,3.42,4.72,9.15,9.15,0,0,1,1.12,2.13,13.88,13.88,0,0,1-1.43-1.93c-.85-1.21-2.06-2.86-3.51-4.59s-2.85-3.2-3.9-4.25A13.41,13.41,0,0,1,249,374.23Z" style="fill: rgb(235, 153, 110); transform-origin: 254.225px 380.49px 0px;" id="elkbwv2eb1exe" class="animable"></path>
                    <path d="M259.27,396.79a2.28,2.28,0,0,1-.76-.3,13.88,13.88,0,0,1-1.9-1.16,32.67,32.67,0,0,1-5.27-5.07c-1.87-2.15-3.54-4.11-4.72-5.55a18.52,18.52,0,0,1-1.85-2.39,16.84,16.84,0,0,1,2.12,2.15c1.26,1.38,3,3.3,4.84,5.44a40.85,40.85,0,0,0,5.1,5.12C258.28,396.19,259.31,396.72,259.27,396.79Z" style="fill: rgb(235, 153, 110); transform-origin: 252.02px 389.555px 0px;" id="el3cjnkfoulyv" class="animable"></path>
                    <path d="M248.55,396.77a7.49,7.49,0,0,1-1.86-.93,43.43,43.43,0,0,1-4.16-2.8,48.57,48.57,0,0,1-3.82-3.23,8.39,8.39,0,0,1-1.43-1.52c.11-.12,2.48,2,5.57,4.34S248.63,396.64,248.55,396.77Z" style="fill: rgb(235, 153, 110); transform-origin: 242.916px 392.527px 0px;" id="eljp7ed08uxg" class="animable"></path>
                    <path d="M307.76,411.77s-3.17-4.9-3.61-6.65,0-10.08-5.84-8.77V397c.15.71,0,17.65,0,17.65Z" style="fill: rgb(255, 190, 157); transform-origin: 303.035px 405.43px 0px;" id="el9p7x2q6tyrw" class="animable"></path>
                    <path d="M232.93,420.64s-5.39,49.74,52.85,48.29c47.48-1.18,46.65-47.46,46.65-47.46Z" style="fill: #941B0B; transform-origin: 282.613px 444.801px 0px;" id="el7haafz2wm2m" class="animable"></path>
                    <ellipse cx="281.81" cy="421.11" rx="54.27" ry="13.12" style="fill: #941B0B; transform-origin: 281.81px 421.11px 0px;" id="elhvwugm9c6l" class="animable"></ellipse>
                    <g id="el6t6euwp2dze">
                        <ellipse cx="282.62" cy="420.64" rx="49.81" ry="8.29" style="opacity: 0.4; transform-origin: 282.62px 420.64px 0px;" class="animable" id="elpg7gq7zx68r"></ellipse>
                    </g>
                    <path d="M334.24,424.86,334,425l-.67.42c-.59.37-1.49.88-2.67,1.48a53.69,53.69,0,0,1-10.52,3.95,133.15,133.15,0,0,1-16.38,3.06,161.61,161.61,0,0,1-20.38,1c-7.23-.06-14.13-.3-20.38-.85a116.26,116.26,0,0,1-16.47-2.56,74.14,74.14,0,0,1-10.72-3.34c-1.24-.47-2.17-.93-2.81-1.21l-.71-.34c-.17-.07-.25-.12-.24-.13a1.8,1.8,0,0,1,.26.09l.74.29c.65.25,1.58.67,2.83,1.11a80.48,80.48,0,0,0,10.74,3.17,120.06,120.06,0,0,0,16.42,2.44c6.24.52,13.12.75,20.35.81a164.63,164.63,0,0,0,20.31-1,136.1,136.1,0,0,0,16.34-2.94,56.44,56.44,0,0,0,10.53-3.77c1.18-.58,2.1-1.05,2.7-1.39l.7-.38C334.15,424.89,334.23,424.85,334.24,424.86Z" style="fill: rgb(38, 50, 56); transform-origin: 283.145px 429.893px 0px;" id="el4icsvc145bu" class="animable"></path>
                    <path d="M301,419.52s5.94-19.91,8-22.56c1.69-2.19,13.66-11.25,17.77-14.32a9.81,9.81,0,0,1,3.39-1.65c4.07-1.07,8.14-1.79,14.84,1.11a17,17,0,0,1,9.14,9.86l-22.35,13.89-.87,9.4-18-4.59a5,5,0,0,0-.53-2.74S306.67,421.78,301,419.52Z" style="fill: rgb(255, 190, 157); transform-origin: 327.57px 399.912px 0px;" id="elb5n23bwbhz9" class="animable"></path>
                    <path d="M279.42,405.38c-2.27-3-4.16-5.89-5.66-8.34s-2.57-4.51-3.28-6a14.69,14.69,0,0,0-1.17-2.22,15.3,15.3,0,0,0,.89,2.35,62.16,62.16,0,0,0,3.08,6.11,98.79,98.79,0,0,0,5.56,8.48c2.24,3.09,4.87,6.37,7.66,9.76,3.9,4.68,7.5,9.05,10.43,12.88l.81,0c-2.93-4-6.62-8.53-10.63-13.35C284.32,411.68,281.69,408.43,279.42,405.38Z" style="fill: rgb(245, 245, 245); transform-origin: 283.523px 408.609px 0px;" id="elxr8dxlasw5e" class="animable"></path>
                    <path d="M265.14,391.12a15.63,15.63,0,0,0,.94,2.31c.65,1.48,1.59,3.61,2.7,6.26a210.69,210.69,0,0,1,7.53,21.14c.78,2.81,1.61,5.54,2.59,8.07h.8c-1-2.57-1.82-5.35-2.64-8.28a171.23,171.23,0,0,0-7.77-21.14c-1.18-2.63-2.2-4.73-2.93-6.17A15.6,15.6,0,0,0,265.14,391.12Z" style="fill: rgb(245, 245, 245); transform-origin: 272.42px 410.01px 0px;" id="ellp0npvd28ep" class="animable"></path>
                    <path d="M267.1,388.73a15.83,15.83,0,0,0,1.07,2.28c.74,1.45,1.83,3.53,3.2,6.09,2.75,5.11,6.6,12.16,11.29,19.69,2.72,4.38,5.45,8.39,8,11.9l.84,0c-2.54-3.61-5.34-7.76-8.14-12.29-4.68-7.51-8.6-14.5-11.47-19.54l-3.42-6A15.39,15.39,0,0,0,267.1,388.73Z" style="fill: rgb(245, 245, 245); transform-origin: 279.301px 408.711px 0px;" id="elr12g8z84gl9" class="animable"></path>
                    <path d="M310.83,422.91A33.12,33.12,0,0,0,302,410.77a79.9,79.9,0,0,0-11-8c-3.59-2.27-7-4.33-9.9-6.42a69.47,69.47,0,0,1-12.58-11.47c-1.31-1.53-2.28-2.77-2.92-3.61l-.74-1a1.39,1.39,0,0,0-.27-.31,1.62,1.62,0,0,0,.21.36l.67,1c.61.88,1.53,2.15,2.82,3.72a66.51,66.51,0,0,0,12.49,11.72c2.93,2.13,6.3,4.23,9.87,6.52a79.93,79.93,0,0,1,10.87,8,32.48,32.48,0,0,1,8.63,11.9,23.52,23.52,0,0,1,1.33,4.22l.78-.08A25.22,25.22,0,0,0,310.83,422.91Z" style="fill: rgb(245, 245, 245); transform-origin: 288.426px 403.68px 0px;" id="el8r16tg3ecru" class="animable"></path>
                    <path d="M309,426.21a34.71,34.71,0,0,0-5.34-9.12,57.77,57.77,0,0,0-9.3-9c-3.59-2.85-7.18-5.31-10.38-7.62s-6-4.47-8.28-6.41a61.38,61.38,0,0,1-5.08-4.89,22.27,22.27,0,0,0-1.77-1.91,2.23,2.23,0,0,0,.36.58c.25.36.65.88,1.18,1.53a48.65,48.65,0,0,0,4.94,5.1,105.14,105.14,0,0,0,8.22,6.58c3.19,2.35,6.76,4.83,10.32,7.65a60.11,60.11,0,0,1,9.23,8.82,35.41,35.41,0,0,1,5.38,8.86c.18.43.33.85.48,1.26l.52-.05C309.36,427.16,309.22,426.7,309,426.21Z" style="fill: rgb(245, 245, 245); transform-origin: 289.166px 407.451px 0px;" id="eljxw6u8yth6" class="animable"></path>
                    <path d="M282.81,421.58c-3.84-7-7.07-13.52-9.36-18.25l-2.7-5.6a13.35,13.35,0,0,0-1.06-2,12.93,12.93,0,0,0,.78,2.15c.56,1.36,1.39,3.31,2.47,5.71,2.17,4.79,5.33,11.34,9.17,18.39,1.31,2.39,2.6,4.68,3.85,6.84l.86,0C285.53,426.51,284.18,424.1,282.81,421.58Z" style="fill: rgb(245, 245, 245); transform-origin: 278.256px 412.275px 0px;" id="elxwet3zlskhk" class="animable"></path>
                    <path d="M290.8,412.6a208.26,208.26,0,0,1-15.26-16.75c-1.83-2.25-3.27-4.1-4.28-5.38a16.22,16.22,0,0,0-1.61-2,15.35,15.35,0,0,0,1.37,2.13c.93,1.34,2.3,3.25,4.09,5.55a170.29,170.29,0,0,0,15.14,17c3.16,3.13,6.37,5.89,9.06,8.6a42.31,42.31,0,0,1,5.25,6.26l.66,0a39,39,0,0,0-5.39-6.73C297.13,418.48,293.94,415.71,290.8,412.6Z" style="fill: rgb(245, 245, 245); transform-origin: 287.434px 408.24px 0px;" id="el0ojufnrjfomo" class="animable"></path>
                    <path d="M274.38,426.37c-1.33-4-2.23-7.88-3.07-11.39-1.62-7-3.13-12.73-4.74-16.46a29.15,29.15,0,0,0-2.87-5.59s0,.14.16.38l.56,1.08c.47.95,1.15,2.36,1.87,4.24,1.51,3.75,2.93,9.42,4.47,16.48.82,3.52,1.69,7.39,3,11.46.26.77.55,1.55.84,2.34h.72C275,428.06,274.67,427.2,274.38,426.37Z" style="fill: rgb(245, 245, 245); transform-origin: 269.51px 410.92px 0px;" id="el2yx5gosclby" class="animable"></path>
                    <path d="M314.68,414.29a.87.87,0,0,1,.24,0,6.77,6.77,0,0,1,.7,0c.61.05,1.51.15,2.66.31a60.66,60.66,0,0,1,9.61,2.13,21.15,21.15,0,0,1,3,1.33,4,4,0,0,1,1.37,1.18,2.31,2.31,0,0,1,.28,1.9,2.56,2.56,0,0,1-1.3,1.47,10.59,10.59,0,0,1-1.73.92,29.46,29.46,0,0,1-3.81,1.33,117.73,117.73,0,0,1-17.56,3.37,207.11,207.11,0,0,1-32.43.9c-4.15-.16-7.5-.36-9.82-.5l-2.67-.19-.69-.06a.58.58,0,0,1-.24,0h.94l2.67.09,9.82.33a223.22,223.22,0,0,0,32.36-1,122.22,122.22,0,0,0,17.49-3.32,30.76,30.76,0,0,0,3.76-1.29,9.79,9.79,0,0,0,1.67-.87,2.24,2.24,0,0,0,1.13-1.21,1.89,1.89,0,0,0-.22-1.56,3.72,3.72,0,0,0-1.22-1.07,21.54,21.54,0,0,0-2.93-1.32,66,66,0,0,0-9.53-2.28c-1.14-.19-2-.33-2.63-.41S314.68,414.31,314.68,414.29Z" style="fill: rgb(38, 50, 56); transform-origin: 297.461px 421.838px 0px;" id="el8ob0erqr4d" class="animable"></path>
                    <path d="M319.53,402c.09.12-1.77,1.57-3.9,3.54s-3.72,3.71-3.84,3.61a24.95,24.95,0,0,1,7.74-7.15Z" style="fill: rgb(235, 153, 110); transform-origin: 315.662px 405.576px 0px;" id="elsc7qbhx1zn" class="animable"></path>
                    <path d="M319.09,409.88a10.54,10.54,0,0,0-3.21-.67,10.81,10.81,0,0,0-3.19.8c0-.05.22-.35.78-.67a5,5,0,0,1,2.39-.65,5.11,5.11,0,0,1,2.43.55C318.86,409.54,319.13,409.83,319.09,409.88Z" style="fill: rgb(235, 153, 110); transform-origin: 315.893px 409.352px 0px;" id="el2w5culkms0p" class="animable"></path>
                </g>
                <g id="freepik--Shelves--inject-38" style="transform-origin: 123.615px 141.186px 0px;" class="animable">
                    <path d="M137.69,203.48c-.58.46-32.29,14.7-32.29,14.7s8.73,18.54,25.67,10.28C146.54,220.92,137.69,203.48,137.69,203.48Z" style="fill: rgb(69, 90, 100); transform-origin: 122.805px 217.031px 0px;" id="elieasnpes48" class="animable"></path>
                    <path d="M137.34,101.07c.71,0,1.3,24.62,1.3,55s-.59,55-1.3,55-1.31-24.61-1.31-55S136.62,101.07,137.34,101.07Z" style="fill: rgb(69, 90, 100); transform-origin: 137.336px 156.07px 0px;" id="el93z5wvvatmr" class="animable"></path>
                    <path d="M114.77,175.34c-.58.46-32.29,14.7-32.29,14.7s8.73,18.54,25.68,10.28C123.63,192.78,114.77,175.34,114.77,175.34Z" style="fill: rgb(69, 90, 100); transform-origin: 99.8867px 188.891px 0px;" id="elgotw0ofx67" class="animable"></path>
                    <path d="M114.42,99.21c.72,0,1.3,18.74,1.3,41.85s-.58,41.85-1.3,41.85-1.3-18.74-1.3-41.85S113.7,99.21,114.42,99.21Z" style="fill: rgb(69, 90, 100); transform-origin: 114.42px 141.061px 0px;" id="elpb6d7klh15f" class="animable"></path>
                    <path d="M87,147.59c-.59.45-32.3,14.69-32.3,14.69s8.74,18.54,25.68,10.28C95.87,165,87,147.59,87,147.59Z" style="fill: rgb(69, 90, 100); transform-origin: 72.1133px 161.135px 0px;" id="elwhoomkajrjj" class="animable"></path>
                    <path d="M86.66,102c.72,0,1.3,11.89,1.3,26.55s-.58,26.56-1.3,26.56-1.3-11.89-1.3-26.56S85.94,102,86.66,102Z" style="fill: rgb(69, 90, 100); transform-origin: 86.6602px 128.555px 0px;" id="elskqlqbtti8k" class="animable"></path>
                    <circle cx="175.06" cy="176.13" r="32.4" style="fill: rgb(69, 90, 100); transform-origin: 175.06px 176.13px 0px;" id="elyopno1p38p" class="animable"></circle>
                    <polygon points="173.85 147.36 171.31 105.69 183.25 105.69 179.94 147.36 173.85 147.36" style="fill: rgb(69, 90, 100); transform-origin: 177.28px 126.525px 0px;" id="el8y5lz01cglp" class="animable"></polygon>
                    <path d="M188.69,198.86l-.21.15-.66.38c-.29.16-.64.39-1.08.6l-1.54.69a26.62,26.62,0,0,1-10.52,1.94,27.39,27.39,0,0,1-15-4.78,24.34,24.34,0,0,1-6.55-6.77A27.77,27.77,0,0,1,149,171.62a24.34,24.34,0,0,1,3.21-8.85A27.48,27.48,0,0,1,164,152.27a26.73,26.73,0,0,1,10.4-2.52H176c.49,0,.9.08,1.23.1l.75.09a1.11,1.11,0,0,1,.26,0H178l-.76,0c-.33,0-.74-.06-1.23-.06l-1.67,0a27.6,27.6,0,0,0-10.25,2.65A27.3,27.3,0,0,0,152.58,163a23.94,23.94,0,0,0-3.13,8.69,27.43,27.43,0,0,0,4.07,19.09,23.94,23.94,0,0,0,6.39,6.66,27.5,27.5,0,0,0,25.22,3.05l1.54-.65c.45-.2.8-.4,1.1-.55l.68-.34Z" style="fill: rgb(38, 50, 56); transform-origin: 168.676px 176.188px 0px;" id="elbz5q5le73do" class="animable"></path>
                    <polygon points="45.16 51.79 56.63 93.29 105.22 93.29 116.7 51.79 45.16 51.79" style="fill: rgb(69, 90, 100); transform-origin: 80.93px 72.54px 0px;" id="el6jk46l65a6i" class="animable"></polygon>
                    <path d="M114.42,60c0,.15-15,.27-33.49.27S47.44,60.16,47.44,60s15-.26,33.49-.26S114.42,59.87,114.42,60Z" style="fill: rgb(38, 50, 56); transform-origin: 80.9316px 60.0039px 0px;" id="eli70lswlua7" class="animable"></path>
                    <path d="M123.33,62.49h-10l1.6-4.34h8.35a2.17,2.17,0,0,1,2.17,2.17h0A2.17,2.17,0,0,1,123.33,62.49Z" style="fill: rgb(38, 50, 56); transform-origin: 119.389px 60.3184px 0px;" id="el1a3u1ufobd" class="animable"></path>
                    <path d="M38.45,62.49H48.4l-1.59-4.34H38.45a2.17,2.17,0,0,0-2.17,2.17h0A2.17,2.17,0,0,0,38.45,62.49Z" style="fill: rgb(38, 50, 56); transform-origin: 42.3398px 60.3184px 0px;" id="elr2e8oqicah" class="animable"></path>
                    <rect x="32.88" y="92.73" width="181.47" height="12.97" style="fill: #941B0B; transform-origin: 123.615px 99.215px 0px;" id="elyh4bkb5lyl" class="animable"></rect>
                </g>
                <g id="freepik--kitchen-tools--inject-38" style="transform-origin: 408.405px 340.545px 0px;" class="animable">
                    <path d="M449.12,277.42a5.41,5.41,0,0,0-7,3.06l-8.05,21.57h0l10,3.68,8.12-21.36A5.4,5.4,0,0,0,449.12,277.42Z" style="fill: #941B0B; transform-origin: 443.309px 291.391px 0px;" id="eldksouvyzif" class="animable"></path>
                    <path d="M448.9,284.24a2.3,2.3,0,1,1-2.29-2.3A2.28,2.28,0,0,1,448.9,284.24Z" style="fill: rgb(250, 250, 250); transform-origin: 446.598px 284.242px 0px;" id="elqy52twpztis" class="animable"></path>
                    <path d="M443.2,298.38a2.3,2.3,0,1,1-2.3-2.29A2.3,2.3,0,0,1,443.2,298.38Z" style="fill: rgb(250, 250, 250); transform-origin: 440.898px 298.391px 0px;" id="el1bhcpauxkgg" class="animable"></path>
                    <polygon points="434.09 302.05 418.58 342.51 437.67 342.27 453.24 308.84 434.09 302.05" style="fill: rgb(224, 224, 224); transform-origin: 435.91px 322.28px 0px;" id="elhl2otwfr1qb" class="animable"></polygon>
                    <rect x="395.01" y="342.51" width="53.5" height="61.53" style="fill: #941B0B; transform-origin: 421.76px 373.275px 0px;" id="el03u9abfhkqw9" class="animable"></rect>
                    <path d="M448.51,357.83c0,.15-12,.27-26.75.27S395,358,395,357.83s12-.26,26.75-.26S448.51,357.69,448.51,357.83Z" style="fill: rgb(255, 255, 255); transform-origin: 421.756px 357.836px 0px;" id="ela74nsalne1" class="animable"></path>
                    <path d="M448.51,364.46c0,.14-12,.26-26.75.26S395,364.6,395,364.46s12-.26,26.75-.26S448.51,364.31,448.51,364.46Z" style="fill: rgb(255, 255, 255); transform-origin: 421.756px 364.459px 0px;" id="eluuuf403gnjh" class="animable"></path>
                    <path d="M448.51,371.08c0,.15-12,.26-26.75.26s-26.75-.11-26.75-.26,12-.26,26.75-.26S448.51,370.94,448.51,371.08Z" style="fill: rgb(255, 255, 255); transform-origin: 421.762px 371.08px 0px;" id="eleo8gidgy40c" class="animable"></path>
                    <path d="M448.51,377.71c0,.14-12,.26-26.75.26s-26.75-.12-26.75-.26,12-.26,26.75-.26S448.51,377.56,448.51,377.71Z" style="fill: rgb(255, 255, 255); transform-origin: 421.762px 377.709px 0px;" id="elc0bqoe9pqge" class="animable"></path>
                    <path d="M448.51,384.33c0,.14-12,.26-26.75.26s-26.75-.12-26.75-.26,12-.26,26.75-.26S448.51,384.19,448.51,384.33Z" style="fill: rgb(255, 255, 255); transform-origin: 421.762px 384.33px 0px;" id="el1fxxdq89g74" class="animable"></path>
                    <path d="M448.51,391c0,.15-12,.26-26.75.26S395,391.1,395,391s12-.26,26.75-.26S448.51,390.81,448.51,391Z" style="fill: rgb(255, 255, 255); transform-origin: 421.756px 391px 0px;" id="el0k40qro2odk5" class="animable"></path>
                    <path d="M363.57,308.64l35.77,2.86s1-17.37-15.74-19.21S363.57,308.64,363.57,308.64Z" style="fill: rgb(69, 90, 100); transform-origin: 381.461px 301.83px 0px;" id="elosxa3ky0n8d" class="animable"></path>
                    <path d="M409.15,342.51c-.68.23-4.4-8.68-8.3-19.91s-6.52-20.54-5.84-20.77,4.39,8.68,8.3,19.91S409.83,342.27,409.15,342.51Z" style="fill: rgb(69, 90, 100); transform-origin: 402.08px 322.17px 0px;" id="elfdlpnohrvxw" class="animable"></path>
                </g>
                <g id="freepik--Food--inject-38" style="transform-origin: 305.525px 418.4px 0px;" class="animable">
                    <path d="M411.29,460.34a3.85,3.85,0,0,1-.71.16l-2.05.34-1.48.23c-.55.07-1.14.11-1.78.18-1.28.11-2.73.3-4.34.32l-2.53.08c-.88,0-1.8,0-2.75,0-1.9,0-3.92-.19-6-.36A81.89,81.89,0,0,1,362.92,454c-1.91-.94-3.75-1.81-5.39-2.78-.82-.47-1.63-.9-2.38-1.37L353,448.44c-1.38-.84-2.53-1.75-3.57-2.49-.52-.38-1-.72-1.44-1.06l-1.16-1-1.59-1.33a4.26,4.26,0,0,1-.53-.49,2.83,2.83,0,0,1,.6.41l1.65,1.25,1.18.92c.44.33.93.66,1.46,1,1.05.72,2.21,1.6,3.6,2.42l2.14,1.33c.75.46,1.56.87,2.38,1.33,1.64.95,3.47,1.8,5.38,2.73a92.66,92.66,0,0,0,13,4.72,91.64,91.64,0,0,0,13.56,2.54c2.11.18,4.12.39,6,.4.95,0,1.86.09,2.73.07l2.53-.05c1.6,0,3.05-.16,4.33-.24.63,0,1.23-.08,1.77-.14l1.48-.18,2.06-.25A4.93,4.93,0,0,1,411.29,460.34Z" style="fill: rgb(69, 90, 100); transform-origin: 378px 451.859px 0px;" id="el6g3qnlgb9b8" class="animable"></path>
                    <path d="M368.71,456.4c-7.5-1-17.3,1.9-22.92,7a73.91,73.91,0,0,0,22.92-7" style="fill: rgb(69, 90, 100); transform-origin: 357.25px 459.801px 0px;" id="elwsh0zum34e" class="animable"></path>
                    <path d="M369.09,456.49c2.75-7.06-1.31-17-1.31-17-.79-1.34-.44,9.17,1.31,17" style="fill: rgb(69, 90, 100); transform-origin: 368.713px 447.93px 0px;" id="elkm4jbjgdfpr" class="animable"></path>
                    <path d="M357.25,450.89c2-5.18-.91-12.46-.91-12.46-.56-1-.33,6.73.91,12.46" style="fill: rgb(69, 90, 100); transform-origin: 357.002px 444.615px 0px;" id="el435118skc64" class="animable"></path>
                    <path d="M379.69,459c2-5.18-.91-12.46-.91-12.46-.57-1-.34,6.73.91,12.46" style="fill: rgb(69, 90, 100); transform-origin: 379.439px 452.725px 0px;" id="elbzdok5oeuzk" class="animable"></path>
                    <path d="M357.48,451c-5.59-.74-12.88,1.42-17.05,5.2a54.89,54.89,0,0,0,17.05-5.2" style="fill: rgb(69, 90, 100); transform-origin: 348.955px 453.527px 0px;" id="elr5zdmlicoxj" class="animable"></path>
                    <path d="M380.83,459.79c-7.93.11-17.63,4.61-22.68,10.72a77.26,77.26,0,0,0,22.68-10.72" style="fill: rgb(69, 90, 100); transform-origin: 369.488px 465.15px 0px;" id="elfikeqhikl" class="animable"></path>
                    <path d="M411.05,421.92a16.16,16.16,0,0,0-28.33,2.65,18.67,18.67,0,0,0,.23,14.27,25.55,25.55,0,0,0,9.34,11c10.57,7.2,25.9,6.87,35.72-1.32,3.65-3,6.58-7.19,7.25-11.89a14.81,14.81,0,0,0-21.91-15" style="fill: #941B0B; transform-origin: 408.412px 434.842px 0px;" id="elbvz0gpotmxa" class="animable"></path>
                    <path d="M411.09,421.9a5.63,5.63,0,0,0-6-4.12l3.54,4.21a5.48,5.48,0,0,0-4.35,3.41c-.16.43-.21,1,.2,1.26a1.06,1.06,0,0,0,.88-.1l4.3-1.78a14.78,14.78,0,0,0,2.56,6.67,17.36,17.36,0,0,0,1.62-6.71l4.75,2.1a7.08,7.08,0,0,0-2.23-3.51,11.83,11.83,0,0,0,4-1.55c.37-.23.77-.62.61-1s-.52-.39-.85-.42a15.67,15.67,0,0,0-9.05,1.88" style="fill: rgb(69, 90, 100); transform-origin: 412.584px 424.602px 0px;" id="el7seoojygauu" class="animable"></path>
                    <path d="M410.78,423.68a31,31,0,0,0-1.18-14.34c1.13-.25,2.52-.42,3.26.48a3.06,3.06,0,0,1,.48,1.91A33.82,33.82,0,0,1,410.8,425" style="fill: rgb(69, 90, 100); transform-origin: 411.477px 417.07px 0px;" id="elcn9yckal6ca" class="animable"></path>
                    <path d="M387.72,440.89a3.63,3.63,0,0,1-.74-.74,13.2,13.2,0,0,1-1.59-2.39,14.64,14.64,0,0,1,2.9-17.52,12.65,12.65,0,0,1,2.27-1.75,4.25,4.25,0,0,1,.94-.47,31.2,31.2,0,0,0-2.95,2.48,14.87,14.87,0,0,0-2.83,17.09A30.5,30.5,0,0,0,387.72,440.89Z" style="fill: rgb(255, 255, 255); transform-origin: 387.592px 429.455px 0px;" id="el4i3imeo249" class="animable"></path>
                    <path d="M392.49,444.49c-.05.13-.8,0-1.56-.57s-1.15-1.2-1-1.29.65.37,1.34.87S392.54,444.35,392.49,444.49Z" style="fill: rgb(255, 255, 255); transform-origin: 391.195px 443.576px 0px;" id="elz8qb3w2kxpb" class="animable"></path>
                    <path d="M191.53,367.05c-.44.1,2.79,16.32,2.79,16.32h8.26l3.65-15.67A26.06,26.06,0,0,0,191.53,367.05Z" style="fill: rgb(69, 90, 100); transform-origin: 198.859px 374.83px 0px;" id="elgit3e3pgvp6" class="animable"></path>
                    <path d="M186.55,458.36s-12.16-34.06-10.46-43.3,5.35-11.19,8.27-14.11,5.35-5.35,6.08-8.27,0-14.59,0-14.59-2.19-3.41-1.46-4.62,18.73,0,18.73,0a8.18,8.18,0,0,1-1.46,4.13s-.48,13.62.25,15.08,11.92,13.87,13.62,20.19-6.72,45.49-6.72,45.49Z" style="fill: rgb(245, 245, 245); transform-origin: 198.137px 415.646px 0px;" id="elkhcsuotk0dl" class="animable"></path>
                    <path d="M186.55,458.36l.47,0,1.37,0,5.28,0,19.73-.09-.16.13c1-4.95,2.15-10.56,3.29-16.73s2.33-12.91,3.16-20.14c.19-1.81.36-3.64.4-5.51a9.26,9.26,0,0,0-1.15-5.39,64.58,64.58,0,0,0-6.49-9.82c-1.22-1.6-2.5-3.19-3.79-4.79-.64-.81-1.29-1.61-1.92-2.45a7.36,7.36,0,0,1-.47-.68,3.44,3.44,0,0,1-.2-.83,14.43,14.43,0,0,1-.14-1.59c-.19-4.21-.06-8.47.06-12.8v-.07l0-.06c.18-.3.38-.62.55-1a7.77,7.77,0,0,0,.86-3l.24.25c-4.1-.26-8.16-.46-12.13-.53a38.63,38.63,0,0,0-5.83.23,1.63,1.63,0,0,0-.52.18,1,1,0,0,0-.12.53,4.26,4.26,0,0,0,.3,1.32,15.4,15.4,0,0,0,1.26,2.5l0,.06v.06c.18,3.11.31,6.17.32,9.18a41.92,41.92,0,0,1-.17,4.49,8.94,8.94,0,0,1-1.63,4.13,25.33,25.33,0,0,1-2.77,3.3c-1,1-2,2-3,2.95a32.33,32.33,0,0,0-2.88,2.85,15.73,15.73,0,0,0-2.14,3.27,26.33,26.33,0,0,0-2.19,7.19,17.15,17.15,0,0,0,0,3.58c.08,1.17.24,2.33.4,3.46a125.62,125.62,0,0,0,2.74,12.36c2,7.44,3.88,13.3,5.17,17.33.66,2,1.17,3.53,1.52,4.6.17.51.29.91.39,1.19s.12.41.12.41a2.93,2.93,0,0,1-.16-.39l-.44-1.18c-.37-1-.91-2.58-1.59-4.58-1.35-4-3.29-9.85-5.33-17.3-1-3.72-2.05-7.84-2.8-12.38-.17-1.14-.33-2.3-.42-3.5a16.62,16.62,0,0,1,0-3.66,26.74,26.74,0,0,1,2.21-7.32,16.22,16.22,0,0,1,2.19-3.37,31.75,31.75,0,0,1,2.91-2.89c1-.93,2-1.93,2.95-2.94a25,25,0,0,0,2.72-3.25,8.47,8.47,0,0,0,1.54-3.92,43.1,43.1,0,0,0,.16-4.43c0-3-.15-6.05-.33-9.15l0,.12a14.76,14.76,0,0,1-1.32-2.6,5.07,5.07,0,0,1-.33-1.49,1.36,1.36,0,0,1,.23-.84,1.48,1.48,0,0,1,.81-.37,38.17,38.17,0,0,1,5.95-.24c4,.06,8,.26,12.16.53H208v.25a8.31,8.31,0,0,1-.91,3.26,10.74,10.74,0,0,1-.59,1l0-.13c-.12,4.31-.25,8.58-.07,12.75a15.45,15.45,0,0,0,.14,1.54,3.25,3.25,0,0,0,.15.68c.13.2.26.4.42.61.61.82,1.27,1.62,1.91,2.42,1.29,1.61,2.57,3.2,3.79,4.81a64.26,64.26,0,0,1,6.53,9.92,9.79,9.79,0,0,1,1.19,5.61c0,1.89-.22,3.74-.42,5.55-.84,7.25-2.07,14-3.21,20.16s-2.31,11.79-3.38,16.73l0,.14h-.14l-19.81-.09-5.25,0-1.34,0Z" style="fill: rgb(38, 50, 56); transform-origin: 198.119px 415.65px 0px;" id="elw3kfc1xsetm" class="animable"></path>
                    <path d="M211.07,454.83a194.78,194.78,0,0,0,6.1-34.77c.11-1.34.11-2.89-.91-3.78-1.24-1.08-3.13-.5-4.7,0a28.43,28.43,0,0,1-14.27.76c-4.61-1-9.19-3.06-13.83-2.29a4.41,4.41,0,0,0-3.05,1.61c-.75,1.12-.57,2.59-.36,3.92,1.83,11.44,5.56,24.58,8.59,34.55Z" style="fill: #941B0B; transform-origin: 198.543px 434.705px 0px;" id="elw7nuzb4e4sm" class="animable"></path>
                    <path d="M214.12,417.69a5.38,5.38,0,0,1-.87.95,21.45,21.45,0,0,1-2.76,2.21,24.49,24.49,0,0,1-22.36,2.81,21.1,21.1,0,0,1-3.22-1.46,4.84,4.84,0,0,1-1.08-.71c0-.09,1.62.89,4.42,1.83a25.51,25.51,0,0,0,22-2.77C212.77,419,214.05,417.61,214.12,417.69Z" style="fill: rgb(255, 255, 255); transform-origin: 198.975px 421.43px 0px;" id="elzlzm2ks727p" class="animable"></path>
                </g>
                <defs>
                    <filter id="active" height="200%">
                        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
                        <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
                        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                        <feMerge>
                            <feMergeNode in="OUTLINE"></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                    <filter id="hover" height="200%">
                        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
                        <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
                        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                        <feMerge>
                            <feMergeNode in="OUTLINE"></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                        <feColorMatrix type="matrix" values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>
                    </filter>
                </defs>
            </svg>
        </div>
    </div>
</div>



<div class="modal fade" id="deleteAccount" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Supprimer votre compte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer votre compte? Si vous cliquez sur oui votre compte sera supprimé et vous serez redirigé vers l'accueil.</p>
                <form action="userProfile.php" method="POST">
                    <input type="hidden" id="deleteLogin" name="deleteLogin" value="<?= $_SESSION['login'] ?>"> <!-- l'input hidden sert à cacher l'id qui va servir à supprimer la recette. pour valider la suppression de l'utilisateur la modale contient un formulaire qui fait passer les données en post -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                <input type="submit" class="btn btn-danger" value="Oui">
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteRecipe" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Supprimer cette recette</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment cette recette?</p>
                    <input type="hidden" name="deleteRecipe" value="<?= $recipe->recipeId ?>"> <!-- l'input hidden sert à cacher l'id qui va servir à supprimer la recette. pour valider la suppression de la recette la modale contient un formulaire qui fait passer les données en post -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                    <input type="submit" class="btn btn-danger" value="Oui">
                </div>
            </form>
        </div>
    </div>
</div>


<?php
require_once 'includes/footer.php';
?>