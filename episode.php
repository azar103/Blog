<html>
    <head>
        <title>Episode</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Roboto+Mono" rel="stylesheet">
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
                   <h2 class="col-xs-12"><?php echo  $data['title'];?> <i>Publié le <?php echo $data['date'] ?></i></h2>
                   <hr size="30">
                   <p class="col-xs-12"><?php echo  $data['content']; ?></p><br>

               </div>


           </div>


      <?php require ('footer.php') ?>
    </body>

</html>