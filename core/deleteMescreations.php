<?php //fichier core/deleteSon.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('../back/login.php');

if(empty($_GET['id']))
	redirect('../back/index.php');

//on recupere le son
$mescreations = $db->prepare('SELECT * FROM mescreations WHERE id = :i');
$mescreations->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$mescreations->execute();

//si on ne trouve pas le son
if($mescreations->rowCount() == 0)
	redirect('../back/index.php');

//on lit les donnees
$data = $mescreations->fetch(PDO::FETCH_ASSOC);


//on cree une requete pour supprimer la ligne de la base
$deleteSon = $db->prepare('DELETE FROM mescreations WHERE id = :i');
$deleteSon->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$deleteSon->execute();

//on cree un message de validation
$success = true;
flash_in('success', 'Le son a été supprimé.');

//on redirige vers la page des livres
redirect('../back/index.php');
