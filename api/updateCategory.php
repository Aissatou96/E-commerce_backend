<?php
require_once 'commun_services.php';

if(!isset($_REQUEST['id']) || !isset($_REQUEST['name'])){
    produceErrorRequest();
    return;
}

if(empty($_REQUEST['id']) || empty($_REQUEST['name'])){
    produceErrorRequest();
    return;
}



try {

    $category = new CategoryEntity();
    $category->setIdCategory($_REQUEST['id']);
    $category->setName($_REQUEST['name']);
    
    $data = $db->updateCategory($category);

    if($data){
        produceResult("Category updated successfully");
    }else{
        produceError("Echec de la modification");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}

?>