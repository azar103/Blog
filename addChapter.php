<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <title>Mon Blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Roboto+Mono" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            mode: "exact",
            selector: '#myTextArea',

        });
    </script>
</head>
<body>
<header>
    <?php	require('nav.php') ?>
</header>

<div class="container" id="addBlock">
    <?php
    require('connectToDb.php');
        if(!empty($_POST)) {
            $errors = array();
            if (empty($_POST['title']) ) {
                $errors['title'] = "vous n'avez pas entrez de titre valide";
            }else{
                    $request = $db->prepare('SELECT id FROM chapter WHERE title = ?');
                    $request->execute(array($_POST['title']));
                    $chapter = $request->fetch();
                    if($chapter){
                        $errors['message']="episode existant !";
                    }
                    $request->closeCursor();
            }
            if (empty($_POST['content'])) {
                 $errors['content'] = "vous n'avez pas entrez de contenu valide";
            }
            if(strlen($_POST['content'])<100){
                $errors['content'] = "Vous devez rentrer 100 caractéres au moins !";
            }
            if(empty($errors)){
                require('connectToDb.php');
                if (isset($_POST['title']) && isset($_POST['content'])) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        $request = $db->prepare('INSERT INTO chapter(title, content, created_at) VALUES (?, ?, NOW())');
                        $request->execute(array($_POST['title'], html_entity_decode($_POST['content'])));
                        header('location: index.php');
                        $request->closeCursor();
                        exit();
                    }
                }
            }
        }

    ?>
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
    <form method="POST" action="">
    <div class="row">
        <h1 class="col-xs-12">Ajouter un nouveau episode</h1>

        <div class="col-xs-12">
            <h2>Titre</h2>
            <input type="text" name="title" class="form-control"  >
        </div>

        <div class="col-xs-12">
            <h2>Contenu</h2>
            <textarea name="content" id="myTextArea" ></textarea>
        </div>
        <div class="col-xs-12 ">
            <input type="submit" class="btn btn-primary btn-lg" id="btn-add" value="Valider">
        </div>
    </form>

    </div>

</div>




  <?php require('footer.php')?>

</body>
</html>