<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19/11/2018
 * Time: 17:02
 */
require ('functions.php');
function addChapter($title, $content){
    $db = dbConnect();
    $request = $db->prepare('INSERT INTO chapter(title, content, created_at) VALUES (?, ?, NOW())');
    $request->execute(array($title, html_entity_decode($content)));
}
function getChapter($title){
    $db = dbConnect();
    $request = $db->prepare('SELECT id FROM chapter WHERE title = ?');
    $request->execute(array($title));
    return $request;
}