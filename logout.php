<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14/11/2018
 * Time: 10:30
 */
session_start();
$_SESSION = array();
session_destroy();
header('location: login.php');
exit();