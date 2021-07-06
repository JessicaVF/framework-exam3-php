<?php

//the namespace let us avoid confussions if we are calling
//the controller class with the same name 

namespace Model;

// this class is to be use as base, not to use directly
// "abstract" make sure it's impossible to use this class directly
abstract class Model
{
    protected $pdo;
    //the PDO gestiona la conexion con la base de datos, tengo que ir a getPdo() si quiero
    // cambiar la contrasena y database que quiero usar

    protected $table;

    //the table no sera definida en el modelo base, sino en cada modelo-hijo

    public function __construct(){
         $this->pdo = \Database::getPdo();
    }

// A continuacion las funciones a usar en general por todas las clases.
// Cabe resaltar que las funciones que son ultraespecificas de una funcion no estan aca:

/**
 * trouver un élément par son id
 * renvoie un tableau contenant l'élément, ou un booleen
 * si inexistant
 * 
 * @param integer $id
 * @return array|bool
 */
public function find(int $id)
{

 

  $maRequete = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id =:id");

  $maRequete->execute(['id' => $id]);

  $item = $maRequete->fetch();

  return $item;

}
    /**
 * retourne un tableau contenant tous les éléments de 
 * une table
 * 
 * @return array
 */
public function findAll() : array
{
       

        $resultat =  $this->pdo->query("SELECT * FROM {$this->table}");
        
        $items = $resultat->fetchAll();

        return $items;

}


/**
 * supprime un élément via son ID
 * @param integer $id
 * @return void
 */
public function delete(int $id) :void
{
 

  $maRequete = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id =:id");

  $maRequete->execute(['id' => $id]);


} 

}