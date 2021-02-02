<?php
require_once 'commun_services.php';

if(!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])){
    produceErrorRequest();
    return;
}

try {
    $product = new ProductEntity();

    $product->setIdProduct($_REQUEST['id']);

    $data = $db->deleteProduct($product);

    if($data){
        produceResult("Suppression réussie!");
    }else{
        produceError("Echec de la suppression");
    }
    
} catch (Exception $th) {
    produceError($th->getMessage());
}

?>