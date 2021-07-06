<?php

namespace Model;
use PDO;

class Plat extends Model{

    protected $table = "plats";
    public $id, $name, $price, $description, $restaurant_id;

    public function findAllByRestaurant(int $restaurant_id, $className){
        
        $maRequete = $this->pdo->prepare("SELECT * FROM $this->table WHERE restaurant_id =:restaurant_id");
        
        $maRequete->execute(['restaurant_id' =>$restaurant_id]);
        
        $plats = $maRequete->fetchAll(PDO::FETCH_CLASS, $className);
        
        return $plats;

    }
    public function insert(string $namePlat, string $descriptionPlat, int $pricePlat, int $restaurantId){
        
        $queryAdd = $this->pdo->prepare("INSERT INTO $this->table (name, price, description, restaurant_id) VALUES (:name, :price, :description, :restaurant_id)");
        $queryAdd->execute(['name' =>$namePlat, 'price'=>$pricePlat, 'description' =>$descriptionPlat, 'restaurant_id' => $restaurantId]);   
        // $newPlat = $queryAdd->fetch(PDO::FETCH_CLASS, $className);
    }
    

}