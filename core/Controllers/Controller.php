<?php

namespace Controllers;

//la palabra clave abstract es para evitar que la clase sea directamene usada,
// en vez de ser solo una base para otras clases

abstract class Controller
{

     protected $model;

     protected $modelName;

     protected $user;
     
        public function __construct(){

            $this->model = new $this->modelName();
        }



}