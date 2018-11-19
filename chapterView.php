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


<div class="container">
    <div id="article">

        <?php if (isset($_GET['action'])){
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
            <p class="content"><?= $data['content'] ?></p><br>
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
                                      href="chapter.php?id=<?= $_GET['id'] ?>&page=<?=$actualPage ?>&action=signal">Signaler</a>
                                </p>
                                <?php
                            }else {
                                ?>
                                <p><a href="chapter.php?id=<?= $_GET['id'] ?>&page=<?= $actualPage ?>&commentId=<?= $data['id'] ?>"><button class="btn btn-danger">Supprimer</button> </a>
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
    <?php require ('footer.php') ?>
    </body>

    </html>