<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 21/11/2018
 * Time: 22:58
 */
require_once ('Manager.php');
class ChapterManager extends  Manager
{
    public function getChapters(){
        $db = $this->dbConnect();
        $pagination = new Pagination;
        $chapterPerPages = $pagination->chapterPerPages();
        $firstEnter = $pagination->firstEnter();
        $req= $db->query('SELECT id, title, content, DATE_FORMAT(created_at ,"%d/%m/%Y à %Hh%imin%ss") AS date FROM chapter ORDER BY date DESC  LIMIT '.$firstEnter.', '.$chapterPerPages);
        return $req;
    }
    public function getChapter($id){
        $db = $this->dbConnect();
        $req =  $db->prepare('SELECT id, title, content, DATE_FORMAT(created_at ,"%d/%m/%Y à %Hh%imin%ss") AS date FROM chapter WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }
    function addChapter($title, $content){
        $db = $this->dbConnect();
        $request = $db->prepare('INSERT INTO chapter(title, content, created_at) VALUES (?, ?, NOW())');
        $request->execute(array($title, html_entity_decode($content)));
    }

    public function updateChapter($title, $content, $id){
        $db = $this->dbConnect();
        $request = $db->prepare('UPDATE chapter set title = ?, content = ? where id = ?');
        $request->execute(array($title, $content, $id));

    }
    public function findChapter($title){
        $db = $this->dbConnect();
        $request = $db->prepare('SELECT * FROM chapter WHERE title = ?');
        $request->execute(array($title));
        return $request;
    }
    public function deleteChapter($id){
        $db = $this->dbConnect();
        $db->prepare('DELETE FROM chapter WHERE id =?')->execute(array($id));

    }


}