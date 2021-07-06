<?php

/**
 * Obtient le nom de la classe avec laquelle nous voulons travailler.
 */

spl_autoload_register(function($nomDeClasse){

$nomDeClasse = str_replace("\\", "/", $nomDeClasse);


require_once "core/$nomDeClasse.php";



});