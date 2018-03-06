<?php // fichier includes/header-back.php

//on recupere le chemin vers le script
$filepath = $_SERVER['PHP_SELF'];

//on decoupe selon le /
$filepath = explode('/', $filepath);

//on recupere la derniere case du tableau
$filename = array_pop($filepath);

?>
<header>
	<h1>Back-Office</h1>

	<nav class="navDesktop">
		<a href="index.php" <?php if($filename == 'index.php') echo 'class="active"'; ?>>Accueil</a>

		<?php //si l'utilisateur est connecte
		if(!empty($_SESSION['user'])){ ?>

			<a href="addFilm.php" <?php if($filename == 'addFilm.php') echo 'class="active"'; ?>>Ajouter un film</a>
        
            <a href="addFrise.php" <?php if($filename == 'addFrise.php') echo 'class="active"'; ?>>Ajouter une infos(apropos)</a>
            <!--<a href="addSon.php" <?php if($filename == 'addSon.php') echo 'class="active"'; ?>>Ajouter un Son</a>-->
        
            <!--<a href="addPlaylist.php" <?php if($filename == 'addPlaylist.php') echo 'class="active"'; ?>>Ajouter une Playlist</a>-->
        
            <a href="addRS.php" <?php if($filename == 'addRS.php') echo 'class="active"'; ?>>Ajouter un réseau</a>
        
			<a href="../core/logout.php">Se déconnecter</a>

		<?php } else { //sinon (il n'est pas connecte) ?>

			<a href="login.php" <?php if($filename == 'login.php') echo 'class="active"'; ?>>Se connecter</a>

		<?php } ?>
		<a href="../">Retour vers le front</a>
	</nav>
    <!--------------------------------  BURGER ------------------------------------------>
    <nav class="mainMenu">
            <input type="checkbox" name="panel" class="hidden" id="panel"/>
            <label for="panel" class="menuTitle"></label>
            <div class="clear"></div>

                <ul class="menu">
                   <li> <a href="index.php" <?php if($filename == 'index.php') echo 'class="active"'; ?>>Accueil</a> </li>

		<?php //si l'utilisateur est connecte
		if(!empty($_SESSION['user'])){ ?>

			<li> <a href="addFilm.php" <?php if($filename == 'addFilm.php') echo 'class="active"'; ?>>Ajouter un film</a> </li>
        
            <li><a href="addFrise.php" <?php if($filename == 'addFrise.php') echo 'class="active"'; ?>>Ajouter une infos(apropos)</a></li>
            <!--<a href="addSon.php" <?php if($filename == 'addSon.php') echo 'class="active"'; ?>>Ajouter un Son</a>-->
        
            <!--<a href="addPlaylist.php" <?php if($filename == 'addPlaylist.php') echo 'class="active"'; ?>>Ajouter une Playlist</a>-->
        
            <li><a href="addRS.php" <?php if($filename == 'addRS.php') echo 'class="active"'; ?>>Ajouter un réseau</a></li>
        
			<li><a href="../core/logout.php">Se déconnecter</a></li>

		<?php } else { //sinon (il n'est pas connecte) ?>

			<li><a href="login.php" <?php if($filename == 'login.php') echo 'class="active"'; ?>>Se connecter</a></li>

		<?php } ?>
		<li><a href="../">Retour vers le front</a></li>
            </ul>
    </nav>
                            

    <!---------------------------------- FIN BURGER --------------------------------------->
    
	<?php //si l'utilisateur est connecte
	if(!empty($_SESSION['user']))
		echo '<p>Hello '.$_SESSION['user'].'</p>';
	
	//on affiche les messages en attente
	flash_out(); ?>
</header>