<!-- Récupération Des Données -->
<?php
require('editChapterModel.php');
$req = findChapter($_GET['id']);
if(!empty($_POST)) {
    $errors = array();
    if (empty($_POST['title'])) {
        $errors['title'] = "vous n'avez pas entrez de titre valide";
    }
    if (empty($_POST['content'])) {
        $errors['content'] = "vous n'avez pas entrez de contenu valide";
    }
    if(empty($errors)){
        require('connectToDb.php');
        if (isset($_POST['title']) && isset($_POST['content'])) {
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                updateChapter($_POST['title'], $_POST['content'], $_GET['id']);
                header('location: home.php?actionEdit');
                exit();
            }
        }
    }
}
require('editChapterView.php');