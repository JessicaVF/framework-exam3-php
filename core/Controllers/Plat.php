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

}