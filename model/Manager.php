<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22/11/2018
 * Time: 12:25
 */

class Manager
{
    protected function dbConnect(){
        try{
            $db = new \PDO( 'mysql:host=localhost;dbname=blogdb;charset=utf8','root',''
            );
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
            die('Erreur  :'.$e->getMessage());
        }
        return $db;
    }
}