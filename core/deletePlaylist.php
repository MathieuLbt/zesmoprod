<?php //fichier core/deleteCategory.php


include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('../back/login.php');

if(empty($_GET['id']))
	redirect('../back/playlist.php');

//on recupere le nombre de son associes a cette playlist
$nbmusic = $db->prepare('SELECT COUNT(*) AS nb FROM playlist WHERE playlist_id = :i');
$nbmusic->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$nbmusic->execute();
$c = $nbmusic->fetch(PDO::FETCH_ASSOC);

//s'il y a au moins un son
if($c['nb'] != 0)
	
	//on cree un message d'erreur
	flash_in('error', 'Vous ne pouvez pas supprimer cette playlist.');
//sinon
else{
	//on cree une requete pour supprimer une ligne de la base
	$delete = $db->prepare('DELETE FROM playlist WHERE id = :i');
	$delete->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
	$delete->execute();
	
	//on cree un message de validation
	flash_in('success', 'La playlist a été supprimée.');
}
//on redirige vers la page des categories
redirect('../back/playlist.php');

