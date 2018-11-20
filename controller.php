<?php
require('loginModel.php');
require('homeModel.php');
require ('chapterModel.php');
require ('addChapterModel.php');
require ('editChapterModel.php');

function getAuthentification(){
    if(!empty($_POST)){
        $errors = array();
        if(empty($_POST['login']) || !preg_match('/^[a-z0-9_]+$/', $_POST['login'])){
            $errors['login'] = "vous n'avez pas entrez de login valide";
        }
        else if(empty($_POST['password'])){
            $errors['password'] = "vous n'avez pas entrez de mot de passe valide";
        }
        else{
            if(isset($_POST['login']) AND isset($_POST['password'])){
                $req = login($_POST['login'], $_POST['password']);
                $result = $req->fetch();
                if($result){
                    session_start();
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['login'] = $result['login'];
                    header('location: index.php?action=chapters');
                    exit();
                }else{
                    $errors['message'] = "vous n'avez pas entrez de login et/ou mot de passe valide";
                }
            }
        }

    }
    require('loginView.php');
}
function chapters(){
    $numberOfPages = getNumberOfPages(3);
    $req = getChapters();
    if(isset($_GET['id'])){
        deleteChapter($_GET['id']);
        header('location:index.php?action=chapters&delete');
    }
    require('homeView.php');
}

function chapter(){
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
                    header('location:index.php?action=chapter&id='.$_GET['id']);
                    exit();
                }
            }
        }
    }
    $number = getNumberOfPagesOfComments(5);
    $actualPage = getActualPage();
    if(isset($_GET['commentId'])){
        deleteComment($_GET['commentId']);
        header('location: index.php?action=chapter&id='.$_GET["id"]);
        exit();
    }
    $reqComments = getComments($_GET['id']);
    $reqChapter= getChapter($_GET['id']);
    require('chapterView.php');
}
function editChapterForm(){
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
            if (isset($_POST['title']) && isset($_POST['content'])) {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                     updateChapter($_POST['title'], $_POST['content'], $_GET['id']);
                    header('location: index.php?action=chapters&edit');
                    exit();
                }
            }
        }
    }
    require('editChapterView.php');
}

function addChapterForm(){
    if(!empty($_POST)) {
        $errors = array();
        if (empty($_POST['title']) ) {
            $errors['title'] = "vous n'avez pas entrez de titre valide";
        }else{
            $request= getChapter($_POST['title']);
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
            if (isset($_POST['title']) && isset($_POST['content'])) {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    addChapter($_POST['title'],$_POST['content']);
                    header('location: index.php?action=chapters&add');
                    $request->closeCursor();
                    exit();
                }
            }
        }
    }
    require('addChapterView.php');
}
