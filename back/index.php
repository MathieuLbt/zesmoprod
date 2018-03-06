 <?php //fichier /back/index.php

//on charge un fichier de parametrage
include('../config/settings.php');


//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user']))
	//on le vire vers la page de login
	redirect('login.php');

//on prepare une requete qui lit les infos de tous les films
$movie = $db->prepare('SELECT id, titre, lien, cover FROM movie ORDER BY titre ASC');

//on execute la requete
$movie->execute();

?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/head-back.php'); ?>
    
	<title>Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>
	<p>Il y a <?php echo $movie->rowCount(); ?> film(s) dans la base de données.</p>
	<table>
		<thead>
			<tr>
				<th>Titre</th>
				<th>Lien</th>
                <th>Cover</th>
				<th>Actions</th>                
			</tr>
		</thead>
		<tbody>
			<?php 
                //tant qu'il reste une ligne non lue dans les resultats de la requete
			     while($data = $movie->fetch(PDO::FETCH_ASSOC)) { ?>
				<tr>
					<td>
						<a href="film.php?id=<?= $data['id'] ?>">
							<?php echo $data['titre']; ?>
						</a>
					</td>
                    <td>
						<p><?= $data['lien'] ?>
						</p>
					</td>
                    <td>
						<p><?= $data['cover'] ?>
						</p>
					</td>
					<td>
						<a class="btn btn-small btn-warning" href="../back/updateFilm.php?id=<?= $data['id'] ?>">Modifier</a>
						<a class="btn btn-small btn-error" href="../core/deleteFilm.php?id=<?= $data['id'] ?>">Supprimer</a>
					</td>
				</tr>
			<?php } ?> 
		</tbody>
	</table>
        <?php
    
    //on prepare une requete qui lit les infos de tous les films
$reseaux = $db->prepare('SELECT * FROM reseaux ORDER BY name ASC');

//on execute la requete
$reseaux->execute();
    ?>
    <p>Il y a <?php echo $reseaux->rowCount(); ?> réseaux dans la base de données.</p>
    	<table>
		<thead>
			<tr>
				<th>name</th>
				<th>Lien</th>
                <th>logo</th>
				<th>Actions</th>                
			</tr>
		</thead>
		<tbody>
			<?php 
                //tant qu'il reste une ligne non lue dans les resultats de la requete
			     while($data = $reseaux->fetch(PDO::FETCH_ASSOC)) { 
            ?>
				<tr>
					<td>
						<a href="RS.php?id=<?= $data['id'] ?>">
							<?php echo $data['name']; ?>
						</a>
					</td>
                    <td>
						<p><?= $data['lien'] ?></p>
					</td>
                    <td>
						<p><?= $data['logo'] ?>
						</p>
					</td>
					<td>
						<a class="btn btn-small btn-warning" href="../back/updateRS.php?id=<?= $data['id'] ?>">Modifier</a>
						<a class="btn btn-small btn-error" href="../core/deleteRS.php?id=<?= $data['id'] ?>">Supprimer</a>
					</td>
				</tr>
			<?php } ?> 
		</tbody>
	</table>
    
        <?php
    
    //on prepare une requete qui lit les infos du contenue
$contenue = $db->prepare('SELECT * FROM contenue ORDER BY titre ASC');

//on execute la requete
$contenue->execute();
    ?>
        	<table>
                <h1>Les Infos de la frise (a propos)</h1>
		<thead>
			<tr>
				<th>date</th>
				<th>texte</th>
				<th>Actions</th>                
			</tr>
		</thead>
		<tbody>
			<?php 
                //tant qu'il reste une ligne non lue dans les resultats de la requete
			     while($data = $contenue->fetch(PDO::FETCH_ASSOC)) { 
            ?>
				<tr>
					<td>
						<a href="frise.php?id=<?= $data['id'] ?>">
							<?php echo $data['titre']; ?>
						</a>
					</td>
                    <td>
						<p><?= $data['texte'] ?>
						</p>
					</td>
					<td>
						<a class="btn btn-small btn-warning" href="../back/updateFrise.php?id=<?= $data['id'] ?>">Modifier</a>
						<a class="btn btn-small btn-error" href="../core/deleteFrise.php?id=<?= $data['id'] ?>">Supprimer</a>
					</td>
				</tr>
			<?php } ?> 
		</tbody>
	</table>        <?php
    
    //on prepare une requete qui lit les infos du contenue
$cv = $db->prepare('SELECT * FROM cv');

//on execute la requete
$cv->execute();
    ?>
        	<table>
		<thead>
			<tr>
				<th>CV</th>
				<th>Actions</th>                
			</tr>
		</thead>
		<tbody>
			<?php 
                //tant qu'il reste une ligne non lue dans les resultats de la requete
			     while($data = $cv->fetch(PDO::FETCH_ASSOC)) { ?>
				<tr>
                    <td>
						<p><?= $data['lien'] ?>
						</p>
					</td>
					<td>
						<a class="btn btn-small btn-warning" href="../back/updateCV.php?id=<?= $data['id'] ?>">Modifier</a>
					</td>
				</tr>
			<?php } ?> 
		</tbody>
	</table>  
        <?php
    
    //on prepare une requete qui lit les infos de tous les films
$creations = $db->prepare('SELECT * FROM mescreations ORDER BY titre ASC');

//on execute la requete
$creations->execute();
    ?>
        	<table>
                <h1>La playlist - Mes créations</h1><a class="btn btn-small btn-warning" href="../back/addMescreations.php?id=<?= $data['id'] ?>">Ajouter Son</a>
		<thead>
			<tr>
				<th>Titre Son</th>
				<th>Fichier</th>
                <th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php while($data = $creations->fetch(PDO::FETCH_ASSOC)) { ?>
				<tr>
					<td>
						<p><?php echo $data['titre']; ?></p>
					</td>
                     <td>   
						<p><?= $data['fichier']; ?></p>
					</td>
					<td>
						<a class="btn btn-small btn-warning" href="../back/updateMescreations.php?id=<?= $data['id'] ?>">Modifier</a>
						<a class="btn btn-small btn-error" href="../core/deleteMescreations.php?id=<?= $data['id'] ?>">Supprimer</a>
					</td>
				</tr>
			<?php } ?> 
		</tbody>
	</table>  
             <?php
    
    //on prepare une requete qui lit les infos de tous les films
$enregistrements = $db->prepare('SELECT * FROM mesenregistrements ORDER BY titre ASC');

//on execute la requete
$enregistrements->execute();
    ?>
        	<table>
                <h1>La playlist - Mes enregistrements</h1><a class="btn btn-small btn-warning" href="../back/addMesenregistrements.php?id=<?= $data['id'] ?>">Ajouter Son</a>
		<thead>
			<tr>
				<th>Titre Son</th>
				<th>Fichier</th>
                <th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php while($data = $enregistrements->fetch(PDO::FETCH_ASSOC)) { ?>
				<tr>
					<td>
						<p><?php echo $data['titre']; ?></p>
					</td>
                     <td>   
						<p><?= $data['fichier']; ?></p>
					</td>
					<td>
						<a class="btn btn-small btn-warning" href="../back/updateMesenregistrements.php?id=<?= $data['id'] ?>">Modifier</a>
						<a class="btn btn-small btn-error" href="../core/deleteMesenregistrements.php?id=<?= $data['id'] ?>">Supprimer</a>
					</td>
				</tr>
			<?php } ?> 
		</tbody>
	</table>  
</body>
</html>