<?php
require ('controller.php');

if(isset($_GET['action'])){
    if($_GET['action'] == 'authentification'){
        getAuthentification();
    }else if($_GET['action'] == 'addChapter'){
         addChapterForm();
    }else if($_GET['action'] == 'chapter'){
        if(isset($_GET['id']) && $_GET['id']>0){
            chapter();
        }
    }
    else if($_GET['action'] == 'editChapter'){
        editChapterForm();
    } else if($_GET['action'] == 'chapters'){
        chapters();
    }
}
else{
    getAuthentification();
}
