<?php //fichier core/deleteFilm.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('../back/login.php');

if(empty($_GET['id']))
	redirect('../back/index.php');

//on recupere le livre
$reseaux = $db->prepare('SELECT * FROM reseaux WHERE id = :i');
$reseaux->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$reseaux->execute();

//si on ne trouve pas le film
if($reseaux->rowCount() == 0)
	//on va sur l'accueil
	redirect('../back/index.php');

//on lit les donnees
$data = $reseaux->fetch(PDO::FETCH_ASSOC);

//s'il y a une image
if(!empty($data['logo']))
	//on supprime le fichier cover
	unlink('../data/reseaux/'.$data['cover']);

//on cree une requete pour supprimer la ligne de la base
$deleteRS = $db->prepare('DELETE FROM reseaux WHERE id = :i');
$deleteRS->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$deleteRS->execute();

//on cree un message de validation
flash_in('success', 'Le RS a été supprimé.');

//on redirige vers la page des films
redirect('../back/index.php');
