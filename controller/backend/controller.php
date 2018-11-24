<?php

require_once('model/ChapterManager.php');
require_once('model/CommentManager.php');
require_once ('model/Pagination.php');

function deleteChapterForm(){
    if(isset($_GET['id'])){
        $chapter = new ChapterManager();
        $chapter->deleteChapter($_GET['id']);
        header('location:index.php?action=chapters&delete');
    }
    require('view/frontend/homeView.php');
}
function editChapterForm(){
    $chapterManager = new ChapterManager();
    $request = $chapterManager->getChapter($_GET['id']);
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
                    $chapterManager->updateChapter($_POST['title'], $_POST['content'], $_GET['id']);
                    header('location: index.php?action=chapters&edit');
                    exit();
                }
            }
        }
    }
    require('view/backend/editChapterView.php');
}

function addChapterForm(){
    $chapter =new ChapterManager();
    if(!empty($_POST)) {
        $errors = array();
        if (empty($_POST['title']) ) {
            $errors['title'] = "vous n'avez pas entrez de titre valide";
        }else{
            $req= $chapter->findChapter($_POST['title']);
            $chapterExist = $req->fetch();
            if($chapterExist){
                $errors['message']="episode existant !";
            }
            $req->closeCursor();
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
                   $chapter->addChapter($_POST['title'],$_POST['content']);
                    header('location: index.php?action=chapters&add');
                    exit();
                }
            }
        }
    }
    require('view/backend/addChapterView.php');
}

function deleteSingleComment(){
    $comment = new CommentManager();
    if(isset($_GET['commentId'])){
        $comment->deleteComment($_GET['commentId']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    require('view/frontend/chapterView.php');
}