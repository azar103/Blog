<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 21/11/2018
 * Time: 23:29
 */
require_once ('Manager.php');
class UserManager extends  Manager
{
    function login($login, $password){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM user WHERE  login = ? AND  password = ?');
        $req->execute(array($login, md5($password)));
        return $req;
    }

}