<?php session_start();?>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="../" class="navbar-brand">Billet Simple pour L'alaska</a>

        </div>

            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <a href="#main">Liste des episodes</a>
                </li>
                <?php
                if (isset($_SESSION['id']) && isset($_SESSION['login']) ){
                    ?>
                    <li ><a href="logout.php">Deconnexion</a></li>
                    <?php
                }?>
            </ul>



    </div>
</div>
