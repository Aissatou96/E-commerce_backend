<?php
header('Content-Type: application/json; charset=utf-8');

define("API", dirname(__FILE__));
define("ROOT", dirname(API));
define("SP",DIRECTORY_SEPARATOR);
define("CONFIG", ROOT.SP."config");
define("MODEL", ROOT.SP."model");
define("ENTITY", ROOT.SP."entity");

require_once CONFIG.SP."config.php";
require_once MODEL.SP."DataLayer.class.php";
require_once ENTITY.SP."userEntity.php";
require_once ENTITY.SP."categoryEntity.php";
require_once ENTITY.SP."productEntity.php";
require_once ENTITY.SP."ordersEntity.php";

$db = new DataLayer();

function answer($response){

    // Recupérations des paramètres envoyés lors de l'appellation du service avec le superglobal $_REQUEST
    global $_REQUEST;

    //On ajoute les infos de la requête dans la variable $response avec comme clé 'args'
    $response['args'] = $_REQUEST;

    //On regarde s'il y a un password dans la response on le détruit avec la fonction unset
    unset($response['args']['password']);

    //On défint la date et l'heure de la requête
    $response['time'] = date('d/m/Y H:i:s');

    // On affiche la response en format json avec la fonction json_encode
    $json = json_encode($response);
    echo $json;
   

}

function produceError($message){
    answer(['status'=>404,'message'=>$message]);
}

function produceErrorAuth(){
    answer(['status'=>401,'message'=>'Erreur d\'authentification']);
}
 
function produceErrorRequest(){
    answer(['status'=>400,'message'=>'Requête mal formulée']);
}

function produceResult($result){
    $result = clearData($result);
    answer(['status'=>200,'message'=>$result]);
}

function clearData($objetMetier){
    $objetMetier = array($objetMetier);
    return $objetMetier;
}

function clearDataArray($array_obj_met){
    $result = [];
    foreach ($array_obj_met as $key => $value) {
      $result[$key] = clearData($value);
    }
}
?>