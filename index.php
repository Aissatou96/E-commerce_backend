<?php
    require_once 'config/config.php';
    require_once 'entity/userEntity.php';
    require_once 'model/DataLayer.class.php';
    require_once 'entity/categoryEntity.php';
    require_once 'entity/productEntity.php';
    require_once 'entity/ordersEntity.php';

    $db = new DataLayer();

    // $users = $db->getUsers();
    // $categories = $db->getCategory();
    // $products = $db->getProduct();
    // $orders = $db->getOrders();

    $user = new UserEntity();

    $user->setPseudo("Abdoul");
    $user->setFirstname("Abdoulaye");
    $user->setLastname("FALL");
    $user->setDateBirth("11/11/1999");
    $user->setSexe(1);
    $user->setEmail("laye@email.com");
    $user->setPassword("layedoudou");
    $db->createUser($user);
 

    // $category = new CategoryEntity();
    // $category->setName("Jupe Femmes");
    // $category->setIdCategory(2);

    // $order = new OrdersEntity();
    // $order->setIdUser(11);
    // $order->setIdProduct(15);
    // $order->setPrice(345.56);
    // $order->setQuantity(2);
    // $order->setIdOrder(7);

    // $product = new ProductEntity();
    // $product->setName("PULL");
    // $product->setDescription("PULL LONG");
    // $product->setPrice(234.8);
    // $product->setStock(350);
    // $product->setCategory(2);
    // $product->setImage("b5.png");
    // $product->setIdProduct(2);

    // $user->setEmail("jean25@gmail.com");
    // $user->setPassword("danielle2020");
    $var = $db->createUser($user);
    var_dump($var);

?>