<?php //fichier config/functions.php


/*
on cree une fonction qui prend en parametre une date au format informatique et qui retourne la date au format europeen
Si la date est vide, on retourne 'n.c.' 
on a un deuxieme parametre $hour qui vaut false par defaut, et qui indique si on souhaite afficher l'heure

Exemple : 
dateEu('2017-05-02')    -> 02/05/2017
dateEu('2017-05-02', false)    -> 02/05/2017
dateEu('2017-05-02 8:02:30')    -> 02/05/2017
dateEu('2017-05-02 8:02:30', true)    -> 02/05/2017 8:02
*/
function dateEU($input, $hour = false){
	if(empty($input))
		return 'n.c.';
	else{
		//on cree un objet temporel
		$time = new DateTime($input);
		//si on veut afficher l'heure
		if($hour)
			return $time->format('d/m/Y H:i');
		else
			//on retourne le format souhaite
			return $time->format('d/m/Y');
	}
}


/* on cree une fonction qui redirige la page et arrete du code (a la suite) */
function redirect($page){
	header('Location: '.$page);
	exit();
}

/*
on cree une fonction qui prend en parametre le nom de la couverture
et donne le chemin vers cette image ou vers l'image par defaut si elle est manquante
*/
function backCover($input){

	if(empty($input))
		return '../img/coverdefault.png';
	else{
		return '../' . $input;
	}
}

function cover($input){


	if(empty($input))
		return 'img/coverdefault.png';
	else{
		return  $input;
	}
}
/*
on cree une fonction qui crypte une chaine de caratere
*/
function cryptPassword($string){
	//on crypte une premiere fois
	$first = hash('sha512', $string);

	//on ajoute un salt
	$first = $first.'ar59dui6W$!g';

	//on re-crypte
	return hash('sha512', $first);
}

//var_dump(cryptPassword('123'));

/* on cree une fonction qui permet d'enregistrer un message en memoire, elle prend deux parametres :
$type qui correspond au type de message : ex: 'error' ou 'success'
$message, le message a ecrire */
function flash_in($type, $message){
	//si la case du type n'existe pas, on la cree
	if( empty( $_SESSION['message'][$type] ))
		$_SESSION['message'][$type] = [];
	//on met le message dans la case, à la suite des autres
	array_push($_SESSION['message'][$type], $message);
}

/* flash_out ecrit tous les messages en attente, puis les efface de la memoire */
function flash_out(){
	if(!empty($_SESSION['message']))
        foreach ($_SESSION['message'] as $key => $value)
    		foreach ($value as $message)
    			echo '<p class="alert alert-'.$key.'">'.$message.'</p>';
	$_SESSION['message'] = [];
}

