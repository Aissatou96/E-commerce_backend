<?php

require_once 'commun_services.php';

$user = new UserEntity();
$user->setEmail("contact@contact.com");
$user->setPassword("azerty");
//var_dump(clearData($user));

produceResult($user);
?>