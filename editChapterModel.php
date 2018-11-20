<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19/11/2018
 * Time: 17:17
 */

function updateChapter($title, $content, $id){
    $db = dbConnect();
    $request = $db->prepare('UPDATE chapter set title = ?, content = ? where id = ?');
    $request->execute(array($title, $content, $id));
}
function findChapter($id){
    $db = dbConnect();
    $request = $db->prepare('SELECT * FROM chapter WHERE id = ?');
    $request->execute(array($id));
    return $request;

}

