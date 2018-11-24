<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 22/11/2018
 * Time: 10:20
 */
require_once ('Manager.php');
class Pagination extends  Manager
{
    private $_chapterPerPages = 3;
    private $_commentsPersPages = 5;
    public function chapterPerPages(){
        return $this->_chapterPerPages;
    }
    public function commentsPerPage(){
        return $this->_commentsPersPages;
    }
    public function getTotalPages(){
        $db = $this->dbConnect();
        $total_data = $db->query('SELECT COUNT(*)  AS total FROM chapter')->fetch();
        $total = $total_data['total'];
        return $total;
    }
    function getNumberOfPages($chapterPerPages){
        $total = $this->getTotalPages();
        $numberOfPages =ceil($total/$chapterPerPages);
        return $numberOfPages;
    }
    public function actualPage(){
        $numberOfPages = $this->getNumberOfPages($this->_chapterPerPages);
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
    function firstEnter(){
        $actualPage = $this->actualPage();
       return ($actualPage-1)*$this->_chapterPerPages;
    }
    function actualCommentPage(){
        $numberOfPages= $this->getNumberOfPagesOfComments(5);
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
        $db = $this->dbConnect();
        $total_data = $db->query('SELECT COUNT(*)  AS total FROM comments WHERE chapter_id = '.$_GET['id'])->fetch();
        $total = $total_data['total'];
        $numberOfPages =ceil($total/$commentsPerPage);

        return $numberOfPages;
    }
    function firstEnterComment(){
        $commentsPerPages = $this->commentsPerPage();
        $numberOfPages = $this->getNumberOfPagesOfComments($commentsPerPages);
        $actualPage = $this->actualCommentPage();
        $firstEnter = ($actualPage-1)*$commentsPerPages;
        return $firstEnter;
    }

}