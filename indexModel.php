<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19/11/2018
 * Time: 17:35
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
function login($login, $password){
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM user WHERE  login = ? AND  password = ?');
    $req->execute(array($login, md5($password)));
    return $req;
}