<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19/11/2018
 * Time: 17:40
 */
function dbConnect(){
    try{
        $db = new PDO('mysql:host=localhost;dbname=blogdb;charset=utf8','root',''
        );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        die('Erreur  :'.$e->getMessage());
    }
    return $db;
}
function addComment($id, $login, $content){
    $db = dbConnect();
    $req = $db->prepare('INSERT INTO comments(chapter_id, login, comment, created_at) VALUES(?,? , ? , NOW() )');
    $req->execute(array($id, $login , $content));
}
function getComments($id){
    $db = dbConnect();
    $commentsPerPages = 5;
    $numberOfPages = getNumberOfPagesOfComments($commentsPerPages);
    $actualPage = getActualPage();
    $firstEnter = ($actualPage-1)*$commentsPerPages;
    $req = $db->prepare('SELECT id, login, comment, DATE_FORMAT(created_at ,\'%d/%m/%Y à %Hh%imin%ss\') AS date FROM comments WHERE chapter_id = ? LIMIT '.$firstEnter.', '.$commentsPerPages);
    $req->execute(array($id));
    return $req;
}
function getActualPage(){
    $numberOfPages= getNumberOfPagesOfComments(5);
    $actualPage = 0;
    if(isset($_GET['page'])){
        $actualPage = intval($_GET['page']);
        if($actualPage>$numberOfPages) {
            $actualPage = $numberOfPages;
        }
    }else{
        $actualPage = 1;
    }
    return $actualPage;
}
function getNumberOfPagesOfComments($commentsPerPage){
    $db = dbConnect();
    $total_data = $db->query('SELECT COUNT(*)  AS total FROM comments WHERE chapter_id = '.$_GET['id'])->fetch();
    $total = $total_data['total'];
    $numberOfPages =ceil($total/$commentsPerPage);

    return $numberOfPages;
}

function deleteComment($id){
    $db = dbConnect();
    $req= $db->prepare('DELETE FROM comments WHERE id = ?')->execute(array($id));
}

function getChapter($id){
    $db = dbConnect();
    $req =  $db->prepare('SELECT id, title, content, DATE_FORMAT(created_at ,"%d/%m/%Y à %Hh%imin%ss") AS date FROM chapter WHERE id = ?');
    $req->execute(array($id));
    return $req;
}
