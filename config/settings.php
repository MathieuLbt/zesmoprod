<?php //fichier config/settings.php

//on demarre la session
session_start();

if($_SERVER['SERVER_NAME'] == 'localhost'){
    
    
define("SQL_HOST","localhost"); 
define("SQL_USER","root"); 
define("SQL_PASS","root"); 
define("SQL_DBNAME","zesmoprod"); 
}
else{
    define("SQL_HOST","zesmoprosztoto12.mysql.db"); 
    define("SQL_USER","zesmoprosztoto12"); 
    define("SQL_PASS","Okamiden64"); 
    define("SQL_DBNAME","zesmoprosztoto12"); 
    
}
try{
	$db = new PDO("mysql:dbname=".SQL_DBNAME.";charset=utf8;host=".SQL_HOST,SQL_USER,SQL_PASS);

} catch(Exception $e){
	die('Erreur : ' . $e->getMessage());
}

//on fixe la taille maximale pour l'envoi de fichier
$maxFileSize = 10048576;

//on charge un fichier de fonctions
include('functions.php');