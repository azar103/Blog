<?php
require('chapterModel.php');
if(!empty($_POST)) {
    $errors = array();
    if (empty($_POST['login'])) {
        $errors['login'] = "le pseudo n'est pas valide ";
    }
    if (empty($_POST['content'])) {
        $errors['content'] = "le contenu n'est pas valide ";
    }
    if (empty($errors)) {
        if(isset($_POST['login']) && isset($_POST['content'])) {
            if (!empty($_POST['login']) && !empty($_POST['content'])) {
                addComment($_GET['id'], $_POST['login'], $_POST['content']);
                header('location:chapter.php?id='.$_GET['id']);
                exit();
            }
        }
    }
}
$number = getNumberOfPagesOfComments(5);
$actualPage = getActualPage();
if(isset($_GET['commentId'])){
    deleteComment($_GET['commentId']);
    header('location: chapter.php?id='.$_GET["id"].'&page='.$actualPage);
    exit();
}
$reqComments = getComments($_GET['id']);
$reqChapter= getChapter($_GET['id']);
require('chapterView.php');



