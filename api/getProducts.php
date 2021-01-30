<?php
    require_once 'commun_services.php';

    try {
       $categories = $db->getProduct();
        if ($product) {
            produceResult(clearDataArray($product));
        }else{
            produceError("Problème de récupération des produits");
        }
    } catch (Exception $th) {
        produceError("Echec de récuperation des produits");
    }
?>