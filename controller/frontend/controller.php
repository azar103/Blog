<?php

require('model/UserManager.php');
require('model/ChapterManager.php');
require('model/CommentManager.php');
require_once ('model/Pagination.php');

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
                $user = new UserManager;
                $req = $user->login($_POST['login'], $_POST['password']);
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
    require('view/frontend/loginView.php');
}
function chapters(){
    $chapter = new ChapterManager();;
    $pagination =  new Pagination();
    $numberOfPages = $pagination->getNumberOfPages(3);
    $req = $chapter->getChapters();
    $total =  $pagination->getTotalPages();
    require('view/frontend/homeView.php');
}

function chapter(){
    $comment = new CommentManager();
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

                   $comment->addComment($_GET['id'], $_POST['login'], $_POST['content']);
                    header('location:index.php?action=chapter&id='.$_GET['id']);
                    exit();
                }
            }
        }
    }
    $pagination = new Pagination();
    $number = $pagination->getNumberOfPagesOfComments(5);
    $actualPage = $pagination->actualCommentPage();
    if(isset($_GET['commentId'])){
        deleteComment($_GET['commentId']);
        header('location: index.php?action=chapter&id='.$_GET["id"]);
        exit();
    }
    $reqComments = $comment->getComments($_GET['id']);
    $chapter = new \Alaska\Blog\Model\ChapterManager();
    $reqChapter= $chapter->getChapter($_GET['id']);
    require('view/frontend/chapterView.php');
}

