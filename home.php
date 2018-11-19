<?php
require('homeModel.php');
$numberOfPages = getNumberOfPages(3);
$req = getChapters();
if(isset($_GET['id'])){
    deleteChapter($_GET['id']);
}

require('homeView.php');

