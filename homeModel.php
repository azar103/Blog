<?php
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
function getNumberOfPages($chapterPerPages){
    $db = dbConnect();
    $total_data = $db->query('SELECT COUNT(*)  AS total FROM chapter')->fetch();
    $total = $total_data['total'];
    $numberOfPages =ceil($total/$chapterPerPages);
    return $numberOfPages;
}
function getChapters(){
    $db = dbConnect();
    $chapterPerPages = 3;
    $numberOfPages = getNumberOfPages($chapterPerPages);
    if(isset($_GET['page'])){
        $actualPage = intval($_GET['page']);
        if($actualPage>$numberOfPages) {
            $actualPage = $numberOfPages;
        }
    }else{
        $actualPage = 1;
    }
    $firstEnter = ($actualPage-1)*$chapterPerPages;
    $req= $db->query('SELECT id, title, content, DATE_FORMAT(created_at ,"%d/%m/%Y à %Hh%imin%ss") AS date FROM chapter ORDER BY date DESC  LIMIT '.$firstEnter.', '.$chapterPerPages);

    return $req;
}
function deleteChapter($id){
    $db = dbConnect();
    $db->prepare('DELETE FROM chapter WHERE id =?')->execute(array($id));

}