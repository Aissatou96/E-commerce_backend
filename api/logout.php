<?php
   require "commun_services.php";
    session_start();

    if(isset($_SESSION['ident'])){
        unset($_SESSION['ident']);
        session_destroy();
        produceResult("Utilisateur déconnecté avec succès");
        return;
    }else{
        produceError("Utilisateur non connecté");
    }

?>