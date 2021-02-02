<?php
require_once 'commun_services.php';

if(!isset($_REQUEST['id']) || !isset($_REQUEST['idUser'])|| !isset($_REQUEST['idProduct']) || !isset($_REQUEST['quantity']) || !isset($_REQUEST['price'])){
    produceErrorRequest();
    return;
}

if(empty($_REQUEST['id']) || empty($_REQUEST['idUser'])||empty($_REQUEST['idProduct'])|| empty($_REQUEST['quantity']) || empty($_REQUEST['price'])){
    produceErrorRequest();
    return;
}

try {
    $order = new OrdersEntity();
    $order->setIdOrder($_REQUEST['id']);
    $order->setIdUser($_REQUEST['idUser']);
    $order->setIdProduct($_REQUEST['idProduct']);
    $order->setQuantity($_REQUEST['quantity']);
    $order->setPrice($_REQUEST['price']);

    $data = $db->updateOrders($order);

    if($data){
        produceResult("Commande modifiée avec succès");
    }else{
        produceError("Echec de la modification de la commande");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}


?>