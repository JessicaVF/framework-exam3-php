<?php

// namespace Model;
//->the namespace let us avoid confussions if we are calling
//the controller class with the same name
namespace Model;

class Exemple extends Model {
    protected $table = "exemples";
    // ->the table make references to the specific table from
    // the database this class is going to use. The name have 
    // to be perfect match


    
}