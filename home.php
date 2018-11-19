<!-- Recupération des Données-->
<?php
require ('connectToDb.php');
$chapterPerPages = 3;
$total_data = $db->query('SELECT COUNT(*)  AS total FROM chapter')->fetch();
$total = $total_data['total'];
$numberOfPages =ceil($total/$chapterPerPages);
$actualPage = 0;
if(isset($_GET['page'])){
    $actualPage = intval($_GET['page']);
    if($actualPage>$numberOfPages) {
        $actualPage = $numberOfPages;
    }
}else{
    $actualPage = 1;
}
$firstEnter = ($actualPage-1)*$chapterPerPages;
$response = $db->query('SELECT id, title, content, DATE_FORMAT(created_at ,"%d/%m/%Y à %Hh%imin%ss") AS date FROM chapter ORDER BY date DESC  LIMIT '.$firstEnter.', '.$chapterPerPages);
require ('affichageHome.php');

