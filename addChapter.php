<!-- Récupération Des Données -->
<?php
    require('addChapterModel.php');
        if(!empty($_POST)) {
            $errors = array();
            if (empty($_POST['title']) ) {
                $errors['title'] = "vous n'avez pas entrez de titre valide";
            }else{
                require ('connectToDb.php');
                $request= getChapter($_POST['title']);
                $chapter = $request->fetch();
                if($chapter){
                    $errors['message']="episode existant !";
                }
                $request->closeCursor();
            }
            if (empty($_POST['content'])) {
                $errors['content'] = "vous n'avez pas entrez de contenu valide";
            }
            if(strlen($_POST['content'])<100){
                $errors['content'] = "Vous devez rentrer 100 caractéres au moins !";
            }
            if(empty($errors)){
                if (isset($_POST['title']) && isset($_POST['content'])) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        addChapter($_POST['title'],$_POST['content']);
                        header('location: home.php');
                        $request->closeCursor();
                        exit();
                    }
                }
            }
        }
require('addChapterView.php');
