<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelTime.php';


switch ($action) {
    
    case "moins" :
        if(!empty($_COOKIE['login'])){
        ModelTime::moins($_COOKIE['login']);
        $view = "Gerer";
        $retard1=ModelTime::recupRetard($_COOKIE['login']);
        $retard = $retard1[0];
        $pagetitle="Gérez le retard";
        }
        else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
    
        
    case "plus" :
        if(!empty($_COOKIE['login'])){
        ModelTime::plus($_COOKIE['login']);
        $view = "Gerer";
        $retard1=ModelTime::recupRetard($_COOKIE['login']);
        $retard = $retard1[0];
        $pagetitle="Gérez le retard";
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
    
    case "RecupRetard" :
        if(!empty($_COOKIE['login'])){
        $view="Gerer";
        $retard1=ModelTime::recupRetard($_COOKIE['login']);
        $retard = $retard1[0];
        $pagetitle="Gérez le retard";
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
}
    
require VIEW_PATH . "view.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

