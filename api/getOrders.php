<?php
    require_once 'commun_services.php';

    try {
       $orders = $db->getOrders();
        if ($orders) {
            produceResult(clearDataArray($orders));
        }else{
            produceError("Problème de récupération des commandes");
        }
    } catch (Exception $th) {
        produceError("Echec de récuperation des commandes");
    }
?>