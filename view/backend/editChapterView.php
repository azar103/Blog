<?php session_start(); ?>
<?php $title="editChapter" ?>
<?php ob_start(); ?>
<div class="container" id="addBlock">
    <?php
    if(!empty($errors)){
        ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error){ ?>
                <ul>
                    <li><?= $error ?></li>
                </ul>

            <?php   } ?>
        </div>
        <?php
    }
    $data = $request->fetch();
    ?>
    <form method="POST" action="">
        <div class="row">
            <h1 class="col-xs-12">Modifier L'episode</h1>

            <div class="col-xs-12">
                <h2>Titre</h2>
                <input type="text" name="title" class="form-control" value="<?= $data['title'] ?>">
            </div>

            <div class="col-xs-12">
                <h2>Contenu</h2>
                <textarea name="content" id="myTextArea" ><?= $data['content']?></textarea>
            </div>
            <div class="col-xs-12 ">
                <input type="submit" class="btn btn-primary btn-lg" id="btn-add" value="Valider">
            </div>
    </form>

</div>

</div>
<?php $content = ob_get_clean();?>
<?php require('view/frontend/template.php'); ?>
