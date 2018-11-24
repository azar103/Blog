<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 21/11/2018
 * Time: 22:59
 */
require_once ('Manager.php');
class CommentManager extends Manager
{
    function addComment($id, $login, $content){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(chapter_id, login, comment, created_at) VALUES(?,? , ? , NOW() )');
        $req->execute(array($id, $login , $content));
    }
    function getComments($id){
        $db = $this->dbConnect();
        $pagination = new Pagination;
        $commentsPerPages = $pagination->commentsPerPage();
        $firstEnter = $pagination->firstEnterComment();
        $req = $db->prepare('SELECT id, login, comment, DATE_FORMAT(created_at ,\'%d/%m/%Y à %Hh%imin%ss\') AS date FROM comments WHERE chapter_id = ? LIMIT '.$firstEnter.', '.$commentsPerPages);
        $req->execute(array($id));
        return $req;
    }

    function deleteComment($id){
        $db = $this->dbConnect();
        $req= $db->prepare('DELETE FROM comments WHERE id = ?')->execute(array($id));

    }

}