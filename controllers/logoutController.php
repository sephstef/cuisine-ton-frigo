<?php
session_start();
session_destroy();
session_unset();
header('location:../index.php');
exit;

// si l'utilisateur clique sur le bouton je lance un session_destroy et unset puis redirige l'utilisateur sur l'index
