<?php

namespace Controllers;

class Plat extends Controller
{

    protected $modelName = \Model\Plat::class;

    public function supprPlatApi(){
        if(!empty($_POST['id']) && ctype_digit ($_POST['id'])){
            $plat_id = $_POST['id'];
            $plat= $this->model->find($plat_id, $this->modelName);
            if(!$plat){
                die("Ce plat n'existe pas");
            }
            
            $this->model->delete($plat_id);
        }
        else{
            die("il faut entrer un id...");
        }
        header("Access-Control-Allow-Origin: *");    
    }


    public function addPlatApi(){

        if(!empty($_POST['platName'])&!empty($_POST['platDescription'])&!empty($_POST['platPrice'])&!empty($_POST['restaurantId'])){
            $namePlat = $_POST['platName'];
            $descriptionPlat = $_POST['platDescription'];
            $pricePlat = $_POST['platPrice'];
            $restaurantId = $_POST['restaurantId'];
        }
        else{
            $message ="Form mal rempli";
            header("Access-Control-Allow-Origin: *");  
            echo json_encode($message);
            die();
        }
        $this->model->insert($namePlat, $descriptionPlat, $pricePlat, $restaurantId);
        header("Access-Control-Allow-Origin: *");  
        

    }
}