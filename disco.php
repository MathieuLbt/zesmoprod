<?php

//on charge un fichier de parametrage
include('config/settings.php');

//on cree la requete pour recuperer les informations du contenue
$mescreations = $db->prepare('SELECT * FROM mescreations ORDER by titre ASC');

//on execute la requete
$mescreations->execute();

//on cree la requete pour recuperer les informations du contenue
$mesenregistrements = $db->prepare('SELECT * FROM mesenregistrements');

//on execute la requete
$mesenregistrements->execute();

//on cree la requete pour recuperer les informations des reseaux
$reseaux = $db->prepare('SELECT * FROM reseaux');

//on execute la requete
$reseaux->execute();


?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="css/disco.css"/>
    <link rel="icon" href="img/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>zesmoprod.com</title>
    
    <!-- SCIRPT PLAYER -->
<script type="text/javascript">
    window.Formaweb = window.Formaweb || {};

    window.Formaweb.Player = function() {
  'use strict';
  
  var audio;
  var playlist;
  var len;
  var current;

  init();
  function init(){
    current = 0;
    audio = $('audio')[0];
    
    playlist = [
      {name: 'test001', path: 'audio/test001.mp3', id: 'test001'},
      {name: 'test002', path: 'audio/test002.mp3', id: 'test002'},
      {name: 'test003', path: 'audio/test003.mp3', id: 'test003'},
      {name: 'test004', path: 'audio/test004.mp3', id: 'test004'},
    ];
    
    len = playlist.length - 1;

    // audio.volume = 0.10;
    run(playlist[0], audio);

    audio.addEventListener('ended', function(e){
      next();
      run(playlist[current], audio);
    });
    
    $('.audio-next').on('click', function(){
      next();
      run(playlist[current], audio);
      
      return false;
    });
    
    $('.audio-prev').on('click', function(){
      prev();
      run(playlist[current], audio);
      
      return false;
    });
    
    $('.audio-play').on('click', function(){
      var music_id = $(this).attr('data-music-id');
        
      
      if(music_id != undefined){
        playById(music_id);
      }
      
      return false;
    });
      
      $('.audio-play').on('click', function(){
        if(audio.paused){
            audio.play();
            $('.pause').removeClass('hiddenPause');   /* changer boutons paypause */

            $('.play').addClass('hiddenPause');
            
       /*     $('.audio-play').addClass('bo'); */
        }else{
            audio.pause();
            $('.pause').addClass('hiddenPause');

            $('.play').removeClass('hiddenPause'); 
            
            $('.audio-play').removeClass('bo');
        }
    });
var previous = null;
      
      $('.audio-playpause').on('click', function(){
        if(audio.paused){
            audio.play();
            $('.pause').removeClass('hiddenPause');   /* changer boutons paypause */

            $('.play').addClass('hiddenPause');
            $(previous).addClass('bo');
            
       /*     $('.audio-play').addClass('bo'); */
        }else{
            audio.pause();
            $('.pause').addClass('hiddenPause');

            $('.play').removeClass('hiddenPause'); 
            previous = $('.bo');
            $('.audio-play').removeClass('bo');
        }
    });
      
      
  }                                                   /* Fin changer bouton playpause */
  function run(music, player) {
    $('.audio-name').text(music.name);
    player.src = music.path;
    
    audio.load();
    //audio.play(); 
  }
  function next(){
    current++;
    if(current > len) current = 0;
  }
function prev(){
    current--;
    if(current < 0) current = 0;
  }
  function playById(id){
    var playlist_id = undefined;
    
    $.each(playlist, function(index, value){
      if(value.id == id){
        playlist_id = index;
      }
    });
    
    if(playlist_id != undefined){
      current = playlist_id;
      run(playlist[current], audio);
    }
  }
}
    $(document).ready(function(){
    var player = window.Formaweb.Player();
    });
</script>

</head>
    <body class="divwrapper">
        
     <?php include('includes/header.php'); ?>
        
        
      <!--Début du conetue de la page-->  
        
        
    <div class="row">
        
        
          <?php
            //on cree la requete pour recuperer les informations du contenue
            $playlist = $db->prepare('SELECT id, pochette, description FROM playlist WHERE id = 4');

            //on execute la requete
            $playlist->execute();
        ?>
        
        <article class="ecoute" id="e1">
           <?php while($data = $playlist->fetch(PDO::FETCH_ASSOC)) { ?>
            <figure class="titre">
                <img class="circle1" id="photoalbum" src="<?= cover($data['pochette']) ?>" alt="imageson creations"/>
                <h1>
                    <figcaption><?= $data['description'] ?></figcaption>
                </h1>
            </figure>
         <?php } ?> 
        </article>
        
           <!---------------- NE PAS EFFACER : TEST CHANGEMENT POCHETTE DE PLAYLIST ( MEME TRIGGER QUE CHANGEMENT DE PLAYLIST ) -------------->
        <?php
            //on cree la requete pour recuperer les informations du contenue
            $playlist = $db->prepare('SELECT id, pochette, description FROM playlist WHERE id = 5');

            //on execute la requete
            $playlist->execute();
        ?>
        <article class="ecoute hiddenEcoute" id="e2">
            <?php while($data = $playlist->fetch(PDO::FETCH_ASSOC)) { ?>
            <figure class="titre">
                <img class="circle1" id="photoalbum" src="<?= cover($data['pochette']) ?>" alt="imageson"/>
                <h1>
                    <figcaption><?= $data['description'] ?></figcaption>
                </h1>
            </figure>
            <?php } ?> 
        </article>
        <article class="ecoute hiddenEcoute" id="e3">
            <figure class="titre">
                <img class="circle2" id="photoalbum" src="img/disco/playlist1/pochette1.jpg" alt="imageson"/>
                <h1>
                    <figcaption>Un bien toto album</figcaption>
                </h1>
            </figure>
       </article>
        <article class="ecoute hiddenEcoute" id="e4">
            <figure class="titre">
                <img class="circle2" id="photoalbum" src="img/disco/playlist1/pochette1.jpg" alt="imageson"/>
                <h1>
                    <figcaption>Un bien gentil album</figcaption>
                </h1>
            </figure>
        </article>
        <article class="ecoute hiddenEcoute" id="e5">
            <figure class="titre">
                <img class="circle2" id="photoalbum" src="img/disco/playlist1/pochette1.jpg" alt="imageson"/>
                <h1>
                    <figcaption>Un bien zozo album</figcaption>
                </h1>
            </figure>
        </article>
        <article class="ecoute hiddenEcoute" id="e6">
            <figure class="titre">
                <img class="circle2" id="photoalbum" src="img/disco/playlist1/pochette1.jpg" alt="imageson"/>
                <h1>
                    <figcaption>Un bien coco album</figcaption>
                </h1>
            </figure>
        </article> 
        
         
                <!-- PLAYLIST -->
    
        <article class="musics" id="p1">
            
			<h1 class="titre" id="titrePlaylist">Mes Créations</h1>
                <div>
                    <?php while($data = $mescreations->fetch(PDO::FETCH_ASSOC)) { ?>
                  <p><a href="javascript:void(0)" class="audio-play" data-music-id="<?= $data['titre'] ?>"><?= $data['titre'] ?></a></p>
                    <?php } ?> 
                </div>
            
        </article>
        
        <article class="musics hiddenmusics" id="p2">
                <h1 class="titre" id="titrePlaylist">Mes enregistrements</h1>
                <div>
                    <?php while($data = $mesenregistrements->fetch(PDO::FETCH_ASSOC)) { ?>
			      <p><a href="javascript:void(0)" class="audio-play audio-playpause" data-music-id="<?= $data['titre'] ?>"><?= $data['titre'] ?></a></p>
                 <?php } ?>    
		      </div>
        </article>
        
        <article class="musics hiddenmusics" id="p3">
            <h1 class="titre" id="titrePlaylist">Titre de la Playlist3</h1>
		      <div>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">1.Piece1</a></p>
			      <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">2.Piece2</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test003">3.Piece3</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test004">4.Piece4</a></p>
		      </div>
        </article>
        
        <article class="musics hiddenmusics" id="p4">
            <h1 class="titre" id="titrePlaylist">Titre de la Playlist4</h1>
		      <div>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">1.Pinky1</a></p>
			      <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">2.Pinky2</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test003">3.Pinky3</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test004">4.Pinky4</a></p>
		      </div>
        </article>
        
        <article class="musics hiddenmusics" id="p5">
            <h1 class="titre" id="titrePlaylist">Titre de la Playlist5</h1>
		      <div>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">1.Toto1</a></p>
			      <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">2.Toto2</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test003">3.Toto3</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test004">4.Toto4</a></p>
		      </div>
        </article>
        
        <article class="musics hiddenmusics" id="p6">
            <h1 class="titre" id="titrePlaylist">Titre de la Playlist6</h1>
		      <div>
                  <p><a href="#" class="audio-play" data-music-id="test002">1.Tom1</a></p>
                  <p><a href="#" class="audio-play" data-music-id="test002">2.Tom2</a></p>
                  <p><a href="#" class="audio-play" data-music-id="test003">3.Tom3</a></p>
                  <p><a href="#" class="audio-play" data-music-id="test004">4.Tom4</a></p>
		      </div>
        </article>   
       
        
        <article class="musics hiddenmusics" id="p7">
			<h1 class="titre" id="titrePlaylist">Titre de la Playlist1</h1>
            
                <div>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test001">1.popo1</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">2.popo2</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test003">3.popo3</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test004">4.popo4</a></p>
                </div>
            
        </article>
        
        <article class="musics hiddenmusics" id="p8">
                <h1 class="titre" id="titrePlaylist">Titre de la Playlist2</h1>
                <div>
			      <p><a href="#" class="audio-play audio-playpause" data-music-id="test001">1.Marre1</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">2.Marre2</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test003">3.Marre3</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test004">4.Marre4</a></p>
		      </div>
        </article>
        
        <article class="musics hiddenmusics" id="p9">
            <h1 class="titre" id="titrePlaylist">Titre de la Playlist3</h1>
		      <div>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">1.Du1</a></p>
			      <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">2.Du2</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test003">3.Du3</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test004">4.Du4</a></p>
		      </div>
        </article>
        
        <article class="musics hiddenmusics" id="p10">
            <h1 class="titre" id="titrePlaylist">Titre de la Playlist4</h1>
		      <div>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">1.JS1</a></p>
			      <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">2.JS2</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test003">3.JS3</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test004">4.JS4</a></p>
		      </div>
        </article>
        
        <article class="musics hiddenmusics" id="p11">
            <h1 class="titre" id="titrePlaylist">Titre de la Playlist5</h1>
		      <div>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">1.On1</a></p>
			      <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">2.On2</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test003">3.On3</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test004">4.On4</a></p>
		      </div>
        </article>
        
        <article class="musics hiddenmusics" id="p12">
            <h1 class="titre" id="titrePlaylist">Titre de la Playlist6</h1>
		      <div>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">1.Arrete1</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test002">2.Arrete2</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test003">3.Arrete3</a></p>
                  <p><a href="#" class="audio-play audio-playpause" data-music-id="test004">4.Arrete4</a></p>
		      </div>
                 
            <!-- "loading" remplace le titre de la chanson a coté du player, quand celle ci se charge --> 
        </article>
        
                        <!-- SCRIPT CHANGEMENT PLAYLIST TRIGGER ONCLICK "autre playlists gauche -->
       
                    
                    <!-- Pochettes autres playlistes droite -->
                 <article class="decouvrir" id="a1">
                    <div class="prev-playlist"><!-- BOUTON PREV PLAYLIST -->
                        <a href="javascript:void(0)" class="prevPlaylist" onclick="switchplaylist(1)">Prev</a>
                    </div>
                    
                        <?php
            //on cree la requete pour recuperer les informations du contenue
            $playlist = $db->prepare('SELECT id, pochette, description FROM playlist WHERE id = 4');

            //on execute la requete
            $playlist->execute();
        ?>
                    <h1 class="titre">Autres playlistes à découvrir:</h1>
                     <?php while($data = $playlist->fetch(PDO::FETCH_ASSOC)) { ?>
                    <ul class="ulPlaylist">
                        <li><a class="circle1" href="javascript:void(0)" title="Mes créations" onclick="triggerplaylist(1)"><img class="circle" id="miniPochette" src="<?= cover($data['pochette']) ?>"></a></li>
                        <?php } ?>
                        
                                          <?php
            //on cree la requete pour recuperer les informations du contenue
            $playlist = $db->prepare('SELECT id, pochette, description FROM playlist WHERE id = 5');

            //on execute la requete
            $playlist->execute();
        ?>
                        
                        
                        <?php while($data = $playlist->fetch(PDO::FETCH_ASSOC)) { ?>
                        <li><a class="circle1" href="javascript:void(0)" title="Mes enregistrements" onclick="triggerplaylist(2)"><img class="circle" id="miniPochette" src="<?= cover($data['pochette']) ?>"></a></li>
                        <?php } ?>
                        
                        
                        
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(3)"></a></li>
                        <br>
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(4)"></a></li>
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(5)"></a></li>
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(6)"></a></li>
                     </ul>
                        <!-- BOUTON NEXT PLAYLIST -->
                     <div class="next-playlist">
                        <a href="javascript:void(0)" class="nextPlaylist" onclick="switchplaylist(2)">Next</a>
                    </div> 
                </article>
        
        
    
                <article class="decouvrir hiddenDecouvrir" id="a2">
                     <div class="prev-playlist"><!-- BOUTON PREV PLAYLIST -->
                        <a href="javascript:void(0)" class="prevPlaylist" onclick="switchplaylist(1)">Prev</a>
                    </div>  
                    <h1 class="titre">Autres playlistes à découvrir:</h1>
                    <ul style="margin-left: 30px;">
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(7)"></a></li>
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(8)"></a></li>
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(9)"></a></li>
                        <br>
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(10)"></a></li>
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(11)"></a></li>
                        <li><a class="circle2" href="javascript:void(0)" title="Projet Perso" onclick="triggerplaylist(12)"></a></li>
                     </ul>
                        <!-- BOUTON NEXT PLAYLIST -->
                       <div class="next-playlist">
                        <a href="javascript:void(0)" class="nextPlaylist" onclick="switchplaylist(2)">Next</a>
                    </div> 
                </article>
                
                    <script type="text/javascript">
                      function triggerplaylist(p){
	                   document.getElementById("p1").classList.add('hiddenmusics');
	                   document.getElementById("p2").classList.add('hiddenmusics');
	                   document.getElementById("p3").classList.add('hiddenmusics');
	                   document.getElementById("p4").classList.add('hiddenmusics');
	                   document.getElementById("p5").classList.add('hiddenmusics');
	                   document.getElementById("p6").classList.add('hiddenmusics');
                        document.getElementById("p7").classList.add('hiddenmusics');
	                   document.getElementById("p8").classList.add('hiddenmusics');
	                   document.getElementById("p9").classList.add('hiddenmusics');
	                   document.getElementById("p10").classList.add('hiddenmusics');
	                   document.getElementById("p11").classList.add('hiddenmusics');
	                   document.getElementById("p12").classList.add('hiddenmusics');
                          
                        document.getElementById("e1").classList.add('hiddenEcoute');
	                   document.getElementById("e2").classList.add('hiddenEcoute');
	                   document.getElementById("e3").classList.add('hiddenEcoute');
	                   document.getElementById("e4").classList.add('hiddenEcoute');
	                   document.getElementById("e5").classList.add('hiddenEcoute');
	                   document.getElementById("e6").classList.add('hiddenEcoute');
	
	               switch(p){
		              case 1:
		              document.getElementById("p1").classList.remove('hiddenmusics');
		              document.getElementById("e1").classList.remove('hiddenEcoute');
                           
		              break;
		              case 2:
		              document.getElementById("p2").classList.remove('hiddenmusics');
		              document.getElementById("e2").classList.remove('hiddenEcoute');
                           
		              break;
		              case 3:
		              document.getElementById("p3").classList.remove('hiddenmusics');
		              document.getElementById("e3").classList.remove('hiddenEcoute')
                           
		              break;
		              case 4:
		              
                        document.getElementById("p4").classList.remove('hiddenmusics');
                        document.getElementById("e4").classList.remove('hiddenEcoute');
		              break;
		              case 5:
		              document.getElementById("p5").classList.remove('hiddenmusics');
		              document.getElementById("e5").classList.remove('hiddenEcoute');
                           
		              break;
		              case 6:
		              document.getElementById("p6").classList.remove('hiddenmusics');
		              document.getElementById("e6").classList.remove('hiddenEcoute');
                           
		              break;
                    case 7:
		              document.getElementById("p7").classList.remove('hiddenmusics');
                           
		              break;
		              case 8:
		              document.getElementById("p8").classList.remove('hiddenmusics');
                        
		              break;
		              case 9:
		              document.getElementById("p9").classList.remove('hiddenmusics');
                           
		              break;
		              case 10:
		              document.getElementById("p10").classList.remove('hiddenmusics');
                           document.getElementById("p10").classList.remove('hiddenmusics');
		              break;
		              case 11:
		              document.getElementById("p11").classList.remove('hiddenmusics');
                           document.getElementById("p11").classList.remove('hiddenmusics');
		              break;
		              case 12:
		              document.getElementById("p12").classList.remove('hiddenmusics');
                           
		              break;
	                   }
	               return true;
                }
                 
                    </script> 
                
                    <script type="text/javascript">
                      function switchplaylist(p){
	                   document.getElementById("a1").classList.add('hiddenDecouvrir');
	                   document.getElementById("a2").classList.add('hiddenDecouvrir');
	                   
	
	               
                    switch(p){
		              case 1:
		              document.getElementById("a1").classList.remove('hiddenDecouvrir');
                           document.getElementById("a1").classList.remove('hiddenDecouvrir');
		              break;
		              case 2:
		              document.getElementById("a2").classList.remove('hiddenDecouvrir');
                           document.getElementById("a2").classList.remove('hiddenDecouvrir');
		              break;
	                   }
	               return true;
                }
                
                    </script>
            </div>
            
        
        
        
        
        
        
        <span class="audio-name">loading...</span>
        <article class="col-12">
            <div id="player">
                 
                      <a href="javascript:void(0)" id="prev" class="audio-prev">Prev</a>
                      <a href="javascript:void(0)" id="z1" class="play audio-playpause" onclick="switchplay(1)">Play</a> 
                      <a href="javascript:void(0)" id="z2" class="pause audio-playpause hiddenPause" onclick="switchplay(2)">Pause</a>
                        
                      <audio  class="player"></audio>
                    
                      <a href="javascript:void(0)" id="next" class="audio-next">Next</a>
                
                <!-- BOUTON TELECHARGER A PROG EN PHP -->
                    
            </div>
            
            
            
        </article>
       
            
        
        
        <!------------------- SCRIPT GARDER PLAY APRES LE CLICK SUR LA CHANSON   --------------->
        <script type="text/javascript">
            // quand le mec clique sur un élément select-objet
        // rechercher tous les éléments select-objet
        var obj = document.getElementsByClassName('audio-play');
    
        // pour chaque élément de cet array obj, on ajoute un événement
        var i;
        var limite = obj.length;
        for(i=0;i<limite;i++){
            obj[i].addEventListener('click', function(){
                for(i=0;i<limite;i++){
                    //obj[i].style.background = 'blue';
                    obj[i].setAttribute('class','audio-play');
                }
                //this.style.background = 'red';
               
                this.setAttribute('class', 'audio-play bo');
            });
        }
    // on change le background

        </script> 
        
        <!-- FIN SCRIPT garder play apres le click  -->
        
        
    <!--Début du conetue de la page-->    
        
        
<footer>
        <p><a href="mentions.php">Mentions légales</a> - Copyright Zesmo 2017. All rights reserved - Oblivion IESA</p>
            <?php while($data = $reseaux->fetch(PDO::FETCH_ASSOC)) { ?>
              
                <a href="<?php echo $data['lien'] ?>" target="_blank"><img src="<?php echo cover($data['logo']) ?>" alt="<?= $data['name'] ?>"/></a>
        
        <?php } ?>            
    </footer>
    </body>
</html>
        
        