
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19/11/2018
 * Time: 12:46
 */
<html>
       <head>
       <title> Authentification</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
       <link rel="stylesheet" type="text/css" href="css/style.css">
       <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Roboto+Mono" rel="stylesheet">
       </head>
       <body>

       <?php require ('nav.php')?>

<div class="container">

    <div class="well">
        <?php
        if(!empty($errors)){

            ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error){ ?>
                    <ul>
                        <li><?php echo $error ?></li>
                    </ul>

                <?php   } ?>


            </div>
            <?php
        }
        ?>
        <div id="authentification">
            <h2>Authentification</h2>
            <hr>
            <p>
                Si vous n'êtes pas membre, vous ne pouvez y acceder. Retour à la<a href="home.php"> page d'accueil</a></p>
            <form action="" method="post">
                <input type="text"  name="login" class="form-control" id="exampleLoginText" placeholder="Login" >
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" >
                <input id="btn" type="submit" name="submit" class="btn btn-primary" value="Se Connecter">
            </form>
        </div>
    </div>
</div>
<?php require ('footer.php')?>

</body>
</html>