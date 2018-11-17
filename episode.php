<html>
    <head>
        <title>Episode</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Roboto+Mono" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
       <?php require ('nav.php') ?>
      <?php  require('connectToDb.php') ?>

           <div class="container">

               <div id="article">

                   <?php

                          $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(created_at ,\'%d/%m/%Y à %Hh%imin%ss\') AS date FROM chapter WHERE id = ?');
                          $req->execute(array($_GET['id']));
                          $data = $req->fetch();

                   ?>
                   <?php
                   //pagination
                   $commentsPerPages = 5;
                   $total_data = $db->query('SELECT COUNT(*)  AS total FROM comments')->fetch();
                   $total = $total_data['total'];
                   $numberOfPages =ceil($total/$commentsPerPages);

                   $actualPage = 0;
                   if(isset($_GET['page'])){
                       $actualPage = intval($_GET['page']);
                       if($actualPage>$numberOfPages) {
                           $actualPage = $numberOfPages;
                       }
                   }else{
                       $actualPage = 1;
                   }

                   $firstEnter = ($actualPage-1)*$commentsPerPages;
                   ?>
                   <h2 class="col-xs-12"><?php echo  $data['title'];?> <i>Publié le <?php echo $data['date'] ?></i></h2>

                   <div class="container">
                       <p class="col-xs-12"><?php echo  $data['content']; ?></p><br>
                       <div class="col-xs-12">
                           <h2>Ecrire un commentaire</h2>

                           <form method="POST" action="">
                               <input id="pseudo-comment" type="text" name="login" placeholder="Entrez votre pseudo...">
                               <textarea id="content-comment" name="content" cols="50" rows="5" class="form-control" placeholder="Entrez un commentaire..." ></textarea>
                               <input type="submit" class="btn btn-primary">
                           </form>

                       </div>

                       <div class="col-xs-12">
                             <h2>Lire les Commentaires</h2>

                           <div class="container">
                               <?php
                               $req = $db->prepare('SELECT pseudo,chapter_id ,comment, DATE_FORMAT(created_at ,"%d/%m/%Y à %Hh%imin%ss") AS date FROM comments WHERE chapter_id= ? ORDER BY date DESC LIMIT '.$firstEnter.', '.$commentsPerPages);
                                  $req->execute(array($_GET['id']));
                               while($data=$req->fetch()){
                               ?>
                               <div class="row">
                                    <?php echo $data['pseudo'] ?>-le <?php echo $data['date'] ?>
                                   <p id="title"><?php echo $data['comment'] ?></p>
                               </div>
                               <?php }  ?>

                           </div>
                       </div>
                       <?php
                       $req->closeCursor();

                       if(!empty($_POST)) {
                           $errors = array();
                           if (empty($_POST['login'])) {
                               $errors['login'] = "le pseudo n'est pas valide ";
                           }
                           if (empty($_POST['content'])) {
                               $errors['content'] = "le contenu n'est pas valide ";
                           }
                           if (empty($errors)) {
                               if(isset($_POST['login']) && isset($_POST['content'])) {
                                   if (!empty($_POST['login']) && !empty($_POST['content'])) {
                                       $req = $db->prepare('INSERT INTO comments(chapter_id, pseudo, comment, created_at) VALUES(?,? , ? , NOW() )');
                                       $req->execute(array($_GET["id"], $_POST["login"], $_POST["content"]));
                                       $req->closeCursor();
                                       header('location: episode.php?id='.$_GET['id']);
                                   }
                               }
                           }
                       }

                       ?>


                   </div>


             </div>


           </div>

       <div class="text-center">
           <div class="btn-group">
               <?php
               for ($i=1;$i<=$numberOfPages;$i++){
                   ?>
                   <a href="episode.php?id=<?php echo $_GET['id']?>&page=<?php echo $i ?>"><button  class="btn btn-primary "><?php echo $i ?></button> </a>

                   <?php

               }
               ?>
           </div>
      <?php require ('footer.php') ?>
    </body>

</html>