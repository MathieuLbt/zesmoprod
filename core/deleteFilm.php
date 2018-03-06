<?php //fichier core/deleteFilm.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('../back/login.php');

if(empty($_GET['id']))
	redirect('../back/index.php');

//on recupere le livre
$movie = $db->prepare('SELECT * FROM movie WHERE id = :i');
$movie->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$movie->execute();

//si on ne trouve pas le film
if($movie->rowCount() == 0)
	//on va sur l'accueil
	redirect('../back/index.php');

//on lit les donnees
$data = $movie->fetch(PDO::FETCH_ASSOC);

//s'il y a une image
if(!empty($data['cover']))
	//on supprime le fichier cover
	unlink('../data/covers/'.$data['cover']);

//on cree une requete pour supprimer la ligne de la base
$deleteMovie = $db->prepare('DELETE FROM movie WHERE id = :i');
$deleteMovie->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$deleteMovie->execute();

//on cree un message de validation
flash_in('success', 'Le film a été supprimé.');

//on redirige vers la page des films
redirect('../back/index.php');
