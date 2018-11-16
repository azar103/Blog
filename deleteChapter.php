<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15/11/2018
 * Time: 20:49
 */
ini_set('display_errors', 1);
require ('connectToDb.php');
$req = $db->prepare('DELETE FROM chapter WHERE id = ?')
          ->execute(array($_GET['id']));


header('location: index.php');
exit();