<?php
require_once 'commun_services.php';

if(!isset($_REQUEST['id']) || !isset($_REQUEST['name'])||!isset($_REQUEST['description'])|| !isset($_REQUEST['price']) || !isset($_REQUEST['stock'])||!isset($_REQUEST['category']) || !isset($_REQUEST['image'])){
    produceErrorRequest();
    return;
}

if(empty($_REQUEST['id']) || empty($_REQUEST['name'])||empty($_REQUEST['description'])|| empty($_REQUEST['price']) || empty($_REQUEST['stock']) || empty($_REQUEST['category']) || empty($_REQUEST['image'])){
    produceErrorRequest();
    return;
}

try {
    $product = new ProductEntity();
    $product->setIdProduct($_REQUEST['id']);
    $product->setName($_REQUEST['name']);
    $product->setDescription($_REQUEST['description']);
    $product->setPrice($_REQUEST['price']);
    $product->setStock($_REQUEST['stock']);
    $product->setCategory($_REQUEST['category']);
    $product->setImage($_REQUEST['image']);

    $data = $db->updateProduct($product);

    if($data){
        produceResult("Product updated successfully");
    }else{
        produceError("Echec de la modification");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}


?>