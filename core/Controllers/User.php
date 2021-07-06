<?php

namespace Controllers;

class User extends Controller
{
      protected $modelName = \Model\User::class;

public function login(){

   

        if(!empty($_POST['username']) && !empty($_POST['password'])){

            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            
            

            if($this->model->signIn($username, $password)){
                

            \Http::redirect('index.php');

            }else{
                die("not logged in");
            }
            

        }else{
            $userModel = new \Model\User();
    
            $user = $userModel->getUser();

        $titreDeLaPage = "Connexion";
        \Rendering::render('user/login', compact('user','titreDeLaPage'));
    }





}    
    
public function logout(){

        $this->model->signOut();
        \Http::redirect('index.php');
    }

public function register(){


    $user = $this->user;


    // si pas déja loggé
    /*  if($this->model->isLoggedIn()){
        echo "isloggedin";
    }else{ */

        if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])){

            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $email = htmlspecialchars($_POST['email']);
            
            

            $this->model->signup($username, $email, $password);
            

            \Http::redirect('index.php');

           

        }else{
            $userModel = new \Model\User();
    
            $user = $userModel->getUser();

        $titreDeLaPage = "Inscription";
        \Rendering::render('user/signup', compact('user','titreDeLaPage'));
    }

}

}