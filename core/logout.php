<?php  //fichier core/logout.php

include('../config/settings.php');

//on vide les elements de la session utilisateur
unset($_SESSION['user']);
unset($_SESSION['user_id']);


//on redirige vers le front
redirect('../');