<?php

session_start();
require "/opt/lampp/htdocs/e-commerce/backend/api/commun_services.php";

// Cas où l'utilisateur est déjà connecté
if(isset($_SESSION['ident'])){
    produceError("utilisateur dejà connecté");
    return;
}

// Cas où la requête est mal formulée
//On teste si l'email n'est pas défini ou le password n'est pas défini
    if(!isset($_POST['email']) || !isset($_POST['password'])){
        produceErrorRequest();
        return;
    }

    try {
        $user = new UserEntity();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

       
        $dataAuth = $db->authentifier($user);

        if($dataAuth){
            $_SESSION['ident']=$dataAuth;
            produceResult(clearData($dataAuth));
        }else{
            produceError("Email ou password incorrecte. Merci de réessayer");
        }

    } catch (Exception $th) {
        produceError($th->getMessage());
    }


?>