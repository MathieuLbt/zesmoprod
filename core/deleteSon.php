<?php //fichier core/deleteSon.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('../back/login.php');

if(empty($_GET['id']))
	redirect('../back/index.php');

//on recupere le son
$zesmoprod = $db->prepare('SELECT * FROM music WHERE id = :i');
$zesmoprod->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$zesmoprod->execute();

//si on ne trouve pas le son
if($zesmoprod->rowCount() == 0)
	redirect('../back/index.php');

//on lit les donnees
$data = $zesmoprod->fetch(PDO::FETCH_ASSOC);


//on cree une requete pour supprimer la ligne de la base
$deleteSon = $db->prepare('DELETE FROM music WHERE id = :i');
$deleteSon->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$deleteSon->execute();

//on cree un message de validation
$success = true;
flash_in('success', 'Le son a été supprimé.');

//on redirige vers la page des livres
redirect('../back/index.php');
