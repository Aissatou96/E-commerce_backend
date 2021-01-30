<?php

require_once 'commun_services.php';
require_once 'model/DataLayer.class.php';

$user = new UserEntity();
$user->setEmail("contact@contact.com");
$user->setPassword("azerty");
//var_dump(clearData($user));

$db = new DataLayer();
$conn = $db->authentifier($user);
echo $conn;
?>