<html>
<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Roboto+Mono" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="public/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            mode: "exact",
            selector: '#myTextArea',
        });
    </script>
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="../../../" class="navbar-brand">Billet Simple pour L'alaska</a>
            </div>
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php?action=chapters">Accueil</a>
                </li>
                <li>
                    <a href="index.php#main">Liste des episodes</a>
                </li>
                <?php
                if (isset($_SESSION['id']) && isset($_SESSION['login']) ){
                    ?>
                    <li ><a href="logout.php">Deconnexion</a></li>
                    <?php
                }?>
            </ul>
        </div>
    </div>

</head>
<body>
<?= $content ?>
<?php require('footer.php') ?>
</body>
</html>