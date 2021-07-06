<?php

namespace Controllers;

class Restaurant extends Controller{

    protected $modelName = \Model\Restaurant::class;

    public function indexApi()
    
    {
        
     $restaurants = $this->model->findAll($this->modelName);

      header('Access-Control-Allow-Origin: *');

      
      echo json_encode($restaurants);


    }


    /**
     * 
     * 
     * show a single restaurant and it's plats. API version
     * 
     * 
     * 
     */
    public function showApi()
    {

      $id= null;
            if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
                $id = $_GET['id'];
            }
        
        
        
    $restaurant = $this->model->find($id, $this->modelName);
    
    
        
        
     
  
        $platModel = new \Model\Plat();

        
        
        $plats = $platModel->findAllByRestaurant($id, \Model\Plat::class);
        
        
       
           header('Access-Control-Allow-Origin: *');
            echo json_encode(
                [
                'restaurant' => $restaurant, 
                'plats' => $plats
                ]
            );


    }












}