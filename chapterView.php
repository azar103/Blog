<?php session_start(); ?>
<?php $title="chapterView" ?>
<?php ob_start();?>

<div class="container">
    <div id="article">

        <?php if (isset($_GET['signal'])){
            ?>
            <h2 class="alert alert-info">
                Votre signalement a été pris en compte.
            </h2>
            <?php
        }
        $data = $reqChapter->fetch();
        ?>
        <h2 class="row"><?= htmlspecialchars($data['title']) ?> <i>Publié le <?= $data['date'] ?></i></h2>
        <div class="container">
            <p ><?= $data['content'] ?></p><br>
            <div >
                <h2>Ecrire un commentaire</h2>

                <form method="POST" action="">

                    <input id="pseudo-comment" type="text" name="login" placeholder="Entrez votre pseudo..."
                    >
                    <textarea id="content-comment" name="content" cols="50" rows="5" class="form-control" placeholder="Entrez un commentaire..." ></textarea>
                    <input type="submit" class="btn btn-primary">
                </form>

            </div>

            <div >
                <h2>Lire les Commentaires</h2>

                <div class="container">
                    <?php

                    while($data=$reqComments->fetch()){
                        ?>
                        <div class="row">
                            <p ><strong><?= htmlspecialchars($data['login']) ?>- le <?php echo $data['date'] ?> </strong> </p>
                            <p id="title"><?= htmlspecialchars($data['comment']) ?></p>
                            <?php
                            if(!isset($_SESSION['id']) && !isset($_SESSION['login'])){ ?>
                                <p><a id="link_signal"
                                      href="chapter.php?id=<?= $_GET['id'] ?>&page=<?=$actualPage ?>&signal">Signaler</a>
                                </p>
                                <?php
                            }else {
                                ?>
                                <p><a href="index.php?action=chapter&id=<?= $_GET['id'] ?>&page=<?= $actualPage ?>&commentId=<?= $data['id'] ?>"><button class="btn btn-danger">Supprimer</button> </a>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                    <?php }
                    $reqComments->closeCursor();
                    ?>

                </div>
            </div>



        </div>


    </div>


</div>

<div class="text-center">
    <div class="btn-group">
        <?php
        for ($i=1;$i<=$number;$i++){
            ?>
            <a href="chapter.php?id=<?php echo $_GET['id']?>&page=<?php echo $i ?>"><button class="btn btn-primary "><?php echo $i ?></button> </a>

            <?php
        }
        ?>
    </div>
<?php $content = ob_get_clean();?>
<?php require('template.php'); ?>