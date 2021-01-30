<?php
    require_once 'commun_services.php';

    try {
       $categories = $db->getCategory();
        if ($categories) {
            produceResult(clearDataArray($categories));
        }else{
            produceError("Problème de récupération des données");
        }
    } catch (Exception $th) {
        produceError("Echec de récuperation des categories");
    }
?>