<?php
require_once 'commun_services.php';

if(!isset($_POST['sexe'])||!isset($_POST['pseudo'])|| !isset($_POST['firstname']) || !isset($_POST['lastname'])||!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['dateBirth']) ){
    produceErrorRequest();
    return;
}

if(empty($_POST['sexe'])||empty($_POST['pseudo'])|| empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['dateBirth'])){
    produceErrorRequest();
    return;
}

try {
    $user = new UserEntity();
    $user->setSexe($_POST['sexe']);
    $user->setPseudo($_POST['pseudo']);
    $user->setFirstname($_POST['firstname']);
    $user->setLastname($_POST['lastname']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setDateBirth($_POST['dateBirth']);

    $result = $db->createUser($user);

    if($result){
        produceResult("Utilisateur créé avec succès");
    }else{
        produceError("Echec de création de l'utilisateur");
    }

} catch (Exception $th) {
   produceError($th->getMessage());
}

?>