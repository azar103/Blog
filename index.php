<?php
require ('indexModel.php');
if(!empty($_POST)){
    $errors = array();
    if(empty($_POST['login']) || !preg_match('/^[a-z0-9_]+$/', $_POST['login'])){
        $errors['login'] = "vous n'avez pas entrez de login valide";
    }
    else if(empty($_POST['password'])){
        $errors['password'] = "vous n'avez pas entrez de mot de passe valide";
    }
    else{
        session_start();
        if(isset($_POST['login']) AND isset($_POST['password'])){
            $req = login($_POST['login'], $_POST['password']);
            $result = $req->fetch();
            if($result){
                session_start();
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
require('indexView.php');
