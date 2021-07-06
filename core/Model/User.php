<?php
namespace Model;

class User extends Model


{

    protected $table = 'users';


    public $id;

    public $username;

    public $password;

    public $email;


    public function isLoggedIn()
    {

        if(isset($_SESSION["user"]["id"]) 
        && !empty($_SESSION["user"]["id"])
        ){


            return true;
        }else{

            return false;
        }



    }

    public function getUser(){

        if($this->isLoggedIn()){

              $user =  $this->find($_SESSION["user"]["id"], \Model\User::class);
              return $user;

        }else{
            return false;
        }

    }

        public function signIn($username, $password)
        {
            $user = $this->findByUsername($username);
            if(!$user){
                die('existe pas');
            }

            if($password == $user->password){

               
               

                $_SESSION["user"] = [
                                        "id" => $user->id,
                                        "username" => $user->username,
                                        "email" => $user->email

                                    ];

                
                return true;
            }else{
                return false;
            }


        }

        public function findByUsername(string $username)
        {

            $sql = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
            $sql->execute(['username' => $username]);
            $user = $sql->fetchObject(\Model\User::class);
            
            if(!$user){
                return false;
            }else{
                return $user;
            }


        }


        public function signOut()
        {
            session_unset();
        }

       public function signUp(string $username, string $email, string $password)
       {

        $maRequete = $this->pdo->prepare("INSERT INTO users (username, password, email) 
        VALUES (:username, :password, :email)");

          $maRequete->execute([
          'username' => $username,
          'password' => $password,
          'email' => $email
       

          ]);

       }

       /**
        * 
        * est-ce que je suis l'auteur de ca - ca est le parametre : une recette ou un gateau
        */


       public function isAuthor(object $gateauOuRecette)
       //  public function isAuthor(object $gateauOuRecette)
       {
            /// on veut comparer $this-id au user_id de cette recette ou ce gateau

            if( $this->id == $gateauOuRecette->user_id ){
                return true;
            }else{

                return false;
            }

       }

       public function hasMade(object $gateauOuRecette)
       {
       
                $modelMake = new \Model\Make();
        if(   $modelMake->findByUser( $this ,  $gateauOuRecette)                   )
        {
            return true;
        }else{
            return false;
        }

       }
    


    
}