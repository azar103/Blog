<?php session_start(); ?>
<?php $title="Authentification" ?>
<?php ob_start(); ?>
<div class="container">
    <div class="well">
        <?php
        if(!empty($errors)){
            ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error){ ?>
                    <ul>
                        <li><?=  $error ?></li>
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
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
