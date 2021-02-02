<?php
require_once 'commun_services.php';

if(!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])){
    produceErrorRequest();
    return;
}

try {
    $category = new CategoryEntity();

    $category->setIdCategory($_REQUEST['id']);

    $data = $db->deleteCategory($category);

    if($data){
        produceResult("Suppression réussie!");
    }else{
        produceError("Echec de la suppression");
    }
    
} catch (Exception $th) {
    produceError($th->getMessage());
}

?>