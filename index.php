<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<title>Mon Blog</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Roboto+Mono" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>  	
   <header>

   	          <?php	require('nav.php') ?>
       <?php require('functions.php') ?>
          <div id="header-photo">
       <img src="https://i.pinimg.com/originals/4e/5d/ad/4e5dad42623fce99caaf8f4e70cdc084.png">
       </div> 

   </header>
   <div class="container">
 <?php
 require ('connectToDb.php');
 if(isset($_GET['id'])) {
     $req = $db->prepare('DELETE FROM chapter WHERE id =?')->execute(array($_GET['id']));
     if ($req) {
         ?>
         <h2 class="alert alert-info">
             chapitre supprime!
         </h2>
         <?php

     }


 }
 if(isset($_GET['actionEdit'])){
     ?>
     <h2 class="alert alert-info">
         chapitre modifie!
     </h2>
     <?php
 }
 ?>
  <section id="presentation">

    <h1 id="title">Billet simple pour l'Alaska, roman en ligne</h1>
    <p>Bienvenue sur le blog de Jean Forteroche. 
Découvrez son dernier roman.</p>



<p><img id="img-presentation" src="http://bguiriec.fr/projet3/assets/image/jean.jpg">
Jean Forteroche est né en 1966 sur l'île Adak, en Alaska, et y a passé une partie de son enfance avant de s'installer en France avec sa mère et sa sœur. 
Il a rédigé son premier roman LES NAUFRAGES lors d'un voyage en mer.
Après avoir parcouru plus de 40 000 milles sur les océans, il échoue lors de sa tentative de tour du monde en solitaire sur un trimaran qu'il a dessiné et construit lui-même.
En 2013, il publie LE DERNIER MILE récit de son propre naufrage dans les Caraïbes lors de son voyage de noces quelques années plus tôt. 
Ce livre fait partie de la liste des best-sellers du Figaro. Publié en France en janvier 2010, LES NAUFRAGES remporte immédiatement un immense succès. Il remporte le prix Médicis et s'est vendu à plus de 300 000 exemplaires.

Porté par son succès, Jean Forteroche est aujourd'hui traduit en dix-huit langues dans plus de soixante pays. Une adaptation cinématographique par une société de production française est en cours.

En 2017, il décide de publier en ligne chapitre par chapitre sur son propre site, son dernier roman BILLET SIMPLE POUR L'ALASKA.</p>


  </section>



   <div id="main">
       <?php     if (isset($_SESSION['id']) && isset($_SESSION['login'])) { ?>
       <div class="row">
           <div class="container">
               <h1 id="title">Ajouter Un Episode</h1>
               <a href="addChapter.php" target="_blank">  <button class="btn btn-primary">Ajouter   <i class="fa fa-plus"></i>  </button></a>
           </div>

       </div>

    <?php }   ?>
    <h1 id="title">Liste des episodes</h1>
   <?php

     $response = $db->query('SELECT id, title, content, DATE_FORMAT(created_at ,\'%d/%m/%Y à %Hh%imin%ss\') AS date FROM chapter ORDER BY date DESC');
     while ($data = $response->fetch())
   {
   ?>
       <article>
       <h1><?php echo $data['title'] ?> </h1><i id="date">Publié le <?php echo $data['date'] ?></i> <br>
           <p>
               <?php
               $str = htmlspecialchars_decode(stripslashes($data['content']));
               echo cutString(100, $str);
               ?>
           </p>
           <?php
           if (!isset($_SESSION['id']) && !isset($_SESSION['login'])) {
               ?>
                 <button class="btn btn-primary">Lire en details
                       >>
                   </button>
               <?php

           } else {
               ?>

               <a href="episode.php?id=<?php echo $data['id'] ?>">  <button class="btn btn-primary">  Lire Les Details >></button></a>

               <a href="editChapter.php?id=<?php echo $data['id'] ?>"> <button class="btn btn-primary">Modifier <i class="fa fa-edit"></i></button></a>
               <a href="index.php?action=delete&id=<?php echo $data['id'] ?>"> <button class="btn btn-primary">Supprimer <i class="fa fa-trash"></i></button></a>

   </article>
               <?php
           }

   }
   $response->closeCursor();
   ?>




   </div>
   </div>


    <?php require('footer.php')?>
 
</body>
</html>