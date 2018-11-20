<?php session_start(); ?>
<?php $title="homePage" ?>
<?php ob_start(); ?>
<header>
    <?php require('functions.php') ?>
    <div id="header-photo">
        <img src="https://i.pinimg.com/originals/4e/5d/ad/4e5dad42623fce99caaf8f4e70cdc084.png">
    </div>
</header>
<div class="container">
    <?php
    if (isset($_GET['delete'])) {
        ?>
        <h2 class="alert alert-info">
            chapitre supprime!
        </h2>
        <?php
    }
    if(isset($_GET['edit'])){
        ?>
        <h2 class="alert alert-info">
            chapitre modifie!
        </h2>
        <?php
    }

    ?>
 <?php
 if(isset($_GET['add'])){
     ?>
     <h2 class="alert alert-info">
         chapitre ajoute!
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
                    <a href="index.php?action=addChapter" target="_blank">  <button class="btn btn-primary">Ajouter   <i class="fa fa-plus"></i>  </button></a>
                </div>

            </div>
        <?php }   ?>
        <h1 id="title">Liste des episodes</h1>
        <?php
        while ($data = $req->fetch())
        {
            ?>
            <article class="row">
            <p></p> <h1 class="col-xs-12"><?php echo $data['title'] ?> </h1><i class="col-xs-12" id="date">Publié le <?php echo $data['date'] ?></i> <br>
            <p class="col-xs-12">
                <?php
                $str = strip_tags($data['content']);
                echo cutString(100, $str);
                ?>
            </p>
            <?php

            if (!isset($_SESSION['id']) && !isset($_SESSION['login'])) {
                ?>
                <div class="col-xs-12">
                    <a href="chapter.php?id=<?php echo $data['id'] ?>&action=chapter">  <button class="btn btn-primary">  Lire Les Details >></button></a>
                </div>
                </article>
                <?php
            } else {
                ?>
                <div class="col-xs-12">
                    <a href="index.php?action=chapter&id=<?= $data['id'] ?>">  <button class="btn btn-primary">  Lire Les Details >></button></a>

                    <a href="index.php?action=editChapter&id=<?= $data['id'] ?>"> <button class="btn btn-primary"> Modifier <i class="fa fa-edit"></i></button></a>
                    <a href="index.php?action=chapters&id=<?= $data['id'] ?>"> <button class="btn btn-primary">Supprimer <i class="fa fa-trash"></i></button></a>
                </div>
                </article>
                <?php
            }
        }
        ?>

    </div>
</div>
<?php
$req->closeCursor();
?>

</div>
<div class="text-center">
    <div class="btn-group">
        <?php
        for ($i=1;$i<=$numberOfPages;$i++){
            ?>
            <a href="home.php?page=<?php echo $i ?>"><button class="btn btn-primary "><?php echo $i ?></button> </a>
            <?php
        }
        ?>
    </div>
<?php $content = ob_get_clean();?>
<?php require ('template.php');?>
