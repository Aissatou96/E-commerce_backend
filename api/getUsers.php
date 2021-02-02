<?php
    require_once 'commun_services.php';

    try {
        $users = new UserEntity();
       $users = $db->getUsers();
        if ($users) {
            produceResult(clearDataArray($users));
        }else{
            produceError("Problème de récupération des utilisateurs");
        }
    } catch (Exception $th) {
        produceError("Echec de récuperation des utilisateurs");
    }
?>