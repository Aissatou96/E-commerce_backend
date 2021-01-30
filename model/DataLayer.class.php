<?php
    class DataLayer{
        
        private $connexion;

        /**
         * Connexion à la base de données dans le constructeur __construct
         */
        function __construct()
        {
            $var="mysql:host=".HOST.";db_name=".DB_NAME;

            try {
                $this->connexion = new PDO($var,DB_USER, DB_PASSWORD);
                //echo "connexion réussie!";
            } catch (PDOException $e) {
               echo $e->getMessage();
            }
        }

        /**
         * Méthode d'authentification d'un user
         * @param UserEntity $user objet métier décrivant un utilisateur
         * @return UserEntity $user objet métier décrivant l'utilisateur authentifié
         * @return FALSE en cas d'échec d'authentification
         * @return NULL en cas d'exception déclanchée
         */
         function authentifier(UserEntity $user){
            $sql = "SELECT * FROM `e-commerce`.`customers` WHERE email =:email";

            try {
                $result = $this->connexion->prepare($sql);
                $var = $result->execute(array(
                    ':email'=>$user->getEmail()
                ));

                $data = $result->fetch(PDO::FETCH_OBJ);

                if($data && ($data->password == sha1($user->getPassword()))){
                    //authentification réussie
                    $user->setIdUser($data->id);
                    $user->setSexe($data->sexe);
                    $user->setFirstname($data->firstname);
                    $user->setLastname($data->lastname);
                    $user->setPassword(NULL);
                    $user->setAdressefacturation($data->adresse_facturation);
                    $user->setAdresselivraison($data->adresse_livraison);
                    $user->setTel($data->tel);
                    $user->setDateBirth($data->dateBirth);
                    return $user;
                }else{
                    //authentification échouée
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
         }

        /**
         * CREATE
         */
        function createUser(UserEntity $user){
            $sql = "INSERT INTO customers(sexe,pseudo,email,,password,firstname,lastname,dateBirth) VALUES (:sexe,:pseudo,:email,:password,:firstname,:lastname,:dateBirth)";

            try {
                $result = $this->connexion->prepare($sql);
                $data = $result->execute(array(
                    ':sexe'=> $user->getSexe(),
                    ':pseudo'=> $user->getPseudo(),
                    ':email'=> $user->getEmail(),
                    ':password'=> sha1($user->getPassword()), //password crypté avec la fonction sha1
                    ':firstname'=> $user->getFirstname(),
                    ':lastname'=> $user->getLastname(),
                    ':dateBirth'=> $user->getDateBirth()
                ));

                if($data){
                    return TRUE;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
        }

        function createCategory(CategoryEntity $category){
            $sql="INSERT INTO `category`(`name`) VALUES (:name)";

            try {
                $result = $this->connexion->prepare($sql);
                $data = $result->execute(array(
                   ':name' => $category->getName()
                ));

                if($data){
                    return TRUE;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
        }

        function createProduct(ProductEntity $product){
            $sql = "INSERT INTO `product`(`name`, `description`, `price`, `stock`, `category`, `image`) VALUES (:name,:description,:price,:stock,:category,:image)";

            try {
                $result = $this->connexion->prepare($sql);
                $data = $result->execute(array(
                    ':name'=> $product->getName(),
                    ':description'=> $product->getDescription(),
                    ':price'=> $product->getPrice(),
                    ':stock'=> $product->getPrice(),
                    ':category'=> $product->getCategory(),
                    ':image'=> $product->getImage()
                ));

                if($data){
                    return TRUE;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
               return NULL;
            }
        }

        function createOrders(OrdersEntity $orders){
            $sql = "INSERT INTO `orders`(`id_customers`, `id_product`, `quantity`, `price`) VALUES (:idCustomer,:idProduct,:quantity,:price)";

            try {
                $result = $this->connexion->prepare($sql);
                $data = $result->execute(array(
                    ':idCustomer'=> $orders->getIdUser(),
                    ':idProduct'=> $orders->getIdProduct(),
                    ':quantity'=> $orders->getQuantity(),
                    ':price'=> $orders->getPrice()
                ));

                if($data){
                    return TRUE;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
               return NULL;
            }
        }

        /**
         * READ
         */
        function getUsers(){
            $sql='SELECT * FROM `e-commerce`.`customers`';

            try {
                $result = $this->connexion->prepare($sql);
                $var = $result->execute();
                $users = [];

                /**
                 * On utilise la boucle while pour parcourir toutes les lignes de la table et on recupère chaque ligne avec la fonction fetch(); Pour que la variable qui reçoit les données ($data) soit un objet on utilise fetch(PDO::FETCH_OBJ) qui fera de $data un objet métier.
                 * Donc à chaque fois on parcoure la table avec la boucle while, on créé un objet métier($user),on met les objets dedans et au final on met l'objet metier $user dans le tableau $users[]
                 */
                while($data = $result->fetch(PDO::FETCH_OBJ)){
                    $user = new UserEntity();
                    $user->setIdUser($data->id);
                    $user->setEmail($data->email);
                    $user->setSexe($data->sexe);
                    $user->setFirstname($data->firstname);
                    $user->setLastname($data->lastname);
                    $users[]= $user;
                }
               
                if($users){
                    return $users;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
        }

        function getCategory(){
            $sql='SELECT * FROM `e-commerce`.`category`';

            try {
                $result = $this->connexion->prepare($sql);
                $var = $result->execute();
                $categories = [];

                while($data = $result->fetch(PDO::FETCH_OBJ)){
                    $category = new CategoryEntity;
                    $category->setIdCategory($data->id);
                    $category->setName($data->name);
                    $categories[]= $category;
                }
               
                if($categories){
                    return $categories;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
        }


        function getProduct(){
            $sql='SELECT * FROM `e-commerce`.`product`';

            try {
                $result = $this->connexion->prepare($sql);
                $var = $result->execute();
                $products = [];

                while($data = $result->fetch(PDO::FETCH_OBJ)){
                    $product = new ProductEntity;
                    $product->setIdProduct($data->id);
                    $product->setName($data->name);
                    $product->setDescription($data->description);
                    $product->setPrice($data->price);
                    $product->setStock($data->stock);
                    $product->setImage($data->image);
                    $product->setCategory($data->category);
                    $product->setCreatedAt($data->createdat);
                    $products[]= $product;
                }
               
                if($products){
                    return $products;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
        }

        function getOrders(){
            $sql='SELECT * FROM `e-commerce`.`orders`';

            try {
                $result = $this->connexion->prepare($sql);
                $var = $result->execute();
                $orders = [];

                while($data = $result->fetch(PDO::FETCH_OBJ)){
                    $order = new OrdersEntity;
                    $order->setIdOrder($data->id);
                    $order->setIdUser($data->id_customers);
                    $order->setIdProduct($data->id_product);
                    $order->setPrice($data->price);
                    $order->setQuantity($data->quantity);
                    $order->setCreatedAt($data->createdat);
                    
                    $orders[]= $order;
                }
               
                if($orders){
                    return $orders;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
  
        }

        /**
         * UPDATE
         */
        function updateUsers(UserEntity $user){
            $sql = "UPDATE `e-commerce`.`customers` SET";

            try {
               $sql.= " pseudo = '".$user->getPseudo()."',";
               $sql.= " email = '".$user->getEmail()."',";
               $sql.= " sexe = ".$user->getSexe().",";
               $sql.= " firstname = '".$user->getFirstname()."',";
               $sql.= " lastname = '".$user->getLastname()."',";
               $sql.= " adresse_facturation = '".$user->getAdressefacturation()."',";
               $sql.= " adresse_livraison = '".$user->getAdresselivraison()."'";

               $sql.= " WHERE id=".$user->getIdUser();

               $result = $this->connexion->prepare($sql);
               $var = $result->execute();

               if($var){
                   return TRUE;
               }else{
                   return FALSE;
               }
              
            } catch (PDOException $th) {
               return NULL;
            }
        }

        function updateProduct(ProductEntity $product){
            $sql = "UPDATE `e-commerce`.`product` SET";

            try {
               $sql.= " name = '".$product->getName()."',";
               $sql.= " description = '".$product->getDescription()."',";
               $sql.= " price = ".$product->getPrice().",";
               $sql.= " stock = '".$product->getStock()."',";
               $sql.= " category = '".$product->getCategory()."',";
               $sql.= " image = '".$product->getImage()."'";
               
               $sql.= " WHERE id=".$product->getIdProduct();

               $result = $this->connexion->prepare($sql);
               $var = $result->execute();

               if($var){
                   return TRUE;
               }else{
                   return FALSE;
               }
              
            } catch (PDOException $th) {
               return NULL;
            }
        }

        function updateCategory(CategoryEntity $category){
            $sql = "UPDATE `e-commerce`.`category` SET" ;

            try {
                $sql.= " name = '".$category->getName()."'";

                $sql.= " WHERE id=".$category->getIdCategory();

               $result = $this->connexion->prepare($sql);
               $var = $result->execute();
            
               if($var){
                   return TRUE;
               }else{
                   return FALSE;
               }
              
            } catch (PDOException $th) {
               return NULL;
            }
        }

        function updateOrders(OrdersEntity $order){
            $sql = "UPDATE `e-commerce`.`orders` SET";

            try {
               $sql.= " id_customers = '".$order->getIdUser()."',";
               $sql.= " id_products = '".$order->getIdProduct()."',";
               $sql.= " quantity = ".$order->getQuantity().",";
               $sql.= " price = '".$order->getPrice()."'";
               
               
               $sql.= " WHERE id=".$order->getIdOrder();

               $result = $this->connexion->prepare($sql);
               $var = $result->execute();
               
               if($var){
                   return TRUE;
               }else{
                   return FALSE;
               }
              
            } catch (PDOException $th) {
               return NULL;
            }
        }


         /**
         * DELETE
         */
        function deleteUsers(UserEntity $user){
            $sql = "DELETE FROM `e-commerce`.`customers` WHERE id=".$user->getIdUser();

            try {
                $result = $this->connexion->prepare($sql);
                $var = $result->execute();

                if($var){
                    return TRUE;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
        }

        function deleteProduct(ProductEntity $product){
            $sql = "DELETE FROM `e-commerce`.`product` WHERE id=".$product->getIdProduct();

            try {
                $result = $this->connexion->prepare($sql);
                $var = $result->execute();

                if($var){
                    return TRUE;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
        }

        function deleteCategory(CategoryEntity $category){
            $sql = "DELETE FROM `e-commerce`.`category` WHERE id=".$category->getIdCategory();

            try {
                $result = $this->connexion->prepare($sql);
                $var = $result->execute();

                if($var){
                    return TRUE;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
        }
        
        function deleteOrders(OrdersEntity $order){
            $sql = "DELETE FROM `e-commerce`.`orders` WHERE id=".$order->getIdOrder();

            try {
                $result = $this->connexion->prepare($sql);
                $var = $result->execute();

                if($var){
                    return TRUE;
                }else{
                    return FALSE;
                }
            } catch (PDOException $th) {
                return NULL;
            }
        }
    }




?>