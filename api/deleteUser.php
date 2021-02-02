<?php
require_once 'commun_services.php';

if(!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])){
    produceErrorRequest();
    return;
}

try {
    $user = new UserEntity();

    $user->setIdUser($_REQUEST['id']);

    $data = $db->deleteUsers($user);

    if($data){
        produceResult("Suppression réussie!");
    }else{
        produceError("Echec de la suppression");
    }
    
} catch (Exception $th) {
    produceError($th->getMessage());
}

?>