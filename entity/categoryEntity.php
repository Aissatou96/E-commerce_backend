<?php
    class CategoryEntity{
        
        protected ?int $idCategory;
        protected string $name;

        function getIdCategory() { 
            return $this->idCategory; 
        } 
   
       function setIdCategory($idCategory) {  
           $this->idCategory = $idCategory; 
        } 
   
       function getName() { 
            return $this->name; 
        } 
   
       function setName($name) {  
           $this->name = $name; 
        } 

    }





	
?>