<?php
    class UserEntity{
        
        protected ?int $idUser;
        protected string $pseudo;
        protected string $email;
        protected ?int $sexe;
        protected ?string $password;
        protected ?string $firstname;
        protected ?string $lastname;
        protected string $description;
        protected string $adresse_livraison;
        protected string $adresse_facturation;
        protected ?string $tel;
        protected ?string $dateBirth;
        protected string $createdAt;

        function getIdUser() { 
            return $this->idUser; 
       } 
   
       function setIdUser($idUser) {  
           $this->idUser = $idUser; 
       } 
   
       function getPseudo() { 
            return $this->pseudo; 
       } 
   
       function setPseudo($pseudo) {  
           $this->pseudo = $pseudo; 
       } 
   
       function getEmail() { 
            return $this->email; 
       } 
   
       function setEmail($email) {  
           $this->email = $email; 
       } 
   
       function getSexe() { 
            return $this->sexe; 
       } 
   
       function setSexe($sexe) {  
           $this->sexe = $sexe; 
       } 
   
       function getPassword() { 
            return $this->password; 
       } 
   
       function setPassword($password) {  
           $this->password = $password; 
       } 
   
       function getFirstname() { 
            return $this->firstname; 
       } 
   
       function setFirstname($firstname) {  
           $this->firstname = $firstname; 
       } 
   
       function getLastname() { 
            return $this->lastname; 
       } 
   
       function setLastname($lastname) {  
           $this->lastname = $lastname; 
       } 
   
       function getDescription() { 
            return $this->description; 
       } 
   
       function setDescription($description) {  
           $this->description = $description; 
       } 
   
       function getAdresselivraison() { 
            return $this->adresselivraison; 
       } 
   
       function setAdresselivraison($adresselivraison) {  
           $this->adresselivraison = $adresselivraison; 
       } 
   
       function getAdressefacturation() { 
            return $this->adressefacturation; 
       } 
   
       function setAdressefacturation($adressefacturation) {  
           $this->adressefacturation = $adressefacturation; 
       } 
   
       function getTel() { 
            return $this->tel; 
       } 
   
       function setTel($tel) {  
           $this->tel = $tel; 
       } 
   
       function getDateBirth() { 
            return $this->dateBirth; 
       } 
   
       function setDateBirth($dateBirth) {  
           $this->dateBirth = $dateBirth; 
       } 
   
       function getCreatedAt() { 
            return $this->createdAt; 
       } 
   
       function setCreatedAt($createdAt) {  
           $this->createdAt = $createdAt; 
       } 

    }





	
?>