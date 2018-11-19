<!-- Recupération des Données-->
<?php
if(!empty($_POST)){
    $errors = array();
    if(empty($_POST['login']) || !preg_match('/^[a-z0-9_]+$/', $_POST['login'])){
        $errors['login'] = "vous n'avez pas entrez de login valide";
    }
    else if(empty($_POST['password'])){
        $errors['password'] = "vous n'avez pas entrez de mot de passe valide";
    }
    else{
        require('connectToDb.php');
        session_start();
        if(isset($_POST['login']) AND isset($_POST['password'])){
            $response = $db->prepare('SELECT * FROM user WHERE  login = ? AND  password = ?');
            $response->execute(array($_POST['login'], md5($_POST['password'])));
            $result = $response->fetch();
            if($result){
                $_SESSION['id'] = $result['id'];
                $_SESSION['login'] = $result['login'];
                header('location: home.php');
                exit();
            }else{

                $errors['message'] = "vous n'avez pas entrez de login et/ou mot de passe valide";
            }
        }
    }

}
require('affichageAuthentification.php');
